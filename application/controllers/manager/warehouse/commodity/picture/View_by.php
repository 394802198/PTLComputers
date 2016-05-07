<?php

require_once 'application/class/warehouse/commodity/CommodityPicture.php';
require_once 'util/myutils/CIPagination.php';

class View_by extends MY_Controller
{
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
            'base_url'          =>  '/manager/warehouse/commodity/picture/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'CommodityPicture',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE
            /* Won't be counted into predicates automatically */
//            'prevented_fields'  =>  array(
//                'start_price', 'end_price'
//            )
        );
        $ciPagination = new CIPagination( $initConfig );

//        $ciPagination->between( 'price', 'start_price', 'end_price' );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_commodity_picture',

//            'selectedRows'        =>  array(
//                'id', 'e_store_sku', 'name', 'price', 'weight', 'location', 'manufacturer', 'type', 'is_on_shelf'
//            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'id DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;


        $this->db->distinct();
        $this->db->select('manufacturer');
        $this->db->order_by('manufacturer ASC');
        $manufacturersQuery = $this->db->get('t_warehouse_commodity_picture');
        $this->db->distinct();
        $this->db->select('type');
        $this->db->order_by('type ASC');
        $typesQuery = $this->db->get('t_warehouse_commodity_picture');

        $data['manufacturers'] = $manufacturersQuery->result_object();
        $data['types'] = $typesQuery->result_object();

        $this->load->view( 'manager/warehouse/commodity/picture/view_by_page', $data );

    }

}

