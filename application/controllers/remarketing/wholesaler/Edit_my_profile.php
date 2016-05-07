<?php 

class Edit_My_Profile extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function index()
    {
        $wholesalerModelQuery = $this->db->get_where('t_remarketing_wholesaler', array(
            'id' => $_SESSION['wholesaler']['id']
        ));
        $data['wholesaler'] = $wholesalerModelQuery->row_array();
        $this->load->view('remarketing/wholesaler/edit_my_profile',$data);
	}
}
