<?php 

class Add extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

    public function index()
    {
        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'     =>$_SESSION['wholesaler']['id']
        ));
        $data['isFirstReceiverAddress'] = $wholesalerReceiverAddressModelQuery->num_rows() > 0 ? false : true;

        $this->load->view('remarketing/wholesaler/receiver_address/add', $data);
	}
}
