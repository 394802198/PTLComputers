<?php

require_once 'util/myutils/CIBeanUtil.php';

class CMSAdvertisement extends CIBeanUtil {

    protected $id;
    protected $page_type;
    protected $position;
    protected $custom_page_id;
    protected $brief_introduction;
    protected $is_activate_linkage;
    protected $linkage;
    protected $is_visible;
    protected $img_path;
    protected $is_auto_hide_count_down_activate;
    protected $auto_hide_count_down_seconds;
    protected $manual_hide_count_down_seconds;

    /* IRRELEVANT FIELDS */
    protected $advertisement_ids;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('advertisement_ids');
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