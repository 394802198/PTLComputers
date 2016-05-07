<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $screenSizeModelQuery = $this->db->get('t_warehouse_product_screen_size');
        $data['screenSizes'] = $screenSizeModelQuery->result_object();
        $this->load->view('manager/warehouse/product/screen_size/view',$data);
	}
}
