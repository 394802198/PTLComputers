<?php

require_once 'util/myutils/CIBeanUtil.php';

class CMSContactUs extends CIBeanUtil {

    protected $subject;
    protected $is_receiver_email_activate;
    protected $receiver_email;
    protected $is_map_visible;
    protected $map_iframe;
    protected $map_position;
    protected $info_position;
    protected $form_position;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
//        $config['irrelevant_fields']=array('');
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