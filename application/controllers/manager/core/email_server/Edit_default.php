<?php

class Edit_Default extends MY_Controller {

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
        $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
            'is_default'    =>  'Y'
        ));
        $data['emailServer'] = $emailServerModelQuery->row_array();
        $this->load->view('manager/core/email_server/edit_default',$data);
    }

}
