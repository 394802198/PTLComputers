<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }

	public function id( $wholesaler_id )
    {
        if( ! isset( $wholesaler_id ) ) header('Location:/manager');

        $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
            'id'=>$wholesaler_id
        ));
        if( $wholesalerModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['wholesaler'] = $wholesalerModelQuery->row_array();

        $this->load->view('manager/remarketing/wholesaler/edit',$data);
	}
	
}
