<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $order_id )
    {
	    if( ! isset($order_id) ) header('Location:/manager/home');

        $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
            'id'=>$order_id
        ));
        $data['order'] = $orderModelQuery->row_array();
        
        if($orderModelQuery->num_rows() > 0)
        {
            $order = $data['order'];

            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'=>$order['id']
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
            
            $this->load->view('manager/remarketing/order/edit',$data);
        }
        else
        {
            header('Location:/manager/home');
        }
	    
	}
	
}
