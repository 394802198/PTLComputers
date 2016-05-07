<?php

require_once 'application/class/e_store/SubscribeList.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

    // Subscribe Rest
	public function subscribe()
	{
        $subscribeList = new SubscribeList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$subscribeList,
                'check_empty'=>array(
                    'email'=>'Email Needed!'
                ),
                'check_email'=>array(
                    'email'=>'Email Format Incorrect!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $subscribeListModelQuery = $this->db->get_where('t_e_store_subscribe_list', array(
                'email'     =>      $subscribeList->email
            ));
            if( $subscribeListModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Email Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->insert('t_e_store_subscribe_list', $subscribeList->getInsertableData());
                $jsonAlert->append(array(
                    'successMsg'=>'We will send you our up to date News and Details'
                ), FALSE);
            }
	    }

        echo $jsonAlert->result();
	}
}
