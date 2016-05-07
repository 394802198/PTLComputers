<?php

class CICartUtil
{
    public static function add2Cart( $jsonAlert, $stock, $cartItem, $cart, $commodityModel )
    {
        $returnedData = [];
        $isAnyItemUpdated = false;
        $totalQtyOrdered = 0;
        $updatableItems = array();
        $insertableItems = array();

        $isNewToCartItemStockEnough = false;
        $isNewToCartItem = true;
        $isInCartItemStockEnough = false;

        /** 没有购物车详情
         */
        if( ! $cart || ! isset( $cart['items'] ) || count( $cart['items'] ) < 1 )
        {
            /** 小于等于库存，则可以添加
             */
            if ( $cartItem->qty_ordered <= $stock )
            {
                /** 新增的商品库存足够
                 */
                $isNewToCartItemStockEnough = true;

                $item = array(
                    'cart_id'               =>      isset( $cart['id'] ) ? $cart['id'] : '',
                    'commodity_id'          =>      $commodityModel['id'],
                    'e_store_sku'           =>      $commodityModel['e_store_sku'],
                    'is_e_store_created'    =>      $commodityModel['is_e_store_created'],
                    'name'                  =>      $commodityModel['name'],
                    'unit_weight'           =>      $commodityModel['weight'],
                    'unit_price'            =>      $commodityModel['price'],
                    'qty_ordered'           =>      intval( $cartItem->qty_ordered )
                );

                $cart['items'] = array( $item );

                array_push( $insertableItems, $item );
            }
        }
        else
        {
            foreach ( $cart['items'] as $index => $item )
            {
                /** 如果匹配到
                 */
                if ( $cartItem->commodity_id == $item['commodity_id'] )
                {
                    /** 不是新增
                     */
                    $isNewToCartItem = false;

                    /** 小于等于库存，则可以添加
                     */
                    if ( ( $item['qty_ordered'] + $cartItem->qty_ordered ) <= $stock )
                    {
                        /** 更新订购数量的商品库存足够
                         */
                        $isInCartItemStockEnough = true;

                        $cart['items'][ $index ]['qty_ordered'] += $cartItem->qty_ordered;

                        array_push( $updatableItems, $cart['items'][ $index ] );
                    }
                }
            }

            /** 如果是新增
             */
            if ( $isNewToCartItem )
            {
                if ( $cartItem->qty_ordered <= $stock )
                {
                    /** 新增的商品库存足够
                     */
                    $isNewToCartItemStockEnough = true;

                    $item = array(
                        'cart_id'               =>      isset( $cart['id'] ) ? $cart['id'] : '',
                        'commodity_id'          =>      $commodityModel['id'],
                        'e_store_sku'           =>      $commodityModel['e_store_sku'],
                        'is_e_store_created'    =>      $commodityModel['is_e_store_created'],
                        'name'                  =>      $commodityModel['name'],
                        'unit_weight'           =>      $commodityModel['weight'],
                        'unit_price'            =>      $commodityModel['price'],
                        'qty_ordered'           =>      $cartItem->qty_ordered
                    );

                    array_push( $cart['items'], $item );

                    array_push( $insertableItems, $item );
                }
            }
        }

        /** 新增或更新订购数量成功
         */
        if
        (
            ( $isNewToCartItem && $isNewToCartItemStockEnough ) ||
            ( ! $isNewToCartItem && $isInCartItemStockEnough )
        )
        {
            /** 新增或更改订购数量也算更新购物车
             */
            $isAnyItemUpdated = true;

            /** 最近更新时间
             */
            $cart['last_update'] = date("Y-m-d h:i:s");

            /** 访客购物车订购总数
             */
            foreach( $cart['items'] as $item )
            {
                $totalQtyOrdered += $item['qty_ordered'];
            }

            $jsonAlert->append(array(
                'successMsg' => 'Product added into your cart'
            ), FALSE);
        }
        else
        {
            /** 库存不足，订购一个时的错误
             */
            if ( $cartItem->qty_ordered == 1 )
            {
                $jsonAlert->append(array(
                    'errorMsg' => 'You have put the maximum of this product\'s stock to your cart, try <a href="/e_store/commodity/search?type=' . $commodityModel['type'] . '&manufacturer=' . $commodityModel['manufacturer'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
            /** 订购多个时的错误
             */
            else
            {
                $jsonAlert->append(array(
                    'errorMsg' => 'The quantity you trying to purchase exceeding the maximum of this product\'s stock, please minimize Purchase Qty to match the stock maybe plus the one that contained in the cart if existed or, try <a href="/e_store/commodity/search?type=' . $commodityModel['type'] . '&manufacturer=' . $commodityModel['manufacturer'] . '" class="btn btn-xs btn-success" style="font-weight:bold;"><i class="fa fa-cubes"></i> similar products</a>'
                ), TRUE);
            }
        }

        $returnedData['isAnyItemUpdated']   =   $isAnyItemUpdated;
        $returnedData['totalQtyOrdered']    =   $totalQtyOrdered;
        $returnedData['cart']               =   $cart;
        $returnedData['cartOnly']           =   array(
            'id'            =>      isset( $cart['id'] ) ? $cart['id'] : null,
            'customer_id'   =>      isset( $cart['customer_id'] ) ? $cart['customer_id'] : null,
            'create_time'   =>      $cart['create_time'],
            'last_update'   =>      $cart['last_update']
        );
        $returnedData['updatableItems']     =   $updatableItems;
        $returnedData['insertableItems']    =   $insertableItems;

        return $returnedData;
    }
}