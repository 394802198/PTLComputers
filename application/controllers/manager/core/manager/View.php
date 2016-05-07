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
        $managerModelQuery = $this->db->get('t_core_manager');
        $data['managers'] = $managerModelQuery->result_object();
        $this->load->view('manager/core/manager/view',$data);
    }

}
