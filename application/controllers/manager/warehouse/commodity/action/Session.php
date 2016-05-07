<?php

require_once 'application/class/warehouse/commodity/CommodityConfiguration.php';
require_once 'application/class/warehouse/commodity/Commodity.php';
require_once 'application/class/e_store/Order.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/MyUtils.php';
require_once 'util/myutils/WarehouseCommodityUtil.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 更新配置
     */
    public function update_configuration()
    {
        $commodityConfiguration = new CommodityConfiguration($this->input);
        $jsonAlert = new JSONAlert();

        if( ! $jsonAlert->hasErrors )
        {
            $commodityConfigurationModelQuery = $this->db->get('t_warehouse_commodity_configuration');
            if( $commodityConfigurationModelQuery->num_rows() > 0 )
            {
                $this->db->update('t_warehouse_commodity_configuration', $commodityConfiguration->getEditableData());
            }
            else
            {
                $this->db->insert('t_warehouse_commodity_configuration', $commodityConfiguration->getInsertableData());
            }

            $jsonAlert->append(array(
                'successMsg'=>'Configuration Updated!'
            ), FALSE);
        }

        echo $jsonAlert->result();
    }

    /** 获取配置
     */
    public function get_configuration()
    {
        $configuration = array();
        $commodityConfigurationModelQuery = $this->db->get('t_warehouse_commodity_configuration');
        if( $commodityConfigurationModelQuery->num_rows() > 0 )
        {
            $commodityConfigurationModel = $commodityConfigurationModelQuery->row_array();
            $configuration = $commodityConfigurationModel;
        }

        echo json_encode( $configuration );
    }

    /** 更新顺序
     */
    public function update_sequence()
    {
        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_warehouse_commodity', $commodity->getEditableData(), array(
                'id'    =>  $commodity->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Sequence Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    // Add Rest
	public function add()
	{
        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'location'=>'Location Needed!',
                    'manufacturer'=>'Manufacturer Needed!',
                    'type'=>'Type Needed!',
                    'price'=>'Price Needed!',
                    'weight'=>'Weight Needed!',
                    'is_on_shelf'=>'Is On Shelf Needed!',
                    'description'=>'Description Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->insert('t_warehouse_commodity', $commodity->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Commodity Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $this->db->trans_begin();

        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'name'=>'Name Needed!',
                    'location'=>'Location Needed!',
                    'manufacturer'=>'Manufacturer Needed!',
                    'type'=>'Type Needed!',
                    'price'=>'Price Needed!',
                    'weight'=>'Weight Needed!',
                    'is_on_shelf'=>'Is On Shelf Needed!',
                    'description'=>'Description Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果有选中图片，并且没有指定【主图】
         */
        $isPictureSelected = count( $commodity->picture_ids ) > 0;
        if( $isPictureSelected && ! $commodity->main_picture_id )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Must tick one as Main Picture if have selected pictures!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** 无条件清空图片关联
             */
            $this->db->delete( 't_warehouse_commodity_picture_combination', array(
                'commodity_id'  =>  $commodity->id
            ));

            /** 有选中图片，则全部与该商品关联
             */
            if( $isPictureSelected )
            {
                $insertableCommodityPictureCombinationBatch = array();
                foreach( $commodity->picture_ids as $picture_id )
                {
                    array_push( $insertableCommodityPictureCombinationBatch, array(
                        'commodity_id'          =>  $commodity->id,
                        'commodity_picture_id'  =>  $picture_id,
                        'is_selected_to_show'   =>  $picture_id === $commodity->main_picture_id ? 'Y' : 'N'
                    ) );
                }
                $this->db->insert_batch( 't_warehouse_commodity_picture_combination', $insertableCommodityPictureCombinationBatch );
            }

            $commodityModelQuery = $this->db->get_where('t_warehouse_commodity', array(
                'id'=>$commodity->id
            ));

    		if( $commodityModelQuery->num_rows() > 0 )
            {
                $this->db->update('t_warehouse_commodity', $commodity->getEditableData(), array(
                    'id'=>$commodity->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Commodity Updated!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Commodity Not Find!'
                ), TRUE);
    		}
	    }

        /** 事务【回滚】还是【提交】
         */
        if ( $this->db->trans_status() === FALSE )
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        echo $jsonAlert->result();
	}

	// Delete batch commodity
	public function delete_batch()
	{
        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'commodity_e_store_skus'=>'Must select at least one commodity!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $commodity->commodity_e_store_skus as $e_store_sku )
            {
                $this->db->delete('t_warehouse_commodity', array(
                    'e_store_sku'=>$e_store_sku
                ));
                $this->db->delete('t_warehouse_commodity_inventory', array(
                    'e_store_sku'=>$e_store_sku
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected commodity deleted!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    // Generate commodity from Remarketing product
    public function generate_commodity_from_remarketing_product()
    {
        $jsonAlert = new JSONAlert();

        WarehouseCommodityUtil::refresh_warehouse_commodity( $jsonAlert, $this );

        echo $jsonAlert->result();
    }

    // On/Off shelf batch commodity
    public function on_off_shelf_selected_commodities()
    {
        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'commodity_ids_arr'=>'Must select at least one commodity!',
                    'is_on_shelf'=>'Must choose to On or Off shelf'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $commodity->commodity_ids_arr as $commodity_id )
            {
                $this->db->update('t_warehouse_commodity', array(
                    'is_on_shelf'   =>  $commodity->is_on_shelf
                ), array(
                    'id'    =>  $commodity_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected commodity switched to ' . ( $commodity->is_on_shelf == 'Y' ? 'On' : 'Off' ) . '!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    // Show/Hide batch commodity weight
    public function show_hide_selected_commodities_weight()
    {
        $commodity = new Commodity($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodity,
                'check_empty'=>array(
                    'commodity_ids_arr'=>'Must select at least one commodity!',
                    'is_weight_shown'=>'Must choose to Show or Hide weight'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $commodity->commodity_ids_arr as $commodity_id )
            {
                $this->db->update('t_warehouse_commodity', array(
                    'is_weight_shown'   =>  $commodity->is_weight_shown
                ), array(
                    'id'    =>  $commodity_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected commodity weight switched to ' . ( $commodity->is_weight_shown == 'Y' ? 'Show' : 'Hide' ) . '!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

}
