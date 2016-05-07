<?php

require_once 'application/class/remarketing/WholesalerReceiverAddress.php';
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

    // Add Rest
	public function add()
	{
        $wholesalerReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesalerReceiverAddress,
                'check_empty'=>array(
                    'wholesaler_id'=>'Wholesaler Needed!',
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
        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'         =>$wholesalerReceiverAddress->wholesaler_id,
            'receiver_name'         =>$wholesalerReceiverAddress->receiver_name,
            'receiver_phone'        =>$wholesalerReceiverAddress->receiver_phone,
            'receiver_email'        =>$wholesalerReceiverAddress->receiver_email,
            'receiver_country'      =>$wholesalerReceiverAddress->receiver_country,
            'receiver_province'     =>$wholesalerReceiverAddress->receiver_province,
            'receiver_city'         =>$wholesalerReceiverAddress->receiver_city,
            'receiver_address'      =>$wholesalerReceiverAddress->receiver_address,
            'receiver_post'         =>$wholesalerReceiverAddress->receiver_post
        ));
        if( $wholesalerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'sameWholesalerReceiverAddressMsg'=>'Please don\'t add redundant Wholesaler Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            /* If this Wholesaler Receiver Address is set as default */
            if( $wholesalerReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_remarketing_wholesaler_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'wholesaler_id' =>$wholesalerReceiverAddress->wholesaler_id
                ));

                $jsonAlert->append(array(
                    'setWholesalerReceiverAddressAsDefaultMsg'=>'Set created wholesaler receiver address as default!'
                ), FALSE);
            }

            $this->db->insert('t_remarketing_wholesaler_receiver_address', $wholesalerReceiverAddress->getInsertableData());


            $jsonAlert->append(array(
                'successMsg'=>'New Wholesaler Receiver Address Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $wholesalerReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesalerReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'wholesaler_id'=>'Wholesaler Needed!',
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
        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'         =>$wholesalerReceiverAddress->wholesaler_id,
            'receiver_name'         =>$wholesalerReceiverAddress->receiver_name,
            'receiver_phone'        =>$wholesalerReceiverAddress->receiver_phone,
            'receiver_email'        =>$wholesalerReceiverAddress->receiver_email,
            'receiver_country'      =>$wholesalerReceiverAddress->receiver_country,
            'receiver_province'     =>$wholesalerReceiverAddress->receiver_province,
            'receiver_city'         =>$wholesalerReceiverAddress->receiver_city,
            'receiver_address'      =>$wholesalerReceiverAddress->receiver_address,
            'receiver_post'         =>$wholesalerReceiverAddress->receiver_post
        ));
        $wholesalerReceiverAddressModel = $wholesalerReceiverAddressModelQuery->row_array();
        if( $wholesalerReceiverAddressModelQuery->num_rows() > 0 && $wholesalerReceiverAddressModel['id'] != $wholesalerReceiverAddress->id )
        {
            $jsonAlert->append(array(
                'sameWholesalerReceiverAddressMsg'=>'Please don\'t add redundant Wholesaler Receiver Address, the basic information you provided is existed in database!'
            ), TRUE);
        }

        /* If this wholesaler receiver address is default, then could not be set as not default.
           The only way to set this as not default is to set this wholesaler's another receiver address as default
           and this receiver address will automatically be not default. */
        if( $wholesalerReceiverAddress->is_default == 'N' )
        {
            $thisWholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
                'id' =>$wholesalerReceiverAddress->id,
                'is_default'    =>'Y'
            ));
            if( $thisWholesalerReceiverAddressModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'couldNotSetDefaultToNotDefaultWholesalerReceiverAddressMsg'=>'The only way to change this Receiver Address as Non-default is to set another Receiver Address as Default!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            /* If this Wholesaler Receiver Address is set as default */
            if( $wholesalerReceiverAddress->is_default == 'Y' )
            {
                $this->db->update('t_remarketing_wholesaler_receiver_address', array(
                    'is_default'    =>'N'
                ), array(
                    'wholesaler_id' =>$wholesalerReceiverAddress->wholesaler_id
                ));

                $jsonAlert->append(array(
                    'setWholesalerReceiverAddressAsDefaultMsg'=>'Set updated wholesaler receiver address as default!'
                ), FALSE);
            }

            $this->db->update('t_remarketing_wholesaler_receiver_address', $wholesalerReceiverAddress->getEditableData(), array(
                'id'=>$wholesalerReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Wholesaler Receiver Address Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    // Delete Wholesaler Receiver Address
	public function delete()
	{
        $wholesalerReceiverAddress = new WholesalerReceiverAddress($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesalerReceiverAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if Wholesaler Receiver Address is set as default */
        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'is_default'    =>'Y',
            'id'            =>$wholesalerReceiverAddress->id
        ));
        if( $wholesalerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'couldNotSetWholesalerReceiverAddressAsDefaultMsg'=>'Wholesaler Receiver Address is set as default, could not be deleted!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_remarketing_wholesaler_receiver_address', array(
                'id'    =>$wholesalerReceiverAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Wholesaler Receiver Address Deleted!'
            ), FALSE);
        }

        $jsonAlert->model = array(
            'wholesaler_id'     =>$wholesalerReceiverAddress->wholesaler_id
        );

        echo $jsonAlert->result();
	}
	
}
