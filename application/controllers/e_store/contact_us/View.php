<?php

include("util/simple-php-captcha-master/simple-php-captcha.php");
require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class View extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $_SESSION['captcha'] = simple_php_captcha( array(
            'min_length' => 5,
            'max_length' => 5,
//            'backgrounds' => array('image.png'),
//            'fonts' => array('font.ttf'),
            'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
            'min_font_size' => 28,
            'max_font_size' => 28,
            'color' => '#666',
            'angle_min' => 0,
            'angle_max' => 10,
            'shadow' => true,
            'shadow_color' => '#fff',
            'shadow_offset_x' => -1,
            'shadow_offset_y' => 1
        ));

        $cmsContactUsModelQuery = $this->db->get('t_e_store_cms_contact_us');
        $data['cmsContactUs'] = $cmsContactUsModelQuery->row_array();

        /** 地址
         */
        $this->db->order_by('sequence');
        $addressObjQuery = $this->db->get('t_e_store_cms_contact_us_address');
        $data['addresses'] = $addressObjQuery->result_object();

        /** 号码
         */
        $this->db->order_by('sequence');
        $numbersObjQuery = $this->db->get('t_e_store_cms_contact_us_number');
        $data['numbers'] = $numbersObjQuery->result_object();

        /** 电邮
         */
        $this->db->order_by('sequence');
        $emailsObjQuery = $this->db->get('t_e_store_cms_contact_us_email');
        $data['emails'] = $emailsObjQuery->result_object();

        /** 工作时间
         */
        $this->db->order_by('sequence');
        $workingHourObjQuery = $this->db->get('t_e_store_cms_contact_us_working_hour');
        $data['workingHours'] = $workingHourObjQuery->result_object();


        $this->load->view('e_store/contact_us', $data);
	}
}
