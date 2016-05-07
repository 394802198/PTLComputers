<?php

require_once 'application/class/warehouse/product/EditByConditionWhere.php';
require_once 'application/class/warehouse/product/EditByConditionFinalData.php';
require_once 'application/class/warehouse/product/Product.php';
require_once 'application/class/warehouse/logistic/courier/Courier.php';
require_once 'application/class/warehouse/logistic/courier/CourierPricing.php';
require_once 'application/class/remarketing/Order.php';
require_once 'application/class/remarketing/Wholesaler.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/CIPagination.php';
require_once 'util/myutils/WarehouseCommodityUtil.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Check Product Item Code Duplicate Rest
	public function check_product_item_code_duplicate()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'item_code'=>'Item Code Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                'item_code'=>$product->item_code
            ));
    		
    		if($productModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Item Code Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Add Rest
	public function add()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'item_code'=>'Item Code Needed!',
                    'product_status'=>'Product Status Needed!',
                    'location'=>'Location Needed!',
                    'type'=>'Type Needed!',
                    'price'=>'Price Needed!',
                    'weight'=>'Weight Needed!',
                    'manufacturer_name'=>'Manufacturer Name Needed!',
                    'model'=>'Model Needed!',
                    'sn'=>'SN Needed!',
                    'processor'=>'Processor Needed!',
                    'processor_speed'=>'Processor Speed Needed!',
                    'mem_size'=>'Mem Size Needed!',
                    'hdd_size'=>'HDD Size Needed!',
                    'visual_status'=>'Visual Status Needed!',
                    'performance_status'=>'Performance Status Needed!',
                    'optical_drive'=>'Optical Drive Needed!',
                    'system_license'=>'System License Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                'item_code'=>$product->item_code
            ));
    		if($productModelQuery->num_rows() < 1)
            {
                $this->db->insert('t_warehouse_product', $product->getInsertableData());

                /** 如果是 Grade A，则有必要同步 EStore Commodity 及其 库存
                 */
                if( strcasecmp( $product->performance_status, 'Grade A' ) == 0 )
                {
                    $commodityInventoryOriginalWhere = array(
                        'type'              =>  $product->type,                 'manufacturer_name' =>  $product->manufacturer_name,  'model'             =>  $product->model,
                        'processor'         =>  $product->processor,            'processor_speed'   =>  $product->processor_speed,    'mem_size'          =>  $product->mem_size,
                        'hdd_size'          =>  $product->hdd_size,             'optical_drive'     =>  $product->optical_drive,      'system_license'    =>  $product->system_license,
                        'is_web_cam'        =>  $product->is_web_cam,           'screen_size'       =>  $product->screen_size
                    );

                    $config = array
                    (
                        'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                    );
                    WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                }

                $jsonAlert->append(array(
                    'successMsg'=>'New Product Created!'
                ), FALSE);
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Item Code Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

	// Edit Rest
	public function edit()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'item_code'=>'Item Code Needed!',
                    'product_status'=>'Product Status Needed!',
                    'location'=>'Location Needed!',
                    'type'=>'Type Needed!',
                    'price'=>'Price Needed!',
                    'weight'=>'Weight Needed!',
                    'manufacturer_name'=>'Manufacturer Name Needed!',
                    'model'=>'Model Needed!',
                    'sn'=>'SN Needed!',
                    'processor'=>'Processor Needed!',
                    'processor_speed'=>'Processor Speed Needed!',
                    'mem_size'=>'Mem Size Needed!',
                    'hdd_size'=>'HDD Size Needed!',
                    'visual_status'=>'Visual Status Needed!',
                    'performance_status'=>'Performance Status Needed!',
                    'optical_drive'=>'Optical Drive Needed!',
                    'system_license'=>'System License Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if product is Sold or Locked */
        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
            'id'    =>$product->id
        ));
        $productModel = $productModelQuery->row_array();
        if( strcasecmp( $productModel['is_ordered'],'Y' )==0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Product is Ordered, please don\'t try to edit it!'
            ), TRUE);
        }

        /* Check if edit product price, only administrator can edit price */
        if( $productModel['price'] != $product->price )
        {
            if( $_SESSION['manager']['role'] != 'administrator' )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Only Administrator can edit product price!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                'id'=>$product->id,
                'item_code'=>$product->item_code
            ));
            $otherProductModelQuery = $this->db->get_where('t_warehouse_product', array(
                'item_code'=>$product->item_code
            ));

    		if($productModelQuery->num_rows() > 0 || $otherProductModelQuery->num_rows() < 1)
            {
                $product->last_update = date("Y-m-d h:i:s");
                $this->db->update('t_warehouse_product', $product->getEditableData(), array(
                    'id'=>$product->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current Product Updated!'
                ), FALSE);

                /* If any of the criteria is not met, then refresh EStore Commodity Inventory */
                $productModel = $productModelQuery->row_array();
                if
                (
                    /** 如果商品在编辑之前 Performance Status 是 Grade A，则有必要同步 EStore Commodity 及其 库存
                     */
                    strcasecmp( $productModel['performance_status'], 'Grade A' ) == 0 || strcasecmp( $product->performance_status, 'Grade A' ) == 0 &&
                    (
                        strcasecmp( $productModel['type'],$product->type )!=0 ||
                        strcasecmp( $productModel['manufacturer_name'],$product->manufacturer_name )!=0 ||
                        strcasecmp( $productModel['model'],$product->model )!=0 ||
                        strcasecmp( $productModel['processor'],$product->processor )!=0 ||
                        strcasecmp( $productModel['processor_speed'],$product->processor_speed )!=0 ||
                        strcasecmp( $productModel['mem_size'],$product->mem_size )!=0 ||
                        strcasecmp( $productModel['hdd_size'],$product->hdd_size )!=0 ||
                        strcasecmp( $productModel['optical_drive'],$product->optical_drive )!=0 ||
                        strcasecmp( $productModel['system_license'],$product->system_license )!=0 ||
                        strcasecmp( $productModel['is_web_cam'],$product->is_web_cam )!=0 ||
                        strcasecmp( $productModel['screen_size'],$product->screen_size )!=0 ||
                        strcasecmp( $productModel['product_status'],$product->product_status )!=0
                    )
                )
                {
                    $commodityInventoryOriginalWhere = array(
                        'type'              =>  $productModel['type'],                  'manufacturer_name' =>  $productModel['manufacturer_name'],  'model'             =>  $productModel['model'],
                        'processor'         =>  $productModel['processor'],             'processor_speed'   =>  $productModel['processor_speed'],    'mem_size'          =>  $productModel['mem_size'],
                        'hdd_size'          =>  $productModel['hdd_size'],              'optical_drive'     =>  $productModel['optical_drive'],      'system_license'    =>  $productModel['system_license'],
                        'is_web_cam'        =>  $productModel['is_web_cam'],            'screen_size'       =>  $productModel['screen_size']
                    );
                    $commodityInventoryTargetWhere = array(
                        'type'              =>  $product->type,           'manufacturer_name' =>  $product->manufacturer_name,  'model'             =>  $product->model,
                        'processor'         =>  $product->processor,      'processor_speed'   =>  $product->processor_speed,    'mem_size'          =>  $product->mem_size,
                        'hdd_size'          =>  $product->hdd_size,       'optical_drive'     =>  $product->optical_drive,      'system_license'    =>  $product->system_license,
                        'is_web_cam'        =>  $product->is_web_cam,     'screen_size'       =>  $product->screen_size
                    );

                    $config = array
                    (
                        'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere,
                        'commodityInventoryTargetWhere'       =>  $commodityInventoryTargetWhere
                    );
                    WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                }
    		}
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Product Item Code Duplicated!'
                ), TRUE);
    		}
	    }
        echo $jsonAlert->result();
	}

    // Check Edit Category Name Duplicate Rest
	public function check_edit_product_item_code_duplicate()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'id'=>'ID Needed!',
                    'item_code'=>'Item Code Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                'id'=>$product->id,
                'item_code'=>$product->item_code
            ));
            $otherProductModelQuery = $this->db->get_where('t_warehouse_product', array(
                'item_code'=>$product->item_code
            ));
    		
    		if($productModelQuery->num_rows() < 1 && $otherProductModelQuery->num_rows() > 0)
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Product Item Code Duplicated!'
                ), TRUE);
    		}
        }
        echo $jsonAlert->result();
	}

    // Edit product by condition
	public function edit_product_by_condition()
	{
        $editByConditionWhere = new EditByConditionWhere($this->input);
        $editByConditionFinalData = new EditByConditionFinalData($this->input);
        $jsonAlert = new JSONAlert();

        $where = $editByConditionWhere->getAllNotNullData();
	    if( ! $where && count( $where ) < 1 )
        {
            $jsonAlert->append(array(
                'whereError'=>'Must assign at least one condition!'
            ), TRUE);
	    }

        $finalData = $editByConditionFinalData->getAllNotNullData();
        if( ! $finalData && count( $finalData ) < 1 )
        {
            $jsonAlert->append(array(
                'finalDataError'=>'Must assign at least one final data!'
            ), TRUE);
	    }

        if( ! $jsonAlert->hasErrors )
        {
            $finalWhere = array();
            foreach( $where as $key=>$value )
            {
                $key = substr($key, 0, strrpos($key, "_condition"));
                $condition = array(
                    $key=>$value
                );
                $finalWhere = array_merge( $finalWhere, $condition );
            }

            /** 为防止相同字段的条件和最终数据一致，判断如果有一致的数据则提示用户，请替换成不一致的再继续
             */
            $is_any_same_field_got_same_data = false;
            foreach( $finalData as $key => $data )
            {
                if( array_key_exists( $key, $finalWhere ) )
                {
                    if( trim( $finalData[ $key ] ) == trim( $finalWhere[ $key ] ) )
                    {
                        $is_any_same_field_got_same_data = true;
                    }
                }
            }

            /** 如果每一个相同字段都没有重复数据，则继续
             */
            if( ! $is_any_same_field_got_same_data )
            {
                $this->load->model('Remarketing_Product_model');
                $this->Remarketing_Product_model->edit_product_by_condition( $finalData, $finalWhere, $jsonAlert );
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Condition and Final data is exactly the same, please differentiate them!'
                ), TRUE);
            }
	    }

        echo $jsonAlert->result();
	}
	
	public function order4wholesaler()
	{
        $order = new Order($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$order,
                'check_empty'=>array(
                    'product_ids'=>'Must select at least one product!',
                    'wholesaler_id'=>'Must specify a wholesaler!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $manager_id = $_SESSION['manager']['manager_id'];

	        $available_product_ids = array();
            $unavailable_product_ids = '';
            $is_unavailable_product_ids_existed = false;
	        
	        foreach ( $order->product_ids as $product_id )
            {
	            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
	                'id'=>$product_id
	            ));
                $productModel = $productModelQuery->row_array();
	            
	            if( ( strcasecmp($productModel['product_status'],'In Stock')==0 || strcasecmp($productModel['product_status'],'Returned')==0 )
                    && strcasecmp($productModel['is_locked'],'N')==0 )
                {
	                array_push($available_product_ids, $product_id);
	            }
                else
                {
                    if( $unavailable_product_ids != '' )
                    {
                        $unavailable_product_ids .= ', ';
                    }
                    $unavailable_product_ids .= $productModel['item_code'];

                    $is_unavailable_product_ids_existed = true;
                }

                $productModel = null;
	        }
	        
	        if( count($available_product_ids) > 0 && ! $is_unavailable_product_ids_existed )
            {
	            $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
	                'id'=>$order->wholesaler_id
	            ));
	            $wholesalerModel = $wholesalerModelQuery->row_array();
	            
	            $street = $wholesalerModel['street'];
	            $area = $wholesalerModel['area'];
	            $city = $wholesalerModel['city'];
	            $country = $wholesalerModel['country'];
	            
                $this->db->insert('t_remarketing_order', array(
                    'wholesaler_id'=>$order->wholesaler_id,
                    'manager_id'=>$manager_id,
                    'ordered_date'=>date("Y-m-d h:i:s"),
                    'order_status'=>'processing',
                    'payment_option'=>'',
                    'paid_amount'=>0,
                    'shipping_method'=>$order->shipping_method,
                    'last_name'=>$wholesalerModel['last_name'],
                    'first_name'=>$wholesalerModel['first_name'],
                    'email'=>$wholesalerModel['email'],
                    'company_name'=>$wholesalerModel['company_name'],
                    'landline_phone'=>$wholesalerModel['landline_phone'],
                    'mobile_phone'=>$wholesalerModel['mobile_phone'],
                    'fax_no'=>$wholesalerModel['fax_no']
                ));

                $insert_order_id = $this->db->insert_id();

                // Get all product details price
                $totalAmount = 0;
                $totalWeight = 0;
            
                foreach( $available_product_ids as $available_product_id )
                {
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'=>$available_product_id
                    ));
                    $productModel = $productModelQuery->row_array();
            
                    // Add product to order_detail
                    $this->db->insert('t_remarketing_order_detail', array(
                        'order_id'=>$insert_order_id,
                        'product_id'=>$productModel['id'],
                        'item_code'=>$productModel['item_code'],
                        'location'=>$productModel['location'],
                        'manufacturer_name'=>$productModel['manufacturer_name'],
                        'type'=>$productModel['type'],
                        'price'=>$productModel['price'],
                        'weight'=>$productModel['weight']
                    ));

                    $totalAmount += $productModel['price'];
                    $totalWeight += $productModel['weight'];

                    $this->db->update('t_warehouse_product', array(
                        'is_locked'=>'Y',
                        'ordered_date'=>date("Y-m-d h:i:s")
                    ), array(
                        'id'=>$available_product_id
                    ));
                }

                $totalGST = $totalAmount*0.15;
                $totalAmountGST = $totalAmount*1.15;

                $shippingFee = 0;
                $shippingArea = '';
                $shippingAddress = '';

                $receiver_name = '';
                $receiver_phone = '';
                $receiver_email = '';
                $receiver_country = '';
                $receiver_province = '';
                $receiver_city = '';
                $receiver_address = '';
                $receiver_post = '';

                /* If shipping method is Shipping, then  */
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
                    $totalAmountGST += ( $courierPricingModel['charge_wholesaler_per_kg'] * $product_weight_kg );

                    $shippingAddress .= $street.', '.$area.', '.$city.', '.$country;

                    $receiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
                        'id'    =>$order->receiver_address_id
                    ));
                    $receiverAddressModel = $receiverAddressModelQuery->row_array();
                    $receiver_name = $receiverAddressModel['receiver_name'];
                    $receiver_phone = $receiverAddressModel['receiver_phone'];
                    $receiver_email = $receiverAddressModel['receiver_email'];
                    $receiver_country = $receiverAddressModel['receiver_country'];
                    $receiver_province = $receiverAddressModel['receiver_province'];
                    $receiver_city = $receiverAddressModel['receiver_city'];
                    $receiver_address = $receiverAddressModel['receiver_address'];
                    $receiver_post = $receiverAddressModel['receiver_post'];

                    $courierShippingAreaModelQuery = $this->db->get_where('t_warehouse_courier_shipping_area', array(
                        'id'    =>$receiverAddressModel['shipping_area_id']
                    ));
                    $courierShippingAreaModel = $courierShippingAreaModelQuery->row_array();
                    $shippingArea = $courierShippingAreaModel['name'];
                }

                $this->db->update('t_remarketing_order', array(
                    'courier_id'=>$order->courier_id,
                    'payable_amount'=>$totalAmount,
                    'total_amount'=>$totalAmount,
                    'gst'=>$totalGST,
                    'total_amount_gst'=>$totalAmountGST,
                    'total_weight'=>$totalWeight,
                    'shipping_area'=>$shippingArea,
                    'shipping_fee'=>$shippingFee,
                    'shipping_address'=>$shippingAddress,
                    'receiver_name'=>$receiver_name,
                    'receiver_phone'=>$receiver_phone,
                    'receiver_email'=>$receiver_email,
                    'receiver_country'=>$receiver_country,
                    'receiver_province'=>$receiver_province,
                    'receiver_city'=>$receiver_city,
                    'receiver_address'=>$receiver_address,
                    'receiver_post'=>$receiver_post
                ), array(
                    'id'=>$insert_order_id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Successfully ordered available product(s) for specified wholesaler!'
                ), FALSE);
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

	// Delete batch product
	public function delete_batch()
	{
        $product = new Product($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$product,
                'check_empty'=>array(
                    'product_ids'=>'Must select at least one product!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( $_SESSION['manager']['role']!='administrator' )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Only Administrator can do this!'
            ), TRUE);
        }

        /* Check if product is sold or locked */
        $unavailableProductItemCode = '';
        $isUnavailableProductExisted = false;
        $unavailableProductCount = 0;

        if( ! $jsonAlert->hasErrors )
        {
            foreach ($product->product_ids as $product_id)
            {
                $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                    'id'    =>$product_id
                ));
                $productModel = $productModelQuery->row_array();
                if( strcasecmp( $productModel['is_ordered'], 'Y' )==0 || strcasecmp( $productModel['is_locked'], 'Y' )==0 )
                {
                    $unavailableProductCount ++;
                    $isUnavailableProductExisted = true;
                    if( $unavailableProductItemCode != '' )
                    {
                        $unavailableProductItemCode .= ', ';
                    }
                    $unavailableProductItemCode .= $productModel['item_code'];
                }
            }
        }

        if( $isUnavailableProductExisted )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Product Item Code:' . $unavailableProductItemCode . ' ' . ( $unavailableProductCount > 1 ? 'are' : 'is' ) . ' unable to be removed, ' . ( $unavailableProductCount > 1 ? 'they are' : 'it is' ) . ' whether sold or locked!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ($product->product_ids as $product_id)
            {
                $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                    'id'    =>  $product_id
                ));
                $productModel = $productModelQuery->row_array();

                $this->db->delete('t_warehouse_product', array(
                    'id'=>$product_id
                ));

                $commodityInventoryOriginalWhere = array(
                    'type'              =>  $productModel['type'],           'manufacturer_name' =>  $productModel['manufacturer_name'],  'model'             =>  $productModel['model'],
                    'processor'         =>  $productModel['processor'],      'processor_speed'   =>  $productModel['processor_speed'],    'mem_size'          =>  $productModel['mem_size'],
                    'hdd_size'          =>  $productModel['hdd_size'],       'optical_drive'     =>  $productModel['optical_drive'],      'system_license'    =>  $productModel['system_license'],
                    'is_web_cam'        =>  $productModel['is_web_cam'],     'screen_size'       =>  $productModel['screen_size']
                );

                $config = array
                (
                    'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                );
                WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected product(s) deleted!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}
    
    public function export()
    {
        $initConfig = array(
            'base_url'          =>  '/manager/warehouse/product/view_by/pagination',
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
                'start_import_date', 'end_import_date',
                'start_price', 'end_price'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'imported_date', 'start_import_date', 'end_import_date' );
        $ciPagination->between( 'price', 'start_price', 'end_price' );
//        $ciPagination->in( 'product_status', array( 'in stock' ) );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_product',

            /* Optional params */
            'num_per_page'      =>  99999999999999999999,
            'order_by'          =>  'item_code ASC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        $data['ciPagination'] = $ciPagination;

//        var_dump( CIPagination::$DEBUG_GET_CONTENT_QUERY );


        $products = $ciPagination->content;

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Products_Export_' . date("Y-m-d h:i:s") . '.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv( $output, array(
            'Item Code', 'Manufacturer', 'Imported Date', 'Product Type', 'Location', 'Price', 'Model', 'SN', 'Processor', 'Processor Speed',
            'Mem Size', 'HDD Size', 'Optical Drive', 'System License', 'Notes', 'Faulty', 'Performance Status'
        ));

        foreach( $products as $product )
        {
            $product_arr = array(
                'Item Code'                 => $product->item_code,
                'Manufacturer'              => $product->manufacturer_name,
                'Imported Date'             => $product->imported_date,
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


    // Get wholesaler receiver addresses
    public function getWholesalerReceiverAddresses()
    {
        $wholesaler = new Wholesaler($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$wholesaler,
                'check_empty'=>array(
                    'id'=>'Wholesaler Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $wholesalerReceiverAddressModelQuery = $this->db->get_where('t_remarketing_wholesaler_receiver_address', array(
                'wholesaler_id'     =>$wholesaler->id
            ));
            $jsonAlert->model = $wholesalerReceiverAddressModelQuery->result_object();
        }

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
            $is_unavailable_product_ids_existed = false;

            foreach ( $order->product_ids as $product_id )
            {
                $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                    'id'=>$product_id
                ));
                $productModel = $productModelQuery->row_array();

                if( ( strcasecmp($productModel['product_status'],'In Stock')==0 || strcasecmp($productModel['product_status'],'Returned')==0 )
                    && strcasecmp($productModel['is_locked'],'N')==0 )
                {
                    array_push($available_product_ids, $product_id);
                }
                else
                {
                    if( $unavailable_product_ids != '' )
                    {
                        $unavailable_product_ids .= ', ';
                    }
                    $unavailable_product_ids .= $productModel['item_code'];

                    $is_unavailable_product_ids_existed = true;
                }

                $productModel = null;
            }

            if( count($available_product_ids) > 0 && ! $is_unavailable_product_ids_existed )
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
