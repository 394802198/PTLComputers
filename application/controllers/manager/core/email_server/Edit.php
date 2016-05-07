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

    public function id( $email_server_id )
    {
        if( ! isset( $email_server_id ) ) header('Location:/manager');

        $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
            'id'            =>  $email_server_id,
            'is_default'    =>  'N'
        ));
        if( $emailServerModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['emailServer'] = $emailServerModelQuery->row_array();
        $this->load->view('manager/core/email_server/edit',$data);
    }

}
