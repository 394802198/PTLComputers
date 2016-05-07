<?php

require_once 'application/class/e_store/cms/CMSContactUsEmail.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 删除
     */
    public function delete()
    {
        $cmsContactUsEmail = new CMSContactUsEmail( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsEmail,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_cms_contact_us_email', array(
                'id'    =>  $cmsContactUsEmail->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Email Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 编辑
     */
    public function edit()
    {
        $cmsContactUsEmail = new CMSContactUsEmail( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsEmail,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'email'=>'Email Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_cms_contact_us_email', $cmsContactUsEmail->getEditableData(), array(
                'id'    =>  $cmsContactUsEmail->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Email Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加
     */
    public function add()
    {
        $cmsContactUsEmail = new CMSContactUsEmail( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsEmail,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'email'=>'Email Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $sequence = 0;

            /** 如果有，则获取最高的 Sequence
             */
            $this->db->select_max('sequence');
            $cmsContactUsEmailModelQuery = $this->db->get('t_e_store_cms_contact_us_email');
            if( $cmsContactUsEmailModelQuery->num_rows() > 0 )
            {
                $cmsContactUsEmailModel = $cmsContactUsEmailModelQuery->row_array();
                $sequence = $cmsContactUsEmailModel['sequence'];
                $sequence ++;
            }

            $cmsContactUsEmail->sequence = $sequence;

            $this->db->insert('t_e_store_cms_contact_us_email', $cmsContactUsEmail->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Email Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
