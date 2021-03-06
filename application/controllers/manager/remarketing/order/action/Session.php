<?php

require_once 'application/class/remarketing/Order.php';
require_once 'application/class/remarketing/OrderDetail.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/WarehouseCommodityUtil.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 一键更新 Pending 订单至 Complete
     */
    public function one_click_complete_pending_orders()
    {
        ini_set('MAX_EXECUTION_TIME', -1);

        $jsonAlert = new JSONAlert();

        $orderObjQuery = $this->db->get_where('t_remarketing_order', array(
            'order_status' => 'pending'
        ));

        if( $orderObjQuery->num_rows() > 0 )
        {
            $orderObj = $orderObjQuery->result_object();

            $commodityInventoryOriginalWhereArr = array();
            $finalUpdatableProductArr = array();

            foreach( $orderObj as $order )
            {
                $orderDetailObjQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'order_id'  =>  $order->id
                ));
                $orderDetailObj = $orderDetailObjQuery->result_object();
                foreach( $orderDetailObj as $orderDetail )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'    =>  $orderDetail->product_id
                    ));
                    $productModel = $productModelQuery->row_array();

                    array_push( $finalUpdatableProductArr, array(
                        'product_status'    =>  'Sold',
                        'is_locked'         =>  'N',
                        'is_ordered'        =>  'Y',
                        'id'                =>  $productModel['id']
                    ));

                    /** 如果是 Grade A 的产品则暂存起来
                     */
                    if( strcasecmp( $productModel['performance_status'], 'Grade A' ) == 0 )
                    {
                        $commodityInventoryOriginalWhere = array(
                            'type'                  =>  $productModel['type'],                  'manufacturer_name' =>  $productModel['manufacturer_name'],     'model'             =>  $productModel['model'],
                            'processor'             =>  $productModel['processor'],             'processor_speed'   =>  $productModel['processor_speed'],       'mem_size'          =>  $productModel['mem_size'],
                            'hdd_size'              =>  $productModel['hdd_size'],              'optical_drive'     =>  $productModel['optical_drive'],         'system_license'    =>  $productModel['system_license'],
                            'is_web_cam'            =>  $productModel['is_web_cam'],            'screen_size'       =>  $productModel['screen_size']
                        );
                        array_push( $commodityInventoryOriginalWhereArr, $commodityInventoryOriginalWhere );
                    }
                }
            }

            /** 批量更新相关产品的 Status = 'Sold'，is_locked = 'N', is_ordered = 'Y'
             */
            $this->db->update_batch('t_warehouse_product', $finalUpdatableProductArr, 'id');

            $finalCommodityInventoryOriginalWhereArr = array_unique( $commodityInventoryOriginalWhereArr, SORT_REGULAR );

            /** 更新 Grade A 的产品在 EStore Commodity 里的库存
             */
            if( count( $finalCommodityInventoryOriginalWhereArr ) > 0 )
            {
                foreach( $finalCommodityInventoryOriginalWhereArr as $finalCommodityInventoryOriginalWhere )
                {
                    $config = array
                    (
                        'commodityInventoryOriginalWhere'     =>  $finalCommodityInventoryOriginalWhere
                    );
                    WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                }
            }

            /** 更新订单至 Completed
             */
            $this->db->update('t_remarketing_order', array(
                'order_status' => 'completed'
            ), array(
                'order_status' => 'pending'
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Successful switch pending orders to completed status'
            ), FALSE);
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'No pending orders yet, please be patient~'
            ), TRUE);
        }

        echo $jsonAlert->result();
    }

    /** 更新 Tracking Codes
     */
    public function update_tracking_codes()
    {
        $order = new Order( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'tracking_codes'=>'Tracking Codes Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_remarketing_order', array(
                'tracking_codes'    =>  $order->tracking_codes
            ), array(
                'id'    =>  $order->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Tracking Codes updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

	// Edit order status
	public function edit_order_status()
	{
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'order_status'=>'Order Status Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'id'    =>  $order->id
        ));
        if( $orderModelQuery->num_rows() > 0 )
        {
            $orderModel = $orderModelQuery->row_array();

            /** 如果状态是是 shipped、completed，并且 shipping_method = 2，则 tracking_codes 必须不能为空
             */
            if( ( strcasecmp( $order->order_status, 'shipped' ) == 0 || strcasecmp( $order->order_status, 'completed' ) == 0 ) && strcasecmp( $orderModel['shipping_method'], 'shipping' ) == 0 && ( ! $order->tracking_codes || trim( $order->tracking_codes ) == '' ) )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Shipping orders Switch to Shipped or Completed must also provide Tracking Code(s), two or more codes could be separate with comma!'
                ), TRUE);
            }
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Order not existed!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
                'id'        =>$order->id
            ));
            $orderModel = $orderModelQuery->row_array();

            if( strcasecmp($order->order_status, 'cancelled')==0 )
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'order_id'=>$order->id
                ));
                $orderDetails = $orderDetailModelQuery->result_object();
                foreach ($orderDetails as $orderDetail)
                {
                    $this->db->update('t_warehouse_product', array(
                        'product_status'=>'In Stock',
                        'is_locked'     =>'N',
                        'is_ordered'    =>'N'
                    ), array(
                        'id'=>$orderDetail->product_id
                    ));

                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'=>$orderDetail->product_id
                    ));
                    $productModel = $productModelQuery->row_array();

                    /** 如果 Performance Status 是 Grade A，则有必要同步 EStore Commodity 及其 库存
                     */
                    if( strcasecmp( $productModel['performance_status'], 'Grade A' ) == 0 )
                    {
                        $commodityInventoryOriginalWhere = array(
                            'type'                  =>  $productModel['type'],                  'manufacturer_name' =>  $productModel['manufacturer_name'],     'model'             =>  $productModel['model'],
                            'processor'             =>  $productModel['processor'],             'processor_speed'   =>  $productModel['processor_speed'],       'mem_size'          =>  $productModel['mem_size'],
                            'hdd_size'              =>  $productModel['hdd_size'],              'optical_drive'     =>  $productModel['optical_drive'],         'system_license'    =>  $productModel['system_license'],
                            'is_web_cam'            =>  $productModel['is_web_cam'],            'screen_size'       =>  $productModel['screen_size']
                        );

                        $config = array
                        (
                            'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                        );
                        WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                    }
                }
            }


            if
            (
                strcasecmp( $orderModel['order_status'], 'cancelled')!=0 && strcasecmp( $orderModel['order_status'], 'completed')!=0 &&
                strcasecmp( $orderModel['order_status'], 'shipped')!=0 && strcasecmp( $orderModel['order_status'], 'waiting_for_shipment')!=0
            )
            {
                /* If order status matched any of the following status */
                if( strcasecmp($order->order_status, 'completed')==0 || strcasecmp($order->order_status, 'shipped')==0 || strcasecmp($order->order_status, 'waiting_for_shipment')==0 )
                {
                    $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                        'order_id'=>$order->id
                    ));
                    $orderDetails = $orderDetailModelQuery->result_object();
                    foreach ($orderDetails as $orderDetail)
                    {
                        $this->db->update('t_warehouse_product', array(
                            'product_status'=>'Sold',
                            'is_locked'     =>'N',
                            'is_ordered'    =>'Y'
                        ), array(
                            'id'=>$orderDetail->product_id
                        ));

                        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                            'id'=>$orderDetail->product_id
                        ));
                        $productModel = $productModelQuery->row_array();

                        /** 如果 Performance Status 是 Grade A，则有必要同步 EStore Commodity 及其 库存
                         */
                        if( strcasecmp( $productModel['performance_status'], 'Grade A' ) == 0 )
                        {
                            $commodityInventoryOriginalWhere = array(
                                'type'                  =>  $productModel['type'],                  'manufacturer_name' =>  $productModel['manufacturer_name'],     'model'             =>  $productModel['model'],
                                'processor'             =>  $productModel['processor'],             'processor_speed'   =>  $productModel['processor_speed'],       'mem_size'          =>  $productModel['mem_size'],
                                'hdd_size'              =>  $productModel['hdd_size'],              'optical_drive'     =>  $productModel['optical_drive'],         'system_license'    =>  $productModel['system_license'],
                                'is_web_cam'            =>  $productModel['is_web_cam'],            'screen_size'       =>  $productModel['screen_size']
                            );

                            $config = array
                            (
                                'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                            );
                            WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                        }
                    }
                }
            }

            $this->db->update('t_remarketing_order', array(
                'order_status'=>$order->order_status
            ), array(
                'id'=>$order->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Order status updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

	// Delete batch order
	public function delete_batch()
	{
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'order_ids'=>'Please select at least one order to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if order is Completed or Cancelled */
        $unavailable_order_id = '';
        $is_unavailable_order_existed = false;
        if( $order->order_ids )
        {
            foreach ( $order->order_ids as $order_id )
            {
                $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
                    'id'=>$order_id
                ));
                $orderModel = $orderModelQuery->row_array();
                if( strcasecmp( $orderModel['order_status'], 'completed' )==0 || strcasecmp( $orderModel['order_status'], 'cancelled' )==0 )
                {
                    if( $unavailable_order_id != '' )
                    {
                        $unavailable_order_id .= ', ';
                    }
                    $unavailable_order_id .= $orderModel['id'];

                    $is_unavailable_order_existed = true;
                }
            }
        }

        if( $is_unavailable_order_existed )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Selected order(s) is/are in Completed or Cancelled status, please check carefully and try again!'
            ), TRUE);
        }


        if( ! $jsonAlert->hasErrors )
        {
            foreach ($order->order_ids as $order_id)
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'order_id'=>$order_id
                ));
                $orderDetails = $orderDetailModelQuery->result_object();
                foreach ($orderDetails as $orderDetail)
                {
                    $this->db->update('t_warehouse_product', array(
                        'is_locked'     =>'N'
                    ), array(
                        'id'=>$orderDetail->product_id
                    ));
                }

                $this->db->delete('t_remarketing_order_detail', array(
                    'order_id'=>$order_id
                ));
                $this->db->delete('t_remarketing_order', array(
                    'id'=>$order_id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Selected order(s) deleted!'
                ), FALSE);
            }
        }
        echo $jsonAlert->result();
	}

	// Remove Detail From Order
	public function delete_batch_order_detail()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'detail_ids'=>'Please select at least one detail to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check order is Completed or Cancelled */
        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'id'    =>$order->id
        ));
        $orderModel = $orderModelQuery->row_array();
        if( strcasecmp( $orderModel['order_status'],'completed' )==0 || strcasecmp( $orderModel['order_status'],'cancelled' )==0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Order status is completed or cancelled, please refresh current page!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ($order->detail_ids as $detail_id)
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'id'=>$detail_id
                ));
                $orderDetailModel = $orderDetailModelQuery->row_array();
                $this->db->update('t_warehouse_product', array(
                    'is_locked'    =>'N'
                ), array(
                    'id'                =>$orderDetailModel['product_id']
                ));

                $this->db->delete('t_remarketing_order_detail', array(
                    'id'=>$detail_id
                ));
            }

            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'=>$order->id
            ));

            if($orderDetailModelQuery->num_rows() > 0)
            {
                $totalAmount = 0;
                $totalWeight = 0;
                foreach ($orderDetailModelQuery->result_object() as $orderDetail)
                {
                    $totalAmount += $orderDetail->price;
                    $totalWeight += $orderDetail->weight;
                }
                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $shippingFee = 0;

                /* If shipping method is Shipping, then  */
                if( $order->shipping_method == 'Shipping' )
                {
                    $item_weight_kg = 1;
                    if( $totalWeight > 1000 )
                    {
                        $item_weight_kg = $totalWeight / 1000;
                        if( $totalWeight % 1000 != 0 )
                        {
                            $item_weight_kg ++;
                        }
                        $item_weight_kg = sprintf("%01.0f",$item_weight_kg);
                    }

                    $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                        'id'    =>$order->courier_pricing_id
                    ));
                    $courierPricingModel = $courierPricingModelQuery->row_array();

                    $shippingFee += ( $courierPricingModel['charge_wholesaler_per_kg'] * $item_weight_kg );
                    $totalAmountGST += ( $courierPricingModel['charge_wholesaler_per_kg'] * $item_weight_kg );
                }

                $this->db->update('t_remarketing_order', array(
                    'payable_amount'=>$totalAmountGST,
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'total_amount_gst'=>$totalAmountGST,
                    'total_weight'=>$totalWeight,
                    'shipping_fee'=>$shippingFee,
                ), array(
                    'id'=>$order->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Selected order detail(s) deleted!'
                ), FALSE);
            }
            else
            {
                $this->db->delete('t_remarketing_order', array(
                    'id'=>$order->id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Order deleted!'
                ), FALSE);
            }
        }
        echo $jsonAlert->result();
	}


    // Refund Order Detail(s)
    public function refund_batch_order_detail()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'detail_ids'=>'Please select at least one detail to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check order is not Completed */
        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'id'    =>$order->id
        ));
        $orderModel = $orderModelQuery->row_array();
        if( strcasecmp( $orderModel['order_status'],'completed' )!=0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Order status is not Completed, please complete the order first!'
            ), TRUE);
        }

        /* Check order detail is Refund */
        $refund_item_codes = '';
        $is_refund_item_existed = false;
        if( ! $jsonAlert->hasErrors )
        {
            foreach ($order->detail_ids as $detail_id)
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'id'=>$detail_id
                ));
                $orderDetailModel = $orderDetailModelQuery->row_array();
                if( strcasecmp( $orderDetailModel['is_refund'],'Y' )==0 )
                {
                    if( $refund_item_codes != '' )
                    {
                        $refund_item_codes .= ', ';
                    }
                    $refund_item_codes .= $orderDetailModel['item_code'];

                    $is_refund_item_existed = true;
                }
            }
        }

        if( $is_refund_item_existed )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Please don\'t select the refund item(s) which item code(s) is/are: ' . $refund_item_codes . ', and try again!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $totalRefundAmount = 0;

            foreach ($order->detail_ids as $detail_id)
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'id'=>$detail_id
                ));
                $orderDetailModel = $orderDetailModelQuery->row_array();
                $this->db->update('t_warehouse_product', array(
                    'product_status'    =>'In Stock',
                    'is_ordered'        =>'N'
                ), array(
                    'id'                =>$orderDetailModel['product_id']
                ));
                $this->db->update('t_remarketing_order_detail', array(
                    'is_refund'    =>'Y'
                ), array(
                    'id'                =>$orderDetailModel['id']
                ));

                $totalRefundAmount += $orderDetailModel['price'];
            }

            $totalRefundAmountGST = $totalRefundAmount*1.15;

            /* If found Refund Item, then update order's Refund Amount */
            if( $totalRefundAmount > 0 )
            {
                $this->db->update('t_remarketing_order', array(
                    'refund_amount' =>$totalRefundAmountGST
                ), array(
                    'id'            =>$order->id
                ));
            }

            WarehouseCommodityUtil::refresh_warehouse_commodity( $jsonAlert, $this );

            $jsonAlert->append(array(
                'successMsg'=>'Selected order detail(s) refund, related product(s) is/are now In Stock!'
            ), FALSE);
        }

        echo $jsonAlert->result();
    }

	
	
}
