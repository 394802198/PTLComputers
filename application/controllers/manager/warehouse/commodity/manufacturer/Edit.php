<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $manufacturer_id )
    {
	    if( !isset($manufacturer_id) ) header('Location:/manager');

        $manufacturerModelQuery = $this->db->get_where('t_warehouse_commodity_manufacturer', array(
            'id'=>$manufacturer_id
        ));
        $data['manufacturer'] = $manufacturerModelQuery->row_array();
        $this->load->view('manager/warehouse/commodity/manufacturer/edit',$data);
	}
	
}
