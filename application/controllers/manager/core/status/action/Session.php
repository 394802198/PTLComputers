<?php

require_once 'application/class/core/Status.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }

    public function switch_e_store_state()
    {
        $coreStatus = new Status($this->input);
        $jsonAlert = new JSONAlert();

        $this->db->update('t_core_status', array(
            'estore_state'=>$coreStatus->estore_state
        ));

        $jsonAlert->append(array(
            'successMsg'=>'EStore System Switch to ' . ( $coreStatus->estore_state == 'routine' ? 'Routine' : 'Maintain' )
        ), FALSE);

        echo $jsonAlert->result();
    }

	public function switch_remarketing_state()
	{
        $coreStatus = new Status($this->input);
        $jsonAlert = new JSONAlert();

        $this->db->update('t_core_status', array(
            'remarketing_state'=>$coreStatus->remarketing_state
        ));

        $jsonAlert->append(array(
            'successMsg'=>'Remarketing System Switch to ' . ( $coreStatus->remarketing_state == 'routine' ? 'Routine' : 'Maintain' )
        ), FALSE);

        echo $jsonAlert->result();
	}
	
}
