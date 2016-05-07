<?php

require_once 'application/class/service/Record.php';
require_once 'util/myutils/CIPagination.php';

class View_by extends MY_Controller
{
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    public function pagination()
    {
        $initConfig = array(
            'base_url'          =>  '/manager/service/record/view_by/pagination',
            'num_links'        =>  3,
            'attributes'        =>  array('class' => 'btn btn-xs btn-primary'),
            'CThis'             =>  $this,
            'Model'             =>  'Record',
            /* search_mode is fuzzy by default */
            'search_mode'       =>  CIPagination::$FUZZY_SEARCH,
            /* predicate_mode is loose by default */
            'predicate_mode'    =>  CIPagination::$LOOSE_PREDICATE,
            /* Won't be counted into predicates automatically */
            'prevented_fields'  =>  array(
                'start_created_at', 'end_created_at',
                'start_check_in_date', 'end_check_in_date',
                'start_check_out_date', 'end_check_out_date'
            )
        );
        $ciPagination = new CIPagination( $initConfig );

        $ciPagination->between( 'created_at', 'start_created_at', 'end_created_at' );
        $ciPagination->between( 'check_in_date', 'start_check_in_date', 'end_check_in_date' );
        $ciPagination->between( 'check_out_date', 'start_check_out_date', 'end_check_out_date' );

        $pageConfig = array(

            /* Required params */
            'table_name'        =>  't_service_record',

//            'selectedRows'        =>  array(
//                'id', 'e_store_sku', 'name', 'price', 'weight', 'location', 'manufacturer', 'type', 'is_on_shelf'
//            ),

            /* Optional params */
            'num_per_page'      =>  50,
            'order_by'          =>  'id DESC',
//            'where_in'=>array(
//                'field'=>'product_status',
//                'values'=>array('in stock')
//            ),
        );
        $ciPagination->initialize( $pageConfig );

        if (count($ciPagination->content) > 0) {
            foreach ($ciPagination->content as $record) {
                if (isset($record->external_service_provider_id)) {
                    $externalServiceProviderModelQuery = $this->db->get_where('t_service_external_service_provider', array(
                        'id' => $record->external_service_provider_id
                    ));
                    $record->external_service_provider = $externalServiceProviderModelQuery->row_array();
                }

                $commentObjQuery = $this->db->get_where('t_service_comment', array(
                    'record_id' => $record->id
                ));
                if ($commentObjQuery->num_rows() > 0) {
                    $record->comments = $commentObjQuery->result_object();
                }
            }
        }

        $userObjQuery = $this->db->get('t_core_manager');
        $data['users'] = $userObjQuery->result_object();

        $data['ciPagination'] = $ciPagination;

        $this->load->view( '/manager/service/record/view_by_page', $data );

    }

    public function print_template()
    {
        $serviceRecordPrintTemplateModelQuery = $this->db->get('t_service_record_print_template');
        $data['recordTemplate'] = $serviceRecordPrintTemplateModelQuery->row_array();

        $this->load->view('/manager/service/record/view_by_print_template', $data);
    }

    public function print_record($record_id)
    {
        if (!$record_id) header('Location:/manager');
        $recordModelQuery = $this->db->get_where('t_service_record', array(
            'id' => $record_id
        ));
        if ($recordModelQuery->num_rows() < 1) header('Location:/manager');
        $data['record'] = $recordModelQuery->row_array();

        $serviceRecordPrintTemplateModelQuery = $this->db->get('t_service_record_print_template');
        if($serviceRecordPrintTemplateModelQuery->num_rows() < 1) header('Location:/manager');
        $data['printTemplate'] = $serviceRecordPrintTemplateModelQuery->row_array();

        $this->load->view('/manager/service/record/view_by_print_record', $data);
    }

}

