<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function id( $courier_pricing_id )
    {
	    if( ! isset( $courier_pricing_id ) ) header('Location:/manager');

        $courierModelQuery = $this->db->get('t_warehouse_courier');
        $data['couriers'] = $courierModelQuery->result_object();

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

        $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
            'id'=>$courier_pricing_id
        ));
        $data['courierPricing'] = $courierPricingModelQuery->row_array();
        $this->load->view('manager/warehouse/logistic/courier/pricing/edit',$data);
	}

}
