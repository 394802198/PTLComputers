<?php 

class Logout extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        if( isset($_SESSION['wholesaler']) ) unset($_SESSION['wholesaler']);
        $this->load->view('remarketing/login');
	}
	
}
