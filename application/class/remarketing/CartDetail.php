<?php

require_once 'util/myutils/CIBeanUtil.php';

class CartDetail extends CIBeanUtil {

    protected $id;
    protected $cart_id;
    protected $product_id;
    protected $item_code;
    protected $create_date;
    protected $location;
    protected $manufacturer_name;
    protected $type;
    protected $price;
    protected $weight;

    /* IRRELEVANT FIELDS */
    protected $product;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('product');
        $config['int_fields']=array('cart_id', 'product_id');
        $config['float_fields']=array('price');
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