<?php

class Edit_My_Profile extends MY_Controller {

    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    public function index()
    {
        if( !isset($_SESSION['manager']['manager_id']) ) header('Location:/manager/home');

        $managerModelQuery = $this->db->get_where('t_core_manager', array(
            'id'=>$_SESSION['manager']['manager_id']
        ));
        $data['manager'] = $managerModelQuery->row_array();
        $this->load->view('manager/core/manager/edit_my_profile',$data);
    }

}
