<?php

require_once 'application/class/warehouse/commodity/CommodityType.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Update Sequence Rest
    public function update_sequence()
    {
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_warehouse_commodity_type', array(
                'sequence'  =>  $commodityType->sequence
            ), array(
                'name'    =>  $commodityType->name
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Type Sequence Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    // Check Name Duplicate Rest
	public function check_name_duplicate()
	{
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'name'=>$commodityType->name
            ));

    		if( $commodityTypeModelQuery->num_rows() > 0 )
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
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'name'=>$commodityType->name
            ));

            if( $commodityTypeModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_commodity_type', $commodityType->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Name Created!'
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
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
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
            $commodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'id'=>$commodityType->id,
                'name'=>$commodityType->name
            ));
            $otherCommodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'name'=>$commodityType->name
            ));

    		if
            (
                $commodityTypeModelQuery->num_rows() > 0 ||
                $otherCommodityTypeModelQuery->num_rows() < 1
            )
            {
                $this->db->update('t_warehouse_commodity_type', $commodityType->getEditableData(), array(
                    'id'=>$commodityType->id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Current Name Updated!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Created!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
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
            $commodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'id'=>$commodityType->id,
                'name'=>$commodityType->name
            ));
            $otherCommodityTypeModelQuery = $this->db->get_where('t_warehouse_commodity_type', array(
                'name'=>$commodityType->name
            ));

            if
            (
                $commodityTypeModelQuery->num_rows() < 1 &&
                $otherCommodityTypeModelQuery->num_rows() > 0
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
