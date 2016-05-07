<?php

require_once 'application/class/e_store/Customer.php';
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

    // Check Account Duplicate Rest
	public function check_account_duplicate()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'account'=>'Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'account'=>$customer->account
            ));

    		if( $customerModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Add Rest
	public function add()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'account'=>'Account Needed!',
                    'password'=>'Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'mobile_phone'=>'Mobile Needed!',
                    'country'=>'Country Needed!',
                    'province'=>'Province Needed!',
                    'city'=>'City Needed!',
                    'address'=>'Address Needed!'
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
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'account'=>$customer->account
            ));

    		if( $customerModelQuery->num_rows() < 1 )
            {
                $customer->password = md5( $customer->password );

                $this->db->insert('t_e_store_customer', $customer->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Customer Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'account'=>'Account Needed!',
                    'password'=>'Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'mobile_phone'=>'Mobile Needed!',
                    'country'=>'Country Needed!',
                    'province'=>'Province Needed!',
                    'city'=>'City Needed!',
                    'address'=>'Address Needed!'
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
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'id'=>$customer->id,
                'account'=>$customer->account
            ));
            $otherCustomerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'account'=>$customer->account
            ));

    		if( $customerModelQuery->num_rows() > 0 || $otherCustomerModelQuery->num_rows() < 1 )
            {
                $customer->password = md5( $customer->password );

    		    $this->db->update('t_e_store_customer', $customer->getEditableData(), array(
                    'id'=>$customer->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Customer Updated!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    // Check Edit Account Duplicate Rest
	public function check_edit_account_duplicate()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'account'=>'Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'id'=>$customer->id,
                'account'=>$customer->account
            ));
            $otherCustomerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'account'=>$customer->account
            ));

            if( $customerModelQuery->num_rows() < 1 && $otherCustomerModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    // Delete customer
	public function delete()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_customer', array(
                'id'=>$customer->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Customer Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Activate customer
	public function activate()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_customer', array(
                'is_activated'  =>  'Y'
            ), array(
                'id'    =>  $customer->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Customer Activated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Inactivate customer
	public function inactivate()
	{
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_customer', array(
                'is_activated'  =>  'N'
            ), array(
                'id'    =>  $customer->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Customer Inactivated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
