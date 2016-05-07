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
        $locationModelQuery = $this->db->get('t_warehouse_commodity_location');
        $data['locations'] = $locationModelQuery->result_object();
        $manufacturerModelQuery = $this->db->get('t_warehouse_commodity_manufacturer');
        $data['manufacturers'] = $manufacturerModelQuery->result_object();
        $typeModelQuery = $this->db->get('t_warehouse_commodity_type');
        $data['types'] = $typeModelQuery->result_object();
	    $this->load->view('manager/warehouse/commodity/add', $data);
	}
}
