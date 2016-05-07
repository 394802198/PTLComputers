<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $product_status_id )
    {
	    if(!isset($product_status_id)) header('Location:/manager');

        $productStatusModelQuery = $this->db->get_where('t_warehouse_product_status', array(
            'id' => $product_status_id
        ));
        $data['productStatus'] = $productStatusModelQuery->row_array();
        $this->load->view('manager/warehouse/product/status/edit',$data);
	    
	}
	
}
