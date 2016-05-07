<?php

require_once 'util/myutils/CIBeanUtil.php';

class ProductScreenSize extends CIBeanUtil {

    protected $id;
    protected $name;
    
    function __construct($input=NULL) {
    
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