<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $job_number_id )
    {
	    if( !isset($job_number_id) ) header('Location:/manager');

        $jobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
            'id'=>$job_number_id
        ));
        $data['jobNumber'] = $jobNumberModelQuery->row_array();
        $this->load->view('manager/warehouse/product/job_number/edit',$data);
	}
	
}
