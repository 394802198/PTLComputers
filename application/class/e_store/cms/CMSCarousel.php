<?php

require_once 'util/myutils/CIBeanUtil.php';

class CMSCarousel extends CIBeanUtil {

    protected $id;
    protected $brief_introduction;
    protected $is_activate_linkage;
    protected $linkage;
    protected $img_path;
    protected $position;
    protected $page_type;
    protected $sequence;
    protected $is_visible;

    /* IRRELEVANT FIELDS */
    protected $carousel_ids;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('carousel_ids');
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