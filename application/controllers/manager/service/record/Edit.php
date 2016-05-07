<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $record_id )
    {
	    if( ! isset( $record_id ) ) header('Location:/manager');

        $recordModelQuery = $this->db->get_where('t_service_record', array(
            'id'=>$record_id
        ));
        $data['record'] = $recordModelQuery->row_array();

        $externalServiceProviderObjQuery = $this->db->get('t_service_external_service_provider');
        $data['externalServiceProviders'] = $externalServiceProviderObjQuery->result_object();

        $this->load->view('manager/service/record/edit',$data);
	}
	
}
