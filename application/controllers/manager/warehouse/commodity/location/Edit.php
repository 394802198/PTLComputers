<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $location_id )
    {
	    if( !isset($location_id) ) header('Location:/manager');

        $locationModelQuery = $this->db->get_where('t_warehouse_commodity_location', array(
            'id'=>$location_id
        ));
        $data['location'] = $locationModelQuery->row_array();
        $this->load->view('manager/warehouse/commodity/location/edit',$data);
	}
	
}
