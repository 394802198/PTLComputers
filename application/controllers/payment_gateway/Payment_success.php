<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Payment_success extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

		$this->load->view('payment_gateway/payment_success', $data);
	}
}
