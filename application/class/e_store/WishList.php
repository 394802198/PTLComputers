<?php

require_once 'util/myutils/CIBeanUtil.php';

class WishList extends CIBeanUtil {

    protected $id;
    protected $customer_id;
    protected $commodity_id;
    protected $e_store_sku;
    protected $create_time;

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