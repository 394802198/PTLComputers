<?php 

class Add extends MY_Controller {
    
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
        $this->load->view('manager/e_store/customer/add');
	}
}
