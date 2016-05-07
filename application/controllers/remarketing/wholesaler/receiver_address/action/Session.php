<?php

require_once 'application/class/remarketing/WholesalerReceiverAddress.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

    // Add Rest
	public function add()
	{
        $myReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$myReceiverAddress,
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

        /* Check if basic details are same */
        $myReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'         =>$_SESSION["wholesaler"]['id'],
            'receiver_name'         =>$myReceiverAddress->receiver_name,
            'receiver_phone'        =>$myReceiverAddress->receiver_phone,
            'receiver_email'        =>$myReceiverAddress->receiver_email,
            'receiver_country'      =>$myReceiverAddress->receiver_country,
            'receiver_province'     =>$myReceiverAddress->receiver_province,
            'receiver_city'         =>$myReceiverAddress->receiver_city,
            'receiver_address'      =>$myReceiverAddress->receiver_address,
            'receiver_post'         =>$myReceiverAddress->receiver_post
        ));
        if( $myReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'sameReceiverAddressMsg'=>'Please don\'t add redundant Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            /* If My Receiver Address is set as default */
            if( $myReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_remarketing_wholesaler_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'wholesaler_id' =>$_SESSION["wholesaler"]['id']
                ));

                $jsonAlert->append(array(
                    'setReceiverAddressAsDefaultMsg'=>'Set created receiver address as default!'
                ), FALSE);
            }
            $myReceiverAddress->wholesaler_id = $_SESSION["wholesaler"]['id'];
            $this->db->insert('t_remarketing_wholesaler_receiver_address', $myReceiverAddress->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Receiver Address Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $myReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$myReceiverAddress,
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

        /* Check if basic details are same */
        $myReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'         =>$_SESSION["wholesaler"]['id'],
            'receiver_name'         =>$myReceiverAddress->receiver_name,
            'receiver_phone'        =>$myReceiverAddress->receiver_phone,
            'receiver_email'        =>$myReceiverAddress->receiver_email,
            'receiver_country'      =>$myReceiverAddress->receiver_country,
            'receiver_province'     =>$myReceiverAddress->receiver_province,
            'receiver_city'         =>$myReceiverAddress->receiver_city,
            'receiver_address'      =>$myReceiverAddress->receiver_address,
            'receiver_post'         =>$myReceiverAddress->receiver_post
        ));
        $myReceiverAddressModel = $myReceiverAddressModelQuery->row_array();
        if( $myReceiverAddressModelQuery->num_rows() > 0 && $myReceiverAddressModel['id'] != $myReceiverAddress->id )
        {
            $jsonAlert->append(array(
                'sameReceiverAddressMsg'=>'Please don\'t add redundant Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        /* If my receiver address is default, then could not be set as not default.
           The only way to set this as not default is to set my another receiver address as default
           and this receiver address will automatically be not default. */
        if( $myReceiverAddress->is_default == 'N' )
        {
            $thisMyReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
                'id' =>$myReceiverAddress->id,
                'is_default'    =>'Y'
            ));
            if( $thisMyReceiverAddressModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'couldNotSetDefaultToNotDefaultMyReceiverAddressMsg'=>'The only way to change this Receiver Address as Non-default is to set another Receiver Address as Default!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            /* If My Receiver Address is set as default */
            if( $myReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_remarketing_wholesaler_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'wholesaler_id' =>$_SESSION["wholesaler"]['id']
                ));

                $jsonAlert->append(array(
                    'setReceiverAddressAsDefaultMsg'=>'Set updated receiver address as default!'
                ), FALSE);
            }

            $myReceiverAddress->wholesaler_id = $_SESSION["wholesaler"]['id'];
            $this->db->update('t_remarketing_wholesaler_receiver_address', $myReceiverAddress->getEditableData(), array(
                'id'=>$myReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Receiver Address Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Delete My Receiver Address
	public function delete()
	{
        $myReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$myReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if Wholesaler Receiver Address is set as default */
        $myReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'is_default'    =>'Y',
            'id'            =>$myReceiverAddress->id
        ));
        if( $myReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'couldNotSetReceiverAddressAsDefaultMsg'=>'Receiver Address is set as default, could not be deleted!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_remarketing_wholesaler_receiver_address', array(
                'id'    =>$myReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Receiver Address Deleted!'
            ), FALSE);
        }

        echo $jsonAlert->result();
	}
	
}
