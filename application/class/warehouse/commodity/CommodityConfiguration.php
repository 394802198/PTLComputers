<?php

require_once 'util/myutils/CIBeanUtil.php';

class CommodityConfiguration extends CIBeanUtil
{
    protected $home_visible_per_page;
    protected $search_visible_per_page;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('');
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