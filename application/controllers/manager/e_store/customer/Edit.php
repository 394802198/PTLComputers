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

	public function id( $customer_id )
    {
        if( ! isset( $customer_id ) ) header('Location:/manager');

        $customerModelQuery = $this->db->get_where('t_e_store_customer', array(
            'id'=>$customer_id
        ));
        if( $customerModelQuery->num_rows() < 1 )
        {
            header('Location:/manager');
        }
        $data['customer'] = $customerModelQuery->row_array();

        $this->load->view('manager/e_store/customer/edit',$data);
	}
	
}
