<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Change_Credential extends MY_Controller {

    public function __construct()
    {
        $config = array(
            'session' => 'customer'
        );
        parent::__construct( $config );
    }

	public function index()
	{
        /** 开始：EStore 几乎都要用到的
         */
        $data = EStoreHeaderAndSideNavUtil::init( $this );
        /** 结束：EStore 几乎都要用到的
         */

        /** 开始：当前页标识
         */
        $data['current_on'] = 'change_credential';
        /** 结束：当前页标识
         */

        /** 开始：SEO 用途
         */
        $data['html_title'] = 'Change Password';
        /** 结束：SEO 用途
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  110
        ));
        if( $homeAdvertisementObjQuery->num_rows() > 0 )
        {
            $homeAdvertisements = $homeAdvertisementObjQuery->result_object();
            foreach( $homeAdvertisements as $homeAdvertisement )
            {
                switch( $homeAdvertisement->position )
                {
                    case 100 : $data['pageTopAdvertisement'] = $homeAdvertisement; break;
                    case 101 : $data['pageLeftAdvertisement'] = $homeAdvertisement; break;
                    case 102 : $data['pageRightAdvertisement'] = $homeAdvertisement; break;
                    case 103 : $data['pageBottomAdvertisement'] = $homeAdvertisement; break;
                    case 104 : $data['headerBottomAdvertisement'] = $homeAdvertisement; break;
                    case 105 : $data['footerTopAdvertisement'] = $homeAdvertisement; break;
                }
            }
        }

        $this->load->view('e_store/customer/change_credential', $data);
	}
}
