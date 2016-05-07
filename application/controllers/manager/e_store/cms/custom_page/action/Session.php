<?php

require_once 'application/class/e_store/cms/CMSCustomPage.php';
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

    /** 添加可定制页
     */
	public function add()
	{
        $cmsCustomPage = new CMSCustomPage($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomPage,
                'check_empty'=>array(
                    'page_type'=>'Page Type Needed!',
                    'page_name'=>'Page Name Needed!',
                    'page_content'=>'Page Content Needed!',
                    'is_page_title_visible'=>'Is Page Title Visible Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 页面那类型是否存在，并且不是 Custom 的
         */
        $customPageModelQuery = $this->db->get_where('t_e_store_cms_custom_page', array(
            'page_type' =>  $cmsCustomPage->page_type
        ));
        $customPageModel = $customPageModelQuery->row_array();
        if( $customPageModelQuery->num_rows() > 0 && $customPageModel['page_type'] != 100 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Page Type Existed!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        /** 页面名称是否存在
         */
        $customPageModelQuery = $this->db->get_where('t_e_store_cms_custom_page', array(
            'page_name' =>  $cmsCustomPage->page_name
        ));
        if( $customPageModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Page Name Existed!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** PHP 5.3.0 以上版本可以通过 bin2hex(openssl_random_pseudo_bytes(32)); 生成唯一串，作为 hash_token
             *  URL : /e_store/page/<?php echo $hash_token ?>
             */
            $cmsCustomPage->hash_token = bin2hex(openssl_random_pseudo_bytes(32));
            $this->db->insert('t_e_store_cms_custom_page', $cmsCustomPage->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Custom Page Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑可定制页
     */
	public function edit()
	{
        $cmsCustomPage = new CMSCustomPage($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomPage,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'page_type'=>'Page Type Needed!',
                    'page_name'=>'Page Name Needed!',
                    'page_content'=>'Page Content Needed!',
                    'is_page_title_visible'=>'Is Activate Linkage Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {

            /** 页面名称是否存在并且不属于当前可定制页
             */
            $customPageModelQuery = $this->db->get_where('t_e_store_cms_custom_page', array(
                'page_name' =>  $cmsCustomPage->page_name
            ));
            $customPageModel = $customPageModelQuery->row_array();
            if( $customPageModelQuery->num_rows() > 0 && $customPageModel['id'] != $cmsCustomPage->id )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Page Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->update('t_e_store_cms_custom_page', $cmsCustomPage->getEditableData(), array(
                    'id'=>$cmsCustomPage->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Custom Page Updated!'
                ), FALSE);
            }
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除可定制页
     */
    public function delete_batch()
    {
        $cmsCustomPage = new CMSCustomPage($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomPage,
                'check_empty'=>array(
                    'custom_page_ids'=>'Must select at least one custom page!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $cmsCustomPage->custom_page_ids as $custom_page_id )
            {
                $this->db->delete('t_e_store_cms_custom_page', array(
                    'id'=>$custom_page_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected custom page deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
