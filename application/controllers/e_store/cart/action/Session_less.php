<?php

require_once 'application/class/warehouse/logistic/courier/CourierPricing.php';
require_once 'application/class/e_store/Order.php';
require_once 'application/class/e_store/CartItem.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/CICartUtil.php';
require_once 'util/myutils/EmailSender.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

    public function confirm_order()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'receiver_name'=>'Name Needed!',
                    'receiver_phone'=>'Phone Needed!',
                    'receiver_email'=>'Email Needed!',
                    'payment_method'=>'Payment Method Needed!',
                    'delivery_method'=>'Delivery Method Needed!'
                ),
                'check_email'=>array(
                    'receiver_email'=>'Email Format Incorrect!'
                ),
                'check_empty_on_other'=>array(
                    'delivery_method=2|receiver_city'=>'Receiver City Needed!',
                    'delivery_method=2|receiver_address'=>'Receiver Address Needed!',
                    'delivery_method=2|receiver_phone'=>'Receiver Phone Needed!',
                    'delivery_method=2|receiver_name'=>'Receiver Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 检查库存是否充足
         */
        $stock_not_enough_sku = '';

        /** 如果是会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();

                $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                if( $cartItemsObjQuery->num_rows() > 0 )
                {
                    $cartItemsObj = $cartItemsObjQuery->result_object();
                    foreach( $cartItemsObj as $cartItemObj )
                    {
                        $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                            'e_store_sku'   =>  $cartItemObj->e_store_sku
                        ));

                        $is_stock_enough = true;

                        if( $commodityInventoryModelQuery->num_rows() > 0 )
                        {
                            $commodityInventoryModel = $commodityInventoryModelQuery->row_array();
                            if( $commodityInventoryModel['stock'] < $cartItemObj->qty_ordered )
                            {
                                $is_stock_enough = false;
                            }
                        }
                        else
                        {
                            $is_stock_enough = false;
                        }

                        /** 如果库存不足
                         */
                        if( ! $is_stock_enough )
                        {
                            if( $stock_not_enough_sku != '' )
                            {
                                $stock_not_enough_sku .= ', ';
                            }
                            $stock_not_enough_sku .= $cartItemObj->e_store_sku;
                        }
                    }
                }
            }
        }
        /** 否则是访客
         */
        else if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
        {
            foreach( $_SESSION['cartSession']['items'] as $item )
            {
                $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $item['e_store_sku']
                ));

                $is_stock_enough = true;

                if( $commodityInventoryModelQuery->num_rows() > 0 )
                {
                    $commodityInventoryModel = $commodityInventoryModelQuery->row_array();
                    if( $commodityInventoryModel['stock'] < $item['qty_ordered'] )
                    {
                        $is_stock_enough = false;
                    }
                }
                else
                {
                    $is_stock_enough = false;
                }

                /** 如果库存不足
                 */
                if( ! $is_stock_enough )
                {
                    if( $stock_not_enough_sku != '' )
                    {
                        $stock_not_enough_sku .= ', ';
                    }
                    $stock_not_enough_sku .= $item['e_store_sku'];
                }
            }
        }

        /** 如果有详情库存不足
         */
        if( $stock_not_enough_sku != '' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Cart Items [ ' . $stock_not_enough_sku . ' ] stock Insufficient! Please refresh the page and click on Auto Adjust button witch is inline with the stock insufficient item or click the Auto Adjust All Insufficient Items button at the top left of the cart!'
            ), TRUE);
        }


        if( ! $jsonAlert->hasErrors )
        {
            $this->load->model('E_Store_Cart_model');
            $resultMap = $this->E_Store_Cart_model->confirm_order( $order, $jsonAlert );

            if( $resultMap['success'] == 'NO' )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Something went wrong with your cart!'
                ), TRUE);
            }
            else
            {
                /** 如果不是 DPS 付款，则发送邮件提醒客户下单成功
                 */
                if( $order->payment_method != 1 )
                {
                    $finalEmailServerConfiguration = array();

                    /** 选择 Purpose 为 102 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                     */
                    $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                        'purpose'   =>  102
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
                            'subject'   =>  'Dear Customer, We Have Received Your Order',
                            'body'      =>  '<h3>Dear ' . $order->receiver_name . ' , we have received your order.</h3><h3>We will start processing your order ASAP!</h3><p style="font-style:italic;">If you have any questions, please don\'t hesitate to Contact Us: 09 - 444 66 11</p><br/><br/><br/>Best regards,<br/>PTLComputers<br/>'
                        );

                        /** 选择 Purpose 为 102 的邮件模板
                         */
                        $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                            'purpose'   =>  102
                        ));
                        if( $emailTemplateModelQuery->num_rows() > 0 )
                        {
                            $emailTemplateModel = $emailTemplateModelQuery->row_array();
                            $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                            $finalEmailTemplate['body'] = str_replace( '<%=receiver_name%>', $order->receiver_name, $emailTemplateModel['body'] );
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
                            'address'       => $order->receiver_email,
                            'subject'       => $finalEmailTemplate['subject'],
                            'body'          => $finalEmailTemplate['body']
                        );
                        EmailSender::send($config);
                    }
                }

                $redirect = '';
                /** 保存完订单后的流程
                 */
                switch( $order->payment_method )
                {
                    /** Payment Express (DPS) - PxPay
                     */
                    case 1 :
                        $redirect = ROOT_PATH . '/payment_gateway/dps_payment_express_session_less/make_payment_online_ordering/online-ordering/' . $resultMap['order_id'] . '/' . $resultMap['grand_total'];
                        break;
                    /** Online Banking
                     */
                    case 2 :
                        $redirect = ROOT_PATH . '/e_store/ordering_success';
                        break;
                    /** Phone Ordering
                     */
                    case 3 :
                        $redirect = ROOT_PATH . '/e_store/ordering_success';
                        break;
                }
                $jsonAlert->model = array(
                    'redirect'  =>  $redirect
                );
            }
        }

        echo $jsonAlert->result();
    }

    public function get_my_default_receiver_address()
    {
        /** 如果是 会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
                'customer_id'   =>  $_SESSION['customer']['id'],
                'is_default'    =>  'Y'
            ));

            if( $customerReceiverAddressModelQuery->num_rows() > 0 )
            {
                $customerReceiverAddressModel = $customerReceiverAddressModelQuery->row_array();

                echo json_encode( $customerReceiverAddressModel );
            }
        }
    }

    public function get_my_selected_receiver_address_detail()
    {
        $courierPricing = new CourierPricing($this->input);

        if( $courierPricing->shipping_area_id )
        {
            /** 如果是 会员
             */
            if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
            {
                $this->db->select('`receiver_city`, `receiver_address`, `receiver_email`, `receiver_phone`, `receiver_name`');
                $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
                    'customer_id'       =>  $_SESSION['customer']['id'],
                    'shipping_area_id'  =>  $courierPricing->shipping_area_id
                ));

                if( $customerReceiverAddressModelQuery->num_rows() > 0 )
                {
                    $customerReceiverAddressModel = $customerReceiverAddressModelQuery->row_array();

                    $resultMap = array(
                        'receiver_city'     =>  $customerReceiverAddressModel['receiver_city'],
                        'receiver_address'  =>  $customerReceiverAddressModel['receiver_address'],
                        'receiver_email'    =>  $customerReceiverAddressModel['receiver_email'],
                        'receiver_phone'    =>  $customerReceiverAddressModel['receiver_phone'],
                        'receiver_name'     =>  $customerReceiverAddressModel['receiver_name']
                    );

                    echo json_encode( $resultMap );
                }
            }
        }
    }

    public function calculate_order_total()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        $total_weight           =   0.00;
        $subtotal               =   0.00;
        $net_charges            =   0.00;
        $gst                    =   0.00;
        $shipping_fee           =   0.00;


        /** 如果是会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();
                $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                if( $cartModelQuery->num_rows() > 0 )
                {
                    $cartItemsObj = $cartItemsObjQuery->result_object();
                    foreach( $cartItemsObj as $cartItem )
                    {
                        $total_weight += intval( $cartItem->unit_weight * $cartItem->qty_ordered );
                        $subtotal += floatval( $cartItem->unit_price * $cartItem->qty_ordered );
                    }
                    $gst += floatval( $subtotal - ( $subtotal / 1.15 ) );
                    $net_charges += $subtotal / 1.15;
                }
            }
        }
        /** 否则是访客
         */
        else if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
        {
            foreach( $_SESSION['cartSession']['items'] as $item )
            {
                $total_weight += intval( $item['unit_weight'] * $item['qty_ordered'] );
                $subtotal += floatval( $item['unit_price'] * $item['qty_ordered'] );
            }
            $gst += floatval( $subtotal - ( $subtotal / 1.15 ) );
            $net_charges += $subtotal / 1.15;
        }


        /** 如果是 送货上门 或者 快递，则计算运费
         */
        if( $order->delivery_method == 2 )
        {
            if( $order->courier_pricing_id )
            {
                $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                    'id'                    =>  $order->courier_pricing_id,
                    'is_for_customer'       =>  'Y'
                ));
                if( $courierPricingModelQuery->num_rows() > 0 )
                {
                    $courierPricingModel = $courierPricingModelQuery->row_array();
                    $charge_customer_per_kg = $courierPricingModel['charge_customer_per_kg'];

                    $shipping_fee += $charge_customer_per_kg * ( $total_weight / 1000 );
                }
            }
        }
        $grand_total    =   $net_charges + $shipping_fee + $gst;


        $jsonAlert->model = array(
            'net_charges'   =>  $net_charges,
            'gst'           =>  $gst,
            'shipping_fee'  =>  $shipping_fee,
            'grand_total'   =>  $grand_total
        );

        echo $jsonAlert->result();
    }

    /** 获得 快递 及 运送价格
     */
    public function get_courier_and_pricing()
    {
        $courierPricing = new CourierPricing($this->input);

        $courierAndPricingArr = array();

        if( $courierPricing->shipping_area_id )
        {
            $courierPricingObjQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'shipping_area_id'  =>  $courierPricing->shipping_area_id,
                'is_for_customer'   =>  'Y'
            ));

            if( $courierPricingObjQuery->num_rows() > 0 )
            {
                $courierPricingObj = $courierPricingObjQuery->result_object();

                foreach( $courierPricingObj as $courierPricing )
                {
                    $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                        'id'  =>  $courierPricing->courier_id
                    ));
                    if( $courierModelQuery->num_rows() > 0 )
                    {
                        $courierModel = $courierModelQuery->row_array();
                        $courierAndPricing = array(
                            'id'                        =>  $courierPricing->id,
                            'name'                      =>  $courierModel['name'],
                            'charge_customer_per_kg'    =>  $courierPricing->charge_customer_per_kg
                        );

                        array_push( $courierAndPricingArr, $courierAndPricing );
                    }
                }
            }
        }

        echo json_encode( $courierAndPricingArr );
    }

    /** 获得 运送地址
     */
    public function get_receiver_address()
    {
        $courierShippingAreaObjQuery = $this->db->get('t_warehouse_courier_shipping_area');

        $courierShippingAreas = array();

        if( $courierShippingAreaObjQuery->num_rows() > 0 )
        {
            $courierShippingAreas = $courierShippingAreaObjQuery->result_array();
        }

        echo json_encode( $courierShippingAreas );
    }

    /** 自动调整选中/所有订购详情的订购数量至小于等于详情所对应的库存数量
     */
    public function auto_adjust_qty_purchased()
    {
        $cartItem = new CartItem($this->input);
        $jsonAlert = new JSONAlert();

        /** 如果是会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $cartModelQuery = $this->db->get_where('t_e_store_cart');
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();

                $this->db->update('t_e_store_cart', array(
                    'last_update'   =>  date("Y-m-d h:i:s")
                ), array(
                    'customer_id'   =>  $_SESSION['customer']['id']
                ));

                $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                /** 准备好订购详情
                 */
                $cartItemsObj = $cartItemsObjQuery->result_object();

                /** 如果有 E 店 Sku，则调整选中订购详情的订购数量
                 */
                if( $cartItem->e_store_sku )
                {
                    $warehouseCommodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                        'e_store_sku'   =>  $cartItem->e_store_sku
                    ));

                    if( $warehouseCommodityInventoryModelQuery->num_rows() > 0 )
                    {
                        $warehouseCommodityInventoryModel = $warehouseCommodityInventoryModelQuery->row_array();

                        foreach( $cartItemsObj as $cartItemObj )
                        {
                            if( $cartItem->e_store_sku == $cartItemObj->e_store_sku )
                            {
                                $this->db->update('t_e_store_cart_item', array(
                                    'qty_ordered'   =>  $warehouseCommodityInventoryModel['stock']
                                ), array(
                                    'cart_id'       =>  $cartModel['id'],
                                    'e_store_sku'   =>  $cartItemObj->e_store_sku
                                ));
                            }
                        }

                        $jsonAlert->append(array(
                            'successMsg'=>'Auto Adjusted Qty Purchased for Product Sku:[ ' . $cartItem->e_store_sku .' ]'
                        ), FALSE);
                    }
                    else
                    {
                        $jsonAlert->append(array(
                            'errorMsg'=>'Sku:[ ' . $cartItem->e_store_sku .' ] not existed in commodity inventory'
                        ), TRUE);
                    }
                }
                /** 否则调整所有订购详情的订购数量
                 */
                else
                {
                    foreach( $cartItemsObj as $cartItemObj )
                    {
                        $warehouseCommodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                            'e_store_sku'   =>  $cartItemObj->e_store_sku
                        ));
                        if( $warehouseCommodityInventoryModelQuery->num_rows() > 0 )
                        {
                            $warehouseCommodityInventoryModel = $warehouseCommodityInventoryModelQuery->row_array();

                            /** 如果订购数量大于库存，则使用库存为订购数量
                             */
                            if( $cartItemObj->qty_ordered > $warehouseCommodityInventoryModel['stock'] )
                            {
                                $this->db->update('t_e_store_cart_item', array(
                                    'qty_ordered'   =>  $warehouseCommodityInventoryModel['stock']
                                ), array(
                                    'cart_id'       =>  $cartModel['id'],
                                    'e_store_sku'   =>  $cartItemObj->e_store_sku
                                ));
                            }
                        }
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Auto Adjusted Qty Purchased for ' . count( $cartItemsObj ) . ' Product(s)'
                    ), FALSE);
                }
            }
        }
        /** 否则是访客并且购物车有订购详情
         */
        else if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
        {
            $_SESSION['cartSession']['last_update'] = date("Y-m-d h:i:s");

            /** 如果有 E 店 Sku，则调整选中订购详情的订购数量
             */
            if( $cartItem->e_store_sku )
            {
                $warehouseCommodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $cartItem->e_store_sku
                ));
                if( $warehouseCommodityInventoryModelQuery->num_rows() > 0 )
                {
                    $warehouseCommodityInventoryModel = $warehouseCommodityInventoryModelQuery->row_array();

                    foreach( $_SESSION['cartSession']['items'] as $index => $item )
                    {
                        if( $cartItem->e_store_sku == $item['e_store_sku'] )
                        {
                            $_SESSION['cartSession']['items'][ $index ]['qty_ordered'] = $warehouseCommodityInventoryModel['stock'];
                        }
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Auto Adjusted Qty Purchased for Product Sku:[ ' . $cartItem->e_store_sku .' ]'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Sku:[ ' . $cartItem->e_store_sku .' ] not existed in commodity inventory'
                    ), TRUE);
                }
            }
            /** 否则调整所有订购详情的订购数量
             */
            else
            {
                foreach( $_SESSION['cartSession']['items'] as $index => $item )
                {
                    $warehouseCommodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                        'e_store_sku'   =>  $item['e_store_sku']
                    ));
                    if( $warehouseCommodityInventoryModelQuery->num_rows() > 0 )
                    {
                        $warehouseCommodityInventoryModel = $warehouseCommodityInventoryModelQuery->row_array();

                        /** 如果订购数量大于库存，则使用库存为订购数量
                         */
                        if( $item['qty_ordered'] > $warehouseCommodityInventoryModel['stock'] )
                        {
                            $_SESSION['cartSession']['items'][ $index ]['qty_ordered'] = $warehouseCommodityInventoryModel['stock'];
                        }
                    }
                }

                $jsonAlert->append(array(
                    'successMsg'=>'Auto Adjusted Qty Purchased for ' . count( $_SESSION['cartSession']['items'] ) . ' Product(s)'
                ), FALSE);
            }
        }

        echo $jsonAlert->result();
    }

    /** 移除订购详情
     */
    public function remove_cart_item()
    {
        $cartItem = new CartItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model' => $cartItem,
                'check_empty' => array(
                    'e_store_sku' => 'Commodity EStore Sku Needed!'
                )
            ));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            /** 如果是会员
             */
            if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
            {
                $is_cart_empty = false;

                $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                    'customer_id'   =>  $_SESSION['customer']['id']
                ));
                if( $cartModelQuery->num_rows() > 0 )
                {
                    $cartModel = $cartModelQuery->row_array();
                    $this->db->update('t_e_store_cart', array(
                        'last_update'   =>  date("Y-m-d h:i:s")
                    ), array(
                        'id'   =>  $cartModel['id']
                    ));

                    $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                        'cart_id'   =>  $cartModel['id']
                    ));
                    if( $cartItemsObjQuery->num_rows() > 0 )
                    {
                        $cartItemsObj = $cartItemsObjQuery->result_object();
                        foreach( $cartItemsObj as $cartItemObj )
                        {
                            if( $cartItem->e_store_sku == $cartItemObj->e_store_sku )
                            {
                                $this->db->delete('t_e_store_cart_item', array(
                                    'cart_id'       =>  $cartModel['id'],
                                    'e_store_sku'   =>  $cartItemObj->e_store_sku
                                ));
                            }
                        }
                    }
                    else
                    {
                        $is_cart_empty = true;
                    }

                    /** 如果上面移除的是最后一个订购详情，则连同购物车一起移除
                     */
                    if( $cartItemsObjQuery->num_rows() == 1 )
                    {
                        $this->db->delete('t_e_store_cart', array(
                            'id'    =>  $cartModel['id']
                        ));
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Remove Product with sku [ ' . $cartItem->e_store_sku . ' ] from cart !'
                    ), FALSE);
                }
                else
                {
                    $is_cart_empty = true;
                }

                if( $is_cart_empty )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Your cart is empty, nothing to remove!'
                    ), TRUE);
                }
            }
            /** 否则是访客
             */
            else
            {
                /** 如果有订购详情
                 */
                if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
                {
                    $_SESSION['cartSession']['last_update'] = date("Y-m-d h:i:s");
                    foreach( $_SESSION['cartSession']['items'] as $index => $item )
                    {
                        if( $cartItem->e_store_sku == $item['e_store_sku'] )
                        {
                            unset( $_SESSION['cartSession']['items'][ $index ] );
                        }
                    }

                    /** 如果上面移除的是最后一个订购详情，则连同购物车一起移除
                     */
                    if( count( $_SESSION['cartSession']['items'] ) < 1 )
                    {
                        unset( $_SESSION['cartSession'] );
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Remove Product with sku [ ' . $cartItem->e_store_sku . ' ] from cart !'
                    ), FALSE);
                }
                /** 否则提示没有订购详情
                 */
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Your cart is empty, nothing to remove!'
                    ), TRUE);
                }
            }
        }

        echo $jsonAlert->result();
    }

    /** 同步总订购数量
     */
    public function synchronize_essential()
    {
        $jsonAlert = new JSONAlert();

        $essentials = array(
            'last_update'           =>  '',
            'product_total'         =>  0,
            'total_qty_purchased'   =>  0,
            'items'                 =>  []
        );

        /** 如果是会员
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $is_cart_empty = false;

            $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();
                $essentials['last_update'] = $cartModel['last_update'];

                $cartItemsObjQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                if( $cartItemsObjQuery->num_rows() > 0 )
                {
                    $cartItemsArr = $cartItemsObjQuery->result_array();
                    foreach( $cartItemsArr as $cartItemArr )
                    {
                        $essentials['product_total']++;
                        $essentials['total_qty_purchased'] += $cartItemArr['qty_ordered'];
                    }
                    $essentials['items'] = $cartItemsArr;
                }
                else
                {
                    $is_cart_empty = true;
                }
            }
            else
            {
                $is_cart_empty = true;
            }

            if( $is_cart_empty )
            {
                $jsonAlert->append(array(
                    'cartEmptyMsg'=>'Cart is empty!'
                ), TRUE);
            }
        }
        /** 如果是访客
         */
        else
        {
            if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession'] ) > 0 )
            {
                $essentials['last_update'] = $_SESSION['cartSession']['last_update'];

                foreach( $_SESSION['cartSession']['items'] as $item )
                {
                    $essentials['product_total']++;
                    $essentials['total_qty_purchased'] += $item['qty_ordered'];
                }
                $essentials['items'] = $_SESSION['cartSession']['items'];
            }

            if
            (
                ! isset( $_SESSION['cartSession'] ) ||
                ! isset( $_SESSION['cartSession']['items'] ) ||
                ( isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession'] ) < 1 )
            )
            {
                $jsonAlert->append(array(
                    'cartEmptyMsg'=>'Cart is empty!'
                ), TRUE);
            }
        }

        $jsonAlert->model = $essentials;


        echo $jsonAlert->result();

    }

    // Edit Cart Item Rest
    public function edit_cart_item_qty()
    {
        $cartItem = new CartItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cartItem,
                'check_empty'=>array(
                    'e_store_sku'=>'Commodity EStore Sku Needed!',
                    'qty_ordered'=>'Qty Ordered Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 先获取库存
         */
        $commodityInventoryModelQuery = $this->db
            ->select('e_store_sku, stock, manufacturer_name, type')
            ->get_where('t_warehouse_commodity_inventory', array(
                'e_store_sku'   =>  $cartItem->e_store_sku
            ));
        $commodityInventoryModel = $commodityInventoryModelQuery->row_array();
        $commodityInventoryStock = $commodityInventoryModel['stock'];

        /** 如果库存小于 0 或者小于订购数量，则不能更改
         */
        if( $commodityInventoryStock < 1 || $commodityInventoryStock < $cartItem->qty_ordered )
        {
            if( $cartItem->qty_ordered == 1 )
            {
                $jsonAlert->append(array(
                    'outOfStockMsg'=>'Your favourite product is currently Out Of Stock, try <a href="/e_store/commodity/search?type=' . $commodityInventoryModel['type'] . '&manufacturer=' . $commodityInventoryModel['manufacturer_name'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
            else
            {
                $jsonAlert->append(array(
                    'outOfStockOrNotEnoughMsg'=>'Your favourite product is currently Out Of Stock or your purchase qty exceeding the maximum qty of the stock, try <a href="/e_store/commodity/search?type=' . $commodityInventoryModel['type'] . '&manufacturer=' . $commodityInventoryModel['manufacturer_name'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
        }
        /** 否则库存充足，可以更改
         */
        else
        {
            /** 如果是会员，则更新该会员所对应的数据库购物车
             */
            if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
            {
                $cartItemModelQuery = $this->db->get_where('t_e_store_cart_item', array(
                    'e_store_sku'   =>  $cartItem->e_store_sku
                ));
                /** 如果匹配到该订购详情
                 */
                if( $cartItemModelQuery->num_rows() > 0 )
                {
                    $this->db->update('t_e_store_cart_item', array(
                        'qty_ordered'   =>  $cartItem->qty_ordered
                    ), array(
                        'e_store_sku'   =>  $cartItem->e_store_sku
                    ));

                    /** 同步购物车最近更新时间
                     */
                    $this->db->update('t_e_store_cart', array(
                        'last_update'   =>  date("Y-m-d h:i:s")
                    ), array(
                        'customer_id'   =>  $_SESSION['customer']['id']
                    ));

                    $cartItemModel = $cartItemModelQuery->row_array();
                    $jsonAlert->append(array(
                        'successMsg'=>'Change Qty from ' . $cartItemModel['qty_ordered'] . ' to ' . $cartItem->qty_ordered
                    ), FALSE);
                }
                /** 否则提示该订购详情不存在
                 */
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Cart Item not existed!'
                    ), TRUE);
                }
            }
            /** 否则是访客，则更新 Session 购物车
             */
            else
            {
                /** 如果 Session 购物车存在
                 */
                if
                (
                    isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0
                )
                {
                    $previous_qty_ordered = 0;

                    foreach( $_SESSION['cartSession']['items'] as $index => $item )
                    {
                        /** 如果匹配到该订购详情，更新订购数量
                         */
                        if( $item['e_store_sku'] == $cartItem->e_store_sku )
                        {
                            $previous_qty_ordered = $item['qty_ordered'];
                            $_SESSION['cartSession']['items'][ $index ]['qty_ordered'] = $cartItem->qty_ordered;
                        }
                    }

                    $_SESSION['cartSession']['last_update'] = date("Y-m-d h:i:s");

                    $jsonAlert->append(array(
                        'successMsg'=>'Change Qty from ' . $previous_qty_ordered . ' to ' . $cartItem->qty_ordered
                    ), FALSE);
                }
                /** 否则提示该购物详情不存在
                 */
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Cart Item not existed!'
                    ), TRUE);
                }
            }
        }

        echo $jsonAlert->result();
    }

    // Add to Cart Rest
	public function add_to_cart()
	{
        $cartItem = new CartItem($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cartItem,
                'check_empty'=>array(
                    'commodity_id'=>'Commodity Id Needed!',
                    'e_store_sku'=>'Commodity EStore Sku Needed!',
                    'qty_ordered'=>'Qty Ordered Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 先获取库存
         */
        $commodityInventoryModelQuery = $this->db
            ->select('e_store_sku, stock, manufacturer_name, type')
            ->get_where('t_warehouse_commodity_inventory', array(
            'e_store_sku'   =>  $cartItem->e_store_sku
        ));
        $commodityInventoryModel = $commodityInventoryModelQuery->row_array();
        $commodityInventoryStock = $commodityInventoryModel['stock'];

        /** 如果库存小于 0 或者小于订购数量，则不能添加
         */
        if( $commodityInventoryStock < 1 || $commodityInventoryStock < $cartItem->qty_ordered )
        {
            if( $cartItem->qty_ordered == 1 )
            {
                $jsonAlert->append(array(
                    'outOfStockMsg'=>'Your favourite product is currently Out Of Stock, try <a href="/e_store/commodity/search?type=' . $commodityInventoryModel['type'] . '&manufacturer=' . $commodityInventoryModel['manufacturer_name'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
            else
            {
                $jsonAlert->append(array(
                    'outOfStockOrNotEnoughMsg'=>'Your favourite product is currently Out Of Stock or your purchase qty exceeding the maximum qty of the stock, try <a href="/e_store/commodity/search?type=' . $commodityInventoryModel['type'] . '&manufacturer=' . $commodityInventoryModel['manufacturer_name'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
        }
        /** 否则库存充足，可以订购
         */
        else
        {
            /** 获取该商品
             */
            $commodityModelQuery = $this->db
                ->select('id, e_store_sku, is_e_store_created, name, price, weight, manufacturer, type')
                ->get_where('t_warehouse_commodity', array(
                'e_store_sku'   =>  $cartItem->e_store_sku,
                'is_on_shelf'   =>  'Y'
            ));
            if( $commodityModelQuery->num_rows() > 0 )
            {
                $commodityModel = $commodityModelQuery->row_array();

                /** 订购总数
                 */
                $totalQtyOrdered = 0;

                /** 访客添加至 Session 中
                 */
                if( ! isset( $_SESSION['customer'] ) )
                {
                    /** 没有 cartSession，则创建购物车
                     */
                    if( ! isset( $_SESSION['cartSession'] ) )
                    {
                        $cart['create_time'] = date("Y-m-d h:i:s");
                    }
                    else
                    {
                        $cart = $_SESSION['cartSession'];
                    }

                    /** 添加至购物车
                     */
                    $returnedData = CICartUtil::add2Cart( $jsonAlert, $commodityInventoryStock, $cartItem, $cart, $commodityModel );

                    /** 如果购物车有改动，同步至 cartSession
                     */
                    if( $returnedData['isAnyItemUpdated'] )
                    {
                        $_SESSION['cartSession'] = $returnedData['cart'];

                        /** 访客购物车订购总数
                         */
                        $totalQtyOrdered = $returnedData['totalQtyOrdered'];
                    }
                }
                /** 会员添加至数据库中
                 */
                else
                {
                    $customerId = $_SESSION['customer']['id'];

                    /** 获取客户在数据库中的购物车
                     */
                    $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                        'customer_id'   =>  $customerId
                    ));

                    /** 没有 t_e_store_cart，则创建购物车
                     */
                    if( $cartModelQuery->num_rows() < 1 )
                    {
                        $this->db->insert('t_e_store_cart', array(
                            'customer_id'   =>  $customerId,
                            'create_time'   =>  date("Y-m-d h:i:s")
                        ));
                        $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                            'customer_id'   =>  $customerId
                        ));

                        $cart = $cartModelQuery->row_array();
                    }
                    else
                    {
                        $cart = $cartModelQuery->row_array();

                        $cartItemsModelsQuery = $this->db->get_where('t_e_store_cart_item', array(
                            'cart_id'   =>  $cart['id']
                        ));
                        if( $cartItemsModelsQuery->num_rows() > 0 )
                        {
                            $cart['items']  =   $cartItemsModelsQuery->result_array();
                        }
                    }

                    /** 添加至购物车
                     */
                    $returnedData = CICartUtil::add2Cart( $jsonAlert, $commodityInventoryStock, $cartItem, $cart, $commodityModel );

                    /** 更新购物车至 t_e_store_cart
                     */
                    if( $returnedData['isAnyItemUpdated'] )
                    {
                        $this->db->update('t_e_store_cart', $returnedData['cartOnly'], array(
                            'id'    =>  $returnedData['cartOnly']['id']
                        ));

                        /** 有新订购商品
                         */
                        if( count( $returnedData['insertableItems'] ) )
                        {
                            $this->db->insert_batch('t_e_store_cart_item', $returnedData['insertableItems']);
                        }
                        if( count( $returnedData['updatableItems'] ) )
                        {
                            $this->db->update_batch('t_e_store_cart_item', $returnedData['updatableItems'], 'id');
                        }

                        /** 会员购物车订购总数
                         */
                        $totalQtyOrdered = $returnedData['totalQtyOrdered'];
                    }
                }

                /** 购物车订购总数
                 */
                $jsonAlert->model = $totalQtyOrdered;
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Your favourite product is currently unavailable, please try other similar products, try other <a href="/e_store/commodity/search?type=' . $commodityInventoryModel['type'] . '&manufacturer=' . $commodityInventoryModel['manufacturer_name'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
	}

}
