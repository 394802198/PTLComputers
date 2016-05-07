<?php

require_once 'application/class/warehouse/commodity/CommodityPicture.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller
{
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Auto Synchronizing Pictures to Related Commodities Rest
    public function auto_synchronizing_pictures_to_related_commodities()
    {
        $jsonAlert = new JSONAlert();

        $commodityPictureObjQuery = $this->db->get('t_warehouse_commodity_picture');
        if( $commodityPictureObjQuery->num_rows() > 0 )
        {
            $commodityPictureObj = $commodityPictureObjQuery->result_object();

            foreach( $commodityPictureObj as $commodityPicture )
            {
                $commodity_model_arr = explode( ',', $commodityPicture->keyword );

                if( count( $commodity_model_arr ) > 0 )
                {
                    foreach( $commodity_model_arr as $commodity_model )
                    {
                        $this->db->join('( SELECT e_store_sku, model FROM t_warehouse_commodity_inventory ) t2', 't2.e_store_sku = t1.e_store_sku');
                        $commodityModelQuery = $this->db->get_where('t_warehouse_commodity t1', array(
                            't1.manufacturer'       =>  $commodityPicture->manufacturer,
                            't2.model'              =>  $commodity_model
                        ));
                        if( $commodityModelQuery->num_rows() > 0 )
                        {
                            $commodityModel = $commodityModelQuery->row_array();
                            var_dump( $commodityModel );
                            /** 如果已经有 14 张关联图片，则不再关联新图片
                             */
                        }
                    }
                }
            }

            $jsonAlert->append(array(
                'successMsg'=>'Successfully Synchronized All Pictures to Related Commodities!'
            ), FALSE);
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'No picture found!'
            ), TRUE);
        }
    }

    // Add Rest
	public function add()
	{
        $commodityPicture = new CommodityPicture($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityPicture,
                'check_empty'=>array(
                    'manufacturer'=>'Manufacturer Needed!',
                    'type'=>'Type Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( $_FILES['picture']['size'] > 0 )
        {
            foreach ( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    if(!in_array($file['type'], array('image/jpeg','image/png','image/gif')))
                    {
                        $jsonAlert->append(array(
                            'picture'=>'Only [.jpg], [.png], [.gif] are supported recently!'
                        ), TRUE);
                    }
                }
            }
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Must choose a picture!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    if( ! is_dir("upload/commodity/images/") )
                    {
                        mkdir("upload/commodity/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/commodity/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $commodityPicture->pic_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $this->db->insert('t_warehouse_commodity_picture', $commodityPicture->getInsertableData());

            /** 如果有关键词，则与对应的 Commodity 做关联
             */
            if( trim( $commodityPicture->keyword ) != '' )
            {
                $insert_picture_id = $this->db->insert_id();

                $keyword = explode( ',', $commodityPicture->keyword );
                foreach( $keyword as $model )
                {
                    $this->db->select('t1.id');
                    $this->db->join('( SELECT e_store_sku, model FROM t_warehouse_commodity_inventory ) t2 ', 't1.e_store_sku = t2.e_store_sku');
                    $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory t1', array(
                        't1.manufacturer_name' =>  $commodityPicture->manufacturer,
                        't1.type'              =>  $commodityPicture->type,
                        't2.model'             =>  $model
                    ));

                    $insertableCommodityCombinations = array();

                    if( $commodityInventoryModelQuery->num_rows() > 0 )
                    {
                        foreach( $commodityInventoryModelQuery->result_object() as $commodity )
                        {
                            /** 该商品关联的图片，是否小于 14 张
                             */
                            $commodityPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                                'commodity_id'          =>  $commodity->id,
                            ));
                            if( $commodityPictureCombinationModelQuery->num_rows() < 14 )
                            {
                                $insertableCommodityCombination = array(
                                    'commodity_id'          =>  $commodity->id,
                                    'commodity_picture_id'  =>  $insert_picture_id
                                );

                                /** 是否没有选中显示的图片
                                 */
                                $commodityPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                                    'commodity_id'          =>  $commodity->id,
                                    'is_selected_to_show'   =>  'Y'
                                ));
                                if( $commodityPictureCombinationModelQuery->num_rows() < 1 )
                                {
                                    $insertableCommodityCombination['is_selected_to_show'] = 'Y';
                                }

                                array_push( $insertableCommodityCombinations, $insertableCommodityCombination );
                            }
                        }
                    }
                    $this->db->insert_batch('t_warehouse_commodity_picture_combination', $insertableCommodityCombinations);
                }
            }

            $jsonAlert->append(array(
                'successMsg'=>'New Picture Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $commodityPicture = new CommodityPicture($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityPicture,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'manufacturer'=>'Manufacturer Needed!',
                    'type'=>'Type Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( $_FILES['picture']['size'] > 0 )
        {
            foreach ( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    if(!in_array($file['type'], array('image/jpeg','image/png','image/gif')))
                    {
                        $jsonAlert->append(array(
                            'picture'=>'目前只支持 [.jpg], [.png], [.gif] 等三种格式图片'
                        ), TRUE);
                    }
                }
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    /** 先删除该【商品图片】的原图
                     */
                    $commodityPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                        'id'    =>  $commodityPicture->id
                    ));
                    $commodityPictureModel = $commodityPictureModelQuery->row_array();
                    unlink( $commodityPictureModel['pic_path'] );

                    if( ! is_dir("upload/commodity/images/") )
                    {
                        mkdir("upload/commodity/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/commodity/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $commodityPicture->pic_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $this->db->update('t_warehouse_commodity_picture', $commodityPicture->getEditableData(), array(
                'id'=>$commodityPicture->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Picture Updated!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    // Delete batch commodity picture
    public function delete_batch()
    {
        $commodityPicture = new CommodityPicture($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityPicture,
                'check_empty'=>array(
                    'commodity_picture_ids'=>'Must select at least one commodity picture!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $commodityPicture->commodity_picture_ids as $commodity_picture_id )
            {
                $this->db->delete('t_warehouse_commodity_picture', array(
                    'id'=>$commodity_picture_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected commodity picture deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
