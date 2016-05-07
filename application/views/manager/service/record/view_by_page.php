<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<link rel="stylesheet" href="/resources/global/css/view_by_page.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<style>
.info-tr {
	background-color: #e8e8e8;
}
input[type=range] {
    /*removes default webkit styles*/
    -webkit-appearance: none;

    /*fix for FF unable to apply focus style bug */
    border: 1px solid white;

    /*required for proper track sizing in FF*/x
}
input[type=range]::-webkit-slider-runnable-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #286090;
    margin-top: -4px;
}
input[type=range]:focus {
    outline: none;
}
input[type=range]:focus::-webkit-slider-runnable-track {
    background: #ccc;
}

input[type=range]::-moz-range-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-moz-range-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #286090;
}

/*hide the outline behind the border*/
input[type=range]:-moz-focusring{
    outline: 1px solid white;
    outline-offset: -1px;
}

input[type=range]::-ms-track {
    width: 300px;
    height: 5px;

    /*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
    background: transparent;

    /*leave room for the larger thumb to overflow with a transparent border */
    border-color: transparent;
    border-width: 6px 0;

    /*remove default tick marks*/
    color: transparent;
}
input[type=range]::-ms-fill-lower {
    background: #777;
    border-radius: 10px;
}
input[type=range]::-ms-fill-upper {
    background: #ddd;
    border-radius: 10px;
}
input[type=range]::-ms-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #5bc0de;
}
input[type=range]:focus::-ms-fill-lower {
    background: #888;
}
input[type=range]:focus::-ms-fill-upper {
    background: #ccc;
}
</style>
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-primary">Home</a></li>
                    <li><a href="/manager#service_panel" class="text-primary">Service</a></li>
                    <li class="active">Record</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/service/record/add" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Record
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <?php
                        $types = array(
                            100 => 'Internal',
                            101 => 'External'
                        );
                        ?>
                        <label for="type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="type" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->type != null && $ciPagination->model->type != null && $ciPagination->model->type=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($types as $key => $type) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && ( $ciPagination->model->type==$key && $ciPagination->model->type!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $type ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $type ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="type">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <?php
                        $statuses = array(
                            100 => 'New',
                            101 => 'Processing',
                            102 => 'Success',
                            103 => 'Shipped',
                            104 => 'Failed',
                            105 => 'Cancelled'
                        );
                        ?>
                        <label for="status" class="col-md-2 control-label">Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->status != null && $ciPagination->model->status != null && $ciPagination->model->status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($statuses as $key => $status) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->status != null && ( $ciPagination->model->status==$key && $ciPagination->model->status!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $status ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $status ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_created_at" class="col-md-2 control-label">Start Created At</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_created_at != null ) echo $ciPagination->model->start_created_at ?>" class="form-control" name="start_created_at" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_created_at">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_created_at" class="col-md-2 control-label">End Created At</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_created_at != null ) echo $ciPagination->model->end_created_at ?>" class="form-control" name="end_created_at" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_created_at">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="user_id" class="col-md-2 control-label">Created By</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="user_id" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->user_id != null && $ciPagination->model->user_id != null && $ciPagination->model->user_id=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($users as $user) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->user_id != null && ( $ciPagination->model->user_id==$user->id && $ciPagination->model->user_id!='NULL' ) ) { ?>
                                            <option value="<?php echo $user->id ?>" selected><?php echo $user->first_name . ' ' . $user->last_name ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $user->id ?>"><?php echo $user->first_name . ' ' . $user->last_name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="user_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_check_in_date" class="col-md-2 control-label">Start Check In Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_check_in_date != null ) echo $ciPagination->model->start_check_in_date ?>" class="form-control" name="start_check_in_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_check_in_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_check_in_date" class="col-md-2 control-label">End Check In Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_check_in_date != null ) echo $ciPagination->model->end_check_in_date ?>" class="form-control" name="end_check_in_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_check_in_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_check_out_date" class="col-md-2 control-label">Start Check Out Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_check_out_date != null ) echo $ciPagination->model->start_check_out_date ?>" class="form-control" name="start_check_out_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_check_out_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_check_out_date" class="col-md-2 control-label">End Check Out Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_check_out_date != null ) echo $ciPagination->model->end_check_out_date ?>" class="form-control" name="end_check_out_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_check_out_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customer_name" class="col-md-2 control-label">Customer Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->customer_name != null ) echo $ciPagination->model->customer_name ?>" name="customer_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="customer_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone" class="col-md-2 control-label">Customer Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->customer_phone != null ) echo $ciPagination->model->customer_phone ?>" name="customer_phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="customer_phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="customer_email" class="col-md-2 control-label">Customer Email</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->customer_email != null ) echo $ciPagination->model->customer_email ?>" name="customer_email" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="customer_email">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="customer_address" class="col-md-2 control-label">Customer Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->customer_address != null ) echo $ciPagination->model->customer_address ?>" name="customer_address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="customer_address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="item_name" class="col-md-2 control-label">Item Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->item_name != null ) echo $ciPagination->model->item_name ?>" name="item_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="item_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="item_model" class="col-md-2 control-label">Item Model</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->item_model != null ) echo $ciPagination->model->item_model ?>" name="item_model" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="item_model">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="item_sn" class="col-md-2 control-label">Item SN</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->item_sn != null ) echo $ciPagination->model->item_sn ?>" name="item_sn" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="item_sn">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="external_service_provider" class="col-md-2 control-label">External Service Provider</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="external_service_provider" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->status != null && $ciPagination->model->external_service_provider != null && $ciPagination->model->external_service_provider=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php if (isset($externalServiceProviders)) { ?>
                                        <?php foreach ($externalServiceProviders as $externalServiceProvider) { ?>
                                            <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->external_service_provider != null && ( $ciPagination->model->external_service_provider==$externalServiceProvider->id && $ciPagination->model->external_service_provider!='NULL' ) ) { ?>
                                                <option value="<?php echo $externalServiceProvider->id ?>" selected><?php echo $externalServiceProvider->name ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $externalServiceProvider->id ?>"><?php echo $externalServiceProvider->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="external_service_provider">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-sm btn-primary">
                                <span class="glyphicon glyphicon-search"></span>
                                Search
                            </a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" id="reset_btn" class="btn btn-sm btn-default">
                                <span class="glyphicon glyphicon-refresh"></span>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align:center; padding:20px 0;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <div class="col-md-12">
               <a href="javascript:void(0);" id="delete_record_btn" class="btn btn-sm btn-primary">
                   <span class="glyphicon glyphicon-trash"></span>
                   Delete selected record
               </a>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="100" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="record_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-center">Job Number</th>
                            <th class="text-center">Status/Type</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Item</th>
                            <th class="text-center" width="20%">Problem Description</th>
                            <th class="text-center">Appraisal</th>
                            <th class="text-center" width="30%">Comment</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $record ): ?>
                        <tr class="<?php echo $index%2==0 ? 'primary' : '' ?> text-center" style="word-break:break-all;">
                            <td class="text-left">
                                <input type="checkbox" data-name="record_checkbox" data-record-id="<?php echo $record->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/service/record/edit/id/<?php echo $record->id ?>" class="btn btn-primary btn-xs">
                                    <?php echo $record->id ?><br/>
                                </a>
                                <br/>
                                <a href="/manager/service/record/view_by/print_record/<?php echo $record->id ?>" target="_blank" class="btn btn-primary btn-xs">
                                    <span class="glyphicon glyphicon-print"></span>
                                    Print This Record
                                </a>
                                <?php if ($record->type == 101) { ?>
                                    <br/><br/>
                                    <strong>Service Provider:</strong><br/>
                                    <?php echo $record->external_service_provider['name'] ?><br/>
<!--                                    --><?php //echo $record->external_service_provider['phone'] ?><!--<br/>-->
<!--                                    --><?php //echo $record->external_service_provider['email'] ?><!--<br/>-->
<!--                                    --><?php //echo $record->external_service_provider['address'] ?><!--<br/>-->
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $statuses[$record->status] ?><br/>
                                <?php echo $types[$record->type] ?>
                            </td>
                            <td>
                                <strong>Created By</strong><br/>
                                <?php foreach ($users as $user) { ?>
                                    <?php if ( $user->id == $record->user_id ) { ?>
                                        <?php echo $user->first_name . ' ' . $user->last_name ?><br/>
                                    <?php } ?>
                                <?php } ?>
                                <strong>Created At</strong><br/>
                                <?php echo $record->created_at ?><br/>
<!--                                <strong>Check In Date</strong><br/>-->
<!--                                --><?php //echo $record->check_in_date ?><!--<br/>-->
<!--                                <strong>Check Out Date</strong><br/>-->
<!--                                --><?php //echo $record->check_out_date ?><!--<br/>-->
                            </td>
                            <td>
                                <strong>Customer Name</strong><br/>
                                <?php echo $record->customer_name ?><br/>
<!--                                <strong>Customer Phone</strong><br/>-->
<!--                                --><?php //echo $record->customer_phone ?><!--<br/>-->
<!--                                <strong>Customer Email</strong><br/>-->
<!--                                --><?php //echo $record->customer_email ?><!--<br/>-->
<!--                                <strong>Customer Address</strong><br/>-->
<!--                                --><?php //echo $record->customer_address ?><!--<br/>-->
                            </td>
                            <td>
                                <strong>Item Name</strong><br/>
                                <?php echo $record->item_name ?><br/>
                                <strong>Item Model</strong><br/>
                                <?php echo $record->item_model ?><br/>
                                <strong>Item SN</strong><br/>
                                <?php echo $record->item_sn ?><br/>
                            </td>
                            <td style="word-break:break-all;">
                                <?php echo $record->problem_description ?>
                            </td>
                            <td>
<!--                                <strong></strong><br/>-->
                                <?php echo $record->appraisal ?>
<!--                                <br/>-->
<!--                                <strong>Payable</strong><br/>-->
<!--                                --><?php //echo $record->payable ?><!--<br/>-->
<!--                                <strong>Cost</strong><br/>-->
<!--                                --><?php //echo $record->cost ?><!--<br/>-->
<!--                                <strong>Paid</strong><br/>-->
<!--                                --><?php //echo $record->paid ?><!--<br/>-->
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Created By</th>
                                            <th width="25%">Created At</th>
                                            <th width="50%" class="text-center">Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($record->comments) && count($record->comments) > 0) { ?>
                                            <?php foreach ($record->comments as $comment) { ?>
                                                <tr>
                                                    <td>
                                                        <?php foreach ($users as $user) { ?>
                                                            <?php if ($user->id == $comment->user_id) { ?>
                                                                <?php echo $user->first_name . ' ' . $user->last_name ?>
                                                            <?php } ?>
                                                         <?php } ?>
                                                    </td>
                                                    <td><?php echo $comment->created_at ?></td>
                                                    <td style="word-break:break-all;"><?php echo $comment->content ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <a class="btn btn-primary btn-xs" data-name="add_comment" data-record-id="<?php echo $record->id ?>">Add Comment</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-primary col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                    Record is empty, please click the button at the top right of this page to add one
                                </div>
                            </div>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
            <div style="text-align:center; padding:20px 0;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addCommentModalLabel">Delete Service Comment</h4>
            </div>
            <div class="modal-body">
                <textarea id="comment_content" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="addCommentConfirm">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteRecordModal" tabindex="-1" role="dialog" aria-labelledby="deleteRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteRecordModalLabel">Delete Record</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteRecordConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script>
var $php_self = '<?php echo $_SERVER["REQUEST_URI"] ?>';
</script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/service/record/view_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
