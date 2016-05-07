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

        $orderModelQuery = $this->db->get_where('t_e_store_order', array(
            'id'=>$order_id
        ));
        $data['order'] = $orderModelQuery->row_array();
        
        if($orderModelQuery->num_rows() > 0)
        {
            $order = $data['order'];

            $orderItemModelQuery = $this->db->get_where('t_e_store_order_item', array(
                'order_id'=>$order['id']
            ));
            $data['orderItems'] = $orderItemModelQuery->result_object();

            $courierModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'id' => $data['order']['courier_id']
            ));
            $data['courier'] = $courierModelQuery->row_array();

            $this->db->select_sum('qty_ordered');
            $this->db->where('order_id', $order_id);
            $data['orderItemCount'] = $this->db->get('t_e_store_order_item')->row()->qty_ordered;
            
            $this->load->view('manager/e_store/order/edit',$data);
        }
        else
        {
            header('Location:/manager/home');
        }
	    
	}
	
}
