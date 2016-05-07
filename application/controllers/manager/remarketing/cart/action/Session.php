<?php

require_once 'application/class/remarketing/Cart.php';
require_once 'application/class/remarketing/CartDetail.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller{
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	// Remove Detail From Cart
	public function remove_detail_from_cart()
    {
        $cartDetail = new CartDetail($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cartDetail,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'cart_id'=>'Cart Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_remarketing_cart_detail', array(
                'id'=>$cartDetail->id
            ));

            $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                'cart_id'=>$cartDetail->cart_id
            ));

            if($cartDetailModelQuery->num_rows() < 1)
            {
                $this->db->delete('t_remarketing_cart', array(
                    'id'=>$cartDetail->cart_id
                ));
            }
            else
            {
                // Get all cart details price
                $totalAmount = 0;

                foreach ($cartDetailModelQuery->result_object() as $cartDetail)
                {
                    $totalAmount += $cartDetail->price;
                }
                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $this->db->update('t_remarketing_cart', array(
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'total_amount_gst'=>$totalAmountGST
                ), array(
                    'id'=>$cartDetail->cart_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Product removed from cart!'
            ), FALSE);

            if( $cartDetailModelQuery->num_rows() > 0 )
            {
                $jsonAlert->model = array(
                    'is_cart_empty'=>$cartDetailModelQuery->num_rows() < 1 ? true : false
                );
            }
        }
        echo $jsonAlert->result();
	}

	// Empty Cart
	public function empty_cart()
    {
        $cart = new Cart($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$cart,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_remarketing_cart_detail', array(
                'cart_id'=>$cart->id
            ));
            $this->db->delete('t_remarketing_cart', array(
                'id'=>$cart->id
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Cart emptied!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
