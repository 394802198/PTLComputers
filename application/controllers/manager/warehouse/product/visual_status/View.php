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
        $productVisualStatusModelQuery = $this->db->get('t_warehouse_product_visual_status');
        $data['visualStatus'] = $productVisualStatusModelQuery->result_object();
        $this->load->view('manager/warehouse/product/visual_status/view',$data);
	}
}
