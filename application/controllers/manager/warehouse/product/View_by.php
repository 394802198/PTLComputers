<?php

require_once 'application/class/warehouse/product/Product.php';
require_once 'util/myutils/CIPagination.php';

class View_by extends MY_Controller {
    
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
            'base_url'          =>  '/manager/warehouse/product/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'Product',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_import_date', 'end_import_date',
                'start_last_update', 'end_last_update',
                'start_ordered_date', 'end_ordered_date',
                'start_price', 'end_price',
                'start_weight', 'end_weight'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'imported_date', 'start_import_date', 'end_import_date' );
        $ciPagination->between( 'last_update', 'start_last_update', 'end_last_update' );
        $ciPagination->between( 'ordered_date', 'start_ordered_date', 'end_ordered_date' );
        $ciPagination->between( 'price', 'start_price', 'end_price' );
        $ciPagination->between( 'weight', 'start_weight', 'end_weight' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_product',

            'selectedRows'        =>  array(
                'id', 'item_code', 'location', 'model', 'sn', 'price', 'processor', 'performance_status', 'product_status', 'is_locked', 'is_ordered'
            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'item_code DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );

        $this->db->distinct();
        $this->db->select('product_status');
        $this->db->order_by('product_status ASC');
	    $productStatusQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('location');
        $this->db->order_by('location ASC');
	    $locationsQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('manufacturer_name');
        $this->db->order_by('manufacturer_name ASC');
	    $manufacturersQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('type');
        $this->db->order_by('type ASC');
	    $typesQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('model');
        $this->db->order_by('model ASC');
	    $modelsQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('visual_status');
        $this->db->order_by('visual_status ASC');
	    $visualStatusQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('performance_status');
        $this->db->order_by('performance_status ASC');
	    $performanceStatusQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('imported_date');
        $this->db->order_by('imported_date ASC');
	    $importedDatesQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('job_number');
        $this->db->order_by('job_number ASC');
        $jobNumbersQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('screen_size');
        $this->db->order_by('screen_size ASC');
        $screenSizesQuery = $this->db->get('t_warehouse_product');


	    $data['productStatus'] = $productStatusQuery->result_object();
	    $data['locations'] = $locationsQuery->result_object();
	    $data['manufacturers'] = $manufacturersQuery->result_object();
	    $data['types'] = $typesQuery->result_object();
	    $data['models'] = $modelsQuery->result_object();
	    $data['visualStatus'] = $visualStatusQuery->result_object();
	    $data['performanceStatus'] = $performanceStatusQuery->result_object();
	    $data['importedDates'] = $importedDatesQuery->result_object();
        $data['jobNumbers'] = $jobNumbersQuery->result_object();
        $data['screenSizes'] = $screenSizesQuery->result_object();

        $this->db->order_by('company_name ASC');
	    $wholesalerModelQuery = $this->db->get('t_remarketing_wholesaler');
	    $data['wholesalers'] = $wholesalerModelQuery->result_object();

        $data['orderTempListCount'] = $this->db->count_all('t_warehouse_product_order_temp_list');

	    // load the view
	    $this->load->view('manager/warehouse/product/view_by_page', $data);
	    
	}

}
