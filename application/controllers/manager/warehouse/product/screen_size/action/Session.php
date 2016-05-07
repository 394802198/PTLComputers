<?php

require_once 'application/class/warehouse/product/ProductScreenSize.php';
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
        $productScreenSize = new ProductScreenSize($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productScreenSize,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'name'=>$productScreenSize->name
            ));
            if( $productScreenSizeModelQuery->num_rows() > 0 )
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
        $productScreenSize = new ProductScreenSize($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productScreenSize,
                'check_empty'=>array(
                    'name'=>'Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'name'=>$productScreenSize->name
            ));
    		if( $productScreenSizeModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_warehouse_product_screen_size', $productScreenSize->getInsertableData());
                $jsonAlert->append(array(
                    'successMsg'=>'New Screen Size Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Screen Size Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $productScreenSize = new ProductScreenSize($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productScreenSize,
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
            $productScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'id'=>$productScreenSize->id,
                'name'=>$productScreenSize->name
            ));
            $otherProductScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'name'=>$productScreenSize->name
            ));

            /* If is this product location or not other product location */
    		if( $productScreenSizeModelQuery->num_rows() > 0 || $otherProductScreenSizeModelQuery->num_rows() < 1 )
            {
                $this->db->update('t_warehouse_product_screen_size', $productScreenSize->getEditableData(), array(
                    'id'=>$productScreenSize->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Screen Size Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Screen Size Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Name Duplicate Rest
	public function check_edit_name_duplicate()
	{
        $productScreenSize = new ProductScreenSize($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productScreenSize,
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
            $productProductScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'id'=>$productScreenSize->id,
                'name'=>$productScreenSize->name
            ));
            $otherProductScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'name'=>$productScreenSize->name
            ));
    		if( $productProductScreenSizeModelQuery->num_rows() < 1 && $otherProductScreenSizeModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    /** 删除屏幕尺寸
     */
    public function delete()
    {
        $productScreenSize = new ProductScreenSize($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productScreenSize,
                'check_empty'=>array(
                    'id'=>'Must select one Screen size!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productScreenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
                'id'    =>  $productScreenSize->id
            ));
            if( $productScreenSizeModelQuery->num_rows() > 0 )
            {
                $productScreenSizeModel = $productScreenSizeModelQuery->row_array();
                /** 如果和产品没有关联则可以直接删除
                 */
                $removable = true;
                if( trim( $productScreenSizeModel['name'] ) != '' )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'screen_size'    =>  $productScreenSizeModel['name']
                    ));
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        $removable = false;
                    }
                }
                if( $removable )
                {
                    $this->db->delete('t_warehouse_product_screen_size', array(
                        'id'=>$productScreenSize->id
                    ));
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected screen size deleted!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Screen size related to some products, could not be deleted!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Screen size not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
