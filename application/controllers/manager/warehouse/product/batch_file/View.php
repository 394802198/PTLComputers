<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $this->isCurrentManagerAdmin();

        $this->db->order_by('file_name_ori', 'ASC');
        $productBatchFileModelQuery = $this->db->get('t_warehouse_product_batch_file');
        $productFinalBatchFilesArray = array();
        $productExistBatchFilesArray = array();
        $productNonExistBatchFilesArray = array();
        if( $productBatchFileModelQuery->num_rows() > 0 )
        {
            $productBatchFilesModel = $productBatchFileModelQuery->result_object();
            foreach( $productBatchFilesModel as $productBatchFileModel )
            {
                $productBatchFileModel->is_file_existed = file_exists( "./upload/product_batch_file/" . $productBatchFileModel->file_name ) ? 'Y' : 'N';
                if( file_exists( "./upload/product_batch_file/" . $productBatchFileModel->file_name ) )
                {
                    array_push( $productExistBatchFilesArray, $productBatchFileModel );
                }
                else
                {
                    array_push( $productNonExistBatchFilesArray, $productBatchFileModel );
                }
            }
            $productExistBatchFilesArray = array_merge( $productExistBatchFilesArray, $productNonExistBatchFilesArray );
            $productFinalBatchFilesArray = array_merge( $productFinalBatchFilesArray, $productExistBatchFilesArray );
        }
        $data['productBatchFiles'] = $productFinalBatchFilesArray;
        $this->load->view('manager/warehouse/product/batch_file/view',$data);
	}
	
}
