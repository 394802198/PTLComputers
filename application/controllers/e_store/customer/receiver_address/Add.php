<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Add extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

    public function index()
    {
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'customer_id'     =>    $_SESSION['customer']['id']
        ));
        $data['isFirstReceiverAddress'] = $customerReceiverAddressModelQuery->num_rows() > 0 ? false : true;

        /** 开始：当前页标识
         */
        $data['current_on'] = 'receiver_address';
        /** 结束：当前页标识
         */

        $this->load->view('e_store/customer/receiver_address/add', $data);
	}
}
