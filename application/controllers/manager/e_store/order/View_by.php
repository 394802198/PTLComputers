<?php

require_once 'application/class/e_store/Order.php';
require_once 'util/myutils/CIPagination.php';

class View_By extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    public function pagination()
    {
        $initConfig = array(
            'base_url'          =>  '/manager/e_store/order/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-info'),
            'CThis'             =>  $this,
            'Model'             =>  'Order',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$PRECISE_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$STRICT_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_create_time', 'end_create_time',
                'start_grand_total', 'end_grand_total'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'create_time', 'start_create_time', 'end_create_time' );
        $ciPagination->between( 'grand_total', 'start_grand_total', 'end_grand_total' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        /** If Order Existed
         */
        $order_count = $this->db->count_all('t_e_store_order');
        if( $order_count > 0 )
        {
            $paymentGatewayButUnpaidOrderObjQuery = $this->db->select('id')
                ->where('payment_method', 1)
                ->where('payment_status', 1)
                ->get('t_e_store_order');

            if( $paymentGatewayButUnpaidOrderObjQuery->num_rows() > 0 )
            {
                $finalNotInOrderIds = array();
                $paymentGatewayButUnpaidOrderObj = $paymentGatewayButUnpaidOrderObjQuery->result_object();
                foreach( $paymentGatewayButUnpaidOrderObj as $paymentGatewayButUnpaidOrder )
                {
                    array_push( $finalNotInOrderIds, $paymentGatewayButUnpaidOrder->id );
                }

                $ciPagination->not_in( 'id', $finalNotInOrderIds );
            }
        }

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_e_store_order',

            'selectedRows'        =>  array(
                'id', 'create_time', 'order_status', 'delivery_method', 'payment_status',
                'sender_name', 'sender_address', 'sender_phone', 'sender_email', 'sender_post',
                'receiver_name', 'receiver_phone', 'receiver_email', 'receiver_country', 'receiver_province', 'receiver_city', 'receiver_address', 'receiver_post',
                'subtotal', 'tax', 'shipping_fee', 'grand_total'
            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'create_time DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );

        $this->load->view('manager/e_store/order/view_by_page',$data);
	}
	
}
