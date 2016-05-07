<?php

require_once 'util/myutils/CIBeanUtil.php';

class ExternalServiceProvider extends CIBeanUtil {

    protected $id;
    protected $name;
    protected $phone;
    protected $email;
    protected $address;

    /* IRRELEVANT FIELDS */
    protected $external_service_provider_ids;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('external_service_provider_ids');
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