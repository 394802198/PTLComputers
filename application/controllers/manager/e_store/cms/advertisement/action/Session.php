<?php

require_once 'application/class/e_store/cms/CMSAdvertisement.php';
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

    /** 添加广告图
     */
	public function add()
	{
        $cmsAdvertisement = new CMSAdvertisement($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsAdvertisement,
                'check_empty'=>array(
                    'page_type'=>'Page Type Needed!',
                    'position'=>'Position Needed!',
                    'is_activate_linkage'=>'Is Activate Linkage Needed!'
                ),
                'check_empty_on_other'=>array(
                    'is_activate_linkage=Y|linkage'=>'Linkage Must Not Be Empty!'
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
                    if( ! is_dir("upload/e_store/cms/advertisement/images/") )
                    {
                        mkdir("upload/e_store/cms/advertisement/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/e_store/cms/advertisement/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $cmsAdvertisement->img_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $this->db->insert('t_e_store_cms_advertisement', $cmsAdvertisement->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Advertisement Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑广告图
     */
	public function edit()
	{
        $cmsAdvertisement = new CMSAdvertisement($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsAdvertisement,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'page_type'=>'Page Type Needed!',
                    'position'=>'Position Needed!',
                    'is_activate_linkage'=>'Is Activate Linkage Needed!'
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
                    $cmsAdvertisementModelQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
                        'id'    =>  $cmsAdvertisement->id
                    ));
                    $cmsAdvertisementModel = $cmsAdvertisementModelQuery->row_array();
                    unlink( $cmsAdvertisementModel['img_path'] );

                    if( ! is_dir("upload/e_store/cms/advertisement/images/") )
                    {
                        mkdir("upload/e_store/cms/advertisement/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/e_store/cms/advertisement/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $cmsAdvertisement->img_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $this->db->update('t_e_store_cms_advertisement', $cmsAdvertisement->getEditableData(), array(
                'id'=>$cmsAdvertisement->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Advertisement Updated!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除广告图
     */
    public function delete_batch()
    {
        $cmsAdvertisement = new CMSAdvertisement($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsAdvertisement,
                'check_empty'=>array(
                    'advertisement_ids'=>'Must select at least one advertisement!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $cmsAdvertisement->advertisement_ids as $advertisement_id )
            {
                /** 先删除该【广告图】的原图
                 */
                $cmsAdvertisementModelQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
                    'id'    =>  $advertisement_id
                ));
                $cmsAdvertisementModel = $cmsAdvertisementModelQuery->row_array();
                unlink( $cmsAdvertisementModel['img_path'] );

                $this->db->delete('t_e_store_cms_advertisement', array(
                    'id'=>$advertisement_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected advertisement deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
