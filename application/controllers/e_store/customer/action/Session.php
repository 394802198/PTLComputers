<?php

require_once 'application/class/e_store/Customer.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

    /** 更新密码
     */
    public function change_credential()
    {
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'current_credential'=>'Current Credential Needed!',
                    'new_credential'=>'New Credential Needed!',
                    'confirm_new_credential'=>'Confirm New Credential Needed!'
                ),
                'check_differ'=>array(
                    'new_credential|confirm_new_credential'=>'New Credential and Confirm New Credential must be same!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customer->id = $_SESSION['customer']['id'];
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'id'        =>  $customer->id,
                'password'  =>  md5( $customer->current_credential )
            ));

            if( $customerModelQuery->num_rows() > 0 )
            {
                if( strcasecmp( $customer->current_credential, $customer->new_credential ) != 0 )
                {
                    $customer->password = md5( $customer->new_credential );
                    $this->db->update('t_e_store_customer', $customer->getEditableData(), array(
                        'id'=>$customer->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Credential updated!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Current Credential and New Credential must be exactly different!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Please provide correct Current Credential!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    /** 更新个人信息
     */
    public function update_my_profile()
    {
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'address'=>'Address Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Emil format incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customer->id = $_SESSION['customer']['id'];
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'id'        =>  $customer->id
            ));

            if( $customerModelQuery->num_rows() > 0 )
            {
                $this->db->update('t_e_store_customer', $customer->getEditableData(), array(
                    'id'=>$customer->id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'My Profile updated!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'You are not existed in database, please contact administrator for more detail!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
