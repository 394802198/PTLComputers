<?php 

class View_By extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'wholesaler'
        );
        parent::__construct( $config );
    }

	// View By Id
	public function id( $order_id )
	{
        if( ! $order_id) header('Location:/remarketing/home');

	    $wholesaler_id = $_SESSION['wholesaler']['id'];

        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'wholesaler_id'=>$wholesaler_id,
            'id'=>$order_id
        ));
        $data['order'] = $orderModelQuery->row_array();
        
        if( $orderModelQuery->num_rows() > 0 )
        {
            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'=>$order_id
            ));
            $data['orderDetails'] = $orderDetailModelQuery->result_object();

            $managerModelQuery = $this->db->get_where('t_core_manager', array(
                'id' => $data['order']['manager_id']
            ));
            $data['manager'] = $managerModelQuery->row_array();

            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'id' => $data['order']['courier_id']
            ));
            $data['courier'] = $courierModelQuery->row_array();

            $this->db->where('order_id', $order_id);
            $data['orderDetailCount'] = $this->db->count_all_results('t_remarketing_order_detail');
        
            $this->load->view('remarketing/order/view_by_id',$data);
        }
        else
        {
            $this->load->view('remarketing/home');
        }
	}
	
}
