<?php

require_once 'application/class/e_store/cms/CMSContactUsNumber.php';
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
        $cmsContactUsNumber = new CMSContactUsNumber( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsNumber,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_cms_contact_us_number', array(
                'id'    =>  $cmsContactUsNumber->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Number Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 编辑
     */
    public function edit()
    {
        $cmsContactUsNumber = new CMSContactUsNumber( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsNumber,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'number'=>'Number Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_cms_contact_us_number', $cmsContactUsNumber->getEditableData(), array(
                'id'    =>  $cmsContactUsNumber->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Number Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加
     */
    public function add()
    {
        $cmsContactUsNumber = new CMSContactUsNumber( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsNumber,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'number'=>'Number Needed!'
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
            $cmsContactUsNumberModelQuery = $this->db->get('t_e_store_cms_contact_us_number');
            if( $cmsContactUsNumberModelQuery->num_rows() > 0 )
            {
                $cmsContactUsNumberModel = $cmsContactUsNumberModelQuery->row_array();
                $sequence = $cmsContactUsNumberModel['sequence'];
                $sequence ++;
            }

            $cmsContactUsNumber->sequence = $sequence;

            $this->db->insert('t_e_store_cms_contact_us_number', $cmsContactUsNumber->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Number Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
