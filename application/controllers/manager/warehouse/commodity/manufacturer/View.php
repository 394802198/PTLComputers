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
        $manufacturerModelQuery = $this->db->get('t_warehouse_commodity_manufacturer');
        $data['manufacturers'] = $manufacturerModelQuery->result_object();
        $this->load->view('manager/warehouse/commodity/manufacturer/view',$data);
	}
}
