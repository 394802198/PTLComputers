<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function id( $commodity_picture_id )
    {
	    if( ! isset( $commodity_picture_id ) ) header('Location:/manager');

        $commodityPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
            'id'=>$commodity_picture_id
        ));
        $data['commodityPicture'] = $commodityPictureModelQuery->row_array();

        $commodityManufacturersModelQuery = $this->db->get('t_warehouse_commodity_manufacturer');
        $commodityTypesModelQuery = $this->db->get('t_warehouse_commodity_type');
        $data['manufacturers'] = $commodityManufacturersModelQuery->result_object();
        $data['types'] = $commodityTypesModelQuery->result_object();

        $this->load->view('manager/warehouse/commodity/picture/edit',$data);
	}
	
}
