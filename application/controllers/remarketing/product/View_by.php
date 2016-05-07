<?php

require_once 'application/class/warehouse/product/Product.php';
require_once 'util/myutils/CIPagination.php';

class View_By extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

    public function pagination()
    {
        $initConfig = array(
            'base_url'          =>  '/remarketing/product/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-primary'),
            'CThis'             =>  $this,
            'Model'             =>  'Product',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
//                'start_import_date', 'end_import_date',
//                'start_price', 'end_price'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

//        $ciPagination->between( 'imported_date', 'start_import_date', 'end_import_date' );
//        $ciPagination->between( 'price', 'start_price', 'end_price' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_product',

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'item_code DESC',
            'total_item_rows_where_in'=>array(
                array(
                    'field'=>'product_status',
                    'values'=>array('in stock')
                ),
                array(
                    'field'=>'is_locked',
                    'values'=>array('N')
                )
            ),
            'where_in'=>array(
                array(
                    'field'=>'product_status',
                    'values'=>array('in stock')
                ),
                array(
                    'field'=>'is_locked',
                    'values'=>array('N')
                )
            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );

        $this->db->distinct();
        $this->db->select('location');
        $this->db->where_in('product_status', array('in stock'));
        $this->db->where('is_locked', 'N');
        $this->db->where('is_ordered', 'N');
        $this->db->order_by('location ASC');
        $locationsQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('manufacturer_name');
        $this->db->where_in('product_status', array('in stock'));
        $this->db->where('is_locked', 'N');
        $this->db->where('is_ordered', 'N');
        $this->db->order_by('manufacturer_name ASC');
        $manufacturersQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('type');
        $this->db->where_in('product_status', array('in stock'));
        $this->db->where('is_locked', 'N');
        $this->db->where('is_ordered', 'N');
        $this->db->order_by('type ASC');
        $typesQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('model');
        $this->db->where_in('product_status', array('in stock'));
        $this->db->where('is_locked', 'N');
        $this->db->where('is_ordered', 'N');
        $this->db->order_by('model ASC');
        $modelsQuery = $this->db->get('t_warehouse_product');

        $data['locations'] = $locationsQuery->result_object();
        $data['manufacturers'] = $manufacturersQuery->result_object();
        $data['types'] = $typesQuery->result_object();
        $data['models'] = $modelsQuery->result_object();

        $this->load->view('remarketing/product/view_by_page',$data);
    }

	// View By Id
	public function id( $product_id )
	{
        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
            'id'=>$product_id
        ));
        $data['product'] = $productModelQuery->row_array();
        $this->load->view('remarketing/product/view_by_id',$data);
	}

}
