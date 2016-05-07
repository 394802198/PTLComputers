<?php

require_once 'application/class/core/Manager.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
        parent::__construct();
        $this->load->database();
    }

    // Login Rest
	public function login()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
		
        if( ! $jsonAlert->hasErrors)
        {
            $managerModelQuery = $this->db->get_where('t_core_manager', array(
                'login_account'=>$manager->login_account,
                'login_password'=>$manager->login_password
            ));

    		if($managerModelQuery->num_rows() < 1)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account and Login Password Unmatched!'
                ), TRUE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'successMsg'=>'Logon Successful!'
                ), FALSE);

                $managerModel = $managerModelQuery->row_array();
                $_SESSION["manager"] = Array(
                    'manager_id'=>$managerModel['id'],
                    'login_account'=>$managerModel['login_account'],
                    'login_password'=>$managerModel['login_password'],
                    'first_name'=>$managerModel['first_name'],
                    'last_name'=>$managerModel['last_name'],
                    'role'=>$managerModel['role']
                );
    		}
        }
        echo $jsonAlert->result();
	}
	
}
