<?php 

class Add_By extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }

    public function customer_id( $customer_id )
    {
        if( ! isset( $customer_id ) ) header('Location:/manager');

        $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
            'id'=>$customer_id
        ));
        if( $customerModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['customer'] = $customerModelQuery->row_array();

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'customer_id'     =>$customer_id
        ));
        $data['isFirstReceiverAddress'] = $customerReceiverAddressModelQuery->num_rows() > 0 ? false : true;

        $this->load->view('manager/e_store/customer/receiver_address/add', $data);
	}
}
