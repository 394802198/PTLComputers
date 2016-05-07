<?php

require_once 'application/class/warehouse/product/ProductVisualStatus.php';
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
        $productVisualStatus = new ProductVisualStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productVisualStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'name'=>$productVisualStatus->name
            ));
    		
    		if( $productVisualStatusModelQuery->num_rows() > 0 )
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
        $productVisualStatus = new ProductVisualStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productVisualStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productVisualStatusModelQuery = $this->db->get('t_warehouse_product_visual_status', array(
                'name' => $productVisualStatus->name
            ));

            if( $productVisualStatusModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_product_visual_status', array(
                    'name'=>$productVisualStatus->name
                ));

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
        $productVisualStatus = new ProductVisualStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productVisualStatus,
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
            $productVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'id'=>$productVisualStatus->id,
                'name'=>$productVisualStatus->name
            ));
            $otherProductVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'name'=>$productVisualStatus->name
            ));

            if($productVisualStatusModelQuery->num_rows() > 0 || $otherProductVisualStatusModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product_visual_status', $productVisualStatus->getInsertableData());

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
        $productVisualStatus = new ProductVisualStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productVisualStatus,
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
            $productVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'id'=>$productVisualStatus->id,
                'name'=>$productVisualStatus->name
            ));
            $otherProductVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'name'=>$productVisualStatus->name
            ));

            if( $productVisualStatusModelQuery->num_rows() < 1 && $otherProductVisualStatusModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    /** 删除可视状态
     */
    public function delete()
    {
        $productVisualStatus = new ProductVisualStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productVisualStatus,
                'check_empty'=>array(
                    'id'=>'Must select one Visual status!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
                'id'    =>  $productVisualStatus->id
            ));
            if( $productVisualStatusModelQuery->num_rows() > 0 )
            {
                $productVisualStatusModel = $productVisualStatusModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productVisualStatusModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'visual_status'    =>  $productVisualStatusModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_visual_status', array(
                        'id'=>$productVisualStatus->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected visual status deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Visual status related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Visual status not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
