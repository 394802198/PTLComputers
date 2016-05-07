<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	public function index()
	{
	    $wholesaler_id = $_SESSION['wholesaler']['id'];
        $this->db->order_by('id desc');
        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'wholesaler_id'=>$wholesaler_id
        ));
        $data['orders'] = $orderModelQuery->result_object();
        $this->db->where(array(
            'wholesaler_id'=>$wholesaler_id
        ));
        $this->db->from('t_remarketing_order');
        $data['total_rows'] = $this->db->count_all_results();
        $this->load->view('remarketing/order/view',$data);
	}
}
