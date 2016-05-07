<?php

require_once 'application/class/warehouse/commodity/CommodityType.php';
require_once 'util/myutils/JSONAlert.php';

class Session_Less extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function getManufacturersByType()
	{
        $commodityType = new CommodityType($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$commodityType,
                'check_empty'=>array(
                    'name'=>'Type Name Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $typeManufacturerObjectsQuery = $this->db
                ->distinct('manufacturer')
                ->select('manufacturer')
                ->where('type', $commodityType->name)
                ->order_by('manufacturer')
                ->get('t_warehouse_commodity');
            $jsonAlert->model = $typeManufacturerObjectsQuery->result_object();
        }

        echo $jsonAlert->result();
	}

    public function getManufacturers()
    {
        $manufacturerObjectsQuery = $this->db
            ->distinct('manufacturer')
            ->select('manufacturer')
            ->order_by('manufacturer')
            ->get('t_warehouse_commodity');
        $manufacturerObjects = $manufacturerObjectsQuery->result_object();

        echo json_encode( $manufacturerObjects );
    }
	
}
