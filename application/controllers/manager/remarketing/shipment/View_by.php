<?php

require_once 'application/class/remarketing/RemarketingShipment.php';
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
            'base_url'          =>  '/manager/remarketing/shipment/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-info'),
            'CThis'             =>  $this,
            'Model'             =>  'RemarketingShipment',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_create_date', 'end_create_date',
                'start_shipping_fee', 'end_shipping_fee'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'create_date', 'start_create_date', 'start_create_date' );
        $ciPagination->between( 'shipping_fee', 'start_shipping_fee', 'end_shipping_fee' );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_remarketing_shipment',

            'selectedRows'        =>  array(
                'id', 'create_date', 'ship_number', 'ship_status',
                'sender_name', 'sender_address', 'sender_phone', 'sender_email', 'sender_post',
                'receive_name', 'receive_phone', 'receive_email', 'receive_address', 'receive_city', 'receive_province', 'receive_post', 'receive_country',
                'qty_total_item_shipped', 'total_weight', 'shipping_fee', 'memo'
            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'create_date DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

        $this->load->view('manager/remarketing/shipment/view_by_page',$data);
	}
	
}
