<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function id( $courier_id )
    {
	    if( ! isset( $courier_id ) ) header('Location:/manager');

        $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
            'id'=>$courier_id
        ));
        $data['courier'] = $courierModelQuery->row_array();
        $this->load->view('manager/warehouse/logistic/courier/edit',$data);
	}

}
