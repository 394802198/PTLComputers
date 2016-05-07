<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function id( $product_id )
    {
	    if(!isset($product_id)) header('Location:/manager');

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
        $performanceStatusModelQuery = $this->db->get('t_warehouse_product_performance_status');
	    $data['performanceStatus'] = $performanceStatusModelQuery->result_object();
        $this->db->order_by('name ASC');
        $screenSizes = $this->db->get('t_warehouse_product_screen_size');
        $data['screenSizes'] = $screenSizes->result_object();
        $this->db->order_by('name ASC');
        $jobNumbers = $this->db->get('t_warehouse_product_job_number');
        $data['jobNumbers'] = $jobNumbers->result_object();

        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
            'id'=>$product_id
        ));
        $data['product'] = $productModelQuery->row_array();
        $this->load->view('manager/warehouse/product/edit',$data);
	}

}
