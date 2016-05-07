<?php

require_once 'application/class/warehouse/product/ProductType.php';
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
        $productType = new ProductType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productType,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'name'=>$productType->name
            ));

    		if($productTypeModelQuery->num_rows() > 0)
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
        $productType = new ProductType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productType,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'name'=>$productType->name
            ));

            if( $productTypeModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_product_type', $productType->getInsertableData());

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
        $productType = new ProductType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productType,
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
            $productTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'id'=>$productType->id,
                'name'=>$productType->name
            ));
            $otherProductTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'name'=>$productType->name
            ));

    		if($productTypeModelQuery->num_rows() > 0 || $otherProductTypeModelQuery->num_rows() < 1)
            {
                $this->db->update('t_warehouse_product_type', $productType->getEditableData(), array(
                    'id'=>$productType->id
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
        $productType = new ProductType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productType,
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
            $productTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'id'=>$productType->id,
                'name'=>$productType->name
            ));
            $otherProductTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'name'=>$productType->name
            ));

            if($productTypeModelQuery->num_rows() < 1 && $otherProductTypeModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    /** 删除类型
     */
    public function delete()
    {
        $productType = new ProductType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productType,
                'check_empty'=>array(
                    'id'=>'Must select one Type!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productTypeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
                'id'    =>  $productType->id
            ));
            if( $productTypeModelQuery->num_rows() > 0 )
            {
                $productTypeModel = $productTypeModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productTypeModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'type'    =>  $productTypeModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_type', array(
                        'id'=>$productType->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected type deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Type related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Type not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
