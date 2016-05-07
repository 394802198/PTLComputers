<?php

require_once 'application/class/remarketing/Order.php';
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
            'base_url'          =>  '/manager/remarketing/order/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-info'),
            'CThis'             =>  $this,
            'Model'             =>  'Order',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_ordered_date', 'end_ordered_date',
                'start_total_amount_gst', 'end_total_amount_gst'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'ordered_date', 'start_ordered_date', 'end_ordered_date' );
        $ciPagination->between( 'total_amount_gst', 'start_total_amount_gst', 'end_total_amount_gst' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_remarketing_order',

            'selectedRows'        =>  array(
                'id', 'ordered_date', 'order_status', 'shipping_method',
                'last_name', 'first_name', 'email', 'company_name', 'landline_phone', 'mobile_phone', 'fax_no', 'shipping_address',
                'receiver_name', 'receiver_phone', 'receiver_email', 'receiver_country', 'receiver_province', 'receiver_city', 'receiver_address', 'receiver_post',
                'gst', 'total_amount', 'shipping_fee', 'total_amount_gst'
            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'ordered_date DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );


        $managerModelQuery = $this->db->get('t_core_manager');
        $data['managers'] = $managerModelQuery->result_object();

        $this->load->view('manager/remarketing/order/view_by_page',$data);
	}
	
}
