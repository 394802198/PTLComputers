<?php

require_once 'application/class/e_store/cms/CMSCustomTopNavItem.php';
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

    /** 添加可定制顶部导航项
     */
	public function add()
	{
        $cmsCustomTopNavItem = new CMSCustomTopNavItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomTopNavItem,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'is_activate_linkage'=>'Is Activate Linkage Needed!',
                    'linkage'=>'Linkage Needed!',
                    'is_visible'=>'Is Visible Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->insert('t_e_store_cms_custom_top_nav_item', $cmsCustomTopNavItem->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Custom Top Nav Item Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑可定制顶部导航项
     */
	public function edit()
	{
        $cmsCustomTopNavItem = new CMSCustomTopNavItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomTopNavItem,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'is_activate_linkage'=>'Is Activate Linkage Needed!',
                    'linkage'=>'Linkage Needed!',
                    'is_visible'=>'Is Visible Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_cms_custom_top_nav_item', $cmsCustomTopNavItem->getEditableData(), array(
                'id'=>$cmsCustomTopNavItem->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Custom Top Nav Item Updated!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除可定制顶部导航项
     */
    public function delete_batch()
    {
        $cmsCustomTopNavItem = new CMSCustomTopNavItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomTopNavItem,
                'check_empty'=>array(
                    'custom_top_nav_ids'=>'Must select at least one custom top nav item!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $cmsCustomTopNavItem->custom_top_nav_ids as $custom_top_nav_id )
            {
                $this->db->delete('t_e_store_cms_custom_top_nav_item', array(
                    'id'=>$custom_top_nav_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected custom top nav item deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 更新顺序
     */
    public function update_sequence()
    {
        $cmsCustomTopNavItem = new CMSCustomTopNavItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsCustomTopNavItem,
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
            $this->db->update('t_e_store_cms_custom_top_nav_item', $cmsCustomTopNavItem->getEditableData(), array(
                'id'    =>  $cmsCustomTopNavItem->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Sequence Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
