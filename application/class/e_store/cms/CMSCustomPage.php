<?php

require_once 'util/myutils/CIBeanUtil.php';

class CMSCustomPage extends CIBeanUtil {

    protected $id;
    protected $hash_token;
    protected $page_type;
    protected $page_name;
    protected $page_title;
    protected $page_title_size;
    protected $page_title_alignment;
    protected $is_page_title_visible;
    protected $page_content;
    protected $seo_title;
    protected $seo_description;
    protected $seo_keywords;

    /* IRRELEVANT FIELDS */
    protected $custom_page_ids;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('custom_page_ids');
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