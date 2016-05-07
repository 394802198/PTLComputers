<?php

require_once 'util/myutils/CIBeanUtil.php';

class CommodityInventory extends CIBeanUtil
{
    protected $id;
    protected $e_store_sku;
    protected $stock;
    protected $price;
    protected $weight;
    protected $location;
    protected $type;
    protected $manufacturer_name;
    protected $model;
    protected $processor;
    protected $processor_speed;
    protected $mem_size;
    protected $hdd_size;
    protected $is_power_supply;
    protected $visual_status;
    protected $performance_status;
    protected $optical_drive;
    protected $system_license;
    protected $is_web_cam;
    protected $screen_size;
    protected $is_self_created;
    
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