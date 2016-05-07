<?php

header("Content-type: text/html; charset=utf-8");

require_once 'application/class/warehouse/product/ProductBatchFile.php';
require_once 'util/myutils/JSONAlert.php';
require_once 'util/myutils/WarehouseCommodityUtil.php';
require_once 'util/phpexcel/PHPExcel.php';
require_once 'util/phpexcel/PHPExcel/IOFactory.php';


class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );

        $this->isCurrentManagerAdmin();
    }
    
    public function upload()
    {
        $jsonAlert = new JSONAlert();

        $file_element_name = 'productBatchFileInput';
        
        $config['upload_path'] = './upload/product_batch_file/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 1024 * 100;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name))
        {
            $jsonAlert->append(array(
                'errorMsg'=>$this->upload->display_errors('', '')
            ), TRUE);
        }
        else
        {
            $upload_data = $this->upload->data();
            $data = array(
                'file_name'=>$upload_data['file_name'],
                'file_name_ori'=>$this->input->post('title'),
                'upload_date'=>date("Y-m-d h:i:s")
            );

            $this->db->insert('t_warehouse_product_batch_file', $data);
            $file_id = $this->db->insert_id();
            if($file_id)
            {
                $jsonAlert->append(array(
                    'successMsg'=>'File successfully uploaded!'
                ), FALSE);
            }
            else
            {
                unlink($upload_data['full_path']);

                $jsonAlert->append(array(
                    'errorMsg'=>'Something went wrong when saving the file, please try again.'
                ), TRUE);
            }
        }
        echo $jsonAlert->result();
    }
    
    public function import()
    {
        $productBatchFile = new ProductBatchFile($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productBatchFile,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors)
        {
            $productBatchFileModelQuery = $this->db->get_where('t_warehouse_product_batch_file', array(
                'id'=>$productBatchFile->id
            ));
            $productBatchFileModel = $productBatchFileModelQuery->row_array();

            if( ! strcasecmp( $productBatchFileModel['is_imported'], 'Y' ) == 0 )
            {
                set_time_limit(0);
                @ini_set('memory_limit', '2048M');
                $input_file = "./upload/product_batch_file/".$productBatchFileModel['file_name'];
                $objPHPExcel = PHPExcel_IOFactory::load($input_file);

                // Read rules
                $sheet_read_arr = array();
                $colArr = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W");

                $sheets = $objPHPExcel->getSheetNames();
                foreach ($sheets as $sheet) {
                    $sheet_read_arr[$sheet] = $colArr;
                }

                $itemCodes = array();
                $products = array();

                // Loop all sheets
                foreach ($sheet_read_arr as $key => $val)
                {
                    $currentSheet = $objPHPExcel->getSheetByName($key);// Get current sheet by name
                    $row_num = $currentSheet!=null ? $currentSheet->getHighestRow() : 0;// Current sheet number

                    // Ignore the first row, starting from the second
                    for ($i = 2; $i <= $row_num; $i++)
                    {

                        $cell_values = array();

                        foreach ($val as $cell_val)
                        {

                            $address = $cell_val . $i;// Cells coordinate

                            // Read cells content
                            $cell_values[] = $currentSheet->getCell($address)->getFormattedValue();

                        }

                        $index = 0;

                        // Fields Index
                        $itemCodeIndex = 0; $manufacturerIndex = 1; $importedDateIndex = 2;
                        $productTypeIndex = 3; $locationIndex = 4; $priceIndex = 5;
                        $modelIndex = 6; $snIndex = 7; $processorIndex = 8; $processorSpeedIndex = 9;
                        $memSizeIndex = 10; $hddSizeIndex = 11; $opticalDriveIndex = 12;
                        $systemLicenseIndex = 13; $notesIndex = 14; $faultyIndex = 15; $performanceStatusIndex = 16;
                        $productStatusIndex = 17; $isPowerSupplyIndex = 18; $isWebCamIndex = 19;
                        $screenSizeIndex = 20; $jobNumberIndex = 21; $weightIndex = 22;

                        // Fields name
                        $itemCode; $manufacturer; $importedDate; $productType; $location; $price;
                        $model; $sn; $processor; $processorSpeed; $memSize; $hddSize; $opticalDrive;
                        $systemLicense; $notes; $faulty; $performanceStatus; $productStatus;
                        $isPowerSupply; $isWebCam; $screenSize; $jobNumber; $weight;

                        foreach ($cell_values as $cell_value)
                        {
                            switch ($index)
                            {
                                case $itemCodeIndex:
                                    $itemCode = trim($cell_value);
                                    break;
                                case $manufacturerIndex:
                                    $manufacturer = $cell_value;
                                    break;
                                case $importedDateIndex:
                                    if(!empty($cell_value) && isset($cell_value)){
                                        $dateStrArr = explode('-', $cell_value);
                                        $dateStr = $dateStrArr[2].'-'.$dateStrArr[0].'-'.$dateStrArr[1];
                                        $finalDate = date('Y-m-d', strtotime($dateStr));
                                        $importedDate = $finalDate;
                                    } else {
                                        $importedDate = null;
                                    }
                                    break;
                                case $productTypeIndex:
                                    $productType = $cell_value;
                                    break;
                                case $locationIndex:
                                    $location = $cell_value;
                                    break;
                                case $priceIndex:
                                    $price = $cell_value;
                                    break;
                                case $modelIndex:
                                    $model = $cell_value;
                                    break;
                                case $snIndex:
                                    $sn = $cell_value;
                                    break;
                                case $processorIndex:
                                    $processor = $cell_value;
                                    break;
                                case $processorSpeedIndex:
                                    $processorSpeed = $cell_value;
                                    break;
                                case $memSizeIndex:
                                    $memSize = $cell_value;
                                    break;
                                case $hddSizeIndex:
                                    $hddSize = $cell_value;
                                    break;
                                case $opticalDriveIndex:
                                    $opticalDrive = $cell_value;
                                    break;
                                case $systemLicenseIndex:
                                    $systemLicense = $cell_value;
                                    break;
                                case $notesIndex:
                                    $notes = $cell_value;
                                    break;
                                case $faultyIndex:
                                    $faulty = $cell_value;
                                    break;
                                case $performanceStatusIndex:
                                    $performanceStatus = $cell_value;
                                    break;
                                case $productStatusIndex:
                                    $productStatus = $cell_value;
                                    break;
                                case $isPowerSupplyIndex:
                                    $isPowerSupply = $cell_value;
                                    break;
                                case $isWebCamIndex:
                                    $isWebCam = $cell_value;
                                    break;
                                case $screenSizeIndex:
                                    $screenSize = $cell_value;
                                    break;
                                case $jobNumberIndex:
                                    $jobNumber = $cell_value;
                                    break;
                                case $weightIndex:
                                    $weight = $cell_value;
                                    break;
                            }
                            $index++;
                        }

                        if( trim( $itemCode ) == '' )
                        {
                            continue;
                        }

                        if( ! empty($jobNumber) )
                        {
                            $jobNumberModelQuery = $this->db->get_where('t_warehouse_product_job_number', array(
                                'name'=>$jobNumber
                            ));
                            if( $jobNumberModelQuery->num_rows() < 1 )
                            {
                                $this->db->insert('t_warehouse_product_job_number', array(
                                    'name'=>$jobNumber
                                ));
                            }
                        }

                        if( ! empty( $importedDate ) && isset( $importedDate ) )
                        {
                            array_push( $itemCodes, trim($itemCode) );
                            $product = array(
                                'item_code'=>trim($itemCode),
                                'manufacturer_name'=>trim($manufacturer),
                                'imported_date'=>$importedDate,
                                'type'=>trim($productType),
                                'location'=>trim($location),
                                'price'=>floatval(trim($price)),
                                'model'=>trim($model),
                                'sn'=>trim($sn),
                                'processor'=>empty($processor) ? 'None' : trim($processor),
                                'processor_speed'=>empty($processorSpeed) ? 'None' : trim($processorSpeed),
                                'mem_size'=>empty($memSize) ? 'None' : trim($memSize),
                                'hdd_size'=>empty($hddSize) ? 'None' : trim($hddSize),
                                'optical_drive'=>empty($opticalDrive) ? 'None' : trim($opticalDrive),
                                'system_license'=>empty($systemLicense) ? 'None' : trim($systemLicense),
                                'notes'=>trim($notes),
                                'faults'=>trim($faulty),
                                'product_batch_file_id'=>trim($productBatchFile->id),
                                'visual_status'=>'Fair wear and tear',
                                'performance_status'=>empty($performanceStatus) ? 'Good' : trim($performanceStatus),
                                'product_status'=>empty($productStatus) ? 'In Stock' : trim($productStatus),
                                'is_power_supply'=>trim($isPowerSupply),
                                'is_web_cam'=>trim($isWebCam),
                                'screen_size'=>trim($screenSize),
                                'job_number'=>trim($jobNumber),
                                'weight'=>intval(trim($weight))
                            );
                            array_push( $products, $product );
                        }
                        else
                        {
                            array_push( $itemCodes, $itemCode );
                            $product = array(
                                'item_code'=>trim($itemCode),
                                'manufacturer_name'=>trim($manufacturer),
                                'imported_date'=>null,
                                'type'=>trim($productType),
                                'location'=>trim($location),
                                'price'=>floatval(trim($price)),
                                'model'=>trim($model),
                                'sn'=>trim($sn),
                                'processor'=>empty($processor) ? 'None' : trim($processor),
                                'processor_speed'=>empty($processorSpeed) ? 'None' : trim($processorSpeed),
                                'mem_size'=>empty($memSize) ? 'None' : trim($memSize),
                                'hdd_size'=>empty($hddSize) ? 'None' : trim($hddSize),
                                'optical_drive'=>empty($opticalDrive) ? 'None' : trim($opticalDrive),
                                'system_license'=>empty($systemLicense) ? 'None' : trim($systemLicense),
                                'notes'=>trim($notes),
                                'faults'=>trim($faulty),
                                'product_batch_file_id'=>$productBatchFile->id,
                                'visual_status'=>'Fair wear and tear',
                                'performance_status'=>empty($performanceStatus) ? 'Good' : trim($performanceStatus),
                                'product_status'=>empty($productStatus) ? 'In Stock' : trim($productStatus),
                                'is_power_supply'=>trim($isPowerSupply),
                                'is_web_cam'=>trim($isWebCam),
                                'screen_size'=>trim($screenSize),
                                'job_number'=>trim($jobNumber),
                                'weight'=>intval(trim($weight))
                            );
                            array_push( $products, $product );
                        }

                    }
                }

                $duplicatedItemCodes = '';

                $item_code_check_arr = array();

                foreach ( $itemCodes as $index => $itemCode )
                {
                    $isItemCodeDuplicated = false;

                    if( $itemCode != '' )
                    {
                        /** 检查 Item Code 是否存在于数据库中
                         */
                        $productModelQuery = $this->db->get_where('t_warehouse_product', array(
                            'item_code'=>$itemCode
                        ));
                        if( $productModelQuery->num_rows() > 0 )
                        {
                            $isItemCodeDuplicated = true;
                        }

                        /** 检查 Item Code 是否存在于数组中
                         * 如果 Item Code 存在，则提醒
                         */
                        if( in_array( $itemCode, $item_code_check_arr ) )
                        {
                            $isItemCodeDuplicated = true;
                        }
                        else
                        {
                            array_push( $item_code_check_arr, $itemCode );
                        }

                        if( $isItemCodeDuplicated )
                        {
                            if( $duplicatedItemCodes != '' )
                            {
                                $duplicatedItemCodes .= ', ';
                            }
                            $duplicatedItemCodes .= $itemCode;
                        }
                    }
                }

                if( $duplicatedItemCodes != '' )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Item code '.$duplicatedItemCodes.' existed!'
                    ), TRUE);
                }
                else
                {
                    foreach ( $products as $product )
                    {
                        $this->db->insert('t_warehouse_product', $product);

                        $commodityInventoryOriginalWhere = array(
                            'type'              =>  $product['type'],           'manufacturer_name' =>  $product['manufacturer_name'],  'model'             =>  $product['model'],
                            'processor'         =>  $product['processor'],      'processor_speed'   =>  $product['processor_speed'],    'mem_size'          =>  $product['mem_size'],
                            'hdd_size'          =>  $product['hdd_size'],       'optical_drive'     =>  $product['optical_drive'],      'system_license'    =>  $product['system_license'],
                            'is_web_cam'        =>  $product['is_web_cam'],     'screen_size'       =>  $product['screen_size']
                        );

                        /** 如果是 Grade A，则有必要同步 EStore Commodity 及其 库存
                         */
                        if( strcasecmp( $product['performance_status'], 'Grade A' ) == 0 )
                        {
                            $config = array
                            (
                                'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                            );
                            WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                        }
                    }

                    // UPDATE is_imported to TRUE
                    $this->db->update('t_warehouse_product_batch_file', array(
                        'is_imported'=>'Y'
                    ), array(
                        'id'=>$productBatchFile->id
                    ));

                    $jsonAlert->append(array(
                        'successMsg'=>'Products successfully imported!'
                    ), FALSE);
                }
            }
            else
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Products already imported!'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
    }
    
    public function delete_product_by_batch_file_id()
    {
        $productBatchFile = new ProductBatchFile($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productBatchFile,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /* Check if product is Sold or Locked */
        $productModelsQuery = $this->db->get_where('t_warehouse_product', array(
            'product_batch_file_id'=>$productBatchFile->id
        ));
        $productModels = $productModelsQuery->result_object();
        if( $productModelsQuery->num_rows() > 0 )
        {
            foreach( $productModels as $productModel )
            {
                if
                (
                    strcasecmp( $productModel->is_ordered,'Y' )==0 ||
                    strcasecmp( $productModel->is_locked,'Y' )==0
                )
                {
                    $jsonAlert->append(array(
                        'errorMsg'=>'Contains Ordered or Locked product, could not be deleted!'
                    ), TRUE);
                }
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_warehouse_product', array(
                'product_batch_file_id'=>$productBatchFile->id
            ));

            // UPDATE is_imported to No
            $this->db->update('t_warehouse_product_batch_file', array(
                'is_imported' => 'N'
            ), array(
                'id'=>$productBatchFile->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Related product(s) successfully deleted!'
            ), FALSE);

            foreach( $productModels as $productModel )
            {
                $commodityInventoryOriginalWhere = array(
                    'type'              =>  $productModel->type,           'manufacturer_name' =>  $productModel->manufacturer_name,  'model'             =>  $productModel->model,
                    'processor'         =>  $productModel->processor,      'processor_speed'   =>  $productModel->processor_speed,    'mem_size'          =>  $productModel->mem_size,
                    'hdd_size'          =>  $productModel->hdd_size,       'optical_drive'     =>  $productModel->optical_drive,      'system_license'    =>  $productModel->system_license,
                    'is_web_cam'        =>  $productModel->is_web_cam,     'screen_size'       =>  $productModel->screen_size
                );

                /** 如果是 Grade A，则有必要同步 EStore Commodity 及其 库存
                 */
                if( strcasecmp( $productModel->performance_status, 'Grade A' ) == 0 )
                {
                    $config = array
                    (
                        'commodityInventoryOriginalWhere'     =>  $commodityInventoryOriginalWhere
                    );
                    WarehouseCommodityUtil::refresh_specified_original_and_target_commodity_inventory_stock( $jsonAlert, $this, $config );
                }
            }
        }

        echo $jsonAlert->result();
    }

    public function download_single_file_verify()
    {
        $productBatchFile = new ProductBatchFile($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$productBatchFile,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $productBatchFileModelQuery = $this->db->get_where('t_warehouse_product_batch_file', array(
            'id'    =>$productBatchFile->id
        ));
        if( $productBatchFileModelQuery->num_rows() > 0 )
        {
            $productBatchFileModel = $productBatchFileModelQuery->row_array();
            if( ! file_exists( "./upload/product_batch_file/" . $productBatchFileModel['file_name'] ) )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'File not exists!'
                ), TRUE);
            }
        }

        echo $jsonAlert->result();
    }

    public function download_single_file()
    {
        if( $this->isCurrentManagerAdmin() )
        {
            parse_str($_SERVER['QUERY_STRING'], $_GET);
            $productBatchFileModelQuery = $this->db->get_where('t_warehouse_product_batch_file', array(
                'id'    =>$_GET['id']
            ));
            if( $productBatchFileModelQuery->num_rows() > 0 )
            {
                $productBatchFileModel = $productBatchFileModelQuery->row_array();
                header('Content-Description: File Transfer');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="'.basename( $productBatchFileModel['file_name_ori'] ).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize( "./upload/product_batch_file/" . $productBatchFileModel['file_name'] ));
                readfile( "./upload/product_batch_file/" . $productBatchFileModel['file_name'] );
            }
            exit;
        }
    }
//    public function delete()
//    {
//
//	    $alertMap = '';
//	    $mapContent = array();
//	    $hasErrors = false;
//
//	    $product_batch_file_id = $this->input->post('product_batch_file_id');
//
//		$addSuccess =  array(
//				'alert-success'=>'Product batch file successfully deleted!'
//		);
//	    $alertMap = 'successMap';
//		$mapContent = array_merge($mapContent, $addSuccess);
//
//		$jsonAlert = array(
//		    $alertMap=>$mapContent,
//		    'hasErrors'=>$hasErrors
//		);
//		echo json_encode($jsonAlert);
//
//    }
	
}
