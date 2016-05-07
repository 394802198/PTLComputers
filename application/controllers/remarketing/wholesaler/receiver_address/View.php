<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

    public function index()
    {
        $myReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'     =>$_SESSION['wholesaler']['id']
        ));
        $myReceiverAddresses = $myReceiverAddressModelQuery->result_object();
        foreach( $myReceiverAddresses as $myReceiverAddress )
        {
            $courierShippingArea = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'    =>$myReceiverAddress->shipping_area_id
            ));
            $myReceiverAddress->shippingArea = $courierShippingArea->row_array();
        }
        $data['myReceiverAddresses'] = $myReceiverAddresses;


        $this->load->view('remarketing/wholesaler/receiver_address/view', $data);
	}

}
