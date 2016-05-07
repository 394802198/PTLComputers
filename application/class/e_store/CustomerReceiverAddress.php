<?php

require_once 'util/myutils/CIBeanUtil.php';

class CustomerReceiverAddress extends CIBeanUtil {

    protected $id;
    protected $shipping_area_id;
    protected $customer_id;
    protected $is_default;
    protected $receiver_name;
    protected $receiver_phone;
    protected $receiver_email;
    protected $receiver_country;
    protected $receiver_province;
    protected $receiver_city;
    protected $receiver_address;
    protected $receiver_post;
    protected $is_use_customer_address;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
//        $config['irrelevant_fields']=array('');
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