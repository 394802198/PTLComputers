<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $locationModelQuery = $this->db->get('t_warehouse_product_location');
        $data['locations'] = $locationModelQuery->result_object();
        $this->load->view('manager/warehouse/product/location/view',$data);
	}
}
