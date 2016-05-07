<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function id( $my_receiver_address_id )
    {
        if( ! isset( $my_receiver_address_id ) ) header('Location:/remarketing');

        $myReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'id'=>$my_receiver_address_id
        ));
        if( $myReceiverAddressModelQuery->num_rows() < 1 )
        {
            header('Location:/remarketing');
        }
        $data['wholesalerReceiverAddress'] = $myReceiverAddressModelQuery->row_array();

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $this->load->view('remarketing/wholesaler/receiver_address/edit',$data);
	}
	
}
