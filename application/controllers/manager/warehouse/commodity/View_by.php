<?php

require_once 'application/class/warehouse/commodity/Commodity.php';
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
            'base_url'          =>  '/manager/warehouse/commodity/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'Commodity',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_price', 'end_price'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 't1.price', 'start_price', 'end_price' );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_commodity',

            'selectedRows'        =>  array(
                't1.id', 't1.e_store_sku', 't1.name', 't1.price', 't1.weight', 't1.location', 't1.manufacturer', 't1.type', 't1.is_on_shelf', 't1.is_weight_shown', 't1.sequence'
            ),

            /* Optional params */
            'num_per_page'          =>  50,
            'order_by'              =>  'sequence DESC',
            'order_by_join_table'   =>  array(
                'table'     =>  't_warehouse_commodity_inventory',
                'field'     =>  'e_store_sku',
                'order_by'  =>  array(
                    array(
                        'field'     =>  'stock',
                        'sort'      =>  'DESC'
                    )
                )
            )
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $commodities = $ciPagination->content;
        if( $commodities != null )
        {
            foreach( $commodities as $commodity )
            {
                $this->db->select('stock');
                $commodityInventoryModel = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $commodity->e_store_sku
                ));
                $commodity->inventory = $commodityInventoryModel->row_array();

                $commodityRelatedMainPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                    'commodity_id'          =>  $commodity->id,
                    'is_selected_to_show'   =>  'Y'
                ));
                $commodityRelatedMainPictureCombinationModel = $commodityRelatedMainPictureCombinationModelQuery->row_array();
                $commodityRelatedMainPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                    'id'                    =>  $commodityRelatedMainPictureCombinationModel['commodity_picture_id']
                ));
                $commodity->main_picture = $commodityRelatedMainPictureModelQuery->row_array();
            }
        }

        $data['ciPagination'] = $ciPagination;

        $this->db->distinct();
        $this->db->select('location');
        $this->db->order_by('location ASC');
        $locationsQuery = $this->db->get('t_warehouse_commodity');
        $data['locations'] = $locationsQuery->result_object();

        $this->db->distinct();
        $this->db->select('manufacturer');
        $this->db->order_by('manufacturer ASC');
        $manufacturersQuery = $this->db->get('t_warehouse_commodity');
        $data['manufacturers'] = $manufacturersQuery->result_object();

        $this->db->distinct();
        $this->db->select('type');
        $this->db->order_by('type ASC');
        $typesQuery = $this->db->get('t_warehouse_commodity');
        $data['types'] = $typesQuery->result_object();

	    $this->load->view('manager/warehouse/commodity/view_by_page', $data);
	    
	}

}
