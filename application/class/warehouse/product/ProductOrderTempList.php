<?php

require_once 'util/myutils/CIBeanUtil.php';

class ProductOrderTempList extends CIBeanUtil {

    protected $id;
    protected $name;
    protected $product_ids;

    /* IRRELEVANT FIELDS */
    protected $product_id;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('product_id');
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