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
	    $this->load->view( 'manager/service/external_service_provider/add' );
	}
}
