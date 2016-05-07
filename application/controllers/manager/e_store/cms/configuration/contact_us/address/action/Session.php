<?php

require_once 'application/class/e_store/cms/CMSContactUsAddress.php';
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
        $cmsContactUsAddress = new CMSContactUsAddress( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_cms_contact_us_address', array(
                'id'    =>  $cmsContactUsAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Address Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 编辑
     */
    public function edit()
    {
        $cmsContactUsAddress = new CMSContactUsAddress( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsAddress,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'address'=>'Address Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_cms_contact_us_address', $cmsContactUsAddress->getEditableData(), array(
                'id'    =>  $cmsContactUsAddress->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Address Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加
     */
    public function add()
    {
        $cmsContactUsAddress = new CMSContactUsAddress( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsAddress,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'address'=>'Address Needed!'
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
            $cmsContactUsAddressModelQuery = $this->db->get('t_e_store_cms_contact_us_address');
            if( $cmsContactUsAddressModelQuery->num_rows() > 0 )
            {
                $cmsContactUsAddressModel = $cmsContactUsAddressModelQuery->row_array();
                $sequence = $cmsContactUsAddressModel['sequence'];
                $sequence ++;
            }

            $cmsContactUsAddress->sequence = $sequence;

            $this->db->insert('t_e_store_cms_contact_us_address', $cmsContactUsAddress->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Address Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
