<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $external_service_provider_id )
    {
	    if( ! isset( $external_service_provider_id ) ) header('Location:/manager');

        $externalServiceProviderModelQuery = $this->db->get_where('t_service_external_service_provider', array(
            'id'=>$external_service_provider_id
        ));
        $data['externalServiceProvider'] = $externalServiceProviderModelQuery->row_array();

        $this->load->view('manager/service/external_service_provider/edit',$data);
	}
	
}
