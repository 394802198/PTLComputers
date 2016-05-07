<?php

require_once 'application/class/warehouse/logistic/courier/CourierShippingArea.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Check Name Duplicate Rest
    public function check_name_duplicate()
    {
        $courierShippingArea = new CourierShippingArea($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierShippingArea,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'name'=>$courierShippingArea->name
            ));

            if( $courierShippingAreaModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    // Add Rest
	public function add()
	{
        $courierShippingArea = new CourierShippingArea($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierShippingArea,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'name'=>$courierShippingArea->name
            ));
    		if( $courierShippingAreaModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_courier_shipping_area', $courierShippingArea->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Courier Shipping Area Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $courierShippingArea = new CourierShippingArea($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierShippingArea,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if Courier Shipping Area is attached to Courier Pricing */
        $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $courierPricingModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInCourierPricingMsg'=>'Courier Shipping Area is being used in Courier Pricing, for data consistency reason please don\'t try to rename it!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier Shipping Area is attached to Wholesaler Receiver Address */
        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $wholesalerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInWholesalerReceiverAddressMsg'=>'Courier Shipping Area is being used in Wholesaler Receiver Address, for data consistency reason please don\'t try to rename it!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier Shipping Area is attached to Customer Receiver Address */
        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $customerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInCustomerReceiverAddressMsg'=>'Courier Shipping Area is being used in Customer Receiver Address, for data consistency reason please don\'t try to rename it!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'=>$courierShippingArea->id,
                'name'=>$courierShippingArea->name
            ));
            $otherCourierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'name'=>$courierShippingArea->name
            ));

    		if( $courierShippingAreaModelQuery->num_rows() > 0 || $otherCourierShippingAreaModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_courier_shipping_area', $courierShippingArea->getEditableData(), array(
                    'id'=>$courierShippingArea->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Courier Shipping Area Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $courierShippingArea = new CourierShippingArea($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierShippingArea,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'=>$courierShippingArea->id,
                'name'=>$courierShippingArea->name
            ));
            $otherCourierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'name'=>$courierShippingArea->name
            ));
    		
    		if( $courierShippingAreaModelQuery->num_rows() < 1 && $otherCourierShippingAreaModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Delete courier pricing
    public function delete()
    {
        $courierShippingArea = new CourierShippingArea($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierShippingArea,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( strcasecmp($_SESSION['manager']['role'],'administrator') != 0 )
        {
            $jsonAlert->hasErrors = TRUE;
        }

        /* Check if Courier Shipping Area is attached to Courier Pricing */
        $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $courierPricingModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInCourierPricingMsg'=>'Courier Shipping Area is being used in Courier Pricing, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier Shipping Area is attached to Wholesaler Receiver Address */
        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $wholesalerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInWholesalerReceiverAddressMsg'=>'Courier Shipping Area is being used in Wholesaler Receiver Address, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier Shipping Area is attached to Customer Receiver Address */
        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'shipping_area_id'    =>$courierShippingArea->id
        ));
        if( $customerReceiverAddressModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'usedInCustomerReceiverAddressMsg'=>'Courier Shipping Area is being used in Customer Receiver Address, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors)
        {
            $this->db->delete('t_warehouse_courier_shipping_area', array(
                'id'=>$courierShippingArea->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Courier Shipping Area deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
