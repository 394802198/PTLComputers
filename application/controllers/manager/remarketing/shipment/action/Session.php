<?php

require_once 'application/class/remarketing/RemarketingShipment.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Add Rest
    public function add()
    {
        $remarketingShipment = new RemarketingShipment($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$remarketingShipment,
                'check_empty'=>array(
                    'order_id'=>'Order Id Needed!',
                    'order_detail_ids'=>'Must tick at least one order item to continue!',
                    'ship_number'=>'Ship Number Needed!',
                    'receive_name'=>'Receiver Name Needed!',
                    'receive_phone'=>'Receiver Phone Needed!',
                    'receive_address'=>'Receiver Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if selected order details contain shipped ones
         */
        $is_any_order_detail_shipped = false;
        $shipped_item_code = '';
        $qty_total_item_shipped = 0;
        $qty_total_weight = 0;
        if( ! $jsonAlert->hasErrors )
        {
            $this->db->where_in( 'id', $remarketingShipment->order_detail_ids );
            $orderDetailsModelQuery = $this->db->get_where('t_remarketing_order_detail');
            $orderDetailsModel = $orderDetailsModelQuery->result_object();
            if( $orderDetailsModelQuery->num_rows() > 0 )
            {
                foreach( $orderDetailsModel as $orderDetail )
                {
                    if( strcasecmp( $orderDetail->is_shipped, 'Y' )==0 )
                    {
                        if( $shipped_item_code != '' )
                        {
                            $shipped_item_code .= ', ';
                        }
                        $shipped_item_code .= $orderDetail->item_code;
                        $is_any_order_detail_shipped = true;
                    }
                    $qty_total_weight += $orderDetail->weight;
                    $qty_total_item_shipped ++;
                }
            }

            if( $is_any_order_detail_shipped )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Selected order detail(s) contain shipped status which, Item Code: ' . $shipped_item_code
                ), TRUE);
                $jsonAlert->hasErrors = true;
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->trans_start();

            $remarketingShipment->total_weight = $qty_total_weight;
            $remarketingShipment->qty_total_item_shipped = $qty_total_item_shipped;
            $remarketingShipment->create_date = date("Y-m-d h:i:s");
            $remarketingShipment->last_update = date("Y-m-d h:i:s");

            $this->db->insert('t_warehouse_remarketing_shipment', $remarketingShipment->getInsertableData());

            $inserted_id = $this->db->insert_id();

            foreach( $remarketingShipment->order_detail_ids as $order_detail_id )
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'id'    =>  $order_detail_id
                ));
                if( $orderDetailModelQuery->num_rows() > 0 )
                {
                    $orderDetailModel = $orderDetailModelQuery->row_array();

                    $this->db->insert('t_warehouse_remarketing_shipment_item', array(
                        'shipment_id'   =>  $inserted_id,
                        'order_item_id' =>  $orderDetailModel['id'],
                        'item_code'     =>  $orderDetailModel['item_code'],
                        'qty_shipped'   =>  1
                    ));

                    $this->db->update('t_remarketing_order_detail', array(
                        'is_shipped'    =>  'Y'
                    ), array(
                        'id'            =>  $order_detail_id
                    ));
                }
            }

            /* If all order items are shipped, then switch status to shipped */
            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'  =>  $remarketingShipment->order_id
            ));
            if( $orderDetailModelQuery->num_rows() > 0 )
            {
                $is_all_shipped = true;
                $orderDetailObj = $orderDetailModelQuery->result_object();
                foreach( $orderDetailObj as $orderDetail )
                {
                    if( strcasecmp( $orderDetail->is_shipped, 'N' ) == 0 )
                    {
                        $is_all_shipped = false;
                    }
                }
                if( $is_all_shipped )
                {
                    $this->db->update('t_remarketing_order', array(
                        'order_status'  =>  'shipped'
                    ), array(
                        'id'    => $remarketingShipment->order_id
                    ));
                }
                else
                {
                    $this->db->update('t_remarketing_order', array(
                        'order_status'  =>  'waiting_for_shipment'
                    ), array(
                        'id'    => $remarketingShipment->order_id
                    ));
                }
            }
            $this->db->trans_complete();

            $jsonAlert->append(array(
                'successMsg'=>'New Shipment Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    // Edit Rest
    public function edit()
    {
        $remarketingShipment = new RemarketingShipment($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$remarketingShipment,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'order_detail_ids'=>'Must tick at least one order item to continue!',
                    'ship_number'=>'Ship Number Needed!',
                    'receive_name'=>'Receiver Name Needed!',
                    'receive_phone'=>'Receiver Phone Needed!',
                    'receive_address'=>'Receiver Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if selected order details contain shipped ones and not related to this shipments item
         */
        $is_any_order_detail_shipped = false;
        $shipped_item_code = '';
        if( ! $jsonAlert->hasErrors )
        {
            $this->db->where( 'shipment_id !=', $remarketingShipment->id );
            $this->db->where_in( 'order_item_id', $remarketingShipment->order_detail_ids );
            $shipmentItemsModelQuery = $this->db->get('t_warehouse_remarketing_shipment_item');
            if( $shipmentItemsModelQuery->num_rows() > 0 )
            {
                $shipmentItemsModel = $shipmentItemsModelQuery->result_object();
                foreach( $shipmentItemsModel as $shipmentItem )
                {
                    if( $shipped_item_code != '' )
                    {
                        $shipped_item_code .= ', ';
                    }
                    $shipped_item_code .= $shipmentItem->item_code;
                    $is_any_order_detail_shipped = true;
                }
            }

            if( $is_any_order_detail_shipped )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Selected order detail(s) contains in other shipment(s) which, Item Code: ' . $shipped_item_code
                ), TRUE);
                $jsonAlert->hasErrors = true;
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->trans_start();

            $shipmentItemsModelQuery = $this->db->get_where('t_warehouse_remarketing_shipment_item', array(
                'shipment_id'   =>  $remarketingShipment->id
            ));
            $shipmentItemsModel = $shipmentItemsModelQuery->result_object();
            foreach( $shipmentItemsModel as $shipmentItem )
            {
                $this->db->update('t_remarketing_order_detail', array(
                    'is_shipped'    =>  'N'
                ), array(
                    'id'    =>  $shipmentItem->order_item_id
                ));
            }

            $this->db->delete('t_warehouse_remarketing_shipment_item', array(
                'shipment_id'   =>  $remarketingShipment->id
            ));

            $qty_total_weight = 0;
            $qty_total_item_shipped = 0;
            foreach( $remarketingShipment->order_detail_ids as $order_detail_id )
            {
                $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                    'id'    =>  $order_detail_id
                ));
                if( $orderDetailModelQuery->num_rows() > 0 )
                {

                    $orderDetailModel = $orderDetailModelQuery->row_array();

                    $qty_total_weight += $orderDetailModel['weight'];
                    $qty_total_item_shipped ++;

                    $this->db->insert('t_warehouse_remarketing_shipment_item', array(
                        'shipment_id'   =>  $remarketingShipment->id,
                        'order_item_id' =>  $orderDetailModel['id'],
                        'item_code'     =>  $orderDetailModel['item_code'],
                        'qty_shipped'   =>  1
                    ));

                    $this->db->update('t_remarketing_order_detail', array(
                        'is_shipped'    =>  'Y'
                    ), array(
                        'id'            =>  $order_detail_id
                    ));
                }
            }

            $remarketingShipment->total_weight = $qty_total_weight;
            $remarketingShipment->qty_total_item_shipped = $qty_total_item_shipped;
            $remarketingShipment->create_date = date("Y-m-d h:i:s");
            $remarketingShipment->last_update = date("Y-m-d h:i:s");

            $this->db->update('t_warehouse_remarketing_shipment', $remarketingShipment->getEditableData(), array(
                'id'    =>  $remarketingShipment->id
            ));

            /* If all order items are shipped, then switch status to shipped */
            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'  =>  $remarketingShipment->order_id
            ));
            if( $orderDetailModelQuery->num_rows() > 0 )
            {
                $is_all_shipped = true;
                $orderDetailObj = $orderDetailModelQuery->result_object();
                foreach( $orderDetailObj as $orderDetail )
                {
                    if( strcasecmp( $orderDetail->is_shipped, 'N' ) == 0 )
                    {
                        $is_all_shipped = false;
                    }
                }
                if( $is_all_shipped )
                {
                    $this->db->update('t_remarketing_order', array(
                        'order_status'  =>  'shipped'
                    ), array(
                        'id'    => $remarketingShipment->order_id
                    ));
                }
                else
                {
                    $this->db->update('t_remarketing_order', array(
                        'order_status'  =>  'waiting_for_shipment'
                    ), array(
                        'id'    => $remarketingShipment->order_id
                    ));
                }
            }

            $jsonAlert->append(array(
                'successMsg'=>'Update Current Shipment!'
            ), FALSE);
            $this->db->trans_complete();
        }
        echo $jsonAlert->result();
    }

    // Switch Status Rest
    public function switch_status()
    {
        $remarketingShipment = new RemarketingShipment($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$remarketingShipment,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'ship_status'=>'Ship Status Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_warehouse_remarketing_shipment', array(
                'ship_status'   =>  $remarketingShipment->ship_status
            ), array(
                'id'    =>  $remarketingShipment->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Update Shipment Status!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    // Switch Status Batch Rest
    public function switch_status_batch()
    {
        $remarketingShipment = new RemarketingShipment($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$remarketingShipment,
                'check_empty'=>array(
                    'shipment_ids'=>'Must tick at least one shipment to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->where_in( 'id', $remarketingShipment->shipment_ids );
            $this->db->update('t_warehouse_remarketing_shipment', array(
                'ship_status'   =>  $remarketingShipment->ship_status
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Update Shipment(s) Status!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
}
