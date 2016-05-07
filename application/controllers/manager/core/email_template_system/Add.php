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
        $this->load->view('manager/core/email_template_system/add');
    }

}
