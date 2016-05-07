<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Page extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function hash( $hash_token )
	{
        if( ! isset( $hash_token ) ) header('Location:/');
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        $pageModelQuery = $this->db->get_where('t_e_store_cms_custom_page', array(
            'hash_token'    =>  $hash_token
        ));
        $pageModel = $pageModelQuery->row_array();
        $data['html_title'] = $pageModel['seo_title'];
        $data['html_description'] = $pageModel['seo_description'];
        $data['html_keywords'] = $pageModel['seo_keywords'];
        $data['page'] = $pageModel;

		$this->load->view('e_store/page', $data);
	}
}
