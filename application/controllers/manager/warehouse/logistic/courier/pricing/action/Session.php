<?php

require_once 'application/class/warehouse/logistic/courier/CourierPricing.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Add Rest
	public function add()
	{
        $courierPricing = new CourierPricing($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierPricing,
                'check_empty'=>array(
                    'courier_id'=>'Courier Needed!',
                    'shipping_area_id'=>'Shipping Area Needed!'
                ),
                'check_one_not_empty'=>array(
                    'charge_wholesaler_per_kg|charge_customer_per_kg'=>'At least assign amount to one of the charges!'
                ),
                'check_empty_on_other'=>array(
                    'is_for_wholesaler=Y|charge_wholesaler_per_kg'=>'Could not left [Charge Wholesaler Per KG] field blank if change [Is For Wholesaler] to Yes',
                    'is_for_customer=Y|charge_customer_per_kg'=>'Could not left [Charge Customer Per KG] field blank if change [Is For Customer] to Yes'
                ),
                'check_not_empty_then_other'=>array(
                    'charge_wholesaler_per_kg|is_for_wholesaler=Y'=>'Could not left [Is For Wholesaler] to No if assigned amount to [Charge Wholesaler Per KG]',
                    'charge_customer_per_kg|is_for_customer=Y'=>'Could not left [Is For Customer] to No if assigned amount to [Charge Customer Per KG]'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'courier_id'=>$courierPricing->courier_id,
                'shipping_area_id'=>$courierPricing->shipping_area_id
            ));
    		if( $courierPricingModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_courier_pricing', $courierPricing->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Courier Pricing Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Courier Shipping Area Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $courierPricing = new CourierPricing($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierPricing,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'courier_id'=>'Courier Needed!',
                    'shipping_area_id'=>'Shipping Area Needed!'
                ),
                'check_one_not_empty'=>array(
                    'charge_wholesaler_per_kg|charge_customer_per_kg'=>'At least assign amount to one of the charges!'
                ),
                'check_empty_on_other'=>array(
                    'is_for_wholesaler=Y|charge_wholesaler_per_kg'=>'Could not left [Charge Wholesaler Per KG] field blank if change [Is For Wholesaler] to Yes',
                    'is_for_customer=Y|charge_customer_per_kg'=>'Could not left [Charge Customer Per KG] field blank if change [Is For Customer] to Yes'
                ),
                'check_not_empty_then_other'=>array(
                    'charge_wholesaler_per_kg|is_for_wholesaler=Y'=>'Could not left [Is For Wholesaler] to No if assigned amount to [Charge Wholesaler Per KG]',
                    'charge_customer_per_kg|is_for_customer=Y'=>'Could not left [Is For Customer] to No if assigned amount to [Charge Customer Per KG]'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'id'=>$courierPricing->id,
                'courier_id'=>$courierPricing->courier_id,
                'shipping_area_id'=>$courierPricing->shipping_area_id
            ));
            $otherCourierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'courier_id'=>$courierPricing->courier_id,
                'shipping_area_id'=>$courierPricing->shipping_area_id
            ));

    		if( $courierPricingModelQuery->num_rows() > 0 || $otherCourierPricingModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_courier_pricing', $courierPricing->getEditableData(), array(
                    'id'=>$courierPricing->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Courier Pricing Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Courier Shipping Area Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Courier Shipping Area Duplicate Rest
	public function check_edit_courier_shipping_area_duplicate()
	{
        $courierPricing = new CourierPricing($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierPricing,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'courier_id'=>'Courier Needed!',
                    'shipping_area_id'=>'Shipping Area Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'id'=>$courierPricing->id,
                'courier_id'=>$courierPricing->courier_id,
                'shipping_area_id'=>$courierPricing->shipping_area_id
            ));
            $otherCourierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'courier_id'=>$courierPricing->courier_id,
                'shipping_area_id'=>$courierPricing->shipping_area_id
            ));
    		
    		if( $courierPricingModelQuery->num_rows() < 1 && $otherCourierPricingModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Courier Shipping Area Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Delete courier pricing
    public function delete()
    {
        $courierPricing = new CourierPricing($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierPricing,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if(strcasecmp($_SESSION['manager']['role'],'administrator') != 0)
        {
            $jsonAlert->hasErrors = TRUE;
        }

        if( ! $jsonAlert->hasErrors)
        {
            $this->db->delete('t_warehouse_courier_pricing', array(
                'id'=>$courierPricing->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Courier Pricing deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
