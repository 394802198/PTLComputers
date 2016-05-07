<?php
/**
 * Created by PhpStorm.
 * User: Steven Chen
 * Date: Feb 2016
 */

class Remarketing_Product_model extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function edit_product_by_condition( $finalData, $finalWhere, $jsonAlert )
    {
        $this->db->trans_begin();


        /** 检查传入的数据是否与库存同步息息相关
         */
        $is_any_field_related_to_stock_synchronization = false;
        $fields_related_to_stock_synchronization = array(
            'type', 'manufacturer_name', 'model', 'processor', 'processor_speed', 'mem_size', 'hdd_size', 'optical_drive', 'system_license', 'is_web_cam', 'screen_size'
        );
        foreach( $fields_related_to_stock_synchronization as $field_related_to_stock_synchronization )
        {
            if( array_key_exists( $field_related_to_stock_synchronization, $finalWhere ) || array_key_exists( $field_related_to_stock_synchronization, $finalData ) )
            {
                $is_any_field_related_to_stock_synchronization = true;
                break;
            }
        }

        /** 如果传入的数据与库存同步息息相关
         */
        if( $is_any_field_related_to_stock_synchronization )
        {
            $this->db->select('`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`');
            $this->db->where('product_status', 'In Stock');
            $this->db->where('performance_status', 'Grade A');
            $this->db->where('is_locked !=', 'Y');
            $this->db->where('is_ordered !=', 'Y');
            $this->db->group_by("`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`");
            $whereProductObjQuery = $this->db->get_where('t_warehouse_product', $finalWhere);

            if( $whereProductObjQuery->num_rows() > 0 )
            {
                $whereProductObj = $whereProductObjQuery->result_object();

                foreach( $whereProductObj as $whereProduct )
                {
                    $commodityInventoryWhere = array(
                        'type'          =>  $whereProduct->type,        'manufacturer_name' =>  $whereProduct->manufacturer_name,   'model'             =>  $whereProduct->model,
                        'processor'     =>  $whereProduct->processor,   'processor_speed'   =>  $whereProduct->processor_speed,     'mem_size'          =>  $whereProduct->mem_size,
                        'hdd_size'      =>  $whereProduct->hdd_size,    'optical_drive'     =>  $whereProduct->optical_drive,       'system_license'    =>  $whereProduct->system_license,
                        'is_web_cam'    =>  $whereProduct->is_web_cam,  'screen_size'       =>  $whereProduct->screen_size
                    );
                    WarehouseCommodityUtil::refresh_specified_commodity_inventory_stock( $jsonAlert, $this, $commodityInventoryWhere, false );
                }
            }
        }

        /** 待 Condition 的执行完毕，则可以执行 Data 的 EStore 库存同步
         */
        $this->db->update('t_warehouse_product', $finalData, $finalWhere);

        /** 如果传入的数据与库存同步息息相关
         */
        if( $is_any_field_related_to_stock_synchronization )
        {
            $this->db->select('`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`');
            $this->db->where('product_status', 'In Stock');
            $this->db->where('performance_status', 'Grade A');
            $this->db->where('is_locked !=', 'Y');
            $this->db->where('is_ordered !=', 'Y');
            $this->db->group_by("`type`, `manufacturer_name`, `model`, `processor`, `processor_speed`, `mem_size`, `hdd_size`, `optical_drive`, `system_license` , `is_web_cam`, `screen_size`");
            $dataProductObjQuery = $this->db->get_where('t_warehouse_product', $finalData);

            if( $dataProductObjQuery->num_rows() > 0 )
            {
                $dataProductObj = $dataProductObjQuery->result_object();

                foreach( $dataProductObj as $dataProduct )
                {
                    $commodityInventoryWhere = array(
                        'type'          =>  $dataProduct->type,        'manufacturer_name' =>  $dataProduct->manufacturer_name,   'model'             =>  $dataProduct->model,
                        'processor'     =>  $dataProduct->processor,   'processor_speed'   =>  $dataProduct->processor_speed,     'mem_size'          =>  $dataProduct->mem_size,
                        'hdd_size'      =>  $dataProduct->hdd_size,    'optical_drive'     =>  $dataProduct->optical_drive,       'system_license'    =>  $dataProduct->system_license,
                        'is_web_cam'    =>  $dataProduct->is_web_cam,  'screen_size'       =>  $dataProduct->screen_size
                    );
                    WarehouseCommodityUtil::refresh_specified_commodity_inventory_stock( $jsonAlert, $this, $commodityInventoryWhere );
                }
            }
        }

        $jsonAlert->append(array(
            'successMsg'=>'Final data updated!'
        ), FALSE);

        if ( $this->db->trans_status() === FALSE )
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
    }

}