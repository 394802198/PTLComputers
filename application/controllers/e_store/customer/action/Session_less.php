<?php

require_once 'application/class/e_store/Customer.php';
require_once 'util/myutils/MyUtils.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

    /** 忘记密码
     */
    public function forget_password()
    {
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'email'=>'Email Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'email' =>  $customer->email
            ));
            if( $customerModelQuery->num_rows() > 0 )
            {
                $customerModel = $customerModelQuery->row_array();

                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 101 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  101
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

                $password = MyUtils::r_str( 6, 'A-Za-z0-9' );

                $this->db->update('t_e_store_customer', array(
                    'password'  =>  md5( $password )
                ), array(
                    'id'    =>  $customerModel['id']
                ));

                /** 如果有配置邮箱服务器
                 */
                if( ! empty( $finalEmailServerConfiguration ) )
                {
                    $finalEmailTemplate = array(
                        'subject'   =>  'Dear Customer, Your New EStore Login Password',
                        'body'      =>  'Your new EStore login password is ' . $password . '.<br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 101 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  101
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $customerModel['first_name'], $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $customerModel['last_name'], $finalEmailTemplate['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=password%>', $password, $finalEmailTemplate['body'] );
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
                        'address'       => $customerModel['email'],
                        'subject'       => $finalEmailTemplate['subject'],
                        'body'          => $finalEmailTemplate['body']
                    );
                    EmailSender::send($config);
                }

                $jsonAlert->append(array(
                    'successMsg'    =>  'We have just send your new login password to your email address!'
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
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'email'=>'Email Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'email' =>  $customer->email
            ));
            if( $customerModelQuery->num_rows() > 0 )
            {
                $customerModel = $customerModelQuery->row_array();

                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 105 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  105
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
                        'body'      =>  'Your EStore login account is ' . $customerModel['account'] . '.<br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 105 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  105
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $customerModel['first_name'], $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $customerModel['last_name'], $finalEmailTemplate['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=account%>', $customerModel['account'], $finalEmailTemplate['body'] );
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
                        'address'       => $customerModel['email'],
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
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'email_or_account'=>'Email or Account Needed!',
                    'password'=>'Password Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $systemStatusModelQuery = $this->db->get('t_core_status');
	    $systemStatusModel = $systemStatusModelQuery->row_array();
	    
	    if( $systemStatusModel['estore_state'] == 'maintain' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'EStore is currently under maintenance, sorry for the inconvenience!'
            ), TRUE);
	    }

        if( ! $jsonAlert->hasErrors )
        {
            /** SELECT * FROM (`t_e_store_customer`)
             *  WHERE `password` = $customer->password
             *  AND
             *  (
             *      `email` = $customer->email_or_account
             *      OR
             *      `account` = $customer->email_or_account
             *  )
             */
            $customerModelQuery = $this->db
                ->where( 'password', md5( $customer->password ) )
                ->group_start()
                    ->where( 'email', $customer->email_or_account )
                    ->or_where( 'account', $customer->email_or_account )
                ->group_end()
                ->get('t_e_store_customer');

            /** 如果登录失败
             */
            if( $customerModelQuery->num_rows() < 1 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account and Credential Unmatched!'
                ), TRUE);
            }
            /** 否则登录成功
             */
            else
            {
                $customerModel = $customerModelQuery->row_array();

                /** 如果客户未激活
                 */
                if( strcasecmp( $customerModel['is_activated'], 'N' ) == 0 )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Your account hasn\'t been activated, please contact system admin to activate it!'
                    ), TRUE);
                }
                /** 否则客户已激活
                 */
                else
                {
                    $_SESSION['customer'] = $customerModel;
                    unset( $_SESSION['customer']['password'] );
                    $customerId = $_SESSION['customer']['id'];

                    /** 如果登录前有订购详情
                     */
                    if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) )
                    {
                        $last_update = date("Y-m-d h:i:s");

                        /** 存放已存在的订购详情
                         */
                        $existingCartItems = array();

                        /** 总的新订购详情数量
                         */
                        $cartItemQtyTotal = 0;

                        /** 获取购物车
                         */
                        $cartModelQuery = $this->db->get_where('t_e_store_cart',array(
                            'customer_id'   =>  $customerId
                        ));

                        /** 如果数据库中没有购物车
                         */
                        if( $cartModelQuery->num_rows() < 1 )
                        {
                            /** 创建新购物车
                             */
                            $this->db->insert('t_e_store_cart', array(
                                'customer_id'   =>  $customerId,
                                'create_time'   =>  date("Y-m-d h:i:s"),
                                'last_update'   =>  $last_update
                            ));
                            /** 重新获取购物车
                             */
                            $cartModelQuery = $this->db->get_where('t_e_store_cart',array(
                                'customer_id'   =>  $customerId
                            ));
                        }
                        /** 否则数据库中有购物车
                         */
                        else
                        {
                            $cartModel = $cartModelQuery->row_array();
                            /** 获取订购详情
                             */
                            $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                                'cart_id'   =>  $cartModel['id']
                            ));
                            if( $cartItemsObjQuery->num_rows() > 0 )
                            {
                                $existingCartItems = $cartItemsObjQuery->result_array();
                            }
                        }
                        $cartModel = $cartModelQuery->row_array();

                        $insertableItems = array();
                        $updatableItems = array();

                        foreach( $_SESSION['cartSession']['items'] as $item )
                        {
                            $isNewCartItem = true;
                            $cartItemQtyTotal += intval( $item['qty_ordered'] );

                            /** 如果有订购详情
                             */
                            if( count( $existingCartItems ) > 0 )
                            {
                                foreach( $existingCartItems as $existingCartItem )
                                {
                                    /** 如果匹配到订购详情，更新订购数量至已有订购详情中
                                     */
                                    if( $item['commodity_id'] == $existingCartItem['commodity_id'] )
                                    {
                                        $isNewCartItem = false;

                                        array_push( $updatableItems, array(
                                            'id'            =>  $existingCartItem['id'],
                                            'qty_ordered'   =>  intval( $item['qty_ordered'] ) + intval( $existingCartItem['qty_ordered'] )
                                        ) );
                                    }
                                }
                            }
                            /** 如果是新订购商品，则可以直接插入到该客户存在数据库中的订购列表
                             */
                            if( $isNewCartItem )
                            {
                                /** 与购物车做关联
                                 */
                                $item['cart_id']    =   $cartModel['id'];
                                array_push( $insertableItems, $item );
                            }
                        }

                        /** 如果有可更新的订购详情
                         */
                        if( count( $updatableItems ) > 0 )
                        {
                            $this->db->update_batch('t_e_store_cart_item', $updatableItems, 'id');
                        }
                        /** 如果有可插入的订购详情
                         */
                        if( count( $insertableItems ) > 0 )
                        {
                            $this->db->insert_batch('t_e_store_cart_item', $insertableItems);
                        }

                        unset( $_SESSION['cartSession'] );

                        $jsonAlert->append(array(
                            'automaticallyAttachFromCartMsg'=>'Automatically attach ' . ( $cartItemQtyTotal ) . ' item(s) from cart to your account\'s related cart'
                        ), FALSE);
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Welcome back~'
                    ), FALSE);
                }
            }
	    }

        echo $jsonAlert->result();
	}

    // Logout Rest
    public function logout()
    {
        $jsonAlert = new JSONAlert();

        unset( $_SESSION['customer'] );

        $jsonAlert->append(array(
            'successMsg'=>'Good Bye~'
        ), FALSE);

        echo $jsonAlert->result();
    }

    // Check Account Exist Rest
    public function check_account_exist()
    {
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'account'=>'Account Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
                'account'=>$customer->account
            ));

            if( $customerModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Account Existed!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }

    // Add Rest
    public function add()
    {
        $customer = new Customer($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$customer,
                'check_empty'=>array(
                    'account'=>'Account Needed!',
                    'email'=>'Email Needed!',
                    'password'=>'Password Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                ),
                'check_size'=>array(
                    'account| >= 6'=>'Account too short, length must be longer than or equals to 6',
                    'password| >= 6'=>'Password too short, length must be longer than or equals to 6'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** Email 是否已存在
         */
        $customerEmailCheckModelQuery = $this->db->get_where('t_e_store_customer', array(
            'email'=>$customer->email
        ));
        if( $customerEmailCheckModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorEmailExistedMsg'=>'Email Existed!'
            ), TRUE);
            $jsonAlert->hasErrors = true;
        }
        /** Account 是否已存在
         */
        $customerAccountCheckModelQuery = $this->db->get_where('t_e_store_customer', array(
            'account'=>$customer->account
        ));
        if( $customerAccountCheckModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorAccountExistedMsg'=>'Account Existed!'
            ), TRUE);
            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $customer->password = md5( $customer->password );

            $this->db->insert('t_e_store_customer', $customer->getInsertableData());

            $_SESSION['customer']           =   $customer->getInsertableData();
            $_SESSION['customer']['id']     =   $this->db->insert_id();
            unset( $_SESSION['customer']['password'] );


            $finalEmailServerConfiguration = array();

            /** 选择 Purpose 为 100 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
             */
            $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                'purpose'   =>  100
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
                    'subject'   =>  'Dear Customer, Welcome to PTL\'s Big Family',
                    'body'      =>  '<h3>Dear ' . $customer->account . ' , Welcome to PTL\'s big family, hope you will be enjoyed while shopping with us.</p><br/><br/><br/>Best regards,<br/>PTLComputers<br/>'
                );

                /** 选择 Purpose 为 100 的邮件模板
                 */
                $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                    'purpose'   =>  100
                ));
                if( $emailTemplateModelQuery->num_rows() > 0 )
                {
                    $emailTemplateModel = $emailTemplateModelQuery->row_array();
                    $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                    $finalEmailTemplate['body'] = str_replace( '<%=account%>', $customer->account, $emailTemplateModel['body'] );
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
                    'address'       => $customer->email,
                    'subject'       => $finalEmailTemplate['subject'],
                    'body'          => $finalEmailTemplate['body']
                );
                EmailSender::send($config);
            }

            $jsonAlert->append(array(
                'successMsg'=>'Sign Up Successfully!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
}
