<?php

require_once 'util/myutils/CIBeanUtil.php';

class RecordPrintTemplate extends CIBeanUtil {

    protected $logo_img;
    protected $company_name;
    protected $company_street;
    protected $company_city;
    protected $phone;
    protected $title;
    protected $term_condition;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('');
//        $config['irrelevant_fields']=array('');
//        $config['int_fields']=array('id');
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