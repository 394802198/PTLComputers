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

    public function id( $manager_id )
    {
        if( !isset($manager_id) ) header('Location:/manager');

        $managerModelQuery = $this->db->get_where('t_core_manager', array(
            'id'=>$manager_id
        ));
        $data['manager'] = $managerModelQuery->row_array();
        $this->load->view('manager/core/manager/edit',$data);
    }

}
