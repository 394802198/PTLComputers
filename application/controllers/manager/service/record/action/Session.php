<?php

require_once 'application/class/service/Record.php';
require_once 'application/class/service/Comment.php';
require_once 'application/class/service/RecordPrintTemplate.php';
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

    /** 添加维修记录
     */
	public function add()
	{
        $record = new Record($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$record,
                'check_empty'=>array(
                    'type'=>'Type Needed!',
                    'status'=>'Status Needed!',
                    'customer_name'=>'Customer Name Needed!',
                    'item_name'=>'Item Name Needed!',
                    'problem_description'=>'Problem Description Needed!',
                ),
                'check_one_not_empty'=>array(
                    'customer_phone|customer_email' => 'Customer Phone or Email Needed!'
                ),
                'check_empty_on_other'=>array(
                    'type=101|external_service_provider_id' => 'External Service Must Assign to an External Service Provider!'
                ),
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $record->created_at = date("Y-m-d h:i:s");
            $record->user_id = $_SESSION["manager"]['manager_id'];

            if (! isset($record->check_in_date)) {
                $record->check_in_date = date('Y-m-d h:i:s');
            }

            $this->db->insert('t_service_record', $record->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Record Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
	}

    /** 编辑维修记录
     */
	public function edit()
	{
        $record = new Record($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$record,
                'check_empty'=>array(
                    'id'=>'Id Needed!',
                    'type'=>'Type Needed!',
                    'status'=>'Status Needed!',
                    'customer_name'=>'Customer Name Needed!',
                    'item_name'=>'Item Name Needed!',
                    'problem_description'=>'Problem Description Needed!',
                ),
                'check_one_not_empty'=>array(
                    'customer_phone|customer_email' => 'Customer Phone or Email Needed!'
                ),
                'check_empty_on_other'=>array(
                    'type=101|external_service_provider_id' => 'External Service Must Assign to an External Service Provider!'
                ),
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $this->db->update('t_service_record', $record->getEditableData(), array(
                'id'=>$record->id
            ));

            $jsonAlert->append(array(
                'successMsg'=>'Current Record Updated!'
            ), FALSE);
	    }
        echo $jsonAlert->result();
	}

    /** 批量删除维修记录
     */
    public function delete_batch()
    {
        $record = new Record($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$record,
                'check_empty'=>array(
                    'record_ids'=>'Must select at least one record!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach ( $record->record_ids as $record_id )
            {
                $this->db->delete('t_service_comment', array(
                    'record_id' => $record_id
                ));

                $this->db->delete('t_service_record', array(
                    'id' => $record_id
                ));
            }
            $jsonAlert->append(array(
                'successMsg'=>'Selected record deleted!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /** 添加维修备注
     */
    public function add_comment()
    {
        $comment = new Comment($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$comment,
                'check_empty'=>array(
                    'record_id'=>'Record Needed!',
                    'content'=>'Content Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( ! $jsonAlert->hasErrors )
        {
            $comment->created_at = date('y-m-d h:i:s');
            $comment->user_id = $_SESSION["manager"]['manager_id'];

            $this->db->insert('t_service_comment', $comment->getInsertableData());

            $jsonAlert->append(array(
                'successMsg'=>'New Comment Created!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }

    /**
     *
     */
    public function edit_print_template()
    {
        $recordPrintTemplate = new RecordPrintTemplate($this->input);
        $jsonAlert = new JSONAlert();

        try {
            $jsonAlert->append_batch(array(
                'model'=>$recordPrintTemplate,
                'check_empty'=>array(
                    'company_name'=>'Company Name Needed!',
                    'company_street'=>'Company Street Needed!',
                    'company_city'=>'Company City Needed!',
                    'phone'=>'Phone Needed!',
                    'title'=>'Title Needed!',
                    'term_condition'=>'Term Condition Needed!'
                )
            ));
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        if( $_FILES['picture']['size'] > 0 )
        {
            foreach ( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    if(!in_array($file['type'], array('image/jpeg','image/png','image/gif')))
                    {
                        $jsonAlert->append(array(
                            'picture'=>'目前只支持 [.jpg], [.png], [.gif] 等三种格式图片'
                        ), TRUE);
                    }
                }
            }
        }

        if( ! $jsonAlert->hasErrors )
        {
            foreach( $_FILES as $file )
            {
                if( $file['size'] > 0 )
                {
                    /** 先删除该【商品图片】的原图
                     */
                    $recordPrintTemplateModelQuery = $this->db->get('t_service_record_print_template');
                    if ($recordPrintTemplateModelQuery->num_rows() > 0) {
                        $recordPrintTemplateModel = $recordPrintTemplateModelQuery->row_array();
                        if (file_exists($recordPrintTemplateModel['logo_img'])) {
                            unlink( $recordPrintTemplateModel['logo_img'] );
                        }
                    }

                    if( ! is_dir("upload/service/record/print_template/images/") )
                    {
                        mkdir("upload/service/record/print_template/images/", 0777, true);
                    }
                    $file_extension = pathinfo( $file["name"], PATHINFO_EXTENSION );
                    // 时间戳+6位随机数+文件后缀名
                    $file_path = "upload/service/record/print_template/images/" . time() . "_" . rand(100000, 999999) . ".". $file_extension;
                    $recordPrintTemplate->logo_img = $file_path;
                    move_uploaded_file( $file["tmp_name"], $file_path );
                }
            }

            $recordPrintTemplateModelQuery = $this->db->get('t_service_record_print_template');
            if ($recordPrintTemplateModelQuery->num_rows() > 0) {
                $this->db->update('t_service_record_print_template', $recordPrintTemplate->getEditableData());
            } else {
                $this->db->insert('t_service_record_print_template', $recordPrintTemplate->getInsertableData());
            }

            $jsonAlert->append(array(
                'successMsg'=>'Record Print Template Updated!'
            ), FALSE);
        }
        echo $jsonAlert->result();
    }
	
}
