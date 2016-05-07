<?php

require_once 'util/myutils/CIBeanUtil.php';

class EmailServer extends CIBeanUtil {

    protected $id;
    protected $host;
    protected $host_name;
    protected $is_ssl;
    protected $port;
    protected $username;
    protected $password;
    protected $from_name;
    protected $reply;
    protected $reply_name;
    protected $is_default;
    protected $is_use_default;
    protected $purpose;
    
    function __construct($input=NULL) {
    
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('');
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