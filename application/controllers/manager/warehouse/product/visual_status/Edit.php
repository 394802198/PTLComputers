<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $visual_status_id )
    {
	    if(!isset($visual_status_id)) header('Location:/manager');

        $productVisualStatusModelQuery = $this->db->get_where('t_warehouse_product_visual_status', array(
            'id'=>$visual_status_id
        ));
        $data['visualStatus'] = $productVisualStatusModelQuery->row_array();
        $this->load->view('manager/warehouse/product/visual_status/edit',$data);
	    
	}
	
}
