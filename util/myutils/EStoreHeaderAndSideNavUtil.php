<?php

class EStoreHeaderAndSideNavUtil
{
    public static function init( $CThis )
    {
        /** 如果 Core Status 的 estore_state 为 maintain，则跳转至 maintaining 界面
         */
        $is_available_for_view = true;

        /** 如果不是后台人员，则需要判断 EStore 是否处在维护中
         */
        if( ! isset( $_SESSION['manager'] ) )
        {
            $coreStatusModelQuery = $CThis->db->get('t_core_status');
            if( $coreStatusModelQuery->num_rows() > 0 )
            {
                $coreStatusModel = $coreStatusModelQuery->row_array();
                if( isset( $coreStatusModel['estore_state'] ) && strcasecmp( $coreStatusModel['estore_state'], 'maintain' )==0 )
                {
                    $is_available_for_view = false;
                }
            }
        }

        if( ! $is_available_for_view )
        {
            header('Location:' . ROOT_PATH . '/e_store/maintaining');
        }

        if( ! isset( $_SESSION ) ) session_start();

        /** 开始：可定制顶部导航条
         */
        $customTopNavItemObjQuery = $CThis->db
            ->order_by('sequence, name')
            ->get_where('t_e_store_cms_custom_top_nav_item', array(
                'is_visible'    =>  'Y'
            ));
        $data['customTopNavItems'] = $customTopNavItemObjQuery->result_object();
        /** 结束：可定制顶部导航条
         */

        /** 开始：导航条
         */
        define( "MAXIMUM_CHARACTER_LEN", 71 );
        define( "MAXIMUM_TYPE_QTY", 7 );
        $realTypesCharacterLen = 0;

        $shownTypes = array();
        $etcTypes = array();

        $typeObjectsQuery = $CThis->db
            ->select('name')
            ->distinct('name')
            ->order_by('sequence, id ASC')
            ->get('t_warehouse_commodity_type');
        $typeObjects = $typeObjectsQuery->result_object();

        foreach( $typeObjects as $typeObject )
        {
            $typeManufacturerObjectsQuery = $CThis->db
                ->distinct('manufacturer')
                ->select('manufacturer')
                ->where('type', $typeObject->name)
                ->order_by('manufacturer')
                ->get('t_warehouse_commodity');
            $typeObject->manufacturerObjects = $typeManufacturerObjectsQuery->result_object();

            $currentTypeCharacters = strlen( $typeObject->name );
            if
            (
                /** 实际【字符总数】跟【当前类型】
                 */
                ( $realTypesCharacterLen + $currentTypeCharacters ) <= MAXIMUM_CHARACTER_LEN &&
                count( $shownTypes ) <= MAXIMUM_TYPE_QTY
            )
            {
                /** 默认显示的【商品类型】及该类型所对应的各【商品厂家】
                 */
                array_push( $shownTypes, $typeObject );

                $realTypesCharacterLen += $currentTypeCharacters;
            }
            else
            {
                /** 等等等默认隐藏的【商品类型】及该类型所对应的各【商品厂家】
                 */
                array_push( $etcTypes, $typeObject );
            }
        }

        $manufacturerObjectsQuery = $CThis->db
            ->distinct('manufacturer')
            ->select('manufacturer')
            ->order_by('manufacturer')
            ->get('t_warehouse_commodity');
        $manufacturerObjects = $manufacturerObjectsQuery->result_object();

        $data['types'] = $typeObjects;
        $data['manufacturers'] = $manufacturerObjects;
        $data['etcTypes'] = $etcTypes;
        $data['shownTypes'] = $shownTypes;
        /** 结束：导航条
         */

        /** 开始：心愿单 和 购物车
         */
        $cartTotal = 0;
        $favouriteTotal = 0;

        /** 如果是会员，统计数据库数据
         */
        if( isset( $_SESSION['customer'] ) && isset( $_SESSION['customer']['id'] ) )
        {
            /** 统计心愿单
             */
            $CThis->db->where(array(
                't1.customer_id'   =>  $_SESSION['customer']['id']
            ));
            $CThis->db->join('( SELECT e_store_sku FROM t_warehouse_commodity ) t2', 't2.e_store_sku = t1.e_store_sku ');
            $favouriteTotal = $CThis->db->count_all_results('t_e_store_wish_list t1');

            /** 统计购物车
             */
            $cartModelQuery = $CThis->db->get_where('t_e_store_cart', array(
                'customer_id'   =>  $_SESSION['customer']['id']
            ));
            if( $cartModelQuery->num_rows() > 0 )
            {
                $cartModel = $cartModelQuery->row_array();
                $cartItemsObjQuery = $CThis->db->get_where('t_e_store_cart_item', array(
                    'cart_id'   =>  $cartModel['id']
                ));
                /** 如果有订购详情
                 */
                if( $cartItemsObjQuery->num_rows() > 0 )
                {
                    $cartItemsObj = $cartItemsObjQuery->result_object();
                    foreach( $cartItemsObj as $cartItem )
                    {
                        $cartTotal += $cartItem->qty_ordered;
                    }
                }
            }
        }
        /** 否则是访客，统计 SESSION 数据
         */
        else
        {
            /** 如果有订购详情
             */
            if( isset( $_SESSION['cartSession'] ) && isset( $_SESSION['cartSession']['items'] ) )
            {
                $items = $_SESSION['cartSession']['items'];
                foreach( $items as $item )
                {
                    $cartTotal += $item['qty_ordered'];
                }
            }
        }

        $data['cartTotal'] = $cartTotal;
        $data['favouriteTotal'] = $favouriteTotal;
        /** 结束：心愿单 和 购物车
         */

        /** 开始：页脚链接
         */
        $nonCustomTypePageObjQuery = $CThis->db->get_where('t_e_store_cms_custom_page', array(
            'page_type != ' =>  100
        ));
        if( $nonCustomTypePageObjQuery->num_rows() > 0 )
        {
            $nonCustomTypePageObj = $nonCustomTypePageObjQuery->result_object();
            foreach( $nonCustomTypePageObj as $nonCustomTypePage )
            {
                switch( $nonCustomTypePage->page_type )
                {
                    case 101 :
                        $data['aboutUsUrl'] = ROOT_PATH . '/e_store/page/hash/' . $nonCustomTypePage->hash_token;
                        $data['aboutUsName'] = $nonCustomTypePage->page_name;
                        break;
                    case 102 :
                        $data['whereToBuyUrl'] = ROOT_PATH . '/e_store/page/hash/' . $nonCustomTypePage->hash_token;
                        $data['whereToBuyName'] = $nonCustomTypePage->page_name;
                        break;
                    case 103 :
                        $data['termsConditionsUrl'] = ROOT_PATH . '/e_store/page/hash/' . $nonCustomTypePage->hash_token;
                        $data['termsConditionsName'] = $nonCustomTypePage->page_name;
                        break;
                    case 104 :
                        $data['returnsUrl'] = ROOT_PATH . '/e_store/page/hash/' . $nonCustomTypePage->hash_token;
                        $data['returnsName'] = $nonCustomTypePage->page_name;
                        break;
                    case 105 :
                        $data['servicesUrl'] = ROOT_PATH . '/e_store/page/hash/' . $nonCustomTypePage->hash_token;
                        $data['servicesName'] = $nonCustomTypePage->page_name;
                        break;
                }
            }
        }
        /** 结束：页脚链接
         */

        return $data;
    }
}