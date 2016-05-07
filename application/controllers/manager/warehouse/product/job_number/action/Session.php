<?php

require_once 'application/class/warehouse/product/ProductJobNumber.php';
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
        $productJobNumber = new ProductJobNumber($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productJobNumber,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'name'=>$productJobNumber->name
            ));
            if( $productJobNumberModelQuery->num_rows() > 0 )
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
        $productJobNumber = new ProductJobNumber($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productJobNumber,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'name'=>$productJobNumber->name
            ));
    		if( $productJobNumberModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_product_job_number', $productJobNumber->getInsertableData());
                $jsonAlert->append(array(
                    'successMsg'=>'New Job Number Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Job Number Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $productJobNumber = new ProductJobNumber($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productJobNumber,
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
            $productJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'id'=>$productJobNumber->id,
                'name'=>$productJobNumber->name
            ));
            $otherProductJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'name'=>$productJobNumber->name
            ));

            /* If is this product job number or not other product job number */
    		if( $productJobNumberModelQuery->num_rows() > 0 || $otherProductJobNumberModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_product_job_number', $productJobNumber->getEditableData(), array(
                    'id'=>$productJobNumber->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Job Number Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Job Number Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $productJobNumber = new ProductJobNumber($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productJobNumber,
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
            $productJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'id'=>$productJobNumber->id,
                'name'=>$productJobNumber->name
            ));
            $otherProductJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'name'=>$productJobNumber->name
            ));
    		if( $productJobNumberModelQuery->num_rows() < 1 && $otherProductJobNumberModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    /** 删除订货号
     */
    public function delete()
    {
        $productJobNumber = new ProductJobNumber($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productJobNumber,
                'check_empty'=>array(
                    'id'=>'Must select one job number!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productJobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                'id'    =>  $productJobNumber->id
            ));
            if( $productJobNumberModelQuery->num_rows() > 0 )
            {
                $productJobNumberModel = $productJobNumberModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productJobNumberModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'job_number'    =>  $productJobNumberModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_job_number', array(
                        'id'=>$productJobNumber->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected job number deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Job number related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Job number not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
