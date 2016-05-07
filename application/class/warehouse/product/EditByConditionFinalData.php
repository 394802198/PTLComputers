<?php

require_once 'util/myutils/CIBeanUtil.php';

class EditByConditionFinalData extends CIBeanUtil
{
    protected $product_status;
    protected $type;
    protected $manufacturer_name;
    protected $location;
    protected $visual_status;
    protected $price;
    protected $weight;
    protected $performance_status;
    protected $screen_size;
    protected $model;
    protected $processor;
    protected $processor_speed;
    protected $mem_size;
    protected $hdd_size;
    protected $optical_drive;
    protected $system_license;
    protected $is_power_supply;
    protected $is_web_cam;
    protected $notes;
    protected $faults;
    protected $job_number;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('');
        $config['irrelevant_fields']=array('');
        $config['int_fields']=array('');
        $config['float_fields']=array('');
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