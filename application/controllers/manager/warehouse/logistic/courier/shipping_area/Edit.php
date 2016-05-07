<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function id( $courier_shipping_area_id )
    {
	    if( ! isset( $courier_shipping_area_id ) ) header('Location:/manager');

        $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
            'id'=>$courier_shipping_area_id
        ));
        $data['courierShippingArea'] = $courierShippingAreaModelQuery->row_array();
        $this->load->view('manager/warehouse/logistic/courier/shipping_area/edit',$data);
	}

}
