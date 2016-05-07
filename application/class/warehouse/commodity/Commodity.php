<?php

require_once 'util/myutils/CIBeanUtil.php';

class Commodity extends CIBeanUtil
{
    protected $id;
    protected $e_store_sku;
    protected $name;
    protected $price;
    protected $weight;
    protected $location;
    protected $manufacturer;
    protected $type;
    protected $is_on_shelf;
    protected $short_description;
    protected $description;
    protected $sequence;
    protected $is_e_store_created;
    protected $is_weight_shown;
    protected $is_on_sale;

    /* IRRELEVANT FIELDS */
    protected $commodity_ids_arr;
    protected $commodity_e_store_skus;
    protected $main_picture_id;
    protected $picture_ids;
    protected $commoditiesAndInventories;
    
    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('commodity_ids_arr', 'commodity_e_store_skus', 'main_picture_id', 'picture_ids', 'commoditiesAndInventories');
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