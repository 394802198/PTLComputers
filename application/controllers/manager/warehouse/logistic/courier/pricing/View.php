<?php

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function index()
	{
        $courierPricingModelQuery = $this->db->get('t_warehouse_courier_pricing');
        $courierPricings = $courierPricingModelQuery->result_object();

        foreach( $courierPricings as $courierPricing )
        {
            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'id'    =>$courierPricing->courier_id
            ));
            $courierPricing->courier = $courierModelQuery->row_array();

            $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                'id'    =>$courierPricing->shipping_area_id
            ));
            $courierPricing->shippingArea = $courierShippingAreaModelQuery->row_array();
        }
        $data['courierPricings'] = $courierPricings;

	    $this->load->view('manager/warehouse/logistic/courier/pricing/view', $data);
	    
	}

}
