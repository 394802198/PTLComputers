<?php

require_once 'util/myutils/CIBeanUtil.php';

class Order extends CIBeanUtil
{
    protected $id;
    protected $courier_id;
    protected $wholesaler_id;
    protected $create_date;
    protected $paid_date;
    protected $order_status;
    protected $payment_option;
    protected $amount;
    protected $freight;
    protected $gst;
    protected $refund_amount;
    protected $paid_amount;
    protected $payable_amount;
    protected $total_amount;
    protected $total_amount_gst;
    protected $total_weight;
    protected $shipping_fee;
    protected $shipping_method;
    protected $tracking_codes;
    protected $shipping_address;
    protected $last_name;
    protected $first_name;
    protected $email;
    protected $company_name;
    protected $landline_phone;
    protected $mobile_phone;
    protected $fax_no;
    protected $street;
    protected $area;
    protected $city;
    protected $country;
    protected $receiver_name;
    protected $receiver_phone;
    protected $receiver_email;
    protected $receiver_country;
    protected $receiver_province;
    protected $receiver_city;
    protected $receiver_address;
    protected $receiver_post;

    /* IRRELEVANT FIELDS */
    protected $cart_id;
    protected $order_ids;
    protected $detail_ids;
    protected $product_ids;
    protected $courier_pricing_id;
    protected $receiver_address_id;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('cart_id', 'order_ids', 'detail_ids', 'product_ids', 'courier_pricing_id');
        $config['int_fields']=array('id', 'wholesaler_id');
        $config['float_fields']=array('amount', 'gst', 'total_amount', 'total_amount_gst', 'freight', 'paid_amount', 'payable_amount');
        parent::__construct($input, $this, $config);
    
    }
    
    function __get($property_name) {
        if (isset($this->$property_name)) {
            return ($this->$property_name);
        } else {
            return NULL;
        }
    }
    
    function __set($property_name, $value) {
        $this->$property_name = $value;
    }
    
    
}