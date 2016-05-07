<?php

require_once 'application/class/warehouse/product/ProductPerformanceStatus.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Check performance_status Name Duplicate Rest
	public function check_name_duplicate()
	{
        $productPerformanceStatus = new ProductPerformanceStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productPerformanceStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'name' => $productPerformanceStatus->name
            ));

    		if($productPerformanceStatusModelQuery->num_rows() > 0)
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
        $productPerformanceStatus = new ProductPerformanceStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productPerformanceStatus,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'name'=>$productPerformanceStatus->name
            ));

            if($productPerformanceStatusModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product_performance_status', $productPerformanceStatus->getInsertableData());

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
        $productPerformanceStatus = new ProductPerformanceStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productPerformanceStatus,
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
            $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'id'=>$productPerformanceStatus->id,
                'name'=>$productPerformanceStatus->name
            ));
            $otherProductPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'name'=>$productPerformanceStatus->name
            ));

            if($productPerformanceStatusModelQuery->num_rows() > 0 || $otherProductPerformanceStatusModelQuery->num_rows() < 1)
            {
                $this->db->update('t_warehouse_product_performance_status', $productPerformanceStatus->getEditableData(), array(
                    'id'=>$productPerformanceStatus->id
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

    // Check Edit performance_status Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $productPerformanceStatus = new ProductPerformanceStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productPerformanceStatus,
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
            $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'id'=>$productPerformanceStatus->id,
                'name'=>$productPerformanceStatus->name
            ));
            $otherProductPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'name'=>$productPerformanceStatus->name
            ));

            if($productPerformanceStatusModelQuery->num_rows() < 1 && $otherProductPerformanceStatusModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    /** 删除性能状态
     */
    public function delete()
    {
        $productPerformanceStatus = new ProductPerformanceStatus($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productPerformanceStatus,
                'check_empty'=>array(
                    'id'=>'Must select one Performance Status!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productPerformanceStatusModelQuery = $this->db->get_where('t_warehouse_product_performance_status', array(
                'id'    =>  $productPerformanceStatus->id
            ));
            if( $productPerformanceStatusModelQuery->num_rows() > 0 )
            {
                $productPerformanceStatusModel = $productPerformanceStatusModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productPerformanceStatusModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'performance_status'    =>  $productPerformanceStatusModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_performance_status', array(
                        'id'=>$productPerformanceStatus->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected performance status deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Performance status related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Performance status not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
