<?php

require_once 'util/myutils/CIBeanUtil.php';

class EStoreShipmentItem extends CIBeanUtil
{
    protected $id;
    protected $e_store_shipment_id;
    protected $order_item_id;
    protected $qty_shipped;
    
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