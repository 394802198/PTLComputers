<?php

require_once 'application/class/core/EmailTemplate.php';
require_once 'util/myutils/JSONAlert.php';

class Session extends MY_Controller {
    
    public function __construct()
    {
        $config = array(
            'session' => 'manager'
        );
        parent::__construct( $config );
    }

    /** 添加系统邮件模板
     */
	public function add()
	{
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'subject'=>'Subject Needed!',
                    'body'=>'Body Needed!',
                    'purpose'=>'Purpose Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果该用途的邮件模板
         */
        $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
            'type'          =>  1,
            'purpose'       =>  $emailTemplate->purpose
        ));
        if( $emailTemplateModelQuery->num_rows() > 0 )
        {
            $jsonAlert->append(array(
                'errorMsg'=>'Email Template ( System ) with the same Purpose is currently existed!'
            ), TRUE);
        }

        if( ! $jsonAlert->hasErrors )
        {
            $emailTemplate->type = 1;

            $this->db->insert('t_core_email_template', $emailTemplate->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Email Template ( System ) Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 更新邮件模板
     */
    public function edit()
    {
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'subject'=>'Subject Needed!',
                    'body'=>'Body Needed!',
                    'purpose'=>'Purpose Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        /** 如果该用途的邮件模板
         */
        $emailTemplateModelQuery = $this->db->get_where('t_core_email_template', array(
            'type'          =>  1,
            'purpose'       =>  $emailTemplate->purpose
        ));
        if( $emailTemplateModelQuery->num_rows() > 0 )
        {
            $emailTemplateModel = $emailTemplateModelQuery->row_array();
            if( $emailTemplate->id != $emailTemplateModel['id'] )
            {
                $jsonAlert->append(array(
                    'errorMsg'=>'Email Template ( System ) with the same Purpose is currently existed!'
                ), TRUE);
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_core_email_template', $emailTemplate->getEditableData(), array(
                'id'        =>  $emailTemplate->id,
                'type'      =>  1
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Email Template ( System ) Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 删除邮件模版
     */
	public function delete()
	{
        $emailTemplate = new EmailTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$emailTemplate,
                'check_empty'=>array(
                    'id'=>'Id Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( strcasecmp( $_SESSION['manager']['role'], 'administrator' )!=0 )
        {
            $jsonAlert->hasErrors = TRUE;
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->delete('t_core_email_template', array(
                'id'    =>  $emailTemplate->id,
                'type'  =>  1
            ));
            $jsonAlert->append(array(
                'successMsg'=>'Email Template ( System ) deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}
	
}
