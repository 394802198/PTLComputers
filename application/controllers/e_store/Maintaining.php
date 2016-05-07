<?php

class Maintaining extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
        /** 如果 Core Status 的 estore_state 为 maintain，则跳转至 maintaining 界面
         */
        $is_available_for_view = false;

        /** 如果不是后台人员，则需要判断 EStore 是否处在维护中
         */
        if( ! isset( $_SESSION['manager'] ) )
        {
            $coreStatusModelQuery = $this->db->get('t_core_status');
            if( $coreStatusModelQuery->num_rows() > 0 )
            {
                $coreStatusModel = $coreStatusModelQuery->row_array();
                if( ! isset( $coreStatusModel['estore_state'] ) || strcasecmp( $coreStatusModel['estore_state'], 'routine' )==0 )
                {
                    $is_available_for_view = true;
                }
            }
            else
            {
                $is_available_for_view = true;
            }
        }
        else
        {
            $is_available_for_view = true;
        }


        if( $is_available_for_view )
        {
            header('Location:' . ROOT_PATH . '/home');
        }

		$this->load->view('e_store/maintaining');
	}
}
