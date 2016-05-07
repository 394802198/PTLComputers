<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';
require_once 'application/class/warehouse/commodity/Commodity.php';
require_once 'util/myutils/CIPagination.php';

class Search extends CI_Controller {
    
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


        $initConfig = array(
            'base_url'          =>  '/e_store/commodity/search',
            'num_links'         =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-info'),
            'CThis'             =>  $this,
            'Model'             =>  'Commodity',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$PRECISE_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$STRICT_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
               'type', 'manufacturer', 'status',  'price_range', 'keyword'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        /** 开始：SEO 用途
         */
        $html_title = 'Searching for ';
        $html_keywords = '';
        /** 结束：SEO 用途
         */

        if( $ciPagination->model->type )
        {
            $ciPagination->appendStrictPredicate( 'type = \'' . $ciPagination->model->type . '\'' );

            /** 开始：SEO 用途
             */
            if( $html_title != 'Searching for ' )
            {
                $html_title .= ' - ';
            }
            $html_title .= 'Type: ' . $ciPagination->model->type;
            if( $html_keywords != '' )
            {
                $html_keywords .= ',';
            }
            $html_keywords .= $ciPagination->model->type;
            /** 结束：SEO 用途
             */
        }
        if( $ciPagination->model->manufacturer  )
        {
            $ciPagination->appendStrictPredicate( 'manufacturer = \'' . $ciPagination->model->manufacturer . '\'' );

            /** 开始：SEO 用途
             */
            if( $html_title != 'Searching for ' )
            {
                $html_title .= ' - ';
            }
            $html_title .= 'Manufacturer: ' . $ciPagination->model->manufacturer;
            if( $html_keywords != '' )
            {
                $html_keywords .= ',';
            }
            $html_keywords .= $ciPagination->model->manufacturer;
            /** 结束：SEO 用途
             */
        }

        if( $ciPagination->model->price_range )
        {
            /** 如果是某个价位以上的
             */
            if( strpos( $ciPagination->model->price_range, '>' ) !== false )
            {
                $priceArr = explode( ">", $ciPagination->model->price_range );
                $ciPagination->appendStrictPredicate('`price` > ' . $priceArr[1] );
            }
            else
            {
                $priceRange = explode( "-", $ciPagination->model->price_range );
                $ciPagination->appendStrictPredicate( '`price` BETWEEN ' . $priceRange[ 0 ] . ' AND ' . $priceRange[ 1 ] );
            }

            /** 开始：SEO 用途
             */
            if( $html_title != 'Searching for ' )
            {
                $html_title .= ' - ';
            }
            $html_title .= 'Price Range: ' . $ciPagination->model->price_range;
            if( $html_keywords != '' )
            {
                $html_keywords .= ',';
            }
            $html_keywords .= $ciPagination->model->price_range;
            /** 结束：SEO 用途
             */
        }

        if( $ciPagination->model->keyword )
        {
            $keyword = $ciPagination->model->keyword;

            $this->db
                ->where('is_on_shelf', 'Y')
                ->group_start()
                    ->like('e_store_sku', $keyword)
                    ->or_like('name', $keyword)
                    ->or_like('manufacturer', $keyword)
                    ->or_like('type', $keyword)
                ->group_end()
                ->select('id');
            $commodityObjQuery = $this->db->get('t_warehouse_commodity');

            $commodityIds = array();
            if( $commodityObjQuery->num_rows() > 0 )
            {
                $commodityObj = $commodityObjQuery->result_object();
                foreach( $commodityObj as $commodity )
                {
                    array_push( $commodityIds, $commodity->id );
                }
            }

            /** 开始：SEO 用途
             */
            if( $html_title != 'Searching for ' )
            {
                $html_title .= ' - ';
            }
            $html_title .= 'Keyword: ' . $ciPagination->model->keyword;
            if( $html_keywords != '' )
            {
                $html_keywords .= ',';
            }
            $html_keywords .= $ciPagination->model->keyword;
            /** 结束：SEO 用途
             */

            $ciPagination->in('id', $commodityIds);
        }


        /** 设置搜索显示数量
         */
        $search_visible_per_page = 20;
        $commodityConfigurationModelQuery = $this->db->get('t_warehouse_commodity_configuration');
        if( $commodityConfigurationModelQuery->num_rows() > 0 )
        {
            $commodityConfigurationModel = $commodityConfigurationModelQuery->row_array();
            $search_visible_per_page = isset( $commodityConfigurationModel['search_visible_per_page'] ) ? $commodityConfigurationModel['search_visible_per_page'] : $search_visible_per_page;
        }

        /** 开始：初始化分页参数
         */
        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_warehouse_commodity',

            'selectedRows'        =>  array(
                'id', 'e_store_sku', 'name', 'price', 'short_description', 'type', 'manufacturer', 'is_on_sale'
            ),

            /* Optional params */
            'num_per_page'      =>  $search_visible_per_page,
            'order_by'          =>  'id DESC',
            'where_in'=>array(
                array(
                    'field'=>'is_on_shelf',
                    'values'=>array('Y')
                )
            ),
        );
        $ciPagination->initialize( $pageConfig );
        /** 结束：初始化分页参数
         */


        /** 开始：匹配库存
         */
        $commodities = $ciPagination->content;
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
        /** 结束：匹配库存
         */

//        var_dump( $ciPagination::$DEBUG_GET_CONTENT_QUERY );

        $data['ciPagination'] = $ciPagination;

        /** 开始：SEO 用途
         */
        if( $html_title == 'Searching for ' )
        {
            $html_title .= 'all';
        }
        $data['html_title'] = $html_title;
        $data['html_keywords'] = $html_keywords ? $html_keywords : 'PC,Personal Computer,Laptop,Desktop,Software,Hardware,Repairing,Services,Remarketing,Wholesale';
        /** 结束：SEO 用途
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  101
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

        $this->load->view('e_store/commodity/search', $data);
	}
	
}
