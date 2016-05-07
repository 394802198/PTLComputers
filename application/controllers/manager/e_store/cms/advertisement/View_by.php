<?php

require_once 'application/class/e_store/cms/CMSAdvertisement.php';
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
            'base_url'          =>  '/manager/e_store/cms/advertisement/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'CMSAdvertisement',
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
            'table_name'        =>  't_e_store_cms_advertisement',

//            'selectedRows'        =>  array(
//                'id', 'e_store_sku', 'name', 'price', 'weight', 'location', 'manufacturer', 'type', 'is_on_shelf'
//            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'page_type, position',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

        $data['page_types'] = array(
            array( 'code'  =>  100, 'name'  =>  'Home' ),
            array( 'code'  =>  101, 'name'  =>  'Product Search' ),
            array( 'code'  =>  102, 'name'  =>  'Product Detail' ),
            array( 'code'  =>  103, 'name'  =>  'My Cart' ),
            array( 'code'  =>  108, 'name'  =>  'Dashboard' ),
            array( 'code'  =>  109, 'name'  =>  'My Profile' ),
            array( 'code'  =>  110, 'name'  =>  'Change Credential' ),
            array( 'code'  =>  111, 'name'  =>  'My Order' ),
            array( 'code'  =>  112, 'name'  =>  'Receiver Address' ),
            array( 'code'  =>  113, 'name'  =>  'My Cart' ),
            array( 'code'  =>  114, 'name'  =>  'Shipment Tracking' ),
            array( 'code'  =>  115, 'name'  =>  'My Wish List' ),
            array( 'code'  =>  200, 'name'  =>  'Custom Page' )
        );

        $data['positions'] = array(
            array( 'code'  =>  100, 'name'  =>  'Page Top' ),
            array( 'code'  =>  101, 'name'  =>  'Page Left' ),
            array( 'code'  =>  102, 'name'  =>  'Page Right' ),
            array( 'code'  =>  103, 'name'  =>  'Page Bottom' ),
            array( 'code'  =>  104, 'name'  =>  'Header Bottom' ),
            array( 'code'  =>  105, 'name'  =>  'Footer Top' )
        );

        $this->load->view( '/manager/e_store/cms/advertisement/view_by_page', $data );

    }

}

