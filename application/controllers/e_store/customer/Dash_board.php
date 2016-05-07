<?php

require_once 'util/myutils/EStoreHeaderAndSideNavUtil.php';

class Dash_Board extends MY_Controller {

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

        /** 开始：仪表盘统计
         */

        $customer_id = $_SESSION['customer']['id'];

        /** 统计收件人地址数量
         */
        $this->db->where('customer_id', $customer_id);
        $data['receiver_address_count'] = $this->db->count_all_results('t_e_store_customer_receiver_address');

        /** 统计订单数量
         */
        $this->db->where('customer_id', $customer_id);
        $data['order_count'] = $this->db->count_all_results('t_e_store_order');

        /** 统计快递或送货上门的订单数量
         */
        $this->db->where('customer_id', $customer_id);
        $this->db->where('delivery_method', 2);
        $data['shipping_order_count'] = $this->db->count_all_results('t_e_store_order');


        /** 结束：仪表盘统计
         */

        /** 开始：当前页标识
         */
        $data['current_on'] = 'dash_board';
        /** 结束：当前页标识
         */

        /** 开始：SEO 用途
         */
        $data['html_title'] = 'Customer Home';
        /** 结束：SEO 用途
         */

        $homeAdvertisementObjQuery = $this->db->get_where('t_e_store_cms_advertisement', array(
            'page_type' =>  108
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

        $this->load->view('e_store/customer/dash_board', $data);
	}
}
