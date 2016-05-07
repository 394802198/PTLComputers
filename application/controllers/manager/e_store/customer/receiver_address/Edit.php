<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
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
            header('Location:/manager');
        }
        $customerReceiverAddress = $customerReceiverAddressModelQuery->row_array();
        $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
            'id'    =>$customerReceiverAddress['customer_id']
        ));
        $customerReceiverAddress['customer'] = $customerModelQuery->row_array();
        $data['customerReceiverAddress'] = $customerReceiverAddress;

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $this->load->view('manager/e_store/customer/receiver_address/edit',$data);
	}
	
}
