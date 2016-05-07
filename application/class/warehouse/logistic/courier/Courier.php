<?php

require_once 'util/myutils/CIBeanUtil.php';

class Courier extends CIBeanUtil
{
    protected $id;
    protected $name;
    protected $website;
    protected $shipment_lookup_url;
    protected $status;

    /* IRRELEVANT FIELDS */
    protected $courier_ids;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('courier_ids');
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