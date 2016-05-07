<?php

require_once 'application/class/core/EmailServer.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 更新默认邮箱服务器
     */
    public function edit_default()
    {
        $emailServer = new EmailServer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailServer,
                'check_empty'=>array(
                    'host'=>'Host Needed!',
                    'host_name'=>'Host Name Needed!',
                    'is_ssl'=>'Is SSL Needed!',
                    'port'=>'Port Needed!',
                    'username'=>'Username Needed!',
                    'password'=>'Password Needed!',
                    'reply'=>'Reply Needed!',
                    'reply_name'=>'Reply Name Needed!',
                    'from_name'=>'From Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $defaultEmailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                'is_default'    =>  'Y'
            ));
            if( $defaultEmailServerModelQuery->num_rows() > 0 )
            {
                $this->db->update('t_core_email_server', $emailServer->getEditableData(), array(
                    'is_default'    =>  'Y'
                ));
            }
            else
            {
                $emailServer->is_default = 'Y';
                $this->db->insert('t_core_email_server', $emailServer->getInsertableData());
            }

            $jsonAlert->append(array(
                'successMsg'=>'Default Email Server Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加邮箱服务器
     */
	public function add()
	{
        $emailServer = new EmailServer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailServer,
                'check_empty'=>array(
                    'host'=>'Host Needed!',
                    'host_name'=>'Host Name Needed!',
                    'is_ssl'=>'Is SSL Needed!',
                    'port'=>'Port Needed!',
                    'username'=>'Username Needed!',
                    'password'=>'Password Needed!',
                    'reply'=>'Reply Needed!',
                    'reply_name'=>'Reply Name Needed!',
                    'from_name'=>'From Name Needed!',
                    'is_use_default'=>'Is Use Default Needed!',
                    'purpose'=>'Purpose Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果该用途的邮箱服务器是否已配置
         */
        $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
            'is_default'    =>  'N',
            'purpose'       =>  $emailServer->purpose
        ));
        if( $emailServerModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Email Server with the same Purpose is currently existed!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $emailServer->is_default = 'N';

            $this->db->insert('t_core_email_server', $emailServer->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Email Server Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 更新邮箱服务器
     */
    public function edit()
    {
        $emailServer = new EmailServer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailServer,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'host'=>'Host Needed!',
                    'host_name'=>'Host Name Needed!',
                    'is_ssl'=>'Is SSL Needed!',
                    'port'=>'Port Needed!',
                    'username'=>'Username Needed!',
                    'password'=>'Password Needed!',
                    'reply'=>'Reply Needed!',
                    'reply_name'=>'Reply Name Needed!',
                    'from_name'=>'From Name Needed!',
                    'is_use_default'=>'Is Use Default Needed!',
                    'purpose'=>'Purpose Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果该用途的邮箱服务器是否已配置
         */
        $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
            'is_default'    =>  'N',
            'purpose'       =>  $emailServer->purpose
        ));
        if( $emailServerModelQuery->num_rows() > 0 )
        {
            $emailServerModel = $emailServerModelQuery->row_array();
            if( $emailServer->id != $emailServerModel['id'] )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Email Server with the same Purpose is currently existed!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_core_email_server', $emailServer->getEditableData(), array(
                'id'            =>  $emailServer->id,
                'is_default'    =>  'N'
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Email Server Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 删除邮箱服务器
     */
	public function delete()
	{
        $emailServer = new EmailServer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailServer,
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
            $this->db->delete('t_core_email_server', array(
                'id'    =>  $emailServer->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Email Server deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
