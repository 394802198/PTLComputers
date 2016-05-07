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

    public function wholesaler_id( $wholesaler_id )
    {
        if( ! isset( $wholesaler_id ) ) header('Location:/manager');

        $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
            'id'=>$wholesaler_id
        ));
        if( $wholesalerModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['wholesaler'] = $wholesalerModelQuery->row_array();

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'     =>$wholesaler_id
        ));
        $data['isFirstReceiverAddress'] = $wholesalerReceiverAddressModelQuery->num_rows() > 0 ? false : true;

        $this->load->view('manager/remarketing/wholesaler/receiver_address/add', $data);
	}
}
