<?php

require_once 'application/class/warehouse/commodity/CommodityManufacturer.php';
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
        $commodityManufacturer = new CommodityManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityManufacturer,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'name'=>$commodityManufacturer->name
            ));
    		if( $commodityManufacturerModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manufacturer Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Add Rest
	public function add()
	{
        $commodityManufacturer = new CommodityManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityManufacturer,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'name'=>$commodityManufacturer->name
            ));
            if( $commodityManufacturerModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_commodity_manufacturer', $commodityManufacturer->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Manufacturer Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manufacturer Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $commodityManufacturer = new CommodityManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityManufacturer,
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
            $commodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'id'=>$commodityManufacturer->id,
                'name'=>$commodityManufacturer->name
            ));
            $otherCommodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'name'=>$commodityManufacturer->name
            ));

    		if
            (
                $commodityManufacturerModelQuery->num_rows() > 0 ||
                $otherCommodityManufacturerModelQuery->num_rows() < 0
            )
            {
                $this->db->update('t_warehouse_commodity_manufacturer', $commodityManufacturer->getEditableData(), array(
                    'id'=>$commodityManufacturer->id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Current Manufacturer Updated!'
                ), TRUE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manufacturer Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $commodityManufacturer = new CommodityManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityManufacturer,
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
            $commodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'id'=>$commodityManufacturer->id,
                'name'=>$commodityManufacturer->name
            ));
            $otherCommodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'name'=>$commodityManufacturer->name
            ));
    		if
            (
                $commodityManufacturerModelQuery->num_rows() < 1 &&
                $otherCommodityManufacturerModelQuery->num_rows() > 0
            )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manufacturer Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    /** 删除厂家
     */
    public function delete()
    {
        $commodityManufacturer = new CommodityManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityManufacturer,
                'check_empty'=>array(
                    'id'=>'Must select one Manufacturer!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $commodityManufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
                'id'    =>  $commodityManufacturer->id
            ));
            if( $commodityManufacturerModelQuery->num_rows() > 0 )
            {
                $commodityManufacturerModel = $commodityManufacturerModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $commodityManufacturerModel['name'] ) != '' )
                {
                    $commodityModelQuery = $this->db->get_where('t_warehouse_commodity', array(
                        'manufacturer'    =>  $commodityManufacturerModel['name']
                    ));
                    if( $commodityModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_commodity_manufacturer', array(
                        'id'=>$commodityManufacturer->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected manufacturer deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Manufacturer related to some commodities, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Manufacturer not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
