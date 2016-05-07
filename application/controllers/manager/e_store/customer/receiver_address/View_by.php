<?php 

class View_By extends MY_Controller {
    
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
        $customerModel = $customerModelQuery->row_array();

        $customerReceiverAddressModelQuery = $this->db->get_where('t_e_store_customer_receiver_address', array(
            'customer_id'     =>$customerModel['id']
        ));
        $customerReceiverAddresses = $customerReceiverAddressModelQuery->result_object();
        foreach( $customerReceiverAddresses as $customerReceiverAddress )
        {
            $courierShippingArea = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'    =>$customerReceiverAddress->shipping_area_id
            ));
            $customerReceiverAddress->shippingArea = $courierShippingArea->row_array();
            $customerReceiverAddress->customer = $customerModel;
        }
        $data['customerReceiverAddresses'] = $customerReceiverAddresses;
        $data['customer'] = $customerModel;

        $this->load->view('manager/e_store/customer/receiver_address/view', $data);
	}

}
