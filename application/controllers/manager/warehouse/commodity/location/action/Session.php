<?php

require_once 'application/class/warehouse/commodity/CommodityLocation.php';
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
        $commodityLocation = new CommodityLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityLocation,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'name'=>$commodityLocation->name
            ));
            if( $commodityLocationModelQuery->num_rows() > 0 )
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
        $commodityLocation = new CommodityLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityLocation,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'name'=>$commodityLocation->name
            ));
    		if( $commodityLocationModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_commodity_location', $commodityLocation->getInsertableData());
                $jsonAlert->append(array(
                    'successMsg'=>'New Location Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Location Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $commodityLocation = new CommodityLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityLocation,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'id'=>$commodityLocation->id,
                'name'=>$commodityLocation->name
            ));
            $otherCommodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'name'=>$commodityLocation->name
            ));

            /* If is this commodity location or not other commodity location */
    		if( $commodityLocationModelQuery->num_rows() > 0 || $otherCommodityLocationModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_commodity_location', $commodityLocation->getEditableData(), array(
                    'id'=>$commodityLocation->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Location Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Location Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $commodityLocation = new CommodityLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityLocation,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'id'=>$commodityLocation->id,
                'name'=>$commodityLocation->name
            ));
            $otherCommodityLocationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
                'name'=>$commodityLocation->name
            ));
    		if
            (
                $commodityLocationModelQuery->num_rows() < 1 &&
                $otherCommodityLocationModelQuery->num_rows() > 0
            )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}
	
}
