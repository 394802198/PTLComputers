<?php

require_once 'application/class/remarketing/Wholesaler.php';
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

    // Check Login Account Duplicate Rest
	public function check_loginaccount_duplicate()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

    		if($wholesalerModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Add Rest
	public function add()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'company_name'=>'Company Name Needed!',
                    'landline_phone'=>'Landline Phone Needed!',
                    'mobile_phone'=>'Mobile Phone Needed!',
                    'street'=>'Street Needed!',
                    'area'=>'Area Needed!',
                    'city'=>'City Needed!',
                    'country'=>'Country Needed!',
                    'security_question'=>'Security Question Needed!',
                    'security_answer'=>'Security Answer Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

    		if($wholesalerModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_remarketing_wholesaler', $wholesaler->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Wholesaler Created!'
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

	// Edit Rest
	public function edit()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'company_name'=>'Company Name Needed!',
                    'landline_phone'=>'Landline Phone Needed!',
                    'mobile_phone'=>'Mobile Phone Needed!',
                    'street'=>'Street Needed!',
                    'area'=>'Area Needed!',
                    'city'=>'City Needed!',
                    'country'=>'Country Needed!',
                    'security_question'=>'Security Question Needed!',
                    'security_answer'=>'Security Answer Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'id'=>$wholesaler->id,
                'login_account'=>$wholesaler->login_account
            ));
            $otherWholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

    		if($wholesalerModelQuery->num_rows() > 0 || $otherWholesalerModelQuery->num_rows() < 1)
            {
    		    $this->db->update('t_remarketing_wholesaler', $wholesaler->getEditableData(), array(
                    'id'=>$wholesaler->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Wholesaler Updated!'
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
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'login_account'=>'Login Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'id'=>$wholesaler->id,
                'login_account'=>$wholesaler->login_account
            ));
            $otherWholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

            if($wholesalerModelQuery->num_rows() < 1 && $otherWholesalerModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    // Delete wholesaler
	public function delete()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_remarketing_wholesaler', array(
                'id'=>$wholesaler->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Wholesaler Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Activate wholesaler
	public function activate()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_remarketing_wholesaler', array(
                'is_activated'=>1
            ), array(
                'id'=>$wholesaler->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Wholesaler Activated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Inactivate wholesaler
	public function inactivate()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_remarketing_wholesaler', array(
                'is_activated'=>0
            ), array(
                'id'=>$wholesaler->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Wholesaler Inactivated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
