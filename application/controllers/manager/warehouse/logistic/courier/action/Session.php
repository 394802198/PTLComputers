<?php

require_once 'application/class/warehouse/logistic/courier/Courier.php';
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
        $courier = new Courier($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courier,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'name'=>$courier->name
            ));
    		
    		if( $courierModelQuery->num_rows() > 0 )
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
        $courier = new Courier($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courier,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'website'=>'Website Needed!',
                    'shipment_lookup_url'=>'Shipment Lookup Url Needed!',
                    'status'=>'Status Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'name'=>$courier->name
            ));
    		if( $courierModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_courier', $courier->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Courier Created!'
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
        $courier = new Courier($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courier,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'name'=>'Name Needed!',
                    'website'=>'Website Needed!',
                    'shipment_lookup_url'=>'Shipment Lookup Url Needed!',
                    'status'=>'Status Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'id'=>$courier->id,
                'name'=>$courier->name
            ));
            $otherCourierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'name'=>$courier->name
            ));

    		if( $courierModelQuery->num_rows() > 0 || $otherCourierModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_courier', $courier->getEditableData(), array(
                    'id'=>$courier->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Courier Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Courier Name Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $courier = new Courier($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courier,
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
            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'id'=>$courier->id,
                'name'=>$courier->name
            ));
            $otherCourierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'name'=>$courier->name
            ));
    		
    		if( $courierModelQuery->num_rows() < 1 && $otherCourierModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Courier Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Delete courier
    public function delete()
    {
        $courier = new Courier($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courier,
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

        /* Check if Courier is attached to Courier Pricing */
        $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
            'courier_id'    =>$courier->id
        ));
        if( $courierPricingModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Courier is being used in Courier Pricing, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier is attached to Remarketing Order */
        $remarketingOrderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'courier_id'    =>$courier->id
        ));
        if( $remarketingOrderModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Courier is being used in Remarketing Order, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }
        /* Check if Courier is attached to EStore Order */
        $eStoreOrderModelQuery = $this->db->get_where('t_e_store_order', array(
            'courier_id'    =>$courier->id
        ));
        if( $eStoreOrderModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Courier is being used in EStore Order, for data consistency reason please don\'t try to detach them!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors)
        {
            $this->db->delete('t_warehouse_courier', array(
                'id'=>$courier->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Courier deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
