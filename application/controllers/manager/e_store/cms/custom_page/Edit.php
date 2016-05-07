<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $custom_page_id )
    {
	    if( ! isset( $custom_page_id ) ) header('Location:/manager');

        $cmsCustomPageModelQuery = $this->db->get_where('t_e_store_cms_custom_page', array(
            'id'=>$custom_page_id
        ));
        $data['customPage'] = $cmsCustomPageModelQuery->row_array();

        $this->load->view('manager/e_store/cms/custom_page/edit',$data);
	}
	
}
