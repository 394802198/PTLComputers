<?php

require_once 'application/class/e_store/cms/CMSContactUsWorkingHour.php';
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
        $cmsContactUsWorkingHour = new CMSContactUsWorkingHour( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsWorkingHour,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_e_store_cms_contact_us_working_hour', array(
                'id'    =>  $cmsContactUsWorkingHour->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Working Hour Deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 编辑
     */
    public function edit()
    {
        $cmsContactUsWorkingHour = new CMSContactUsWorkingHour( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsWorkingHour,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'time_range'=>'Time Range Needed!',
                    'sequence'=>'Sequence Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_e_store_cms_contact_us_working_hour', $cmsContactUsWorkingHour->getEditableData(), array(
                'id'    =>  $cmsContactUsWorkingHour->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Working Hour Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加
     */
    public function add()
    {
        $cmsContactUsWorkingHour = new CMSContactUsWorkingHour( $this->input );
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cmsContactUsWorkingHour,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'time_range'=>'Time Range Needed!'
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
            $cmsContactUsWorkingHourModelQuery = $this->db->get('t_e_store_cms_contact_us_working_hour');
            if( $cmsContactUsWorkingHourModelQuery->num_rows() > 0 )
            {
                $cmsContactUsWorkingHourModel = $cmsContactUsWorkingHourModelQuery->row_array();
                $sequence = $cmsContactUsWorkingHourModel['sequence'];
                $sequence ++;
            }

            $cmsContactUsWorkingHour->sequence = $sequence;

            $this->db->insert('t_e_store_cms_contact_us_working_hour', $cmsContactUsWorkingHour->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'Contact Us Working Hour Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
