<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $carousel_id )
    {
	    if( ! isset( $carousel_id ) ) header('Location:/manager');

        $cmsCarouselModelQuery = $this->db->get_where('t_e_store_cms_carousel', array(
            'id'=>$carousel_id
        ));
        $data['carousel'] = $cmsCarouselModelQuery->row_array();

        $this->load->view('manager/e_store/cms/component/carousel/edit',$data);
	}
	
}
