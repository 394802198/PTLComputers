<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }
    
	public function index()
	{
        $wholesalerModelQuery = $this->db->get('t_remarketing_wholesaler');
        $data['wholesalers'] = $wholesalerModelQuery->result_object();

        $this->load->view('manager/remarketing/wholesaler/view',$data);
	}

}
