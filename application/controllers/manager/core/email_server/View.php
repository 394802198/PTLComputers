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
        $emailServerQuery = $this->db->get_where('t_core_email_server', array(
            'is_default'    =>  'N'
        ));
        $data['emailServers'] = $emailServerQuery->result_object();
        $this->load->view('manager/core/email_server/view',$data);
    }

}
