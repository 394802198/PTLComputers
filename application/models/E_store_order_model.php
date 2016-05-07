<?php
/**
 * Created by PhpStorm.
 * User: Steven Chen
 * Date: 2016/1/13
 * Time: 16:29
 */

class E_Store_Order_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function change_status( $order, $jsonAlert )
    {
        $this->db->trans_begin();

        $updatableData = array(
            'last_update'   =>  date("Y-m-d h:i:s"),
            'order_status'  =>  $order->order_status
        );

        /** 如果是订单 取消 或 退款，则需要：
         *  1. 将 qty_ordered 追加至所对应的 Commodity Inventory stock
         *  2. 将 item_codes 所对应的 不存在于 item_codes_cancelled 或者 item_codes_refunded 的 Product product_status = In Stock，以及 is_ordered = N
         *  3. 将 qty_ordered 赋给 qty_cancelled 或者 qty_refunded，并且将 item_codes 赋给 item_codes_cancelled 或者 item_codes_refunded
         */
        if( $order->order_status == 6 || $order->order_status == 7 )
        {
            $orderItemObjQuery = $this->db->get_where('t_e_store_order_item', array(
                'order_id'  =>  $order->id
            ));
            if( $orderItemObjQuery->num_rows() > 0 )
            {
                $qty_type = '';
                $item_codes_to = '';
                $qty_total_item_changed = 0;
                if( $order->order_status == 6 )
                {
                    $qty_type = 'qty_cancelled';
                    $item_codes_to = 'item_codes_cancelled';
                }
                else if( $order->order_status == 7 )
                {
                    $qty_type = 'qty_refunded';
                    $item_codes_to = 'item_codes_refunded';
                }
                $updatable_products = array();
                $updatable_order_items = array();
                $updatable_commodity_inventories = array();

                $orderItemObj = $orderItemObjQuery->result_object();
                foreach( $orderItemObj as $orderItem )
                {

                    $item_codes = explode( ', ', $orderItem->item_codes );

                    if( count( $item_codes ) > 0 )
                    {
                        $item_codes_cancelled = explode( ', ', $orderItem->item_codes_cancelled );
                        $item_codes_refunded = explode( ', ', $orderItem->item_codes_refunded );

                        $available_stock = 0;

                        foreach( $item_codes as $item_code )
                        {
                            if( ! in_array( $item_code, $item_codes_cancelled ) && ! in_array( $item_code, $item_codes_refunded ) )
                            {
                                $available_stock ++;

                                /**     2. 将 item_codes 所对应的 Product product_status = In Stock，以及 is_ordered = N
                                 */
                                array_push( $updatable_products, array(
                                    'item_code'         =>  $item_code,
                                    'product_status'    =>  'In Stock',
                                    'is_ordered'        =>  'N'
                                ));
                            }
                        }
                    }

                    /**     1. 将 qty_ordered 追加至所对应的 Commodity Inventory stock
                     */
                    $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                        'e_store_sku'   =>  $orderItem->e_store_sku
                    ));

                    if( $commodityInventoryModelQuery->num_rows() > 0 )
                    {
                        $commodityInventoryModel = $commodityInventoryModelQuery->row_array();

                        array_push( $updatable_commodity_inventories, array(
                            'stock'         =>  $commodityInventoryModel['stock'] + $available_stock,
                            'e_store_sku'   =>  $orderItem->e_store_sku
                        ));
                    }

                    $qty_total_item_changed += $orderItem->qty_ordered;

                    /**     3. 将 qty_ordered 付给 qty_cancelled 或者 qty_refunded
                     */
                    array_push( $updatable_order_items, array(
                        'id'            =>  $orderItem->id,
                        $qty_type       =>  $orderItem->qty_ordered,
                        $item_codes_to  =>  $orderItem->item_codes
                    ));
                }

                if( count( $updatable_commodity_inventories ) > 0 )
                {
                    $this->db->update_batch('t_warehouse_commodity_inventory', $updatable_commodity_inventories, 'e_store_sku');
                }
                if( count( $updatable_products ) > 0 )
                {
                    $this->db->update_batch('t_warehouse_product', $updatable_products, 'item_code');
                }
                if( count( $updatable_order_items ) > 0 )
                {
                    $this->db->update_batch('t_e_store_order_item', $updatable_order_items, 'id');
                }

                $updatableData[ $order->order_status == 6 ? 'qty_total_item_cancelled' : 'qty_total_item_refunded' ] = $qty_total_item_changed;
            }
        }

        $this->db->update('t_e_store_order', $updatableData, array(
            'id'    =>  $order->id
        ));

        if ( $this->db->trans_status() === FALSE )
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }

}