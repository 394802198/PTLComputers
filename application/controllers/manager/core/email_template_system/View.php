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
        $emailTemplateQuery = $this->db->get_where('t_core_email_template', array(
            'type'    =>  1
        ));
        $data['emailTemplates'] = $emailTemplateQuery->result_object();
        $this->load->view('manager/core/email_template_system/view', $data);
    }

}
