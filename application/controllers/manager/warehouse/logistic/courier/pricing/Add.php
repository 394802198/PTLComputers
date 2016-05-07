<?php 

class Add extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $courierModelQuery = $this->db->get('t_warehouse_courier');
        $data['couriers'] = $courierModelQuery->result_object();

        $courierShippingAreaModelQuery = $this->db->get('t_warehouse_courier_shipping_area');
        $data['courierShippingAreas'] = $courierShippingAreaModelQuery->result_object();

	    $this->load->view('manager/warehouse/logistic/courier/pricing/add', $data);
	}
}
