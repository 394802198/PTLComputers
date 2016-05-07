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
        $productPerformanceStatusModelQuery = $this->db->get('t_warehouse_product_performance_status');
        $data['performanceStatus'] = $productPerformanceStatusModelQuery->result_object();
        $this->load->view('manager/warehouse/product/performance_status/view',$data);
	}
}
