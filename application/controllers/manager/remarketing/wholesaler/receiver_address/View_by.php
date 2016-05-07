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
        $wholesalerModel = $wholesalerModelQuery->row_array();

        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'     =>$wholesalerModel['id']
        ));
        $wholesalerReceiverAddresses = $wholesalerReceiverAddressModelQuery->result_object();
        foreach( $wholesalerReceiverAddresses as $wholesalerReceiverAddress )
        {
            $courierShippingArea = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'    =>$wholesalerReceiverAddress->shipping_area_id
            ));
            $wholesalerReceiverAddress->shippingArea = $courierShippingArea->row_array();
            $wholesalerReceiverAddress->wholesaler = $wholesalerModel;
        }
        $data['wholesalerReceiverAddresses'] = $wholesalerReceiverAddresses;
        $data['wholesaler'] = $wholesalerModel;


        $this->load->view('manager/remarketing/wholesaler/receiver_address/view', $data);
	}

}
