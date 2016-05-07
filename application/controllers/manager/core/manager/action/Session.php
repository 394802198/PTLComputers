<?php

require_once 'application/class/core/Manager.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Check Login Account Duplicate Rest
	public function check_loginaccount_duplicate()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
    		$managerModelQuery = $this->db->get_where('t_core_manager', array(
    		    'login_account'=>$manager->login_account
    		));

    		if($managerModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Existed!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	    
	}

    // Add Rest
	public function add()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
    		$managerModelQuery = $this->db->get_where('t_core_manager', array(
    		    'login_account'=>$manager->login_account
    		));
    		if($managerModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_core_manager', $manager->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Manager Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'successMsg'=>'Login Account Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'Id Account Needed!',
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
            $managerModelQuery = $this->db->get_where('t_core_manager', array(
                'id'=>$manager->id,
                'login_account'=>$manager->login_account
            ));
            $otherManagerModelQuery = $this->db->get_where('t_core_manager', array(
                'login_account'=>$manager->login_account
            ));
    		
    		if( $managerModelQuery->num_rows() > 0 || $otherManagerModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_core_manager', $manager->getEditableData(), array(
                    'id'=>$manager->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Manager Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Login Account Duplicate Rest
	public function check_edit_loginaccount_duplicate()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'Id Account Needed!',
                    'login_account'=>'Login Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
            $managerModelQuery = $this->db->get_where('t_core_manager', array(
                'id'=>$manager->id,
                'login_account'=>$manager->login_account
            ));
            $otherManagerModelQuery = $this->db->get_where('t_core_manager', array(
    		    'login_account'=>$manager->login_account
    		));

            if( $managerModelQuery->num_rows() < 1 && $otherManagerModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Delete manager
	public function delete()
	{
        $manager = new Manager($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$manager,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(!isset($_SESSION)) session_start();
        if(strcasecmp($_SESSION['manager']['role'],'administrator') != 0)
        {
            $jsonAlert->hasErrors = TRUE;
        }

        if( ! $jsonAlert->hasErrors)
        {
            $this->db->delete('t_core_manager', array(
                'id'=>$manager->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Manager deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
