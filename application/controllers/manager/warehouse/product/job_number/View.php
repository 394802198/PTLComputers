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
        $jobNumberModelQuery = $this->db->get('t_warehouse_product_job_number');
        $data['jobNumbers'] = $jobNumberModelQuery->result_object();
        $this->load->view('manager/warehouse/product/job_number/view',$data);
	}
}
