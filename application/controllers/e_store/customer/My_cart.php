<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';
require_once 'application/class/warehouse/commodity/Commodity.php';
require_once 'util/myutils/CIPagination.php';

class My_Cart extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if( ! isset( $_SESSION ) ) session_start();
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $cartItemTotal = 0;
        $productTotal = 0;


        /** 如果是客户
         */
        if( isset( $_SESSION['customer'] ) )
        {
            $data['current_on'] = 'my_cart';

            $cartModelQuery = $this->db->get_where('t_e_store_cart', array(
                'customer_id'   =>      $_SESSION['customer']['id']
            ));

            /** 如果有购物车
             */
            if( $cartModelQuery->num_rows() > 0 )
            {
                $data['cart'] = $cartModelQuery->row_array();

                /** 如果订购详情不为空
                 */
                $cartItemsModelsQuery = $this->db->get_where('t_e_store_cart_item');
                if( $cartItemsModelsQuery->num_rows() > 0 )
                {
                    $data['cart']['items'] = $cartItemsModelsQuery->result_array();
                }
            }
        }
        else
        {
            /** 如果 Session 中有购物车
             */
            if( isset( $_SESSION['cartSession'] ) )
            {
                $data['cart'] = $_SESSION['cartSession'];

                /** 如果订单详情不为空
                 */
                if( isset( $_SESSION['cartSession']['items'] ) && count( $_SESSION['cartSession']['items'] ) > 0 )
                {
                    $data['cart']['items'] = $_SESSION['cartSession']['items'];
                }
            }
        }

        /** 如果有订购详情，则获取相应的商品信息：图片、库存
         */
        if( isset( $data['cart'] ) && isset( $data['cart']['items'] ) && count( $data['cart']['items'] ) > 0 )
        {
            foreach( $data['cart']['items'] as $index => $item )
            {
                $this->db->select('stock, manufacturer_name, type');
                $commodityInventoryModel = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $item['e_store_sku']
                ));
                $item['inventory'] = $commodityInventoryModel->row_array();

                $commodityModel = $this->db->get_where('t_warehouse_commodity', array(
                    'e_store_sku'   =>  $item['e_store_sku']
                ));
                $item['commodity'] = $commodityModel->row_array();

                $commodityRelatedMainPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                    'commodity_id'          =>  $item['commodity_id'],
                    'is_selected_to_show'   =>  'Y'
                ));
                $commodityRelatedMainPictureCombinationModel = $commodityRelatedMainPictureCombinationModelQuery->row_array();
                $commodityRelatedMainPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                    'id'                    =>  $commodityRelatedMainPictureCombinationModel['commodity_picture_id']
                ));
                $item['main_picture'] = $commodityRelatedMainPictureModelQuery->row_array();

                $data['cart']['items'][ $index ] = $item;

                $cartItemTotal += $item['qty_ordered'];
                $productTotal = count( $data['cart']['items'] );
            }
        }

        $data['cartItemTotal'] = $cartItemTotal;
        $data['productTotal'] = $productTotal;

        /** 开始：SEO 用途
         */
        $data['html_title'] = 'Check Out';
        /** 结束：SEO 用途
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  103
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

        $this->load->view('e_store/customer/my_cart', $data);
	}
	
}
