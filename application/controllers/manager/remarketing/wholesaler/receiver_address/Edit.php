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

	public function id( $wholesaler_receiver_address_id )
    {
        if( ! isset( $wholesaler_receiver_address_id ) ) header('Location:/manager');

        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'id'=>$wholesaler_receiver_address_id
        ));
        if( $wholesalerReceiverAddressModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $wholesalerReceiverAddress = $wholesalerReceiverAddressModelQuery->row_array();
        $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
            'id'    =>$wholesalerReceiverAddress['wholesaler_id']
        ));
        $wholesalerReceiverAddress['wholesaler'] = $wholesalerModelQuery->row_array();
        $data['wholesalerReceiverAddress'] = $wholesalerReceiverAddress;

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $this->load->view('manager/remarketing/wholesaler/receiver_address/edit',$data);
	}
	
}
