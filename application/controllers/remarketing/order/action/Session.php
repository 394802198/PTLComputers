<?php

require_once 'application/class/remarketing/Order.php';
require_once 'util/myutils/EmailSender.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	// Ordering
	public function put_cart_2_order()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'cart_id'=>'Cart Id Needed!',
                    'product_ids'=>'Must select at least one product!',
                    'shipping_method'=>'Shipping Method Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesaler_id = $_SESSION['wholesaler']['id'];

            $available_product_ids = array();
            $unavailable_product_item_codes = '';
            $is_unavailable_product_ids_existed = false;

            foreach ( $order->product_ids as $product_id )
            {
                $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                    'id'=>$product_id
                ));
                $productModel = $productModelQuery->row_array();

                if( ( strcasecmp($productModel['product_status'],'In Stock')==0 || strcasecmp($productModel['product_status'],'Returned')==0 )
                    && strcasecmp($productModel['is_locked'],'N')==0 )
                {
                    array_push($available_product_ids, $product_id);
                }
                else
                {
                    if( $unavailable_product_item_codes != '' )
                    {
                        $unavailable_product_item_codes .= ', ';
                    }
                    $unavailable_product_item_codes .= $productModel['item_code'];

                    $is_unavailable_product_ids_existed = true;
                }
            }

            if( count($available_product_ids) > 0 && ! $is_unavailable_product_ids_existed )
            {
                $street = $_SESSION['wholesaler']['street'];
                $area = $_SESSION['wholesaler']['area'];
                $city = $_SESSION['wholesaler']['city'];
                $country = $_SESSION['wholesaler']['country'];

                $this->db->insert('t_remarketing_order', array(
                    'wholesaler_id'=>$wholesaler_id,
                    'ordered_date'=>date("Y-m-d h:i:s"),
                    'order_status'=>'pending',
                    'payment_option'=>'',
                    'paid_amount'=>0,
                    'shipping_method'=>$order->shipping_method,
                    'last_name'=>$_SESSION['wholesaler']['last_name'],
                    'first_name'=>$_SESSION['wholesaler']['first_name'],
                    'email'=>$_SESSION['wholesaler']['email'],
                    'company_name'=>$_SESSION['wholesaler']['company_name'],
                    'landline_phone'=>$_SESSION['wholesaler']['landline_phone'],
                    'mobile_phone'=>$_SESSION['wholesaler']['mobile_phone'],
                    'fax_no'=>$_SESSION['wholesaler']['fax_no']
                ));

                $insert_order_id = $this->db->insert_id();

                // Get all product details price
                $totalAmount = 0;
                $totalWeight = 0;

                foreach( $available_product_ids as $available_product_id )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'=>$available_product_id
                    ));
                    $productModel = $productModelQuery->row_array();

                    // Add product to order_detail
                    $this->db->insert('t_remarketing_order_detail', array(
                        'order_id'=>$insert_order_id,
                        'product_id'=>$productModel['id'],
                        'item_code'=>$productModel['item_code'],
                        'location'=>$productModel['location'],
                        'manufacturer_name'=>$productModel['manufacturer_name'],
                        'type'=>$productModel['type'],
                        'price'=>$productModel['price']
                    ));

                    $totalAmount += $productModel['price'];
                    $totalWeight += $productModel['weight'];

                    $this->db->update('t_warehouse_product', array(
                        'is_locked'=>'Y'
                    ), array(
                        'id'=>$available_product_id
                    ));
                }

                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $shippingFee = 0;
                $shippingArea = '';
                $shippingAddress = '';

                $receiver_name = '';
                $receiver_phone = '';
                $receiver_email = '';
                $receiver_country = '';
                $receiver_province = '';
                $receiver_city = '';
                $receiver_address = '';
                $receiver_post = '';

                /* If shipping method is Shipping, then  */
                if( $order->shipping_method == 'Shipping' )
                {
                    $product_weight_kg = 1;
                    if( $totalWeight > 1000 )
                    {
                        $product_weight_kg = $totalWeight / 1000;
                        if( $totalWeight % 1000 != 0 )
                        {
                            $product_weight_kg ++;
                        }
                        $product_weight_kg = sprintf("%01.0f",$product_weight_kg);
                    }

                    $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                        'id'    =>$order->courier_pricing_id
                    ));
                    $courierPricingModel = $courierPricingModelQuery->row_array();

                    $shippingFee += ( $courierPricingModel['charge_wholesaler_per_kg'] * $product_weight_kg );
                    $totalAmountGST += ( $courierPricingModel['charge_wholesaler_per_kg'] * $product_weight_kg );

                    $shippingAddress .= $street.', '.$area.', '.$city.', '.$country;

                    $receiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
                        'id'    =>$order->receiver_address_id
                    ));
                    $receiverAddressModel = $receiverAddressModelQuery->row_array();
                    $receiver_name = $receiverAddressModel['receiver_name'];
                    $receiver_phone = $receiverAddressModel['receiver_phone'];
                    $receiver_email = $receiverAddressModel['receiver_email'];
                    $receiver_country = $receiverAddressModel['receiver_country'];
                    $receiver_province = $receiverAddressModel['receiver_province'];
                    $receiver_city = $receiverAddressModel['receiver_city'];
                    $receiver_address = $receiverAddressModel['receiver_address'];
                    $receiver_post = $receiverAddressModel['receiver_post'];

                    $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                        'id'    =>$receiverAddressModel['shipping_area_id']
                    ));
                    $courierShippingAreaModel = $courierShippingAreaModelQuery->row_array();
                    $shippingArea = $courierShippingAreaModel['name'];
                }

                $this->db->update('t_remarketing_order', array(
                    'courier_id'=>$order->courier_id,
                    'payable_amount'=>$totalAmount,
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'total_amount_gst'=>$totalAmountGST,
                    'total_weight'=>$totalWeight,
                    'shipping_area'=>$shippingArea,
                    'shipping_fee'=>$shippingFee,
                    'shipping_address'=>$shippingAddress,
                    'receiver_name'=>$receiver_name,
                    'receiver_phone'=>$receiver_phone,
                    'receiver_email'=>$receiver_email,
                    'receiver_country'=>$receiver_country,
                    'receiver_province'=>$receiver_province,
                    'receiver_city'=>$receiver_city,
                    'receiver_address'=>$receiver_address,
                    'receiver_post'=>$receiver_post
                ), array(
                    'id'=>$insert_order_id
                ));

                // Last, empty cart
                $this->db->delete('t_remarketing_cart_detail', array(
                    'cart_id'=>$order->cart_id
                ));
                $this->db->delete('t_remarketing_cart', array(
                    'id'=>$order->cart_id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Successfully ordered, we\'ll go through it soon!'
                ), FALSE);


                $finalEmailServerConfiguration = array();

                /** 选择 Purpose 为 202 的邮箱服务器，如果没有则使用 Default 的邮箱服务器
                 */
                $emailServerModelQuery = $this->db->get_where('t_core_email_server', array(
                    'purpose'   =>  202
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
                    $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
                        'id'    =>  $_SESSION['wholesaler']['id']
                    ));
                    $wholesalerModel = $wholesalerModelQuery->row_array();

                    $finalEmailTemplate = array(
                        'subject'   =>  'Dear Wholesaler, We Have Received Your Order',
                        'body'      =>  'Dear ' . $wholesalerModel['first_name'] . ' ' . $wholesalerModel['last_name'] . ' , we have received your order.<br/><br/>Best regards,<br/>PTLComputers<br/>'
                    );

                    /** 选择 Purpose 为 202 的邮件模板
                     */
                    $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
                        'purpose'   =>  202
                    ));
                    if( $emailTemplateModelQuery->num_rows() > 0 )
                    {
                        $emailTemplateModel = $emailTemplateModelQuery->row_array();
                        $finalEmailTemplate['subject'] = $emailTemplateModel['subject'];
                        $finalEmailTemplate['body'] = str_replace( '<%=first_name%>', $wholesalerModel['first_name'], $emailTemplateModel['body'] );
                        $finalEmailTemplate['body'] = str_replace( '<%=last_name%>', $wholesalerModel['last_name'], $finalEmailTemplate['body'] );
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

            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Sorry for the inconvenience. Please choose the In Stock and Unlocked ones. Remove the Sold or Locked Product Item Code:'.$unavailableProductItemCodes . ' and try again!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}
	
}
