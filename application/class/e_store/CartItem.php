<?php

require_once 'util/myutils/CIBeanUtil.php';

class CartItem extends CIBeanUtil {

    protected $id;
    protected $cart_id;
    protected $commodity_id;
    protected $e_store_sku;
    protected $is_e_store_created;
    protected $name;
    protected $unit_weight;
    protected $qty_ordered;
    protected $qty_shipped;
    protected $unit_price;
    protected $unit_cost;
    protected $unit_gst;

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