<?php 

class Edit extends MY_Controller
{
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $cart_id )
    {
	    if( !isset($cart_id) ) header('Location:/manager/home');

        $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
            'id' => $cart_id
        ));
        $data['cart'] = $cartModelQuery->row_array();
        
        if( $cartModelQuery->num_rows() > 0 )
        {
            $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                'cart_id'=>$cart_id
            ));
            $data['cartDetails'] = $cartDetailModelQuery->result_object();

            $this->load->view('manager/remarketing/cart/edit',$data);
        }
        else
        {
            $this->load->view('manager/home');
        }
	}
}
