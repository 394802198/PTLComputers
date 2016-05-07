<?php

require_once 'util/myutils/CIBeanUtil.php';

class Product extends CIBeanUtil
{
    protected $id;
    protected $import_date;
    protected $last_update;
    protected $ordered_date;
    protected $product_status;
    protected $item_code;
    protected $job_number;
    protected $location;
    protected $type;
    protected $price;
    protected $weight;
    protected $manufacturer_name;
    protected $model;
    protected $sn;
    protected $processor;
    protected $processor_speed;
    protected $mem_size;
    protected $hdd_size;
    protected $is_power_supply;
    protected $visual_status;
    protected $performance_status;
    protected $optical_drive;
    protected $system_license;
    protected $notes;
    protected $faults;
    protected $is_web_cam;
    protected $screen_size;
    protected $is_locked;

    /* IRRELEVANT FIELDS */
    protected $cart_id;
    protected $product_ids;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('cart_id', 'product_ids');
        $config['int_fields']=array('id');
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