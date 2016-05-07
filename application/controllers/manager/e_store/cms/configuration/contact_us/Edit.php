<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager',
            'role' => 'administrator'
        );
        parent::__construct( $config );
    }
    
	public function index()
	{
        $cmsContactUsModelQuery = $this->db->get('t_e_store_cms_contact_us');
        $data['cmsContactUs'] = $cmsContactUsModelQuery->row_array();

        /** Address
         */
        $this->db->order_by('sequence');
        $addressObjQuery = $this->db->get('t_e_store_cms_contact_us_address');
        $data['addresses'] = $addressObjQuery->result_object();

        /** Number
         */
        $this->db->order_by('sequence');
        $numberObjQuery = $this->db->get('t_e_store_cms_contact_us_number');
        $data['numbers'] = $numberObjQuery->result_object();

        /** Email
         */
        $this->db->order_by('sequence');
        $emailObjQuery = $this->db->get('t_e_store_cms_contact_us_email');
        $data['emails'] = $emailObjQuery->result_object();

        /** Working Hour
         */
        $this->db->order_by('sequence');
        $workingHourObjQuery = $this->db->get('t_e_store_cms_contact_us_working_hour');
        $data['workingHours'] = $workingHourObjQuery->result_object();

        $this->load->view('manager/e_store/cms/configuration/contact_us/edit', $data);
	}
}
