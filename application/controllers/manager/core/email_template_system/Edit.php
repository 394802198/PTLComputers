<?php

class Edit extends MY_Controller {

    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }

    public function id( $email_template_id )
    {
        if( ! isset( $email_template_id ) ) header('Location:/manager');

        $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
            'id'            =>  $email_template_id,
            'type'          =>  1
        ));
        if( $emailTemplateModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['emailTemplate'] = $emailTemplateModelQuery->row_array();
        $this->load->view('manager/core/email_template_system/edit', $data);
    }

}
