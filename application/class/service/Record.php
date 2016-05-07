<?php

require_once 'util/myutils/CIBeanUtil.php';

class Record extends CIBeanUtil {

    protected $id;
    protected $type;
    protected $status;
    protected $user_id;
    protected $created_at;
    protected $check_in_date;
    protected $check_out_date;
    protected $customer_name;
    protected $customer_phone;
    protected $customer_email;
    protected $customer_address;
    protected $item_name;
    protected $item_model;
    protected $item_sn;
    protected $problem_description;
    protected $appraisal;
    protected $payable;
    protected $cost;
    protected $paid;
    protected $external_service_provider_id;

    /* IRRELEVANT FIELDS */
    protected $record_ids;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('');
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