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
        $productStatusModelQuery = $this->db->get('t_warehouse_product_status');
        $data['productStatus'] = $productStatusModelQuery->result_object();
        $this->load->view('manager/warehouse/product/status/view',$data);
	}
}
