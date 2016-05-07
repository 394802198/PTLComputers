<?php 

class View extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        $typeModelQuery = $this->db
            ->select('name')
            ->distinct('name')
            ->order_by('sequence ASC, id ASC')
            ->get('t_warehouse_commodity_type');
        $data['types'] = $typeModelQuery->result_object();

        foreach( $data['types'] as $index => $type )
        {
            $typeFindIdObjQuery = $this->db
                ->select('id, sequence')
                ->where('name', $type->name)
                ->order_by('sequence ASC, id ASC')
                ->limit( 1 )
                ->get('t_warehouse_commodity_type');
            $typeFindIdObj = $typeFindIdObjQuery->result_object();
            foreach( $typeFindIdObj as $typeFindId )
            {
                $type->id           = $typeFindId->id;
                $type->sequence     = $typeFindId->sequence;
            }
        }

        $this->load->view('manager/warehouse/commodity/type/view',$data);
	}
}
