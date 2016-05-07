<?php

require_once 'application/class/remarketing/Order.php';
require_once 'util/myutils/CIPagination.php';

class Add_By extends MY_Controller {
    
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
            'base_url'          =>  '/manager/remarketing/shipment/add_by/pagination',
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

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_remarketing_order',

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'ordered_date DESC',
            'total_item_rows_where_in'=>array(
                array(
                    'field'=>'order_status',
                    'values'=>array('waiting_for_shipment')
                )
            ),
            'where_in'=>array(
                array(
                    'field'=>'order_status',
                    'values'=>array('waiting_for_shipment')
                )
            ),
        );

        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );

        $managerModelQuery = $this->db->get('t_core_manager');
        $data['managers'] = $managerModelQuery->result_object();

        $this->load->view('manager/remarketing/shipment/add_by_page',$data);
	}
	
}
