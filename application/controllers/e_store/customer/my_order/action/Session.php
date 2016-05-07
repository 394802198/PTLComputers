<?php

require_once 'application/class/e_store/CustomerReceiverAddress.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {

    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

    /** 更新收件人地址
     */
    public function edit()
    {
        $customerReceiverAddress = new CustomerReceiverAddress( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customerReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'shipping_area_id'=>'Shipping Area Needed!',
                    'receiver_name'=>'Receiver Name Needed!',
                    'receiver_phone'=>'Receiver Phone Needed!',
                    'receiver_address'=>'Receiver Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果已存在相同基本信息
         */
        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'customer_id'           =>  $_SESSION['customer']['id'],
            'receiver_name'         =>  $customerReceiverAddress->receiver_name,
            'receiver_phone'        =>  $customerReceiverAddress->receiver_phone,
            'receiver_email'        =>  $customerReceiverAddress->receiver_email,
            'receiver_country'      =>  $customerReceiverAddress->receiver_country,
            'receiver_province'     =>  $customerReceiverAddress->receiver_province,
            'receiver_city'         =>  $customerReceiverAddress->receiver_city,
            'receiver_address'      =>  $customerReceiverAddress->receiver_address,
            'receiver_post'         =>  $customerReceiverAddress->receiver_post
        ));
        $customerReceiverAddressModel = $customerReceiverAddressModelQuery->row_array();
        if( $customerReceiverAddressModelQuery->num_rows() > 0 && $customerReceiverAddressModel['id'] != $customerReceiverAddress->id )
        {
            $jsonAlert->append(array(
                'sameCustomerReceiverAddressMsg'=>'Please don\'t add redundant Customer Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);
        }

        /** 如果是默认收件地址，则不能手动改成非默认，只能通过将另一个收件地址改成默认来变更默认收件地址
         */
        if( $customerReceiverAddress->is_default == 'N' )
        {
            $thisCustomerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
                'id' =>$customerReceiverAddress->id,
                'is_default'    =>'Y'
            ));
            if( $thisCustomerReceiverAddressModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'couldNotSetDefaultToNotDefaultCustomerReceiverAddressMsg'=>'The only way to change this Receiver Address as Non-default is to set another Receiver Address as Default!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** 如果该收件人地址被设置为默认
             */
            if( $customerReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_e_store_customer_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'customer_id' =>$customerReceiverAddress->customer_id
                ));

                $jsonAlert->append(array(
                    'setCustomerReceiverAddressAsDefaultMsg'=>'Set updated customer receiver address as default!'
                ), FALSE);
            }

            $customerReceiverAddress->customer_id = $_SESSION['customer']['id'];

            $this->db->update('t_e_store_customer_receiver_address', $customerReceiverAddress->getEditableData(), array(
                'id'=>$customerReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Customer Receiver Address Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加收件人地址
     */
    public function add()
    {
        $customerReceiverAddress = new CustomerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customerReceiverAddress,
                'check_empty'=>array(
                    'shipping_area_id'=>'Shipping Area Needed!',
                    'receiver_name'=>'Receiver Name Needed!',
                    'receiver_phone'=>'Receiver Phone Needed!',
                    'receiver_address'=>'Receiver Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果已存在相同基本信息
         */
        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'customer_id'           =>  $_SESSION['customer']['id'],
            'receiver_name'         =>  $customerReceiverAddress->receiver_name,
            'receiver_phone'        =>  $customerReceiverAddress->receiver_phone,
            'receiver_email'        =>  $customerReceiverAddress->receiver_email,
            'receiver_country'      =>  $customerReceiverAddress->receiver_country,
            'receiver_province'     =>  $customerReceiverAddress->receiver_province,
            'receiver_city'         =>  $customerReceiverAddress->receiver_city,
            'receiver_address'      =>  $customerReceiverAddress->receiver_address,
            'receiver_post'         =>  $customerReceiverAddress->receiver_post
        ));
        if( $customerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'sameCustomerReceiverAddressMsg'=>'Please don\'t add redundant Customer Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** 如果该收件人地址被设置为默认
             */
            if( $customerReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_e_store_customer_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'customer_id' =>    $_SESSION['customer']['id']
                ));

                $jsonAlert->append(array(
                    'setCustomerReceiverAddressAsDefaultMsg'=>'Set created customer receiver address as default!'
                ), FALSE);
            }

            $customerReceiverAddress->customer_id = $_SESSION['customer']['id'];

            $this->db->insert('t_e_store_customer_receiver_address', $customerReceiverAddress->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Customer Receiver Address Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 更新默认收件地址
     */
    public function set_as_default()
    {
        $customerReceiverAddress = new CustomerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customerReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_customer_receiver_address', array(
                'is_default'    =>  'N'
            ), array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));

            $this->db->update('t_e_store_customer_receiver_address', array(
                'is_default'    =>  'Y'
            ), array(
                'id'            =>  $customerReceiverAddress->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Successfully set this Receiver Address as default'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 删除收件人地址
     */
    public function delete()
    {
        $customerReceiverAddress = new CustomerReceiverAddress( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customerReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果该收件人地址是默认收件地址
         */
        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'is_default'    =>'Y',
            'id'            =>$customerReceiverAddress->id
        ));
        if( $customerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'couldNotSetCustomerReceiverAddressAsDefaultMsg'=>'Customer Receiver Address is set as default, could not be deleted!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_customer_receiver_address', array(
                'id'    =>$customerReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Customer Receiver Address Deleted!'
            ), FALSE);
        }

        echo $jsonAlert->result();
    }

}
