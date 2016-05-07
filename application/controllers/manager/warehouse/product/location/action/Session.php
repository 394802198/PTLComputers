<?php

require_once 'application/class/warehouse/product/ProductLocation.php';
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
        $productLocation = new ProductLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productLocation,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'name'=>$productLocation->name
            ));
            if($productLocationModelQuery->num_rows() > 0)
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
        $productLocation = new ProductLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productLocation,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'name'=>$productLocation->name
            ));
    		if($productLocationModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product_location', $productLocation->getInsertableData());
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
        $productLocation = new ProductLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productLocation,
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
            $productLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'id'=>$productLocation->id,
                'name'=>$productLocation->name
            ));
            $otherProductLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'name'=>$productLocation->name
            ));

            /* If is this product location or not other product location */
    		if($productLocationModelQuery->num_rows() > 0 || $otherProductLocationModelQuery->num_rows() < 1)
            {
                $this->db->update('t_warehouse_product_location', $productLocation->getEditableData(), array(
                    'id'=>$productLocation->id
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
        $productLocation = new ProductLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productLocation,
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
            $productLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'id'=>$productLocation->id,
                'name'=>$productLocation->name
            ));
            $otherProductLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'name'=>$productLocation->name
            ));
    		if($productLocationModelQuery->num_rows() < 1 && $otherProductLocationModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    /** 删除位置
     */
    public function delete()
    {
        $productLocation = new ProductLocation($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productLocation,
                'check_empty'=>array(
                    'id'=>'Must select one location!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productLocationModelQuery = $this->db->get_where('t_warehouse_product_location', array(
                'id'    =>  $productLocation->id
            ));
            if( $productLocationModelQuery->num_rows() > 0 )
            {
                $productLocationModel = $productLocationModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productLocationModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'location'    =>  $productLocationModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_location', array(
                        'id'=>$productLocation->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected location deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Location related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Location not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
