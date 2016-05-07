<?php

require_once 'application/class/warehouse/product/Product.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/CIPagination.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function add_products_2_cart()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'product_ids'=>'Please select at least one product!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesaler_id = $_SESSION['wholesaler']['id'];

            $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
                'wholesaler_id'=>$wholesaler_id
            ));

            // If wholesaler does not own a cart
            if($cartModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_remarketing_cart', array(
                    'wholesaler_id'=>$wholesaler_id,
                    'create_date'=>date("Y-m-d h:i:s")
                ));

                $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
                    'wholesaler_id'=>$wholesaler_id
                ));
            }

            $cartModel = $cartModelQuery->row_array();

            $cart_id = $cartModel['id'];

            $available_product_ids = array();

            foreach ($product->product_ids as $product_id)
            {
                $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                    'cart_id'=>$cart_id,
                    'product_id'=>$product_id
                ));

                // If product is in cart
                if($cartDetailModelQuery->num_rows() < 1)
                {
                    array_push($available_product_ids, $product_id);
                }
            }

            if(count($available_product_ids) > 0)
            {
                $is_any_product_available = false;

                foreach($available_product_ids as $available_product_id)
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'=>$available_product_id
                    ));
                    $productModel = $productModelQuery->row_array();

                    if( ( strcasecmp($productModel['product_status'],'in stock')==0 || strcasecmp($productModel['product_status'],'returned')==0 )
                         && strcasecmp($productModel['is_locked'],'N')==0 )
                    {
                        $is_any_product_available = true;

                        // Add product to cart_detail
                        $this->db->insert('t_remarketing_cart_detail', array(
                            'cart_id'=>$cart_id,
                            'product_id'=>$productModel['id'],
                            'create_date'=>date("Y-m-d h:i:s"),
                            'item_code'=>$productModel['item_code'],
                            'location'=>$productModel['location'],
                            'manufacturer_name'=>$productModel['manufacturer_name'],
                            'type'=>$productModel['type'],
                            'price'=>$productModel['price'],
                        ));

                        // Get all cart details price
                        $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                            'cart_id'=>$cart_id
                        ));
                        $totalAmount = 0;
                        foreach ($cartDetailModelQuery->result_object() as $cartDetailModel)
                        {
                            $totalAmount += $cartDetailModel->price;
                        }
                        $totalGST = $totalAmount*0.15;
                        $totalAmountGST = $totalAmount*1.15;

                        $this->db->update('t_remarketing_cart', array(
                            'total_amount'=>$totalAmount,
                            'gst'=>$totalGST,
                            'total_amount_gst'=>$totalAmountGST
                        ), array(
                            'id'=>$cart_id
                        ));
                    }
                }

                if($is_any_product_available)
                {
                    $jsonAlert->append(array(
                        'successMsg'=>'Selected product(s) added into cart!'
                    ), FALSE);
                }
                else
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Selected product(s) not avaiable!'
                    ), TRUE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Selected product(s) existed in your cart!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
	}

    // Add product to cart
    public function add_to_cart()
    {
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'item_code'=>'Product Status Needed!',
                    'location'=>'Product Status Needed!',
                    'manufacturer_name'=>'Product Status Needed!',
                    'type'=>'Product Status Needed!',
                    'price'=>'Product Status Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesaler_id = $_SESSION['wholesaler']['id'];

            $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
                'wholesaler_id'=>$wholesaler_id
            ));

            // If wholesaler does not own a cart
            if( $cartModelQuery->num_rows() < 1 )
            {
                $this->db->insert('t_remarketing_cart',array(
                    'wholesaler_id'=>$wholesaler_id,
                    'create_date'=>date("Y-m-d h:i:s")
                ));

                $cartModelQuery = $this->db->get_where('t_remarketing_cart', array(
                    'wholesaler_id'=>$wholesaler_id
                ));
            }

            $cartModel = $cartModelQuery->row_array();

            $cart_id = $cartModel['id'];

            // If product is in cart
            $cartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                'cart_id'=>$cart_id,
                'product_id'=>$product->id
            ));

            // If product is available
            if( (strcasecmp($product->product_status, 'In Stock')==0 || strcasecmp($product->product_status,'Returned')==0 )
                && strcasecmp($product->is_locked, 'N')==0 && $cartDetailModelQuery->num_rows() < 1)
            {
                // Add product to cart_detail
                $this->db->insert('t_remarketing_cart_detail',array(
                    'cart_id'=>$cart_id,
                    'product_id'=>$product->id,
                    'create_date'=>date("Y-m-d h:i:s"),
                    'item_code'=>$product->item_code,
                    'location'=>$product->location,
                    'manufacturer_name'=>$product->manufacturer_name,
                    'type'=>$product->type,
                    'price'=>$product->price,
                ));

                // Get all cart details price
                $allCartDetailModelQuery = $this->db->get_where('t_remarketing_cart_detail', array(
                    'cart_id'=>$cart_id
                ));
                $totalAmount = 0;
                foreach ($allCartDetailModelQuery->result_object() as $allCartDetailModel)
                {
                    $totalAmount += $allCartDetailModel->price;
                }
                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $this->db->update('t_remarketing_cart', array(
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'total_amount_gst'=>$totalAmountGST
                ), array(
                    'id'=>$cart_id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Product added into cart!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Product existed in cart!'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
    
    public function export()
    {
        $initConfig = array(
            'base_url'          =>  '/remarketing/product/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-success'),
            'CThis'             =>  $this,
            'Model'             =>  'Product',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
//                'start_import_date', 'end_import_date',
//                'start_price', 'end_price'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

//        $ciPagination->between( 'imported_date', 'start_import_date', 'end_import_date' );
//        $ciPagination->between( 'price', 'start_price', 'end_price' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_product',

            /* Optional params */
            'num_per_page'      =>  99999999999999999999,
            'order_by'          =>  'manufacturer_name ASC',
            'total_item_rows_where_in'=>array(
                array(
                    'field'=>'product_status',
                    'values'=>array('in stock')
                ),
                array(
                    'field'=>'is_locked',
                    'values'=>array('N')
                )
            ),
            'where_in'=>array(
                array(
                    'field'=>'product_status',
                    'values'=>array('in stock')
                ),
                array(
                    'field'=>'is_locked',
                    'values'=>array('N')
                )
            )
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );


        $products = $ciPagination->content;

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Products_Export_' . time() . '.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv( $output, array(
            'Item Code', 'Manufacturer', 'Product Type', 'Location', 'Price', 'Model', 'SN', 'Processor', 'Processor Speed',
            'Mem Size', 'HDD Size', 'Optical Drive', 'System License', 'Notes', 'Faulty', 'Performance Status'
        ));

        foreach( $products as $product )
        {
            $product_arr = array(
                'Item Code'                 => $product->item_code,
                'Manufacturer'              => $product->manufacturer_name,
                'Product Type'              => $product->type,
                'Location'                  => $product->location,
                'Price'                     => $product->price,
                'Model'                     => $product->model,
                'SN'                        => $product->sn,
                'Processor'                 => $product->processor,
                'Processor Speed'           => $product->processor_speed,
                'Mem Size'                  => $product->mem_size,
                'HDD Size'                  => $product->hdd_size,
                'Optical Drive'             => $product->optical_drive,
                'System License'            => $product->system_license,
                'Notes'                     => $product->notes,
                'Faulty'                    => $product->faults,
                'Performance Status'        => $product->performance_status
            );

            fputcsv( $output, $product_arr );
        }
    }
	
}
