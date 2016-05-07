<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $performance_status_id )
    {
	    if(!isset($performance_status_id)) header('Location:/manager');

        $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
            'id'=>$performance_status_id
        ));
        $data['performanceStatus'] = $productPerformanceStatusModelQuery->row_array();
        $this->load->view('manager/warehouse/product/performance_status/edit',$data);
	    
	}
	
}
