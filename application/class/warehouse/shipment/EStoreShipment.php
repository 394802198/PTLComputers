<?php

require_once 'util/myutils/CIBeanUtil.php';

class EStoreShipment extends CIBeanUtil
{
    protected $id;
    protected $order_id;
    protected $creator_id;
    protected $executor_id;
    protected $courier_id;
    protected $ship_number;
    protected $ship_status;
    protected $qty_total_item_shipped;
    protected $shipping_cost;
    protected $shipping_fee;
    protected $total_weight;
    protected $create_time;
    protected $last_update;
    protected $picked_time;
    protected $received_time;
    protected $memo;
    protected $sender_name;
    protected $sender_address;
    protected $sender_phone;
    protected $sender_email;
    protected $sender_post;
    protected $receive_name;
    protected $receive_phone;
    protected $receive_email;
    protected $receive_country;
    protected $receive_province;
    protected $receive_city;
    protected $receive_address;
    protected $receive_post;
    
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