<?php

require_once 'application/class/e_store/WishList.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

    // Favourite Rest
	public function favourite()
	{
        $wishList = new WishList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wishList,
                'check_empty'=>array(
                    'commodity_id'=>'Commodity Id Needed!',
                    'e_store_sku'=>'Commodity EStore Sku Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! isset( $_SESSION['customer'] ) )
        {
            $jsonAlert->append(array(
                'signInMsg'=>'Please Sign In first then add it to your Wish List'
            ), TRUE);
        }
        else
        {
            $wishList->customer_id = $_SESSION['customer']['id'];
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wishListModelQuery = $this->db->get_where('t_e_store_wish_list', array(
                'commodity_id'  =>  $wishList->commodity_id,
                'e_store_sku'   =>  $wishList->e_store_sku,
                'customer_id'   =>  $wishList->customer_id
            ));
            if( $wishListModelQuery->num_rows() > 0 )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Favourite Product Existed in Wish List'
                ), TRUE);
            }
            else
            {
                $wishList->create_time = date("Y-m-d h:i:s");
                $this->db->insert('t_e_store_wish_list', $wishList->getInsertableData());
                $jsonAlert->append(array(
                    'successMsg'=>'Favourite Product Added to Your Wish List, Hoping You Enjoying the Shopping Journey'
                ), FALSE);
            }
	    }

        echo $jsonAlert->result();
	}

    // Remove Rest
    public function remove()
    {
        $wishList = new WishList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wishList,
                'check_empty'=>array(
                    'commodity_id'=>'Commodity Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! isset( $_SESSION['customer'] ) )
        {
            $jsonAlert->append(array(
                'signInMsg'=>'Please Sign In first then you add it to your Wish List'
            ), TRUE);
        }
        else
        {
            $wishList->customer_id = $_SESSION['customer']['id'];
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wishListModelQuery = $this->db->get_where('t_e_store_wish_list', array(
                'commodity_id'  =>  $wishList->commodity_id,
                'customer_id'   =>  $wishList->customer_id
            ));
            if( $wishListModelQuery->num_rows() > 0 )
            {
                $this->db->delete('t_e_store_wish_list', array(
                    'commodity_id'  =>  $wishList->commodity_id,
                    'customer_id'   =>  $wishList->customer_id
                ));
                $jsonAlert->append(array(
                    'successMsg'=>'Favourite Removed From Your Wish List, Hoping You Enjoying the Shopping Journey'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Favourite Not Found in Your Wish List'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
    }
}
