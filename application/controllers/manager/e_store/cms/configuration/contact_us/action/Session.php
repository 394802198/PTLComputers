<?php

require_once 'application/class/e_store/cms/CMSContactUs.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 更新 联系我们 配置
     */
    public function edit()
    {
        $cmsContactUs = new CMSContactUs( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUs,
                'check_empty'=>array(
                    'subject'=>'Subject Needed!',
                    'is_receiver_email_activate'=>'Receiver Email Activate Or Not?',
                    'is_map_visible'=>'Map Visible Or Not?',
                ),
                'check_empty_on_other'=>array(
                    'is_receiver_email_activate=Y|receiver_email'=>'Receiver Needed if choose activate to YES',
                    'is_map_visible=Y|map_iframe'=>'Map iFrame Needed if choose visibility to YES'
                 )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** 如果有，则更新
             */
            $cmsContactUsModelQuery = $this->db->get('t_e_store_cms_contact_us');
            if( $cmsContactUsModelQuery->num_rows() > 0 )
            {
                $this->db->update('t_e_store_cms_contact_us', $cmsContactUs->getEditableData());
            }
            /** 否则没有，则插入
             */
            else
            {
                $this->db->insert('t_e_store_cms_contact_us', $cmsContactUs->getInsertableData());
            }

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Configuration Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
