<?php 

class Edit extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }
    
	public function id( $commodity_id )
    {
	    if( ! isset( $commodity_id ) ) header('Location:/manager');

        $locationModelQuery = $this->db->get('t_warehouse_commodity_location');
        $data['locations'] = $locationModelQuery->result_object();
        $manufacturerModelQuery = $this->db->get('t_warehouse_commodity_manufacturer');
        $data['manufacturers'] = $manufacturerModelQuery->result_object();
        $typeModelQuery = $this->db->get('t_warehouse_commodity_type');
        $data['types'] = $typeModelQuery->result_object();

        $commodityModelQuery = $this->db->get_where('t_warehouse_commodity', array(
            'id'=>$commodity_id
        ));
        if( $commodityModelQuery->num_rows() > 0 )
        {
            $commodityModel = $commodityModelQuery->row_array();

            $commodityInventoryModelQuery = $this->db->get_where('t_warehouse_commodity_inventory', array(
                'e_store_sku'   =>  $commodityModel['e_store_sku']
            ));
            $commodityModel['inventory'] = $commodityInventoryModelQuery->row_array();
            $data['commodity'] = $commodityModel;

            /** 获得商品相同【类型】及【厂家】的图片
             */
            $commodityPicturesModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                'manufacturer'  =>  $commodityModel['manufacturer'],
                'type'          =>  $commodityModel['type']
            ));
            $data['commodityPictures'] = $commodityPicturesModelQuery->result_object();

            /** 获得商品关联的所有图片
             */
            $commodityRelatedPicturesModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                'commodity_id'  =>  $commodity_id
            ));
            if( $commodityRelatedPicturesModelQuery->num_rows() > 0 )
            {
                $commodityRelatedPicturesIds = array();
                $commodityRelatedPicturesModel = $commodityRelatedPicturesModelQuery->result_object();
                foreach( $commodityRelatedPicturesModel as $commodityRelatedPicture )
                {
                    array_push( $commodityRelatedPicturesIds, $commodityRelatedPicture->commodity_picture_id );
                }
                $this->db->where_in( 'id', $commodityRelatedPicturesIds );
                $commodityRelatedPictures = $this->db->get_where( 't_warehouse_commodity_picture' );
                $data['commodityRelatedPictures'] = $commodityRelatedPictures->result_object();
            }
            else
            {
                $data['commodityRelatedPictures'] = null;
            }

            /** 获得商品关联的【主图】
             */
            $commodityRelatedMainPictureCombinationModelQuery = $this->db->get_where('t_warehouse_commodity_picture_combination', array(
                'commodity_id'          =>  $commodity_id,
                'is_selected_to_show'   =>  'Y'
            ));
            if( $commodityRelatedMainPictureCombinationModelQuery->num_rows() > 0 )
            {
                $commodityRelatedMainPictureCombination = $commodityRelatedMainPictureCombinationModelQuery->row_array();
                $commodityRelatedMainPictureModelQuery = $this->db->get_where('t_warehouse_commodity_picture', array(
                    'id'  =>  $commodityRelatedMainPictureCombination['commodity_picture_id']
                ));
                $data['commodityRelatedMainPicture'] = $commodityRelatedMainPictureModelQuery->row_array();
            }
            else
            {
                $data['commodityRelatedMainPicture'] = null;
            }

            $this->load->view('manager/warehouse/commodity/edit',$data);
        }
        else
        {
            header('Location:/manager/home');
        }
	}

}
