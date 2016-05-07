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
        $typeModelQuery = $this->db->get('t_warehouse_product_type');
        $data['types'] = $typeModelQuery->result_object();
        $this->load->view('manager/warehouse/product/type/view',$data);
	}
}
