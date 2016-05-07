<?php

class Home extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function index()
	{
		$this->load->view('remarketing/home');
	}
}
