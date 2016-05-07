<?php

require_once 'util/myutils/CIBeanUtil.php';

class Customer extends CIBeanUtil {

    protected $id;
    protected $account;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $company_name;
    protected $fixed_phone;
    protected $mobile_phone;
    protected $fax_no;
    protected $country;
    protected $province;
    protected $city;
    protected $address;
    protected $post;
    protected $is_activated;

    /* IRRELEVANT FIELDS */
    protected $email_or_account;
    protected $current_credential;
    protected $new_credential;
    protected $confirm_new_credential;

    function __construct($input=NULL)
    {
        $config['auto_increment']=array('id');
        $config['irrelevant_fields']=array('email_or_account', 'current_credential', 'new_credential', 'confirm_new_credential');
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