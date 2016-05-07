<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class My_Wish_list extends MY_Controller {

    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $customer_id = $_SESSION['customer']['id'];
        $this->db->select('id, e_store_sku, create_time');
        $wishListObjQuery = $this->db->get_where('t_e_store_wish_list', array(
            'customer_id'    =>  $customer_id
        ));
        $wishListObj = $wishListObjQuery->result_object();

        if( $wishListObjQuery->num_rows() > 0 )
        {
            foreach( $wishListObj as $wishList )
            {
                $this->db->select('id, name, manufacturer, type');
                $commodityModelQuery = $this->db->get_where('t_warehouse_commodity', array(
                    'e_store_sku'   =>  $wishList->e_store_sku
                ));
                if( $commodityModelQuery->num_rows() > 0 )
                {
                    $commodityModel = $commodityModelQuery->row_array();

                    $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                        'e_store_sku'   =>  $wishList->e_store_sku
                    ));
                    $commodityModelInventory = $commodityInventoryModelQuery->row_array();

                    $commodityModel['inventory']    =   $commodityModelInventory;

                    $wishList->commodity = $commodityModel;

                    $this->db->select('commodity_picture_id');
                    $commodityPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                        'commodity_id'          =>  $commodityModel['id'],
                        'is_selected_to_show'   =>  'Y'
                    ));
                    $commodityPictureCombinationModel = $commodityPictureCombinationModelQuery->row_array();

                    $this->db->select('pic_path');
                    $commodityPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                        'id'    =>  $commodityPictureCombinationModel['commodity_picture_id']
                    ));
                    $commodityPictureModel = $commodityPictureModelQuery->row_array();

                    $wishList->pic_path = $commodityPictureModel['pic_path'];
                }
            }
        }

        $data['wishListObj'] = $wishListObjQuery->result_object();

        /** 开始：当前页标识
         */
        $data['current_on'] = 'my_wish_list';
        /** 结束：当前页标识
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  115
        ));
        if( $homeAdvertisementObjQuery->num_rows() > 0 )
        {
            $homeAdvertisements = $homeAdvertisementObjQuery->result_object();
            foreach( $homeAdvertisements as $homeAdvertisement )
            {
                switch( $homeAdvertisement->position )
                {
                    case 100 : $data['pageTopAdvertisement'] = $homeAdvertisement; break;
                    case 101 : $data['pageLeftAdvertisement'] = $homeAdvertisement; break;
                    case 102 : $data['pageRightAdvertisement'] = $homeAdvertisement; break;
                    case 103 : $data['pageBottomAdvertisement'] = $homeAdvertisement; break;
                    case 104 : $data['headerBottomAdvertisement'] = $homeAdvertisement; break;
                    case 105 : $data['footerTopAdvertisement'] = $homeAdvertisement; break;
                }
            }
        }

        $this->load->view('e_store/customer/my_wish_list', $data);
	}
}
