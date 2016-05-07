<?php 

class Logout extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        if( isset($_SESSION['manager']) ) unset($_SESSION['manager']);
        header('Location:/manager/login');
	}
	
}
