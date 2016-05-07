<?php 

class Add extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $commodityManufacturersModelQuery = $this->db->get('t_warehouse_commodity_manufacturer');
        $commodityTypesModelQuery = $this->db->get('t_warehouse_commodity_type');
        $data['manufacturers'] = $commodityManufacturersModelQuery->result_object();
        $data['types'] = $commodityTypesModelQuery->result_object();

	    $this->load->view( 'manager/warehouse/commodity/picture/add', $data );
	}
}
