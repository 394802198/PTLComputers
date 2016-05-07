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
        $cartModelQuery = $this->db->get('t_remarketing_cart');
        $data['carts'] = $cartModelQuery->result_object();

        $this->load->view('manager/remarketing/cart/view',$data);
	}
	
}
