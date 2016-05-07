<?php

require_once 'application/class/remarketing/Wholesaler.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

    // Login Rest
	public function login()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $coreStatusModelQuery = $this->db->get('t_core_status');
	    $coreStatusModel = $coreStatusModelQuery->row_array();

		$is_not_first_time = NULL;
	    
	    if( $coreStatusModel['status'] == 'maintain' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'System is currently under maintenance, sorry for your inconvenience!'
            ), TRUE);
	    }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account,
                'login_password'=>$wholesaler->login_password
            ));

            if( $wholesalerModelQuery->num_rows() < 1 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account and Login Password Unmatched!'
                ), TRUE);
            }
            else
            {
                $wholesalerModel = $wholesalerModelQuery->row_array();
                if( $wholesalerModel['is_activated'] == 0 )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Your account hasn\'t been activated, please contact system admin to activate it!'
                    ), TRUE);
                }
                else if($wholesalerModel['is_not_first_time'] == 0)
                {
                    $is_not_first_time = 0;

                    $_SESSION["wholesaler_id_4_terms_conditions"] = $wholesalerModel['id'];
                }
                else
                {
                    $is_not_first_time = 1;

                    $_SESSION["wholesaler"] = $wholesalerModel;
                }
            }
	    }
        $jsonAlert->model = array(
            'is_not_first_time'=>$is_not_first_time
        );
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
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'company_name'=>'Company Name Needed!',
                    'landline_phone'=>'Landline Phone Needed!',
                    'mobile_phone'=>'Mobile Phone Needed!',
//                    'fax_no'=>'Fax No Needed!',
                    'street'=>'Street Needed!',
                    'area'=>'Area Needed!',
                    'city'=>'City Needed!',
                    'country'=>'Country Needed!',
                    'security_question'=>'Security Question Needed!',
                    'security_answer'=>'Security Answer Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesaler->id = $_SESSION['wholesaler']['id'];
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
                    'successMsg'=>'My account details up to date!'
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
	
}
