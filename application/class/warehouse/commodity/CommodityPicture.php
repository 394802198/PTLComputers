<?php

require_once 'util/myutils/CIBeanUtil.php';

class CommodityPicture extends CIBeanUtil {

    protected $id;
    protected $manufacturer;
    protected $type;
    protected $keyword;
    protected $pic_path;

    /* IRRELEVANT FIELDS */
    protected $commodity_picture_ids;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('commodity_picture_ids');
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