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
        $this->isCurrentManagerAdmin();

        $this->db->distinct();
        $this->db->select('location');
        $this->db->order_by('location','ASC');
	    $conditionLocationModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('manufacturer_name');
        $this->db->order_by('manufacturer_name','ASC');
        $conditionManufacturerModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('type');
        $this->db->order_by('type','ASC');
        $conditionTypeModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('model');
        $this->db->order_by('model','ASC');
        $conditionModelModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('visual_status');
        $this->db->order_by('visual_status','ASC');
        $conditionVisualStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('performance_status');
        $this->db->order_by('performance_status','ASC');
        $conditionPerformanceStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('imported_date');
        $this->db->order_by('imported_date','ASC');
        $conditionImportedDateModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('product_status');
        $this->db->order_by('product_status','ASC');
        $conditionProductStatusModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('screen_size');
        $this->db->order_by('screen_size','ASC');
        $conditionScreenSizesModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('job_number');
        $this->db->order_by('job_number','ASC');
        $conditionJobNumbersModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('processor');
        $this->db->order_by('processor','ASC');
        $conditionProcessorsModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('processor_speed');
        $this->db->order_by('processor_speed','ASC');
        $conditionProcessorSpeedsModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('mem_size');
        $this->db->order_by('mem_size','ASC');
        $conditionMemSizesModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('hdd_size');
        $this->db->order_by('hdd_size','ASC');
        $conditionHDDSizesModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('optical_drive');
        $this->db->order_by('optical_drive','ASC');
        $conditionOpticalDrivesModelQuery = $this->db->get('t_warehouse_product');
        $this->db->distinct();
        $this->db->select('system_license');
        $this->db->order_by('system_license','ASC');
        $conditionSystemLicensesModelQuery = $this->db->get('t_warehouse_product');
	    
	    $data['conditionLocations'] = $conditionLocationModelQuery->result_object();
	    $data['conditionManufacturers'] = $conditionManufacturerModelQuery->result_object();
	    $data['conditionTypes'] = $conditionTypeModelQuery->result_object();
	    $data['conditionModels'] = $conditionModelModelQuery->result_object();
	    $data['conditionVisualStatus'] = $conditionVisualStatusModelQuery->result_object();
	    $data['conditionPerformanceStatus'] = $conditionPerformanceStatusModelQuery->result_object();
	    $data['conditionImportedDates'] = $conditionImportedDateModelQuery->result_object();
	    $data['conditionProductStatus'] = $conditionProductStatusModelQuery->result_object();
        $data['conditionScreenSizes'] = $conditionScreenSizesModelQuery->result_object();
        $data['conditionJobNumbers'] = $conditionJobNumbersModelQuery->result_object();
        $data['conditionProcessors'] = $conditionProcessorsModelQuery->result_object();
        $data['conditionProcessorSpeeds'] = $conditionProcessorSpeedsModelQuery->result_object();
        $data['conditionMemSizes'] = $conditionMemSizesModelQuery->result_object();
        $data['conditionHDDSizes'] = $conditionHDDSizesModelQuery->result_object();
        $data['conditionOpticalDrives'] = $conditionOpticalDrivesModelQuery->result_object();
        $data['conditionSystemLicenses'] = $conditionSystemLicensesModelQuery->result_object();


        $finalProductStatusModelQuery = $this->db->get('t_warehouse_product_status');
        $data['finalProductStatus'] = $finalProductStatusModelQuery->result_object();
        $finalLocationModelQuery = $this->db->get('t_warehouse_product_location');
        $data['finalLocations'] = $finalLocationModelQuery->result_object();
        $finalManufacturerModelQuery = $this->db->get('t_warehouse_product_manufacturer');
        $data['finalManufacturers'] = $finalManufacturerModelQuery->result_object();
        $finalTypeModelQuery = $this->db->get('t_warehouse_product_type');
        $data['finalTypes'] = $finalTypeModelQuery->result_object();
        $finalVisualStatusModelQuery = $this->db->get('t_warehouse_product_visual_status');
        $data['finalVisualStatus'] = $finalVisualStatusModelQuery->result_object();
        $finalPerformanceStatusModelQuery = $this->db->get('t_warehouse_product_performance_status');
        $data['finalPerformanceStatus'] = $finalPerformanceStatusModelQuery->result_object();
        $finalScreenSizes = $this->db->get('t_warehouse_product_screen_size');
        $data['finalScreenSizes'] = $finalScreenSizes->result_object();
        $finalJobNumbers = $this->db->get('t_warehouse_product_job_number');
        $data['finalJobNumbers'] = $finalJobNumbers->result_object();
	    
        $this->load->view('manager/warehouse/product/edit_by_condition', $data);
	}
	
}
