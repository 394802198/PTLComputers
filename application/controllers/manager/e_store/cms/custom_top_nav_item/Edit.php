<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $custom_top_nav_item_id )
    {
	    if( ! isset( $custom_top_nav_item_id ) ) header('Location:/manager');

        $cmsCustomTopNavItemModelQuery = $this->db->get_where('t_e_store_cms_custom_top_nav_item', array(
            'id'=>$custom_top_nav_item_id
        ));
        $data['customTopNavItem'] = $cmsCustomTopNavItemModelQuery->row_array();

        $this->load->view('manager/e_store/cms/custom_top_nav_item/edit',$data);
	}
	
}
