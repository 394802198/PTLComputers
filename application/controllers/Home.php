<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */



        /** 开始：匹配心愿单
         */
//        if( ! isset( $_SESSION ) ) session_start();
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            $wishListObjQuery = $this->db
                ->select('commodity_id')
                ->get_where('t_e_store_wish_list', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $wishListObjQuery->num_rows() > 0 )
            {
                $data['wishListObj'] = $wishListObjQuery->result_object();
            }
        }
        /** 结束：匹配心愿单
         */

        /** 头部底端轮播器
         */
        $this->db->order_by('sequence');
        $cmsCarouselHeaderBottomObjQuery = $this->db->get_where('t_e_store_cms_carousel', array(
            'page_type'     =>  100,
            'position'      =>  104,
            'is_visible'    =>  'Y'
        ));
        if( $cmsCarouselHeaderBottomObjQuery->num_rows() > 0 )
        {
            $data['carouselHeaderBottomObj'] = $cmsCarouselHeaderBottomObjQuery->result_object();
        }


        /** 设置首页显示数量
         */
        $home_visible_per_page = 10;
        $commodityConfigurationModelQuery = $this->db->get('t_warehouse_commodity_configuration');
        if( $commodityConfigurationModelQuery->num_rows() > 0 )
        {
            $commodityConfigurationModel = $commodityConfigurationModelQuery->row_array();
            $home_visible_per_page = isset( $commodityConfigurationModel['home_visible_per_page'] ) ? $commodityConfigurationModel['home_visible_per_page'] : $home_visible_per_page;
        }

        $this->db->order_by('sequence DESC');
        $this->db->where('is_on_shelf', 'Y');
        $commodityObjQuery = $this->db->get('t_warehouse_commodity', $home_visible_per_page);
        $commodities = $commodityObjQuery->result_object();
        if( $commodities != null )
        {
            foreach( $commodities as $commodity )
            {
                $this->db->select('stock');
                $commodityInventoryModel = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $commodity->e_store_sku
                ));
                $commodity->inventory = $commodityInventoryModel->row_array();

                $commodityRelatedMainPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                    'commodity_id'          =>  $commodity->id,
                    'is_selected_to_show'   =>  'Y'
                ));
                $commodityRelatedMainPictureCombinationModel = $commodityRelatedMainPictureCombinationModelQuery->row_array();
                $commodityRelatedMainPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                    'id'                    =>  $commodityRelatedMainPictureCombinationModel['commodity_picture_id']
                ));
                $commodity->main_picture = $commodityRelatedMainPictureModelQuery->row_array();
            }
        }
        $data['commodities'] = $commodities;

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  100
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

        $this->load->view('e_store/home', $data);
	}
}
