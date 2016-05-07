<?php

require_once 'application/class/warehouse/product/ProductManufacturer.php';
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
        $productManufacturer = new ProductManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productManufacturer,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'name'=>$productManufacturer->name
            ));
    		if($productManufacturerModelQuery->num_rows() > 0)
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
        $productManufacturer = new ProductManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productManufacturer,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'name'=>$productManufacturer->name
            ));
            if($productManufacturerModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product_manufacturer', $productManufacturer->getInsertableData());

                $jsonAlert->append(array(
                    'successMsg'=>'New Name Created!'
                ), TRUE);
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
        $productManufacturer = new ProductManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productManufacturer,
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
            $productManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'id'=>$productManufacturer->id,
                'name'=>$productManufacturer->name
            ));
            $otherProductManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'name'=>$productManufacturer->name
            ));

    		if($productManufacturerModelQuery->num_rows() > 0 || $otherProductManufacturerModelQuery->num_rows() < 0)
            {
                $this->db->update('t_warehouse_product_manufacturer', $productManufacturer->getEditableData(), array(
                    'id'=>$productManufacturer->id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Current Name Updated!'
                ), TRUE);
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
        $productManufacturer = new ProductManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productManufacturer,
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
            $productManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'id'=>$productManufacturer->id,
                'name'=>$productManufacturer->name
            ));
            $otherProductManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'name'=>$productManufacturer->name
            ));
    		if($productManufacturerModelQuery->num_rows() < 1 && $otherProductManufacturerModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    /** 删除厂家
     */
    public function delete()
    {
        $productManufacturer = new ProductManufacturer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productManufacturer,
                'check_empty'=>array(
                    'id'=>'Must select one Manufacturer!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productManufacturerModelQuery = $this->db->get_where('t_warehouse_product_manufacturer', array(
                'id'    =>  $productManufacturer->id
            ));
            if( $productManufacturerModelQuery->num_rows() > 0 )
            {
                $productManufacturerModel = $productManufacturerModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productManufacturerModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'manufacturer_name'    =>  $productManufacturerModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_manufacturer', array(
                        'id'=>$productManufacturer->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected manufacturer deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Manufacturer related to some products, could not be deleted!'
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
