<?php

require_once 'application/class/util/payment_express/PxPay.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Dps_Payment_Express_Session_Less extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->pxPay = new PxPay();
    }

    public function make_payment_online_ordering( $type, $txnData1, $grand_total)
    {
        // Step 1: Grab the encrypted transaction result that DPS would append to this page
        $txnData1 = isset( $txnData1 ) ? $txnData1 : FALSE;
        $grand_total = isset( $grand_total ) ? $grand_total : FALSE;

        if ( ! $txnData1 && ! $grand_total )
        {
            die('This page expected to receive an encrypted transaction result.');
        }
        else
        {
            $merchantReference = '';
            $urlSuccess = '';
            $urlFail = '';

            /** 在线下单
             */
            switch( $type )
            {

            }
            if( $type == 'online-ordering' )
            {
                $merchantReference = 'Online Ordering Payment';
                $urlSuccess = ROOT_PATH . '/payment_gateway/dps_payment_express_session_less/payment_success/' . $type;
                $urlFail = ROOT_PATH . '/payment_gateway/dps_payment_express_session_less/payment_fail/' . $type;
            }

            $detail = array(
                'amountInput'           => $grand_total,
                'merchantReference'     => $merchantReference,
                'txnData1'              => $txnData1,
                'urlSuccess'            => $urlSuccess,
                'urlFail'               => $urlFail
            );

            $this->pxPay->postRequest( $detail );
        }

    }

    public function payment_success( $type )
    {
        $this->pxPay->postResponse();

        $success_redirect_url = '';

        if( $this->pxPay->getResponse()->isValid() )
        {
            switch( $type )
            {
                /** 在线下单
                 */
                case "online-ordering":
                    $success_redirect_url = ROOT_PATH . '/payment_gateway/payment_success#target';
                    $where = array(
                        'txn_id' => $this->pxPay->getResponse()->getTxnId()
                    );
                    $query = $this->db->get_where('t_dps_response', $where);
                    /**
                     * If existed then do nothing, Else insert transaction and continue
                     */
                    if( $query->num_rows() < 1 )
                    {
                        $responseArray = $this->pxPay->getResponseArray();

                        $this->db->update('t_e_store_order',array(
                            'total_paid'        =>  $responseArray['amount_settlement'],
                            'last_update'       =>  date("Y-m-d h:i:s"),
                            'payment_status'    =>  2
                        ), array(
                            'id' => $responseArray['txn_data1']
                        ));

                        /** 同步库存
                         */
                        $orderItemObjQuery = $this->db->get_where('t_e_store_order_item', array(
                            'order_id'  =>  $responseArray['txn_data1']
                        ));
                        if( $orderItemObjQuery->num_rows() > 0 )
                        {
                            $orderItemObj = $orderItemObjQuery->result_object();
                            foreach( $orderItemObj as $orderItem )
                            {
                                $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                                    'e_store_sku'   =>  $orderItem->e_store_sku
                                ));
                                if( $commodityInventoryModelQuery->num_rows() > 0 )
                                {
                                    $commodityInventoryModel = $commodityInventoryModelQuery->row_array();
                                    $this->db->update('t_warehouse_commodity_inventory', array(
                                        'stock' =>  $commodityInventoryModel['stock'] - $orderItem->qty_ordered
                                    ), array(
                                        'e_store_sku'   =>  $orderItem->e_store_sku
                                    ));
                                }
                            }
                        }

                        $finalEmailServerConfiguration = array();

                        /** 选择 Purpose 为 103 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                         */
                        $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                            'purpose'   =>  103
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
                            $orderModelQuery = $this->db->get_where('t_e_store_order', array(
                                'id'    =>  $responseArray['txn_data1']
                            ));
                            $orderModel = $orderModelQuery->row_array();

                            $finalEmailTemplate = array(
                                'subject'   =>  'Dear Customer, We Have Received Your Payment',
                                'body'      =>  '<h3>Dear ' . $orderModel['receiver_name'] . ' , we have received your order.</h3><h3>we will contact you before we start processing your order ASAP!</h3><h3>We will start processing your order ASAP!</h3><p style="font-style:italic;">If you have any questions, please don\'t hesitate to Contact Us: 09 - 444 66 11</p><br/><br/><br/>Best regards,<br/>PTLComputers<br/>'
                            );

                            /** 选择 Purpose 为 103 的邮件模板
                             */
                            $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                                'purpose'   =>  103
                            ));
                            if( $emailTemplateModelQuery->num_rows() > 0 )
                            {
                                $emailTemplateModel = $emailTemplateModelQuery->row_array();
                                $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                                $finalEmailTemplate['body'] = str_replace( '<%=receiver_name%>', $orderModel['receiver_name'], $emailTemplateModel['body'] );
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
                                'address'       => $orderModel['receiver_email'],
                                'subject'       => $finalEmailTemplate['subject'],
                                'body'          => $finalEmailTemplate['body']
                            );
                            EmailSender::send($config);
                        }

                        $this->db->insert('t_dps_response', $responseArray);
                    }

                    /** 下单成功后的善后工作
                     */

                    /** 如果是会员
                     */
                    if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
                    {
                        $eStoreCartModelQuery = $this->db->get_where('t_e_store_cart', array(
                            'customer_id'   =>  $_SESSION['customer']['id']
                        ));
                        if( $eStoreCartModelQuery->num_rows() > 0 )
                        {
                            $eStoreCartModel = $eStoreCartModelQuery->row_array();

                            $this->db->delete('t_e_store_cart_item', array(
                                'cart_id'   =>  $eStoreCartModel['id']
                            ));

                            $this->db->delete('t_e_store_cart', array(
                                'id'    =>  $eStoreCartModel['id']
                            ));
                        }
                    }
                    /** 否则是访客
                     */
                    else if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
                    {
                        unset( $_SESSION['cartSession'] );
                    }
                    break;
            }
        }

        header('Location:' . $success_redirect_url );
    }

    public function payment_fail( $type )
    {
        $fail_redirect_url = '';

        // Step 1: Grab the encrypted transaction result that DPS would append to this page
        $result = isset($_GET['result']) ? (string) $_GET['result'] : FALSE;
        if ( ! $result)
        {
            die('This page expected to receive an encrypted transaction result.');
        }
        else
        {
            switch( $type )
            {
                /** 在线下单
                 */
                case 'online-ordering':
                    $fail_redirect_url = ROOT_PATH . '/payment_gateway/payment_fail#target';
                    break;
            }
        }

        header('Location:' . $fail_redirect_url );
    }

}