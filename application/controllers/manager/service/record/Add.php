<?php 

class Add extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $externalServiceProviderObjQuery = $this->db->get('t_service_external_service_provider');
        $data['externalServiceProviders'] = $externalServiceProviderObjQuery->result_object();

	    $this->load->view( 'manager/service/record/add', $data);
	}
}
