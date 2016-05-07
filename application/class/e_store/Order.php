<?php

require_once 'util/myutils/CIBeanUtil.php';

class Order extends CIBeanUtil {

    protected $id;
    protected $customer_id;
    protected $create_time;
    protected $last_update;
    protected $order_status;
    protected $qty_total_item_ordered;
    protected $qty_total_item_shipped;
    protected $qty_total_item_refunded;
    protected $qty_total_item_cancelled;
    protected $grand_total;
    protected $subtotal;
    protected $shipping_fee;
    protected $tax;
    protected $total_invoiced;
    protected $total_paid;
    protected $total_refunded;
    protected $total_weight;
    protected $payment_status;
    protected $payment_method;
    protected $delivery_method;
    protected $tracking_codes;
    protected $sender_name;
    protected $sender_address;
    protected $sender_phone;
    protected $sender_email;
    protected $sender_post;
    protected $receiver_name;
    protected $receiver_phone;
    protected $receiver_email;
    protected $receiver_country;
    protected $receiver_province;
    protected $receiver_city;
    protected $receiver_address;
    protected $receiver_post;
    protected $memo;
    protected $is_deleted;

    /* IRRELEVANT FIELDS */
    protected $commodity_ids;
    protected $courier_pricing_id;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('commodity_ids','courier_pricing_id');
        $config['int_fields']=array('id');
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