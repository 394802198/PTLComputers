<?php

require_once 'application/class/warehouse/product/ProductOrderTempList.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    // Delete order temp list Rest
    public function delete_order_temp_list()
    {
        $productOrderTempList = new ProductOrderTempList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productOrderTempList,
                'check_empty'=>array(
                    'id'=>'Existing order temp list needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_warehouse_product_order_temp_list', array(
                'id'    =>  $productOrderTempList->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Delete selected Order temp list!'
            ), FALSE);
        }

        echo $jsonAlert->result();
    }

    // Delete product_id from order temp list Rest
    public function delete_product_id_from_order_temp_list()
    {
        $productOrderTempList = new ProductOrderTempList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productOrderTempList,
                'check_empty'=>array(
                    'id'=>'Existing order temp list needed!',
                    'product_id'=>'Must choose a product to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productOrderTempListModelQuery = $this->db->get_where('t_warehouse_product_order_temp_list', array(
                'id'    =>  $productOrderTempList->id
            ));

            if( $productOrderTempListModelQuery->num_rows() > 0 )
            {
                $productOrderTempListModel = $productOrderTempListModelQuery->row_array();

                /** 如果有产品编号
                 */
                if( trim( $productOrderTempListModel['product_ids'] ) != '' )
                {
                    $product_ids_arr = explode( ', ', $productOrderTempListModel['product_ids'] );
                    $final_product_ids = '';

                    $delete_product_id_item_code = '';

                    foreach( $product_ids_arr as $product_id )
                    {
                        if( $productOrderTempList->product_id == trim( $product_id ) )
                        {
                            unset( $product_ids_arr[ $product_id ] );

                            $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                                'id'    =>  $product_id
                            ));
                            if( $productModelQuery->num_rows() > 0 )
                            {
                                $productModel = $productModelQuery->row_array();

                                $delete_product_id_item_code = $productModel['item_code'];
                            }
                        }
                        else
                        {
                            if( $final_product_ids != '' )
                            {
                                $final_product_ids .= ', ';
                            }
                            $final_product_ids .= $product_id;
                        }
                    }

                    $this->db->update('t_warehouse_product_order_temp_list', array(
                        'product_ids'   =>  $final_product_ids
                    ), array(
                        'id'    =>  $productOrderTempList->id
                    ));

                    $productOrderTempListModelQuery = $this->db->get_where('t_warehouse_product_order_temp_list', array(
                        'id'    =>  $productOrderTempList->id
                    ));

                    if( $productOrderTempListModelQuery->num_rows() > 0 )
                    {
                        $productOrderTempListModel = $productOrderTempListModelQuery->row_array();
                        if( trim( $productOrderTempListModel['product_ids'] ) != '' )
                        {
                            $product_ids = explode( ', ', $productOrderTempListModel['product_ids'] );
                            $this->db->where_in('id', $product_ids);
                            $jsonAlert->model = $this->db->get('t_warehouse_product')->result_object();
                        }
                    }

                    $jsonAlert->append(array(
                        'successMsg'=>'Product ' . $delete_product_id_item_code . ' removed from order temp list!'
                    ), FALSE);
                }
            }
        }
        echo $jsonAlert->result();
    }

    // Get product by ids Rest
    public function get_product_by_ids()
    {
        $productOrderTempList = new ProductOrderTempList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productOrderTempList,
                'check_empty'=>array(
                    'id'=>'Existing order temp list needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productOrderTempListModelQuery = $this->db->get_where('t_warehouse_product_order_temp_list', array(
                'id'    =>  $productOrderTempList->id
            ));

            if( $productOrderTempListModelQuery->num_rows() > 0 )
            {
                $productOrderTempListModel = $productOrderTempListModelQuery->row_array();
                if( trim( $productOrderTempListModel['product_ids'] ) != '' )
                {
                    $product_ids = explode( ', ', $productOrderTempListModel['product_ids'] );
                    $this->db->where_in('id', $product_ids);
                    $jsonAlert->model = $this->db->get('t_warehouse_product')->result_object();
                }
            }
        }
        echo $jsonAlert->result();
    }

    // Append Rest
    public function append()
    {
        $productOrderTempList = new ProductOrderTempList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productOrderTempList,
                'check_empty'=>array(
                    'id'=>'Existing order temp list needed!',
                    'product_ids'=>'Must select at least one product to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $productOrderTempListModelQuery = $this->db->get_where('t_warehouse_product_order_temp_list', array(
                'id'    =>  $productOrderTempList->id
            ));

            $sold_or_locked = 0;
            $existed_ids = 0;
            $new_ids = 0;

            if( $productOrderTempListModelQuery->num_rows() > 0 )
            {
                $productOrderTempListModel = $productOrderTempListModelQuery->row_array();

                $final_product_ids = '';
                $product_id_arr = explode( ',', $productOrderTempList->product_ids );
                $existing_product_id_arr = explode( ',', $productOrderTempListModel['product_ids'] );
                foreach( $product_id_arr as $product_id )
                {
                    $final_product_id = trim( $product_id );
                    if( $final_product_id != '' )
                    {
                        $this->db->where_not_in('product_status', 'Sold');
                        $this->db->where_not_in('is_locked', 'Y');
                        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                            'id'    =>  $final_product_id
                        ));

                        /** 已售出或已锁定，不能添加至暂存订购列表
                         */
                        if( $productModelQuery->num_rows() > 0 )
                        {
                            if( in_array( $final_product_id, $existing_product_id_arr ) )
                            {
                                $existed_ids ++;
                            }
                            else
                            {
                                if( $final_product_ids != '' )
                                {
                                    $final_product_ids .= ', ';
                                }
                                $final_product_ids .= $final_product_id;
                                $new_ids ++;
                            }
                        }
                        else
                        {
                            $sold_or_locked ++;
                        }
                    }
                }

                if( $final_product_ids != '' )
                {
                    $this->db->update('t_warehouse_product_order_temp_list', array(
                        'product_ids'   =>  ( trim( $productOrderTempListModel['product_ids'] ) != '' ? $productOrderTempListModel['product_ids'] . ', ' : '' ) . $final_product_ids
                    ), array(
                        'id'    =>  $productOrderTempList->id
                    ));
                }
            }

            if( $sold_or_locked > 0 )
            {
                $jsonAlert->append(array(
                    'successSoldOrLockedMsg'=>$sold_or_locked . ' Sold or Locked product(s) not added!'
                ), FALSE);
            }

            $jsonAlert->append(array(
                'successExistedIdsMsg'=>$existed_ids . ' Existed product(s) not added!'
            ), FALSE);

            if( $new_ids > 0 )
            {
                $jsonAlert->append(array(
                    'successNewIdsMsg'=>$new_ids . ' New product(s) added!'
                ), FALSE);

                $jsonAlert->append(array(
                    'successUpdatedMsg'=>'Existing Order temp list Updated!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'successNothingUpdatedMsg'=>'Existing Order temp list Nothing Updated!'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
    }

    // Add Rest
    public function add()
    {
        $productOrderTempList = new ProductOrderTempList($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productOrderTempList,
                'check_empty'=>array(
                    'name'=>'Name needed!',
                    'product_ids'=>'Must select at least one product to continue!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $sold_or_locked = 0;
            $new_ids = 0;

            $final_product_ids = '';
            $product_id_arr = explode( ',', $productOrderTempList->product_ids );
            foreach( $product_id_arr as $product_id )
            {
                $final_product_id = trim( $product_id );
                if( $final_product_id != '' )
                {
                    $this->db->where_not_in('product_status', 'Sold');
                    $this->db->where_not_in('is_locked', 'Y');
                    $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                        'id'    =>  $final_product_id
                    ));

                    /** 已售出或已锁定，不能添加至暂存订购列表
                     */
                    if( $productModelQuery->num_rows() > 0 )
                    {
                        if( $final_product_ids != '' )
                        {
                            $final_product_ids .= ', ';
                        }
                        $final_product_ids .= $final_product_id;
                        $new_ids ++;
                    }
                    else
                    {
                        $sold_or_locked ++;
                    }
                }
            }

            if( $final_product_ids != '' )
            {

                $this->db->insert('t_warehouse_product_order_temp_list', array(
                    'name'          =>  $productOrderTempList->name,
                    'product_ids'   =>  $final_product_ids
                ));
            }

            if( $sold_or_locked > 0 )
            {
                $jsonAlert->append(array(
                    'successSoldOrLockedMsg'=>$sold_or_locked . ' Sold or Locked product(s) not added!'
                ), FALSE);
            }

            if( $new_ids > 0 )
            {
                $jsonAlert->append(array(
                    'successNewIdsMsg'=>$new_ids . ' New product(s) added!'
                ), FALSE);


                $jsonAlert->append(array(
                    'successMsg'=>'New Order temp list Created!'
                ), FALSE);
            }
            else
            {
                $jsonAlert->append(array(
                    'successNothingAddedMsg'=>'No available product(s) added!'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
    }

    /** 获取暂存订购列表
     */
    public function get_all()
    {
        $productOrderTempListObjQuery = $this->db->get('t_warehouse_product_order_temp_list');

        $productOrderTempListObj = array();

        if( $productOrderTempListObjQuery->num_rows() > 0 )
        {
            $productOrderTempListObj = $productOrderTempListObjQuery->result_object();

            foreach( $productOrderTempListObj as $productOrderTempList )
            {
                if( trim( $productOrderTempList->product_ids ) != '' )
                {
                    $product_ids = explode( ', ', $productOrderTempList->product_ids );
                    $this->db->where_in('id', $product_ids);
                    $productOrderTempList->count_all_results_product = $this->db->count_all_results('t_warehouse_product');
                }
            }
        }

        echo json_encode( $productOrderTempListObj );
    }
	
}
