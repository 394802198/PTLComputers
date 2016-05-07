<?php

require_once 'application/class/warehouse/logistic/courier/CourierPricing.php';
require_once 'application/class/warehouse/product/Product.php';
require_once 'application/class/remarketing/Order.php';
require_once 'application/class/remarketing/Cart.php';
require_once 'application/class/remarketing/CartDetail.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
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

            if( $cartDetailModelQuery->num_rows() < 1 )
            {

                $this->db->delete('t_remarketing_cart', array(
                    'id'=>$cartDetail->cart_id
                ));
            }
            else
            {
                // Get all cart details price
                $allCartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                    'cart_id'=>$cartDetail->cart_id
                ));

                $totalAmount = 0;
                foreach ($allCartDetailModelQuery->result_object() as $allCartDetailModel) {
                    $totalAmount += $allCartDetailModel->price;
                }
                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $this->db->update('t_cart', array(
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



    // Get wholesaler receiver addresses
    public function getWholesalerReceiverAddresses()
    {
        $jsonAlert = new JSONAlert();

        $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
            'wholesaler_id'     =>$_SESSION['wholesaler']['id']
        ));
        $jsonAlert->model = $wholesalerReceiverAddressModelQuery->result_object();

        echo $jsonAlert->result();
    }

    // Get courier and pricing
    public function getCourierAndPricing()
    {
        $courierPricing = new CourierPricing($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$courierPricing,
                'check_empty'=>array(
                    'shipping_area_id'=>'Shipping Area Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                'shipping_area_id'     =>$courierPricing->shipping_area_id,
                'is_for_wholesaler'    =>'Y'
            ));
            $courierPricingModel = $courierPricingModelQuery->result_object();
            foreach( $courierPricingModel as $courierPrice )
            {
                $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                    'id'        =>$courierPrice->courier_id,
                    'status'    =>1
                ));
                $courierPrice->courier = $courierModelQuery->row_array();
            }

            if( $courierPricingModelQuery->num_rows() < 1 )
            {
                $shippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                    'id'    =>$courierPricing->shipping_area_id
                ));
                $jsonAlert->bak_model = $shippingAreaModelQuery->row_array();
            }
            $jsonAlert->model = $courierPricingModel;
        }

        echo $jsonAlert->result();
    }

    public function calculateOrderingTotal()
    {
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'product_ids'=>'Must select at least one product!',
                    'shipping_method'=>'Shipping Method Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $available_product_ids = array();
            $unavailable_product_ids = '';

            foreach ( $order->product_ids as $product_id )
            {
                $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                    'id'=>$product_id
                ));
                $productModel = $productModelQuery->row_array();

                if( ( strcasecmp($productModel['product_status'],'In Stock')==0 || strcasecmp($productModel['product_status'],'Returned')==0 )
                    && strcasecmp($productModel['is_locked'],'N')==0 )
                {
                    array_push( $available_product_ids, $product_id );
                }
                else
                {
                    if( $unavailable_product_ids != '' )
                    {
                        $unavailable_product_ids .= ', ';
                    }
                    $unavailable_product_ids .= $productModel['item_code'];
                }

                $productModel = null;
            }

            if( count($available_product_ids) > 0 )
            {
                // Get all product details price
                $totalAmount = 0;
                $totalWeight = 0;

                foreach( $available_product_ids as $available_product_id )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'=>$available_product_id
                    ));
                    $productModel = $productModelQuery->row_array();

                    $totalAmount += $productModel['price'];
                    $totalWeight += $productModel['weight'];

                }

                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $shippingFee = 0;
                $totalAmountGSTAndShippingFee = $totalAmountGST;

                if( $order->shipping_method == 'Shipping' )
                {
                    $product_weight_kg = 1;
                    if( $totalWeight > 1000 )
                    {
                        $product_weight_kg = $totalWeight / 1000;
                        if( $totalWeight % 1000 != 0 )
                        {
                            $product_weight_kg ++;
                        }
                        $product_weight_kg = sprintf("%01.0f",$product_weight_kg);
                    }

                    $courierPricingModelQuery = $this->db->get_where('t_warehouse_courier_pricing', array(
                        'id'    =>$order->courier_pricing_id
                    ));
                    $courierPricingModel = $courierPricingModelQuery->row_array();

                    $shippingFee += ( $courierPricingModel['charge_wholesaler_per_kg'] * $product_weight_kg );
                    $totalAmountGSTAndShippingFee += ( $courierPricingModel['charge_wholesaler_per_kg'] * $product_weight_kg ) ;
                }

                $jsonAlert->model = array(
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'shipping_fee'=>$shippingFee,
                    'total_amount_gst'=>$totalAmountGST,
                    'total_amount_gst_shipping_fee'=>$totalAmountGSTAndShippingFee
                );
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Unavailable product(s) being selected, unavailable product(s) Item Code: ' . $unavailable_product_ids
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
	
}
