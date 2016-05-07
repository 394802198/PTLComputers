<?php 

class Edit_By extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	// Edit by condition
	public function condition()
    {
        $this->db->distinct();
        $this->db->select('location');
        $this->db->order_by('location','ASC');
	    $locationModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('manufacturer_name');
        $this->db->order_by('manufacturer_name','ASC');
        $manufacturerModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('type');
        $this->db->order_by('type','ASC');
        $typeModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('model');
        $this->db->order_by('model','ASC');
        $modelModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('visual_status');
        $this->db->order_by('visual_status','ASC');
        $visualStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('performance_status');
        $this->db->order_by('performance_status','ASC');
        $performanceStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('imported_date');
        $this->db->order_by('imported_date','ASC');
        $importedDateModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('product_status');
        $this->db->order_by('product_status','ASC');
        $productStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('processor');
        $this->db->order_by('processor','ASC');
        $processorModelQuery = $this->db->get('t_warehouse_product');
	    
	    $data['locations'] = $locationModelQuery->result_object();
	    $data['manufacturers'] = $manufacturerModelQuery->result_object();
	    $data['types'] = $typeModelQuery->result_object();
	    $data['models'] = $modelModelQuery->result_object();
	    $data['visualStatus'] = $visualStatusModelQuery->result_object();
	    $data['performanceStatus'] = $performanceStatusModelQuery->result_object();
	    $data['importedDates'] = $importedDateModelQuery->result_object();
	    $data['productStatus'] = $productStatusModelQuery->result_object();
        $data['processor'] = $processorModelQuery->result_object();
	    
        $this->load->view('manager/warehouse/product/edit_by_condition', $data);
	}
	
}
