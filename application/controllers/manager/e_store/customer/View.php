<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }
    
	public function index()
	{
        $customerModelQuery = $this->db->get('t_e_store_customer');
        $data['customers'] = $customerModelQuery->result_object();

        $this->load->view('manager/e_store/customer/view',$data);
	}

}
