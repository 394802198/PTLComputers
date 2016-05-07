<?php

require_once 'application/class/remarketing/Wholesaler.php';
require_once 'util/myutils/MyUtils.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if(!isset($_SESSION)) session_start();
    }

    /** 忘记密码
     */
    public function forget_password()
    {
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'email'=>'Email Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $systemStatusModelQuery = $this->db->get('t_core_status');
        $systemStatusModel = $systemStatusModelQuery->row_array();

        if( $systemStatusModel['remarketing_state'] == 'maintain' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Remarketing System is currently under maintenance, sorry for the inconvenience!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'email' =>  $wholesaler->email
            ));

            if( $wholesalerModelQuery->num_rows() > 0 )
            {
                $wholesalerModel = $wholesalerModelQuery->row_array();

                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 201 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  201
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

                $password = MyUtils::r_str(  6, 'A-Za-z0-9' );

                $this->db->update('t_remarketing_wholesaler', array(
                    'login_password'    =>  $password
                ),array(
                    'id'    =>  $wholesalerModel['id']
                ));

                /** 如果有配置邮箱服务器
                 */
                if( ! empty( $finalEmailServerConfiguration ) )
                {
                    $finalEmailTemplate = array(
                        'subject'   =>  'Dear Wholesaler, Your Remarketing Auto Generated Pass',
                        'body'      =>  'We have generate an random string <span style="display:inline-block; padding:3px 5px; font-size:11px; line-height:14px; color:grey; border:1px solid grey; border-radius:4px; vertical-align:baseline; white-space:nowrap; background-color:#e1e1e1;">' . $password . '</span> for you to use as your new login password.<br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 201 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  201
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $wholesalerModel['first_name'], $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $wholesalerModel['last_name'], $finalEmailTemplate['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=login_password%>', $password, $finalEmailTemplate['body'] );
                    }

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
                        'address'       => $wholesalerModel['email'],
                        'subject'       => $finalEmailTemplate['subject'],
                        'body'          => $finalEmailTemplate['body']
                    );
                    EmailSender::send($config);
                }

                $jsonAlert->append(array(
                    'successMsg'    =>  'We have just send your login password to your email address!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Email not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    /** 忘记账号
     */
    public function forget_account()
    {
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'email'=>'Email Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $systemStatusModelQuery = $this->db->get('t_core_status');
        $systemStatusModel = $systemStatusModelQuery->row_array();

        if( $systemStatusModel['remarketing_state'] == 'maintain' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Remarketing System is currently under maintenance, sorry for the inconvenience!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'email' =>  $wholesaler->email
            ));

            if( $wholesalerModelQuery->num_rows() > 0 )
            {
                $wholesalerModel = $wholesalerModelQuery->row_array();

                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 203 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  203
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
                    $finalEmailTemplate = array(
                        'subject'   =>  'Dear Customer, Your EStore Login Account',
                        'body'      =>  'Your EStore login account is ' . $wholesalerModel['login_account'] . '.<br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 203 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  203
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $wholesalerModel['first_name'], $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $wholesalerModel['last_name'], $finalEmailTemplate['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=login_account%>', $wholesalerModel['login_account'], $finalEmailTemplate['body'] );
                    }

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
                        'address'       => $wholesalerModel['email'],
                        'subject'       => $finalEmailTemplate['subject'],
                        'body'          => $finalEmailTemplate['body']
                    );
                    EmailSender::send($config);
                }

                $jsonAlert->append(array(
                    'successMsg'    =>  'We have just send your login account to your email address!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Email not found!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    // Login Rest
	public function login()
	{
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $systemStatusModelQuery = $this->db->get('t_core_status');
	    $systemStatusModel = $systemStatusModelQuery->row_array();

		$is_not_first_time = NULL;
	    
	    if( $systemStatusModel['remarketing_state'] == 'maintain' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Remarketing System is currently under maintenance, sorry for the inconvenience!'
            ), TRUE);
	    }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account,
                'login_password'=>$wholesaler->login_password
            ));

            if( $wholesalerModelQuery->num_rows() < 1 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account and Login Password Unmatched!'
                ), TRUE);
            }
            else
            {
                $wholesalerModel = $wholesalerModelQuery->row_array();
                if( $wholesalerModel['is_activated'] == 0 )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Your account hasn\'t been activated, please contact system admin to activate it!'
                    ), TRUE);
                }
                else if( $wholesalerModel['is_not_first_time'] == 0 )
                {
                    $is_not_first_time = 0;

                    $_SESSION["wholesaler_id_4_terms_conditions"] = $wholesalerModel['id'];
                }
                else
                {
                    $is_not_first_time = 1;

                    $_SESSION["wholesaler"] = $wholesalerModel;
                }
            }
	    }
        $jsonAlert->model = array(
            'is_not_first_time'=>$is_not_first_time
        );
        echo $jsonAlert->result();
	}

    public function accept_terms_conditions()
    {
        $jsonAlert = new JSONAlert();

        $isAccepted = $this->input->post('is_accepted');
        if($isAccepted=='false')
        {
            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesaler_id_4_terms_conditions = $_SESSION["wholesaler_id_4_terms_conditions"];

            $this->db->update('t_remarketing_wholesaler', array(
                'is_not_first_time'=>1
            ), array(
                'id'=>$wholesaler_id_4_terms_conditions
            ));

            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'id'=>$wholesaler_id_4_terms_conditions
            ));
            unset($_SESSION['wholesaler_id_4_terms_conditions']);

            $_SESSION["wholesaler"] = $wholesalerModelQuery->row_array();

            $jsonAlert->append(array(
                'successMsg'=>'Hope you enjoying our services!'
            ), FALSE);
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'You can\'t continue without accepting our terms & conditions!'
            ), TRUE);
        }
        echo $jsonAlert->result();
    }

    // Check Login Account Duplicate Rest
    public function check_loginaccount_duplicate()
    {
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

            if($wholesalerModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    // Add Rest
    public function add()
    {
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'login_account'=>'Login Account Needed!',
                    'login_password'=>'Login Password Needed!',
                    'first_name'=>'First Name Needed!',
                    'last_name'=>'Last Name Needed!',
                    'email'=>'Email Needed!',
                    'company_name'=>'Company Name Needed!',
                    'landline_phone'=>'Landline Phone Needed!',
                    'mobile_phone'=>'Mobile Phone Needed!',
                    'street'=>'Street Needed!',
                    'area'=>'Area Needed!',
                    'city'=>'City Needed!',
                    'country'=>'Country Needed!',
                    'security_question'=>'Security Question Needed!',
                    'security_answer'=>'Security Answer Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                'login_account'=>$wholesaler->login_account
            ));

            if($wholesalerModelQuery->num_rows() < 1)
            {
                $wholesaler->is_activated = 1;
                $this->db->insert('t_remarketing_wholesaler', $wholesaler->getInsertableData());

                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 200 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  200
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
                    $finalEmailTemplate = array(
                        'subject'   =>  'Dear Wholesaler, Welcome to PTL\'s Remarketing System',
                        'body'      =>  'Dear ' . $wholesaler->first_name . ' ' . $wholesaler->last_name . ',<br/><br/> Welcome to PTL\'s Remarketing System, we will activate your Wholesaler account if everything is fine.<br/><br/>Hope you will be enjoyed while shopping with us.<br/><br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 200 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  200
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $wholesaler->first_name, $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $wholesaler->last_name, $finalEmailTemplate['body'] );
                    }

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
                        'address'       => $wholesaler->email,
                        'subject'       => $finalEmailTemplate['subject'],
                        'body'          => $finalEmailTemplate['body']
                    );
                    EmailSender::send($config);
                }

                $jsonAlert->append(array(
                    'successMsg'=>'Successfully Registered!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Login Account Duplicated!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
}
