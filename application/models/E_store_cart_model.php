<?php
/**
 * Created by PhpStorm.
 * User: Steven Chen
 * Date: 2016/1/13
 * Time: 16:29
 */

class E_Store_Cart_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function confirm_order( $order, $jsonAlert )
    {
        $this->db->trans_begin();

        $insertableOrder = array(
            'total_weight'      =>  0,
            'subtotal'          =>  0,
            'grand_total'       =>  0,
            'qty_total_item_ordered'    =>  0,
            'create_time'       =>  date("Y-m-d h:i:s"),
            'last_update'       =>  date("Y-m-d h:i:s"),
            'order_status'      =>  1,
            'payment_status'    =>  1,
            'payment_method'    =>  $order->payment_method,
            'delivery_method'   =>  $order->delivery_method,
            'receiver_name'     =>  $order->receiver_name,
            'receiver_phone'    =>  $order->receiver_phone,
            'receiver_email'    =>  $order->receiver_email,
            'receiver_address'  =>  $order->receiver_address,
            'receiver_city'     =>  $order->receiver_city,
            'customer_id'       =>  isset( $_SESSION['customer'] ) ? $_SESSION['customer']['id'] : null
        );

        $this->db->insert('t_e_store_order', $insertableOrder);
        $order_id = $this->db->insert_id();
        $order->id = $order_id;

        $total_weight = 0.00;
        $subtotal = 0.00;
        $shipping_fee = 0.00;
        $shipping_area = '';
        $courier_id = '';
        $gst = 0.00;

        $orderItems = array();

        /** 如果是会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();

                $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                if( $cartItemsObjQuery->num_rows() > 0 )
                {
                    $cartItemsObj = $cartItemsObjQuery->result_object();
                    foreach( $cartItemsObj as $cartItemObj )
                    {
                        $total_weight += intval( $cartItemObj->unit_weight * $cartItemObj->qty_ordered );
                        $subtotal += floatval( $cartItemObj->unit_price * $cartItemObj->qty_ordered );

                        array_push( $orderItems, array(
                            'order_id'              =>  $order_id,
                            'commodity_id'          =>  $cartItemObj->commodity_id,
                            'e_store_sku'           =>  $cartItemObj->e_store_sku,
                            'is_e_store_created'    =>  $cartItemObj->is_e_store_created,
                            'name'                  =>  $cartItemObj->name,
                            'qty_ordered'           =>  $cartItemObj->qty_ordered,
                            'unit_cost'             =>  0,
                            'unit_price'            =>  $cartItemObj->unit_price,
                            'unit_weight'           =>  $cartItemObj->unit_weight,
                            'unit_gst'              =>  $cartItemObj->unit_price - ( $cartItemObj->unit_price / 1.15 )
                        ) );
                    }
                    $gst += floatval( $subtotal - ( $subtotal / 1.15 ) );

                    /** 清空购物车
                     */
                    $this->db->delete('t_e_store_cart_item', array(
                        'cart_id'   =>  $cartModel['id']
                    ));
                    $this->db->delete('t_e_store_cart', array(
                        'id'    =>  $cartModel['id']
                    ));
                }
            }
        }
        /** 否则是访客
         */
        else if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
        {
            foreach( $_SESSION['cartSession']['items'] as $item )
            {
                $total_weight += intval( $item['unit_weight'] * $item['qty_ordered'] );
                $subtotal += floatval( $item['unit_price'] * $item['qty_ordered'] );

                array_push( $orderItems, array(
                    'order_id'              =>  $order_id,
                    'commodity_id'          =>  $item['commodity_id'],
                    'e_store_sku'           =>  $item['e_store_sku'],
                    'is_e_store_created'    =>  $item['is_e_store_created'],
                    'name'                  =>  $item['name'],
                    'qty_ordered'           =>  $item['qty_ordered'],
                    'unit_cost'             =>  0,
                    'unit_price'            =>  $item['unit_price'],
                    'unit_weight'           =>  $item['unit_weight'],
                    'unit_gst'              =>  $item['unit_price'] - ( $item['unit_price'] / 1.15 )
                ) );
            }
            $gst += floatval( $subtotal - ( $subtotal / 1.15 ) );

            /** 清空购物车
             */
            unset( $_SESSION['cartSession'] );
        }

        $this->db->insert_batch('t_e_store_order_item', $orderItems);

        /** 1. 同步 EStore 产品库存
         *  2. 更新该商品在 Remarketing 对应产品的 product_status = 'Sold', is_ordered = 'Y'
         *  3. 将改变状态的产品的 Item Code 拼接成字符串附在对应的 Order Item 上
         */

        $qty_total_item_ordered = 0;

        if( count( $orderItems ) > 0 )
        {
            foreach( $orderItems as $orderItem )
            {
                $qty_total_item_ordered += $orderItem['qty_ordered'];

                $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $orderItem['e_store_sku']
                ));
                if( $commodityInventoryModelQuery->num_rows() > 0 )
                {
                    $commodityInventoryModel = $commodityInventoryModelQuery->row_array();

                    /** 同步库存，DPS 付款的话不是在这里扣库存，而应该是在付款完成后扣除
                     */
                    if( $order->payment_method != 1 )
                    {
                        $this->db->update('t_warehouse_commodity_inventory', array(
                            'stock' =>  $commodityInventoryModel['stock'] - $orderItem['qty_ordered']
                        ), array(
                            'e_store_sku'   =>  $orderItem['e_store_sku']
                        ));
                    }

                    /** 如果不是 EStore 自建的
                     */
                    if( strcasecmp( $orderItem['is_e_store_created'], 'N' ) == 0 )
                    {

                        /** 通过订购详情的【订购数量】来限定获取该商品在 Remarketing 的对应产品
                         */
                        $this->db->limit( $orderItem['qty_ordered'] );
                        $productObjQuery = $this->db->get_where('t_warehouse_product', array(
                            'type'                  =>  $commodityInventoryModel['type'],
                            'manufacturer_name'     =>  $commodityInventoryModel['manufacturer_name'],
                            'model'                 =>  $commodityInventoryModel['model'],
                            'processor'             =>  $commodityInventoryModel['processor'],
                            'processor_speed'       =>  $commodityInventoryModel['processor_speed'],
                            'mem_size'              =>  $commodityInventoryModel['mem_size'],
                            'hdd_size'              =>  $commodityInventoryModel['hdd_size'],
                            'optical_drive'         =>  $commodityInventoryModel['optical_drive'],
                            'system_license'        =>  $commodityInventoryModel['system_license'],
                            'is_web_cam'            =>  $commodityInventoryModel['is_web_cam'],
                            'screen_size'           =>  $commodityInventoryModel['screen_size']
                        ));

                        $item_codes = '';

                        $productObj = $productObjQuery->result_object();
                        foreach( $productObj as $product )
                        {
                            if( $item_codes != '' )
                            {
                                $item_codes .= ', ';
                            }
                            $item_codes .= $product->item_code;

                            /** 更新该产品的【状态】为 [Sold] 以及【是否被订购】为 [Y]
                             */
                            $this->db->update('t_warehouse_product', array(
                                'product_status'        =>  'Sold',
                                'is_ordered'            =>  'Y',
                                'ordered_date'          =>  date("Y-m-d h:i:s")
                            ), array(
                                'item_code'             =>  $product->item_code
                            ));
                        }

                        /** 追加 Item Code 至关联的 Order Item 上
                         */
                        $this->db->update('t_e_store_order_item', array(
                            'is_e_store_created'    =>  'N',
                            'item_codes'            =>  $item_codes
                        ), array(
                            'order_id'              =>  $order_id,
                            'e_store_sku'           =>  $orderItem['e_store_sku']
                        ));
                    }
                }
            }
        }

        /** 如果是 运送 订单
         */
        if( $order->delivery_method == 2 )
        {
            $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'id'    =>  $order->courier_pricing_id,
                'is_for_customer'       =>  'Y'
            ));
            $courierPricingModel = $courierPricingModelQuery->row_array();
            $courier_id = $courierPricingModel['courier_id'];

            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'    =>  $courierPricingModel['shipping_area_id']
            ));
            $courierShippingAreaModel = $courierShippingAreaModelQuery->row_array();
            $shipping_area = $courierShippingAreaModel['name'];

            $shipping_fee = $courierPricingModel['charge_customer_per_kg'] * ( $total_weight / 1000 );
        }

        /** 更新订单
         */
        $this->db->update('t_e_store_order', array(
            'qty_total_item_ordered'    =>  $qty_total_item_ordered,
            'grand_total'               =>  $subtotal + $shipping_fee,
            'subtotal'                  =>  $subtotal,
            'total_weight'              =>  $total_weight,
            'shipping_fee'              =>  $shipping_fee,
            'shipping_area'             =>  $shipping_area,
            'tax'                       =>  $gst,
            'courier_id'                =>  $courier_id != '' ? $courier_id : null
        ), array(
            'id'                        =>  $order_id
        ));

        $resultMap = array();

        if ( $this->db->trans_status() === FALSE )
        {
            $resultMap['success'] = 'NO';
            $this->db->trans_rollback();
        }
        else
        {
            $resultMap['success'] = 'YES';
            $resultMap['grand_total'] = $subtotal + $shipping_fee;
            $resultMap['order_id'] = $order_id;
            $this->db->trans_commit();
        }

        return $resultMap;
    }

}