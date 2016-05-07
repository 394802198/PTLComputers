<?php

require_once 'util/myutils/CIBeanUtil.php';

class Cart extends CIBeanUtil
{
    protected $id;
    protected $wholesaler_id;
    protected $create_date;
    protected $amount;
    protected $freight;
    protected $gst;
    protected $total_amount;
    protected $total_amount_gst;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
//        $config['irrelevant_fields']=array('');
        $config['int_fields']=array('id', 'wholesaler_id');
        $config['float_fields']=array('amount', 'gst', 'total_amount', 'total_amount_gst', 'freight');
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