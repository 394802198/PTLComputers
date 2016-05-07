<?php

require_once 'application/class/e_store/cms/CMSCustomPage.php';
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
            'base_url'          =>  '/manager/e_store/cms/custom_page/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'CMSCustomPage',
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
            'table_name'        =>  't_e_store_cms_custom_page',

//            'selectedRows'        =>  array(
//                'id', 'e_store_sku', 'name', 'price', 'weight', 'location', 'manufacturer', 'type', 'is_on_shelf'
//            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'page_type DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

        $data['page_types'] = array(
            array( 'code'  =>  100, 'name'  =>  'Custom' ),
            array( 'code'  =>  101, 'name'  =>  'About Us' ),
            array( 'code'  =>  102, 'name'  =>  'Where to buy' ),
            array( 'code'  =>  103, 'name'  =>  'Terms & Conditions' ),
            array( 'code'  =>  104, 'name'  =>  'Returns' ),
            array( 'code'  =>  105, 'name'  =>  'Tree View Site Map' )
        );

        $data['page_title_sizes'] = array(
            array( 'code'  =>  100, 'name'  =>  'Extra Large' ),
            array( 'code'  =>  101, 'name'  =>  'Large' ),
            array( 'code'  =>  102, 'name'  =>  'Medium' ),
            array( 'code'  =>  103, 'name'  =>  'Small' ),
            array( 'code'  =>  104, 'name'  =>  'Extra Small' )
        );

        $this->load->view( '/manager/e_store/cms/custom_page/view_by_page', $data );

    }

}

