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
        $this->db->order_by('name ASC');
        $productStatusModelQuery = $this->db->get('t_warehouse_product_status');
        $data['productStatus'] = $productStatusModelQuery->result_object();
        $this->db->order_by('name ASC');
        $locationModelQuery = $this->db->get('t_warehouse_product_location');
        $data['locations'] = $locationModelQuery->result_object();
        $this->db->order_by('name ASC');
        $manufacturerModelQuery = $this->db->get('t_warehouse_product_manufacturer');
        $data['manufacturers'] = $manufacturerModelQuery->result_object();
        $this->db->order_by('name ASC');
        $typeModelQuery = $this->db->get('t_warehouse_product_type');
        $data['types'] = $typeModelQuery->result_object();
        $this->db->order_by('name ASC');
        $visualStatusModelQuery = $this->db->get('t_warehouse_product_visual_status');
        $data['visualStatus'] = $visualStatusModelQuery->result_object();
        $this->db->order_by('name ASC');
        $performanceStatus = $this->db->get('t_warehouse_product_performance_status');
        $data['performanceStatus'] = $performanceStatus->result_object();
        $this->db->order_by('name ASC');
        $screenSizes = $this->db->get('t_warehouse_product_screen_size');
        $data['screenSizes'] = $screenSizes->result_object();
        $this->db->order_by('name ASC');
        $jobNumbers = $this->db->get('t_warehouse_product_job_number');
        $data['jobNumbers'] = $jobNumbers->result_object();

	    $this->load->view('manager/warehouse/product/add', $data);
	}
}
