<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: Dec 2015
 */

require_once 'application/class/warehouse/commodity/Commodity.php';
require_once 'util/myutils/MyUtils.php';

class WarehouseCommodityUtil
{
    /**
     * @param $jsonAlert
     * @param $CThis
     * @param $config
     * @param bool $isMsgShown
     */
    public static function refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $CThis, $config, $isMsgShown = true )
    {
        $CThis->db->trans_begin();

        if( isset( $config['commodityInventoryOriginalWhere'] ) )
        {
            WarehouseCommodityUtil::refresh_specified_commodity_inventory_stock( $jsonAlert, $CThis, $config['commodityInventoryOriginalWhere'] );
        }
        if( isset( $config['commodityInventoryTargetWhere'] ) )
        {
            WarehouseCommodityUtil::refresh_specified_commodity_inventory_stock( $jsonAlert, $CThis, $config['commodityInventoryTargetWhere'] );
        }

        if ( $CThis->db->trans_status() === FALSE  )
        {
            $CThis->db->trans_rollback();
        }
        else
        {
            $CThis->db->trans_commit();
        }
    }

    public static function refresh_specified_commodity_inventory_stock( $jsonAlert, $CThis, $commodityInventoryWhere, $isInStock = true )
    {
        $CThis->db->select('COUNT(*) stock, `price`, `weight`, `job_number`, `location`, `type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `is_power_supply`, `visual_status`, `performance_status`, `optical_drive`, `system_license`, `is_web_cam`, `screen_size`');
        $CThis->db->where('product_status', 'In Stock');
        $CThis->db->where('performance_status', 'Grade A');
        $CThis->db->where('is_locked !=', 'Y');
        $CThis->db->where('is_ordered !=', 'Y');
        $CThis->db->where( $commodityInventoryWhere );
        $CThis->db->group_by("`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`");
        $productObjectQuery = $CThis->db->get('t_warehouse_product');
        $productObject = $productObjectQuery->result_object();
        $productModel = $productObjectQuery->row_array();

        /** 获取非自建【商品库存】
         */
        $nonSelfCreatedCommodityInventoryModelWhere = array(
            'is_self_created'   =>  'N',
            'type'          =>  $commodityInventoryWhere['type'],       'manufacturer_name' =>  $commodityInventoryWhere['manufacturer_name'],  'model'             =>  $commodityInventoryWhere['model'],
            'processor'     =>  $commodityInventoryWhere['processor'],  'processor_speed'   =>  $commodityInventoryWhere['processor_speed'],    'mem_size'          =>  $commodityInventoryWhere['mem_size'],
            'hdd_size'      =>  $commodityInventoryWhere['hdd_size'],   'optical_drive'     =>  $commodityInventoryWhere['optical_drive'],      'system_license'    =>  $commodityInventoryWhere['system_license'],
            'is_web_cam'    =>  $commodityInventoryWhere['is_web_cam'], 'screen_size'       =>  $commodityInventoryWhere['screen_size']
        );

        $nonSelfCreatedCommodityInventoryModelQuery = $CThis->db->get_where( 't_warehouse_commodity_inventory', $nonSelfCreatedCommodityInventoryModelWhere );

        /** 存在，则更新
         */
        if( $nonSelfCreatedCommodityInventoryModelQuery->num_rows() > 0 )
        {
            /** 如果库存为空，则为 0 库存
             */
            $productModel['stock']    =   isset( $productModel['stock'] ) && $isInStock ? $productModel['stock'] : 0;
            $CThis->db->update( 't_warehouse_commodity_inventory', array( 'stock' => $productModel['stock'] ), $nonSelfCreatedCommodityInventoryModelWhere );

        }
        /** 不存在，则插入
         */
        else
        {
            $commodity = new Commodity();
            WarehouseCommodityUtil::setNewCommoditiesAndInventories( $productObject, $commodity, $isInStock );
            WarehouseCommodityUtil::addLocationAndTypeAndManufacturerAndCommodityAndInventory( $CThis, $commodity );
        }
    }


    /** 更新 Remarketing【产品】现有库存至 EStore【商品库存】中，并保存产品信息至【商品】中
     * @param $jsonAlert
     * @param $CThis
     * @param bool $isMsgShown
     */
    public static function refresh_warehouse_commodity( $jsonAlert, $CThis, $isMsgShown = true )
    {
        $CThis->db->trans_begin();
        /** 获取非自建【商品库存】
         */
        $nonSelfCreatedCommodityInventoryModelQuery = $CThis->db->get_where('t_warehouse_commodity_inventory', array(
            'is_self_created'   =>'N'
        ));

        /** 如果没有非自建【商品库存】
         */
        if( $nonSelfCreatedCommodityInventoryModelQuery->num_rows() < 1 )
        {
            /** 分组获取与【商品库存】匹配且【E店SKU】为空的【产品】，将取得的每一类产品总数增添至【商品库存】中，并保存产品信息至【商品】中
             */

            /** 先存储没有库存的【产品】至【商品】及【库存】表
             */
            $CThis->db->select('`price`, `weight`, `job_number`, `location`, `type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `is_power_supply`, `visual_status`, `performance_status`, `optical_drive`, `system_license`, `is_web_cam`, `screen_size`');
            $CThis->db->where('product_status !=', 'In stock');
            $CThis->db->where('performance_status', 'Grade A');
            $CThis->db->group_by("`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`");
            $outOfStockProductObjectsQuery = $CThis->db->get('t_warehouse_product');
            $outOfStockProductObjects = $outOfStockProductObjectsQuery->result_object();
            $outOfStockCommodity = new Commodity();
            WarehouseCommodityUtil::setNewCommoditiesAndInventories( $outOfStockProductObjects, $outOfStockCommodity, false );
            WarehouseCommodityUtil::addLocationAndTypeAndManufacturerAndCommodityAndInventory( $CThis, $outOfStockCommodity );


            /** 再存储有库存的【产品】至【商品】及【库存】表
             */
            $CThis->db->select('COUNT(*) stock, `price`, `weight`, `job_number`, `location`, `type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `is_power_supply`, `visual_status`, `performance_status`, `optical_drive`, `system_license`, `is_web_cam`, `screen_size`');
            $CThis->db->where('product_status', 'In Stock');
            $CThis->db->where('is_locked !=', 'Y');
            $CThis->db->where('is_ordered !=', 'Y');
            $CThis->db->where('performance_status', 'Grade A');
            $CThis->db->group_by("`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`");
            $inStockProductObjectsQuery = $CThis->db->get('t_warehouse_product');
            $inStockProductObjects = $inStockProductObjectsQuery->result_object();
            $inStockCommodity = new Commodity();
            WarehouseCommodityUtil::setNewCommoditiesAndInventories( $inStockProductObjects, $inStockCommodity, true );
            WarehouseCommodityUtil::addLocationAndTypeAndManufacturerAndCommodityAndInventory( $CThis, $inStockCommodity );

            if ( $CThis->db->trans_status() === FALSE  )
            {
                $CThis->db->trans_rollback();
            }
            else
            {
                $jsonAlert->append(array(
                    'successMsg'=>'Remarketing Products and Commodities and Inventories Successfully Synchronized!'
                ), FALSE);

                $CThis->db->trans_commit();
            }
        }
        else
        {
            $jsonAlert->append(array(
                'errorMsg'=>'This function could only be use at when the amount of Commodity Inventory is Less Than 1!'
            ), TRUE);
        }
    }

    public static function addLocationAndTypeAndManufacturerAndCommodityAndInventory( $CThis, $commodity )
    {
        /** 暂存和最终数据
         */
        $tmpLocations                  = array();
        $tmpTypes                      = array();
        $tmpManufacturers              = array();
        $finalLocations                = array();
        $finalTypes                    = array();
        $finalManufacturers            = array();

        /** 封装数组
         */
        foreach( $commodity->commoditiesAndInventories as $commodityAndInventory )
        {
            if( isset( $commodityAndInventory['commodity']['location'] ) )
            {
                array_push( $tmpLocations, $commodityAndInventory['commodity']['location'] );
            }
            if( isset( $commodityAndInventory['commodity']['type'] ) )
            {
                array_push( $tmpTypes, $commodityAndInventory['commodity']['type'] );
            }
            if( isset( $commodityAndInventory['commodity']['manufacturer'] ) )
            {
                array_push( $tmpManufacturers, $commodityAndInventory['commodity']['manufacturer'] );
            }
        }

        /** 地址、类型、厂家去重
         */
        $tmpLocations      = array_unique( $tmpLocations );
        $tmpTypes          = array_unique( $tmpTypes );
        $tmpManufacturers  = array_unique( $tmpManufacturers );

        if( count( $tmpLocations ) > 0 )
        {
            foreach( $tmpLocations as $tmpLocation )
            {
                $commodityLocationModelQuery = $CThis->db->get_where('t_warehouse_commodity_location', array(
                    'name'      =>  $tmpLocation
                ));
                /** 数据库中没有，则保存为最终数据
                 */
                if( $commodityLocationModelQuery->num_rows() < 1 )
                {
                    array_push( $finalLocations, array(
                        'name'  =>  $tmpLocation
                    ) );
                }
            }
            if( count( $finalLocations ) > 0 )
            {
                $CThis->db->insert_batch( 't_warehouse_commodity_location', $finalLocations );
            }
        }

        if( count( $tmpTypes ) > 0 )
        {
            foreach( $tmpTypes as $tmpType )
            {
                $commodityTypeModelQuery = $CThis->db->get_where('t_warehouse_commodity_type', array(
                    'name'      =>  $tmpType
                ));
                /** 数据库中没有，则保存为最终数据
                 */
                if( $commodityTypeModelQuery->num_rows() < 1 )
                {
                    array_push( $finalTypes, array(
                        'name'  =>  $tmpType
                    ) );
                }
            }
            if( count( $finalTypes ) > 0 )
            {
                $CThis->db->insert_batch( 't_warehouse_commodity_type', $finalTypes );
            }
        }

        if( count( $tmpManufacturers ) > 0 )
        {
            foreach( $tmpManufacturers as $tmpManufacturer )
            {
                $commodityManufacturerModelQuery = $CThis->db->get_where('t_warehouse_commodity_manufacturer', array(
                    'name'      =>  $tmpManufacturer
                ));
                /** 数据库中没有，则保存为最终数据
                 */
                if( $commodityManufacturerModelQuery->num_rows() < 1 )
                {
                    array_push( $finalManufacturers, array(
                        'name'  =>  $tmpManufacturer
                    ) );
                }
            }
            if( count( $finalManufacturers ) > 0 )
            {
                $CThis->db->insert_batch( 't_warehouse_commodity_manufacturer', $finalManufacturers );
            }
        }

        $insertableCommodities = array();
        $insertableCommodityInventories = array();

        if( count( $commodity->commoditiesAndInventories ) > 0 )
        {
            foreach( $commodity->commoditiesAndInventories as $commodityAndInventory )
            {
                /** 获取非自建【商品库存】
                 */
                $nonSelfCreatedCommodityInventoryModelWhere = array(
                    'is_self_created'   =>  'N',
                    'type'              =>  $commodityAndInventory['commodityInventory']['type'],           'manufacturer_name' =>  $commodityAndInventory['commodityInventory']['manufacturer_name'],  'model'             =>  $commodityAndInventory['commodityInventory']['model'],
                    'processor'         =>  $commodityAndInventory['commodityInventory']['processor'],      'processor_speed'   =>  $commodityAndInventory['commodityInventory']['processor_speed'],    'mem_size'          =>  $commodityAndInventory['commodityInventory']['mem_size'],
                    'hdd_size'          =>  $commodityAndInventory['commodityInventory']['hdd_size'],       'optical_drive'     =>  $commodityAndInventory['commodityInventory']['optical_drive'],      'system_license'    =>  $commodityAndInventory['commodityInventory']['system_license'],
                    'is_web_cam'        =>  $commodityAndInventory['commodityInventory']['is_web_cam'],     'screen_size'       =>  $commodityAndInventory['commodityInventory']['screen_size']
                );

                $nonSelfCreatedCommodityInventoryModelQuery = $CThis->db->get_where( 't_warehouse_commodity_inventory', $nonSelfCreatedCommodityInventoryModelWhere );

                /** 存在，则更新
                 */
                if( $nonSelfCreatedCommodityInventoryModelQuery->num_rows() > 0 )
                {
                    /** 如果库存为空，则为 0 库存
                     */
                    $CThis->db->update( 't_warehouse_commodity_inventory', array( 'stock' => $commodityAndInventory['commodityInventory']['stock'] ), $nonSelfCreatedCommodityInventoryModelWhere );
                }
                /** 不存在，则插入
                 */
                else
                {
                    array_push( $insertableCommodities, $commodityAndInventory['commodity'] );
                    array_push( $insertableCommodityInventories, $commodityAndInventory['commodityInventory'] );
                }
            }

            /** 商品库存
             */
            if( count( $insertableCommodityInventories ) > 0 )
            {
                $CThis->db->insert_batch( 't_warehouse_commodity_inventory', $insertableCommodityInventories );

                /** 商品
                 */
                if( count( $insertableCommodities ) > 0 )
                {
                    $CThis->db->insert_batch( 't_warehouse_commodity', $insertableCommodities );
                }
            }
        }
    }

    public static function setNewCommoditiesAndInventories( $productObjects, $commodity, $isInStock = false )
    {

        $commoditiesAndInventories = array();

        /** 生成 ESTORE + 6个随机大写字母 + 毫秒级时间戳 + 6个随机大写字母 结构的 E 店SKU
         */
        foreach( $productObjects as $productObject )
        {
            /** 准备好 EStore Sku
             */
            $e_store_sku = $e_store_sku = 'ESTORE' . ( microtime(true) * 10000 ) . MyUtils::r_str( 3, 'A-Z0-9' );

            /** 开始：设置【商品】信息
             */

            $short_description = $productObject->manufacturer_name;

            $ul_begin = '<ul>';
            $li = '<li>Manufacturer: ' . $productObject->manufacturer_name . '</li>';
            $li .= '<li>Type: ' . $productObject->type . '</li>';
            if( $productObject->model && $productObject->model != 'None' && strcasecmp( $productObject->model, 'N/A' ) != 0 ) { $li .= '<li>Model: ' . $productObject->model . '</li>'; $short_description .= ', ' . $productObject->model; }
            if( $productObject->processor && $productObject->processor != 'None' && strcasecmp( $productObject->processor, 'N/A' ) != 0 ) { $li .= '<li>Processor: ' . $productObject->processor . '</li>'; $short_description .= ', ' . $productObject->processor; }
            if( $productObject->processor_speed && $productObject->processor_speed != 'None' && strcasecmp( $productObject->processor_speed, 'N/A' ) != 0 ) { $li .= '<li>Processor Speed: ' . $productObject->processor_speed . '</li>'; $short_description .= '/' . $productObject->processor_speed; }
            if( $productObject->mem_size && $productObject->mem_size != 'None' && strcasecmp( $productObject->mem_size, 'N/A' ) != 0 ) { $li .= '<li>Mem Size: ' . $productObject->mem_size . '</li>'; $short_description .= '/' . $productObject->mem_size; }
            if( $productObject->hdd_size && $productObject->hdd_size != 'None' && strcasecmp( $productObject->hdd_size, 'N/A' ) != 0 ) { $li .= '<li>HDD Size: ' . $productObject->hdd_size . '</li>'; $short_description .= '/' . $productObject->hdd_size; }
            if( $productObject->is_power_supply && $productObject->is_power_supply != 'N' && strcasecmp( $productObject->is_power_supply, 'N/A' ) != 0 ) { $li .= '<li>Power Supply: YES</li>'; }
            if( $productObject->visual_status && $productObject->visual_status != 'None' && strcasecmp( $productObject->visual_status, 'N/A' ) != 0 ) { $li .= '<li>Visual Status: ' . $productObject->visual_status . '</li>'; }
            if( $productObject->performance_status && $productObject->performance_status != 'None' && strcasecmp( $productObject->performance_status, 'N/A' ) != 0 ) { $li .= '<li>Performance Status: ' . $productObject->performance_status . '</li>'; }
            if( $productObject->optical_drive && $productObject->optical_drive != 'None' && strcasecmp( $productObject->optical_drive, 'N/A' ) != 0 ) { $li .= '<li>Optical Drive: ' . $productObject->optical_drive . '</li>'; $short_description .= '/' . $productObject->optical_drive; }
            if( $productObject->system_license && $productObject->system_license != 'None' && strcasecmp( $productObject->system_license, 'N/A' ) != 0 ) { $li .= '<li>System License: ' . $productObject->system_license . '</li>'; $short_description .= '/' . $productObject->system_license; }
            if( $productObject->screen_size && $productObject->screen_size != 'None' && strcasecmp( $productObject->screen_size, 'N/A' ) != 0 ) { $li .= '<li>Screen Size: ' . $productObject->screen_size . '</li>'; $short_description .= '/' . $productObject->screen_size; }
            if( $productObject->is_web_cam && $productObject->is_web_cam != 'N' && strcasecmp( $productObject->is_web_cam, 'N/A' ) != 0 ) { $li .= '<li>Web Cam: YES</li>'; $short_description .= '/Web Cam'; }
            $ul_end = '</ul>';
            $commodity_description = $ul_begin . $li . $ul_end;

            $commodityArrModel = array(
                'e_store_sku'           =>  $e_store_sku,
                'name'                  =>  $productObject->manufacturer_name . ' - ' . $productObject->type . ' - ' . $productObject->model,
                'price'                 =>  $productObject->price,
                'weight'                =>  $productObject->weight,
                'location'              =>  trim( $productObject->location ),
                'manufacturer'          =>  trim( $productObject->manufacturer_name ),
                'type'                  =>  trim( $productObject->type ),
                'description'           =>  $commodity_description,
                'short_description'     =>  $short_description
            );
            /** 结束：设置【商品】信息
             */

            /** 开始：设置【商品库存】信息
             */

            $commodityInventoryModel = array(
                'e_store_sku'           =>  $e_store_sku,
                'stock'                 =>  $isInStock ? $productObject->stock : 0,
                'price'                 =>  $productObject->price,
                'job_number'            =>  $productObject->job_number,
                'weight'                =>  $productObject->weight,
                'location'              =>  trim( $productObject->location ),
                'type'                  =>  trim( $productObject->type ),
                'manufacturer_name'     =>  trim( $productObject->manufacturer_name ),
                'model'                 =>  $productObject->model,
                'processor'             =>  $productObject->processor,
                'processor_speed'       =>  $productObject->processor_speed,
                'mem_size'              =>  $productObject->mem_size,
                'hdd_size'              =>  $productObject->hdd_size,
                'is_power_supply'       =>  $productObject->is_power_supply,
                'visual_status'         =>  $productObject->visual_status,
                'performance_status'    =>  $productObject->performance_status,
                'optical_drive'         =>  $productObject->optical_drive,
                'system_license'        =>  $productObject->system_license,
                'is_web_cam'            =>  $productObject->is_web_cam,
                'screen_size'           =>  $productObject->screen_size
            );
            /** 结束：设置【商品库存】信息
             */

            array_push( $commoditiesAndInventories, array(
                'commodity'             =>  $commodityArrModel,
                'commodityInventory'    =>  $commodityInventoryModel
            ) );
        }

        $commodity->commoditiesAndInventories = $commoditiesAndInventories;
    }
}