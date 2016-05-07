<?php

require_once 'util/myutils/CIBeanUtil.php';

class CourierPricing extends CIBeanUtil
{
    protected $id;
    protected $courier_id;
    protected $shipping_area_id;
    protected $charge_wholesaler_per_kg;
    protected $charge_customer_per_kg;
    protected $is_for_wholesaler;
    protected $is_for_customer;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
//        $config['irrelevant_fields']=array('');
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