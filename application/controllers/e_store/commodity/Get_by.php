<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';
require_once 'application/class/warehouse/commodity/Commodity.php';
require_once 'util/myutils/CIPagination.php';

class Get_By extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function e_store_sku( $e_store_sku )
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        /** 开始：匹配心愿单
         */
        if( ! isset( $_SESSION ) ) session_start();
        if( isset( $_SESSION['customer'] ) )
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

        $is_commodity_found = true;

        if( ! $e_store_sku )
        {
            $is_commodity_found = false;
        }
        else
        {
            $commodityArrQuery = $this->db->get_where('t_warehouse_commodity', array(
                'e_store_sku'   =>  $e_store_sku
            ));
            if( $commodityArrQuery->num_rows() > 0 )
            {
                $commodityArr = $commodityArrQuery->row_array();

                /** 开始：匹配库存
                 */
                $this->db->select('stock, model, location');
                $commodityInventoryModel = $this->db->get_where('t_warehouse_commodity_inventory', array(
                    'e_store_sku'   =>  $commodityArr['e_store_sku']
                ));
                $commodityArr['inventory'] = $commodityInventoryModel->row_array();
                /** 结束：匹配库存
                 */


                /** 开始：获取主图
                 */
                $this->db->select('commodity_picture_id');
                $commodityRelatedMainPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                    'commodity_id'          =>  $commodityArr['id'],
                    'is_selected_to_show'   =>  'Y'
                ));
                $commodityRelatedMainPictureCombinationModel = $commodityRelatedMainPictureCombinationModelQuery->row_array();
                $this->db->select('id, pic_path');
                $commodityRelatedMainPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                    'id'                    =>  $commodityRelatedMainPictureCombinationModel['commodity_picture_id']
                ));
                $commodityArr['main_picture'] = $commodityRelatedMainPictureModelQuery->row_array();
                /** 结束：获取主图
                 */


                /** 开始：获取所有图片
                 */
                $this->db->select('commodity_picture_id');
                $commodityRelatedPictureCombinationObjQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                    'commodity_id'          =>  $commodityArr['id']
                ));
                $commodityRelatedPictureCombinationObj = $commodityRelatedPictureCombinationObjQuery->result_object();

                $commodity_picture_ids = array();
                if( $commodityRelatedPictureCombinationObjQuery->num_rows() > 0 )
                {
                    foreach( $commodityRelatedPictureCombinationObj as $commodityRelatedPictureCombination )
                    {
                        array_push( $commodity_picture_ids, $commodityRelatedPictureCombination->commodity_picture_id );
                    }
                    $this->db->where_in('id', $commodity_picture_ids);
                    $this->db->select('id, pic_path');
                    $commodityRelatedMainPictureObjQuery = $this->db->get_where('t_warehouse_commodity_picture');
                    $commodityRelatedMainPictureObj = $commodityRelatedMainPictureObjQuery->result_object();
                    $commodityArr['pictures'] = $commodityRelatedMainPictureObj;
                }
                /** 结束：获取所有图片
                 */

                $data['commodity'] = $commodityArr;
            }
            else
            {
                $is_commodity_found = false;
            }
        }

        if( ! $is_commodity_found )
        {
            header('Location:/e_store/commodity/search');
        }

        /** 开始：SEO 用途
         */
        $data['html_title'] = $data['commodity']['name'];
        $data['html_description'] = str_replace( '  ', ', ', trim( strip_tags( str_replace( '<', ' <', $data['commodity']['description'] ) ) ) );
        $data['html_keywords'] = $data['commodity']['type'] . ',' . $data['commodity']['manufacturer'] . ',' . $data['commodity']['inventory']['model'];
        /** 结束：SEO 用途
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  102
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

        $this->load->view('e_store/commodity/detail', $data);
	}
	
}
