<?php

require_once 'application/class/core/EmailTemplate.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 发送业务通讯邮件模板至
     */
    public function send_to()
    {
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'to'=>'To Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                'id'    =>  $emailTemplate->id,
                'type'  =>  2
            ));

            if( $emailTemplateModelQuery->num_rows() > 0 )
            {
                $emailTemplateModel = $emailTemplateModelQuery->row_array();

                $email_addresses = array();

                switch( $emailTemplate->to )
                {
                    /** E 店客户
                     */
                    case 'e_store_customer' :

                        $this->db->select('email');
                        $customerObjQuery = $this->db->get('t_e_store_customer');
                        if( $customerObjQuery->num_rows() > 0 )
                        {
                            $customerObj = $customerObjQuery->result_object();
                            foreach( $customerObj as $customer )
                            {
                                if( trim( $customer->email ) != '' )
                                {
                                    array_push( $email_addresses, $customer->email );
                                }
                            }
                        }
                        break;
                    /** E 店订阅者
                     */
                    case 'e_store_subscriber' :

                        $this->db->select('email');
                        $subscribeObjQuery = $this->db->get('t_e_store_subscribe_list');
                        if( $subscribeObjQuery->num_rows() > 0 )
                        {
                            $subscribeObj = $subscribeObjQuery->result_object();
                            foreach( $subscribeObj as $subscribe )
                            {
                                if( trim( $subscribe->email ) != '' )
                                {
                                    array_push( $email_addresses, $subscribe->email );
                                }
                            }
                        }
                        break;
                    /** E 店批发商
                     */
                    case 'remarketing_wholesaler' :

                        $this->db->select('email');
                        $wholesalerObjQuery = $this->db->get('t_remarketing_wholesaler');
                        if( $wholesalerObjQuery->num_rows() > 0 )
                        {
                            $wholesalerObj = $wholesalerObjQuery->result_object();
                            foreach( $wholesalerObj as $wholesaler )
                            {
                                if( trim( $wholesaler->email ) != '' )
                                {
                                    array_push( $email_addresses, $wholesaler->email );
                                }
                            }
                        }
                        break;
                }

                if( ! empty( $email_addresses ) )
                {
                    $finalEmailServerConfiguration = array();

                    /** 选择 Purpose 为 104 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                     */
                    $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                        'purpose'   =>  104
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
                        $config = array(
                            'host'          => $finalEmailServerConfiguration['host'],
                            'is_ssl'        => strcasecmp( $finalEmailServerConfiguration['is_ssl'], 'Y' )==0 ? true : false,
                            'port'          => $finalEmailServerConfiguration['port'],
                            'host_name'     => $finalEmailServerConfiguration['host_name'],
                            'reply'         => $finalEmailServerConfiguration['reply_name'],
                            'reply_name'    => $finalEmailServerConfiguration['reply'],
                            'from'          => $finalEmailServerConfiguration['username'],
                            'from_name'     => $finalEmailServerConfiguration['from_name'],
                            'username'      => $finalEmailServerConfiguration['username'],
                            'password'      => $finalEmailServerConfiguration['password'],
                            'bccs'          => $email_addresses,
                            'subject'       => $emailTemplateModel['subject'],
                            'body'          => rawurldecode( $emailTemplateModel['body'] )
                        );
                        EmailSender::send($config);
                    }
                }

                $jsonAlert->append(array(
                    'successMsg'=>'Send Email Template ( Newsletter ) To Specified Addresses!'
                ), FALSE);
            }
        }
        echo $jsonAlert->result();
    }

    /** 添加业务通讯邮件模板
     */
	public function add()
	{
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'subject'=>'Subject Needed!',
                    'body'=>'Body Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $emailTemplate->type = 2;

            $this->db->insert('t_core_email_template', $emailTemplate->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Email Template ( Newsletter ) Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 更新业务通讯邮件模板
     */
    public function edit()
    {
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'subject'=>'Subject Needed!',
                    'body'=>'Body Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_core_email_template', $emailTemplate->getEditableData(), array(
                'id'        =>  $emailTemplate->id,
                'type'      =>  2
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Email Template ( Newsletter ) Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 删除业务通讯邮件模版
     */
	public function delete()
	{
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( strcasecmp( $_SESSION['manager']['role'], 'administrator' )!=0 )
        {
            $jsonAlert->hasErrors = TRUE;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_core_email_template', array(
                'id'    =>  $emailTemplate->id,
                'type'  =>  2
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Email Template ( Newsletter ) deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
