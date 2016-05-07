<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function index()
	{
	    $wholesaler_id = $_SESSION['wholesaler']['id'];
        $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
            'wholesaler_id'=>$wholesaler_id
        ));
        $data['cart'] = $cartModelQuery->row_array();
        
        if($cartModelQuery->num_rows() > 0)
        {
            $cart = $cartModelQuery->row_array();

            $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                'cart_id'=>$cart['id']
            ));
            $data['cartDetails'] = $cartDetailModelQuery->result_object();
        }
        
        $this->load->view('remarketing/cart/view',$data);
	}
	
}
