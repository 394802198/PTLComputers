<?php

require_once 'application/class/service/ExternalServiceProvider.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller
{
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 添加外部维修提供者
     */
	public function add()
	{
        $externalServiceProvider = new ExternalServiceProvider($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$externalServiceProvider,
                'check_empty'=>array(
                    'name'=>'Name Needed!',
                    'phone'=>'Phone Needed!',
                    'email'=>'Email Needed!',
                    'address'=>'Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 维修提供者名称是否存在
         */
        $externalServiceProviderQuery = $this->db->get_where('t_service_external_service_provider', array(
            'name' =>  $externalServiceProvider->name
        ));
        if( $externalServiceProviderQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Name Existed!'
            ), TRUE);

            $jsonAlert->hasErrors = true;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->insert('t_service_external_service_provider', $externalServiceProvider->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New External Service Provider Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑外部维修提供者
     */
	public function edit()
	{
        $externalServiceProvider = new ExternalServiceProvider($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$externalServiceProvider,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'name'=>'Name Needed!',
                    'phone'=>'Phone Needed!',
                    'email'=>'Email Needed!',
                    'address'=>'Address Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {

            /** 外部维修提供者名称是否存在并且不属于当前外部维修提供者
             */
            $externalServiceProviderModelQuery = $this->db->get_where('t_service_external_service_provider', array(
                'name' =>  $externalServiceProvider->name
            ));
            $externalServiceProviderModel = $externalServiceProviderModelQuery->row_array();
            if( $externalServiceProviderModelQuery->num_rows() > 0 && $externalServiceProviderModel['id'] != $externalServiceProvider->id )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Name Existed!'
                ), TRUE);
            }
            else
            {
                $this->db->update('t_service_external_service_provider', $externalServiceProvider->getEditableData(), array(
                    'id'=>$externalServiceProvider->id
                ));

                $jsonAlert->append(array(
                    'successMsg'=>'Current External Service Provider Updated!'
                ), FALSE);
            }
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除外部维修提供者
     */
    public function delete_batch()
    {
        $externalServiceProvider = new ExternalServiceProvider($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$externalServiceProvider,
                'check_empty'=>array(
                    'external_service_provider_ids'=>'Must select at least one external service provider!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $externalServiceProvider->external_service_provider_ids as $external_service_provider_id )
            {
                $this->db->delete('t_service_external_service_provider', array(
                    'id'=>$external_service_provider_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected external service provider deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
