<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    public function id( $shipment_id )
    {
        if( ! isset( $shipment_id ) ) header('Location:/manager/home');

        $shipmentModelQuery = $this->db->get_where('t_warehouse_remarketing_shipment', array(
            'id'=>$shipment_id
        ));

        if( $shipmentModelQuery->num_rows() > 0 )
        {
            $shipmentModel = $shipmentModelQuery->row_array();
            $data['shipment'] = $shipmentModel;

            $shipmentItemModelQuery = $this->db->get_where('t_warehouse_remarketing_shipment_item', array(
                'shipment_id'   =>  $shipmentModel['id']
            ));
            $data['shipment']['items'] = $shipmentItemModelQuery->result_object();

            $orderModelQuery = $this->db->get_where('t_remarketing_order', array(
                'id'=>$shipmentModel['order_id']
            ));
            $orderModel = $orderModelQuery->row_array();
            $data['order'] = $orderModel;

            $orderDetailModelQuery = $this->db->get_where('t_remarketing_order_detail', array(
                'order_id'=>$orderModel['id']
            ));
            $data['orderDetails'] = $orderDetailModelQuery->result_object();

            $managerModelQuery = $this->db->get_where('t_core_manager', array(
                'id' => $orderModel['manager_id']
            ));
            $data['manager'] = $managerModelQuery->row_array();

            $this->db->where('order_id', $orderModel['id']);
            $data['orderDetailCount'] = $this->db->count_all_results('t_remarketing_order_detail');

            $couriersModelQuery = $this->db->get_where('t_warehouse_courier', array(
                'status'    => 1
            ));
            $data['couriers'] = $couriersModelQuery->result_object();

            $this->load->view('manager/remarketing/shipment/edit',$data);
        }
        else
        {
            header('Location:/manager/home');
        }

    }
	
}
