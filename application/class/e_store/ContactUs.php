<?php

require_once 'util/myutils/CIBeanUtil.php';

class ContactUs extends CIBeanUtil {

    protected $id;
    protected $title;
    protected $last_name;
    protected $first_name;
    protected $fax;
    protected $phone;
    protected $email;
    protected $message;
    protected $map_iframe;
    protected $is_map_shown;
    protected $receiving_email;
    protected $receiving_title;

    /* IRRELEVANT FIELDS */
    protected $captcha_code;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('captcha_code');
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