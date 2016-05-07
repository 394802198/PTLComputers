<?php

require_once 'application/class/e_store/cms/CMSCarousel.php';
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

    // Update Sequence Rest
    public function update_sequence()
    {
        $cmsCarousel = new CMSCarousel($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCarousel,
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
            $this->db->update('t_e_store_cms_carousel', array(
                'sequence'  =>  $cmsCarousel->sequence
            ), array(
                'id'    =>  $cmsCarousel->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Carousel Sequence Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加轮播图
     */
	public function add()
	{
        $cmsCarousel = new CMSCarousel($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCarousel,
                'check_empty'=>array(
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
                    if( ! is_dir("upload/e_store/cms/component/carousel/images/") )
                    {
                        mkdir("upload/e_store/cms/component/carousel/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/e_store/cms/component/carousel/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $cmsCarousel->img_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $sequence = 0;

            $this->db->select_max('sequence');
            $carouselModelQuery = $this->db->get_where('t_e_store_cms_carousel', array(
                'position'  =>  $cmsCarousel->position,
                'page_type' =>  $cmsCarousel->page_type
            ));
            if( $carouselModelQuery->num_rows() > 0 )
            {
                $carouselModel = $carouselModelQuery->row_array();
                $sequence = $carouselModel['sequence'];
                $sequence ++;
            }

            $cmsCarousel->sequence = $sequence;

            $this->db->insert('t_e_store_cms_carousel', $cmsCarousel->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Carousel Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑轮播图
     */
	public function edit()
	{
        $cmsCarousel = new CMSCarousel($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCarousel,
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
                    $cmsCarouselModelQuery = $this->db->get_where('t_e_store_cms_carousel', array(
                        'id'    =>  $cmsCarousel->id
                    ));
                    $cmsCarouselModel = $cmsCarouselModelQuery->row_array();
                    unlink( $cmsCarouselModel['img_path'] );

                    if( ! is_dir("upload/e_store/cms/component/carousel/images/") )
                    {
                        mkdir("upload/e_store/cms/component/carousel/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/e_store/cms/component/carousel/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $cmsCarousel->img_path = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $this->db->update('t_e_store_cms_carousel', $cmsCarousel->getEditableData(), array(
                'id'=>$cmsCarousel->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Carousel Updated!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除轮播图
     */
    public function delete_batch()
    {
        $cmsCarousel = new CMSCarousel($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCarousel,
                'check_empty'=>array(
                    'carousel_ids'=>'Must select at least one carousel!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $cmsCarousel->carousel_ids as $carousel_id )
            {
                /** 先删除该【轮播图】的原图
                 */
                $cmsCarouselModelQuery = $this->db->get_where('t_e_store_cms_carousel', array(
                    'id'    =>  $carousel_id
                ));
                $cmsCarouselModel = $cmsCarouselModelQuery->row_array();
                unlink( $cmsCarouselModel['img_path'] );

                $this->db->delete('t_e_store_cms_carousel', array(
                    'id'=>$carousel_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected carousel deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
