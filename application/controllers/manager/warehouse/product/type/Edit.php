<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $type_id )
    {
	    if(!isset($type_id)) header('Location:/manager');

        $typeModelQuery = $this->db->get_where('t_warehouse_product_type', array(
            'id'=>$type_id
        ));
        $data['type'] = $typeModelQuery->row_array();
        $this->load->view('manager/warehouse/product/type/edit',$data);
	    
	}
	
}
