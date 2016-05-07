<?php 

class Home extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $coreStatus = $this->db->get( 't_core_status' );
        $data['coreStatus'] = $coreStatus->row_array();

        /* Get Notification Deatils */
        /* Remarketing Module */
        $this->db->where( 'order_status', 'pending' );
        $pendingOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['pendingOrderCount'] = $pendingOrderCount;
        $this->db->where( 'order_status', 'processing' );
        $processingOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['processingOrderCount'] = $processingOrderCount;
        $this->db->where( 'order_status', 'waiting_for_shipment' );
        $waitingForShipmentOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['waitingForShipmentOrderCount'] = $waitingForShipmentOrderCount;
        $this->db->where( 'order_status', 'shipped' );
        $shippedOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['shippedOrderCount'] = $shippedOrderCount;
        $this->db->where( 'order_status', 'completed' );
        $completeOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['completeOrderCount'] = $completeOrderCount;
        $this->db->where( 'order_status', 'cancelled' );
        $cancelledOrderCount = $this->db->count_all_results( 't_remarketing_order' );
        $data['cancelledOrderCount'] = $cancelledOrderCount;

        /* EStore Module */
        $paymentGatewayButUnpaidOrderObjQuery = $this->db->select('id')
            ->where('payment_method', 1)
            ->where('payment_status', 1)
            ->get('t_e_store_order');

        $finalNotInOrderIds = array();
        if( $paymentGatewayButUnpaidOrderObjQuery->num_rows() > 0 )
        {
            $paymentGatewayButUnpaidOrderObj = $paymentGatewayButUnpaidOrderObjQuery->result_object();
            foreach( $paymentGatewayButUnpaidOrderObj as $paymentGatewayButUnpaidOrder )
            {
                array_push( $finalNotInOrderIds, $paymentGatewayButUnpaidOrder->id );
            }
        }
        $this->db->where( 'order_status', 1 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $pendingOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['pendingOrderCountEStore'] = $pendingOrderCountEStore;
        $this->db->where( 'order_status', 2 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $processingOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['processingOrderCountEStore'] = $processingOrderCountEStore;
        $this->db->where( 'order_status', 3 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $waitingForShipmentOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['waitingForShipmentOrderCountEStore'] = $waitingForShipmentOrderCountEStore;
        $this->db->where( 'order_status', 4 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $shippedOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['shippedOrderCountEStore'] = $shippedOrderCountEStore;
        $this->db->where( 'order_status', 5 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $completeOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['completeOrderCountEStore'] = $completeOrderCountEStore;
        $this->db->where( 'order_status', 6 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $cancelledOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['cancelledOrderCountEStore'] = $cancelledOrderCountEStore;
        $this->db->where( 'order_status', 7 );
        if( count( $finalNotInOrderIds ) > 0 )
        {
            $this->db->where_not_in('id', $finalNotInOrderIds);
        }
        $refundedOrderCountEStore = $this->db->count_all_results( 't_e_store_order' );
        $data['refundedOrderCountEStore'] = $refundedOrderCountEStore;


        /* Service Module */
        $this->db->where('status', 100);
        $newRecordCountService = $this->db->count_all_results('t_service_record');
        $data['newRecordCountService'] = $newRecordCountService;
        $this->db->where('status', 101);
        $processingRecordCountService = $this->db->count_all_results('t_service_record');
        $data['processingRecordCountService'] = $processingRecordCountService;
        $this->db->where('status', 102);
        $successRecordCountService = $this->db->count_all_results('t_service_record');
        $data['successRecordCountService'] = $successRecordCountService;
        $this->db->where('status', 103);
        $shippedRecordCountService = $this->db->count_all_results('t_service_record');
        $data['shippedRecordCountService'] = $shippedRecordCountService;
        $this->db->where('status', 104);
        $failedRecordCountService = $this->db->count_all_results('t_service_record');
        $data['failedRecordCountService'] = $failedRecordCountService;
        $this->db->where('status', 105);
        $cancelledRecordCountService = $this->db->count_all_results('t_service_record');
        $data['cancelledRecordCountService'] = $cancelledRecordCountService;


		$this->load->view('manager/home', $data);
	}
	
}
