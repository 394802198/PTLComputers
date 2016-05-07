<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $screen_size_id )
    {
	    if( !isset($screen_size_id) ) header('Location:/manager');

        $screenSizeModelQuery = $this->db->get_where('t_warehouse_product_screen_size', array(
            'id'=>$screen_size_id
        ));
        $data['screenSize'] = $screenSizeModelQuery->row_array();
        $this->load->view('manager/warehouse/product/screen_size/edit',$data);
	}
	
}
