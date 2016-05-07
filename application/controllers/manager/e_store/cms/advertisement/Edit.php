<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $advertisement_id )
    {
	    if( ! isset( $advertisement_id ) ) header('Location:/manager');

        $cmsAdvertisementModelQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'id'=>$advertisement_id
        ));
        $data['advertisement'] = $cmsAdvertisementModelQuery->row_array();

        $this->load->view('manager/e_store/cms/advertisement/edit',$data);
	}
	
}
