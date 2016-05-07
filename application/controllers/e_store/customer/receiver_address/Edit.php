<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

    public function id( $customer_receiver_address_id )
    {
        if( ! isset( $customer_receiver_address_id ) ) header('Location:/manager');

        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'id'=>$customer_receiver_address_id
        ));
        if( $customerReceiverAddressModelQuery->num_rows() < 1 )
        {
            header('Location:/e_store/customer/dash_board');
        }

        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $customerReceiverAddress = $customerReceiverAddressModelQuery->row_array();
        $data['customerReceiverAddress'] = $customerReceiverAddress;

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();


        /** 开始：当前页标识
         */
        $data['current_on'] = 'receiver_address';
        /** 结束：当前页标识
         */

        $this->load->view('e_store/customer/receiver_address/edit', $data);
	}
}
