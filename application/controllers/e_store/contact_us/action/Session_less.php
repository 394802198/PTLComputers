<?php

require_once 'application/class/e_store/ContactUs.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

    // Submit Enquiry Rest
	public function submit_enquiry()
	{
        $contactUs = new ContactUs($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$contactUs,
                'check_empty'=>array(
                    'message'=>'Enquiry Needed!',
                    'captcha_code'=>'Please Enter the code in the box below the Enquiry'
                ),
                'check_one_not_empty'=>array(
                    'first_name|last_name'=>'First or Last Name Needed!',
                    'email|phone'=>'Contact Phone or Email Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果验证码过期
         */
        if( ! isset( $_SESSION['captcha'] ) || ! isset( $_SESSION['captcha']['code'] ) )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'The code is expired, please refresh current page and try again!'
            ), TRUE);
        }
        /** 否则如果验证码不匹配
         */
        else if( strcasecmp( $_SESSION['captcha']['code'], $contactUs->captcha_code )!=0 )
        {
            if( ! $jsonAlert->hasErrors )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'The code you entered is incorrect, please check and try again!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {

            $finalEmailServerConfiguration = array();

            /** 选择 Purpose 为 106 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
             */
            $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                'purpose'   =>  106
            ));
            $is_use_default = false;
            if( $emailServerModelQuery->num_rows() > 0 )
            {
                $emailServerModel = $emailServerModelQuery->row_array();
                if( strcasecmp( $emailServerModel['is_use_default'], 'Y' )==0 )
                {
                    $is_use_default = true;
                }
                else
                {
                    $finalEmailServerConfiguration = $emailServerModel;
                }
            }
            else
            {
                $is_use_default = true;
            }

            if( $is_use_default )
            {
                $defaultEmailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'is_default'    =>  'Y'
                ));
                if( $defaultEmailServerModelQuery->num_rows() > 0 )
                {
                    $defaultEmailServerModel = $defaultEmailServerModelQuery->row_array();
                    $finalEmailServerConfiguration = $defaultEmailServerModel;
                }
            }

            /** 如果有配置邮箱服务器
             */
            if( ! empty( $finalEmailServerConfiguration ) )
            {
                $cmsContactUsModelQuery = $this->db->get('t_e_store_cms_contact_us');
                $cmsContactUsModel = $cmsContactUsModelQuery->row_array();

                $final_msg = '<strong>Enquiry From</strong> : ' . $contactUs->first_name . ' ' . $contactUs->last_name . '<br/>';
                $final_msg .= '<strong>Contact Info</strong> : ' . $contactUs->email . ' ' . $contactUs->phone . '<br/>';
                $final_msg .= '<strong>Message</strong> : <br/>' . $contactUs->message;

                $finalEmailTemplate = array(
                    'subject'   =>  $cmsContactUsModel['subject'],
                    'body'      =>   $final_msg
                );

                $config = array(
                    'host'          => $finalEmailServerConfiguration['host'],
                    'is_ssl'        => strcasecmp( $finalEmailServerConfiguration['is_ssl'], 'Y' )==0 ? true : false,
                    'port'          => $finalEmailServerConfiguration['port'],
                    'host_name'     => $finalEmailServerConfiguration['host_name'],
                    'reply'         => $contactUs->email,
                    'reply_name'    => $contactUs->first_name . ' ' . $contactUs->last_name,
                    'from'          => $finalEmailServerConfiguration['username'],
                    'from_name'     => $finalEmailServerConfiguration['from_name'],
                    'username'      => $finalEmailServerConfiguration['username'],
                    'password'      => $finalEmailServerConfiguration['password'],
                    'address'       => $cmsContactUsModel['receiver_email'],
                    'subject'       => $finalEmailTemplate['subject'],
                    'body'          => $finalEmailTemplate['body']
                );
                EmailSender::send($config);
            }

            $jsonAlert->append(array(
                'successMsg'=>'We have send your enquiry to our information collection center, will reply back as soon as possible!'
            ), FALSE);
	    }

        echo $jsonAlert->result();
	}
}
