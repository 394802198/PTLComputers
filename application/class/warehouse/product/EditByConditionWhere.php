<?php

require_once 'util/myutils/CIBeanUtil.php';

class EditByConditionWhere extends CIBeanUtil
{
    protected $product_status_condition;
    protected $type_condition;
    protected $manufacturer_name_condition;
    protected $location_condition;
    protected $visual_status_condition;
    protected $price_condition;
    protected $weight_condition;
    protected $performance_status_condition;
    protected $screen_size_condition;
    protected $model_condition;
    protected $processor_condition;
    protected $processor_speed_condition;
    protected $mem_size_condition;
    protected $hdd_size_condition;
    protected $optical_drive_condition;
    protected $system_license_condition;
    protected $is_power_supply_condition;
    protected $is_web_cam_condition;
    protected $notes_condition;
    protected $faults_condition;
    protected $job_number_condition;
    
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