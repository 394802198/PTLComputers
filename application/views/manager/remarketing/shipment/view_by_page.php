<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<link rel="stylesheet" href="/resources/global/css/view_by_page.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<style>
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
    background: #5bc0de;
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
    background: #5bc0de;
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-info">Home</a></li>
                    <li><a href="/manager#remarketing_panel" class="text-info">Remarketing</a></li>
                    <li class="active">Shipment</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/remarketing/shipment/add_by/pagination" class="btn btn-xs btn-info">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Shipment
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="start_create_date" class="col-md-2 control-label">Start Create Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_create_date != null ) echo $ciPagination->model->start_create_date ?>" class="form-control" name="start_create_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_create_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_create_date" class="col-md-2 control-label">End Create Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_create_date != null ) echo $ciPagination->model->end_create_date ?>" class="form-control" name="end_create_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_create_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="creator_id" class="col-md-2 control-label">Creator ID</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->creator_id != null ) echo $ciPagination->model->creator_id ?>" name="creator_id" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="creator_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order_id" class="col-md-2 control-label">Order ID</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->order_id != null ) echo $ciPagination->model->order_id ?>" name="wholesaler_id" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="order_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="courier_id" class="col-md-2 control-label">Courier ID</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->courier_id != null ) echo $ciPagination->model->courier_id ?>" name="wholesaler_id" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="courier_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="ship_number" class="col-md-2 control-label">Ship Number</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->ship_number != null ) echo $ciPagination->model->ship_number ?>" name="ship_number" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="ship_number">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sender_name" class="col-md-2 control-label">Sender Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_name != null ) echo $ciPagination->model->sender_name ?>" name="sender_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_name" class="col-md-2 control-label">Receiver Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_name != null ) echo $ciPagination->model->receiver_name ?>" name="receiver_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="ship_status" class="col-md-2 control-label">Ship Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <?php $shipStatus = array( 1=>'Pending', 2=>'Dispatched', 3=>'Signed', 4=>'Exception', 5=>'Invalid' ) ?>
                                <select name="ship_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->ship_status != null && $ciPagination->model->ship_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($shipStatus as $key=>$shipState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->ship_status != null && ( $ciPagination->model->ship_status==$key && $ciPagination->model->ship_status!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $shipState ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $shipState ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="ship_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sender_address" class="col-md-2 control-label">Sender Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_address != null ) echo $ciPagination->model->sender_address ?>" name="sender_address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_address" class="col-md-2 control-label">Receiver Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_address != null ) echo $ciPagination->model->receiver_address ?>" name="receiver_address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_shipping_fee" class="col-md-2 control-label">Start Shipping Fee</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="start_shipping_fee" name="start_shipping_fee" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_shipping_fee != null ) { echo $ciPagination->model->start_shipping_fee; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="start_shipping_fee_result" name="start_shipping_fee" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_shipping_fee != null ) echo $ciPagination->model->start_shipping_fee ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_shipping_fee">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_shipping_fee" class="col-md-2 control-label">End Shipping Fee</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="end_shipping_fee" name="end_shipping_fee" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_shipping_fee != null ) { echo $ciPagination->model->end_shipping_fee; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="end_shipping_fee_result" name="end_shipping_fee" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_shipping_fee != null ) echo $ciPagination->model->end_shipping_fee ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_shipping_fee">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-xs btn-info">
                                <span class="glyphicon glyphicon-search"></span>
                                Search
                            </a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" id="reset_btn" class="btn btn-xs btn-default">
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
                <?php if($_SESSION['manager']['role']=='administrator'){ ?>
                    <a href="javascript:void(0);" id="delete_shipment_btn" class="btn btn-xs btn-info" style="color:#FFF;">Delete selected shipment with item(s)</a>
                    <a href="javascript:void(0);" id="switchShipmentStatusBatchBtn" class="btn btn-xs btn-info" style="color:#FFF;">Switch selected shipment status</a>
                <?php } ?>
            </div>
            <div>
                <table class="table" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                        <thead >
                        <tr>
                            <th colspan="12" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="shipment_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                            <span class="pull-right">
                            Total Shipments: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            Searched Shipments: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                            <tr>
                                <th>&nbsp;</th>
                                <th>ID</th>
                                <th>Create Date</th>
                                <th>Ship Number</th>
                                <th>Ship Status</th>
                                <th style="width:20%;">Sender Detail</th>
                                <th style="width:20%;">Receiver Detail</th>
                                <th style="text-align:right">Total Shipped</th>
                                <th style="text-align:right">Total Weight (Gram)</th>
                                <th style="text-align:right">Shipping Fee</th>
                                <th style="text-align:right">Memo</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $ciPagination->content as $index => $shipment ):?>
                            <tr class="<?php echo $index%2==0 ? 'info' : '' ?>">
                                <td>
                                    <input type="checkbox" data-name="shipment_checkbox" data-shipment-id="<?php echo $shipment->id ?>" />
                                </td>
                                <td>
                                    <a href="/manager/remarketing/shipment/edit/id/<?php echo $shipment->id ?>" class="btn btn-xs btn-info">
                                        <?php echo $shipment->id ?>
                                        <span class="glyphicon glyphicon-pencil" ></span>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $shipment->create_date ?>
                                </td>
                                <td>
                                    <?php echo $shipment->ship_number ?>
                                </td>
                                <?php $shipStatus = array( 1=>'Pending', 2=>'Dispatched', 3=> 'Signed', 4=>'Exception', 5=>'Invalid' )  ?>
                                <td>
                                    <strong> Current:</strong>
                                    <label class="label
                                                <?php
                                                    switch( $shipment->ship_status )
                                                    {
                                                        case 1: echo 'label-warning'; break;
                                                        case 2: echo 'label-info'; break;
                                                        case 3: echo 'label-success'; break;
                                                        case 4: echo 'label-danger'; break;
                                                        case 5: echo 'label-default'; break;
                                                        default: echo 'label-default'; break;
                                                    }
                                                ?>">
                                        <?php echo $shipStatus[ $shipment->ship_status ] ?></label>
                                    <br/><br/>
                                    <strong>Switch to:</strong>
                                    <?php foreach( $shipStatus as $key => $shipState ){ ?>
                                        <?php if( $shipment->ship_status != $key ) { ?>
                                            <button data-name="switchShipmentStatusBtn"
                                                    data-shipment-id="<?php echo $shipment->id ?>"
                                                    data-shipment-status="<?php echo $key ?>"
                                                    data-shipment-ship-number="<?php echo $shipment->ship_number ?>"
                                                    data-shipment-from-status="<?php echo $shipStatus[ $shipment->ship_status ] ?>"
                                                    data-shipment-to-status="<?php echo $shipState ?>"
                                                    class="btn btn-xs
                                                <?php
                                                    switch( $key )
                                                    {
                                                        case 1: echo 'btn-warning'; break;
                                                        case 2: echo 'btn-info'; break;
                                                        case 3: echo 'btn-success'; break;
                                                        case 4: echo 'btn-danger'; break;
                                                        case 5: echo 'btn-default'; break;
                                                        default: echo 'btn-default'; break;
                                                    }
                                                ?>"
                                                <?php echo $shipment->ship_status == $key ? 'disabled' : '' ?> >
                                                <?php echo $shipState ?>
                                            </button>
                                            <br/>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <strong>Name:</strong> <?php echo $shipment->sender_name ?><br/>
                                    <strong>Phone:</strong> <?php echo $shipment->sender_phone ?><br/>
                                    <strong>Email:</strong> <?php echo $shipment->sender_email ?><br/>
                                    <strong>Post:</strong> <?php echo $shipment->sender_post ?><br/>
                                    <strong>Address:</strong> <?php echo $shipment->sender_address ?><br/>
                                </td>
                                <td>
                                    <strong>Name:</strong> <?php echo $shipment->receive_name ?><br/>
                                    <strong>Phone:</strong> <?php echo $shipment->receive_phone ?><br/>
                                    <strong>Email:</strong> <?php echo $shipment->receive_email ?><br/>
                                    <strong>Address:</strong> <?php echo $shipment->receive_address . ', ' . $shipment->receive_city . ', ' . $shipment->receive_province . ', ' . $shipment->receive_post . ', ' . $shipment->receive_country ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $shipment->qty_total_item_shipped ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $shipment->total_weight ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $shipment->shipping_fee ?>
                                </td>
                                <td>
                                    <?php echo $shipment->memo ?>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    <?php } else { ?>
                        <tfoot>
                        <div style="text-align:center;">
                            <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                No matches.
                            </div>
                        </div>
                        </tfoot>
                    <?php } ?>
                </table>
                <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <div class="col-md-12" style="text-align:center; padding:20px 0;">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteOrderWithDetailModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderWithDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteOrderWithDetailModalLabel">Delete order(s) with detail(s)</h4>
      </div>
      <div class="modal-body">
        Sure to delete order(s) with detail(s)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deleteOrderWithDetailConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="switchShipmentStatusModal" tabindex="-1" role="dialog" aria-labelledby="switchShipmentStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="switchShipmentStatusModalLabel">Switch Shipment Status</h4>
            </div>
            <div class="modal-body">
                Sure to switch shipment[<strong id="shipNumber"></strong>] status from [<strong id="fromStatusSpan"></strong>] to [<strong id="toStatusSpan"></strong>]?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="switchShipmentStatusConfirm">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="switchShipmentStatusBatchModal" tabindex="-1" role="dialog" aria-labelledby="switchShipmentStatusBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="switchShipmentStatusBatchModalLabel">Switch Shipment Status Batch</h4>
            </div>
            <div class="modal-body">
                Sure to switch selected shipment(s) status to
                    <select class="form-control" id="shipStatusSelector">
                        <option value="1">Pending</option>
                        <option value="2">Dispatched</option>
                        <option value="3">Signed</option>
                        <option value="4">Exception</option>
                        <option value="5">Invalid</option>
                    </select>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="switchShipmentStatusBatchConfirm">Confirm</button>
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

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/remarketing/shipment/view_shipment_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->