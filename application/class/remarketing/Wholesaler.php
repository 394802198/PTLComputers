<?php

require_once 'util/myutils/CIBeanUtil.php';

class Wholesaler extends CIBeanUtil {

    protected $id;
    protected $level;
    protected $login_account;
    protected $login_password;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $company_name;
    protected $landline_phone;
    protected $mobile_phone;
    protected $fax_no;
    protected $street;
    protected $area;
    protected $city;
    protected $country;
    protected $security_question;
    protected $security_answer;
    protected $is_activated;
    
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