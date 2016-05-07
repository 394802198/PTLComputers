<?php

require_once 'application/class/warehouse/product/ProductStatus.php';
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
        $productStatus = new ProductStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'name'=>$productStatus->name
            ));
    		
    		if($productStatusModelQuery->num_rows() > 0)
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
        $productStatus = new ProductStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'name'=>$productStatus->name
            ));

            if($productStatusModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product_status', $productStatus->getInsertableData());

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
        $productStatus = new ProductStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productStatus,
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
            $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'id'=>$productStatus->id,
                'name'=>$productStatus->name
            ));
            $otherProductStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'name'=>$productStatus->name
            ));

    		if($productStatusModelQuery->num_rows() > 0 || $otherProductStatusModelQuery->num_rows() < 1)
            {
                $this->db->update('t_warehouse_product_status', $productStatus->getEditableData(), array(
                    'id'=>$productStatus->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Name Updated!'
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
        $productStatus = new ProductStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productStatus,
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
            $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'id'=>$productStatus->id,
                'name'=>$productStatus->name
            ));
            $otherProductStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'name'=>$productStatus->name
            ));

            if($productStatusModelQuery->num_rows() < 1 && $otherProductStatusModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    /** 删除状态
     */
    public function delete()
    {
        $productStatus = new ProductStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productStatus,
                'check_empty'=>array(
                    'id'=>'Must select one Status!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
                'id'    =>  $productStatus->id
            ));
            if( $productStatusModelQuery->num_rows() > 0 )
            {
                $productStatusModel = $productStatusModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productStatusModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'product_status'    =>  $productStatusModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_status', array(
                        'id'=>$productStatus->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected status deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Status related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Status not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
