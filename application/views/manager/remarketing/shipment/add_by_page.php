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
                    <li><a href="/manager/remarketing/shipment/view_by/pagination" class="text-info">Shipment</a></li>
                    <li class="active">Add Shipment</li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="start_ordered_date" class="col-md-2 control-label">Start Ordered Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_ordered_date != null ) echo $ciPagination->model->start_ordered_date ?>" class="form-control" name="start_ordered_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_ordered_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_ordered_date" class="col-md-2 control-label">End Ordered Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_ordered_date != null ) echo $ciPagination->model->end_ordered_date ?>" class="form-control" name="end_ordered_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_ordered_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="type" class="col-md-2 control-label">Shipping Method</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <?php $shippingMethods = array('Shipping', 'Pick Up') ?>
                                <select name="shipping_method" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->shipping_method != null && $ciPagination->model->shipping_method=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($shippingMethods as $shippingMethod) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->shipping_method != null && ( strcasecmp( $ciPagination->model->shipping_method,$shippingMethod )==0 && $ciPagination->model->shipping_method!='NULL' ) ) { ?>
                                            <option value="<?php echo $shippingMethod ?>" selected><?php echo $shippingMethod ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $shippingMethod ?>"><?php echo $shippingMethod ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="shipping_method">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="wholesaler_id" class="col-md-2 control-label">Wholesaler ID</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->wholesaler_id != null ) echo $ciPagination->model->wholesaler_id ?>" name="wholesaler_id" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="wholesaler_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="manager_id" class="col-md-2 control-label">Manager</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="manager_id" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manager_id != null && $ciPagination->model->manager_id=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($managers as $manager) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manager_id != null && ( strcasecmp( $ciPagination->model->manager_id,$manager->id )==0 && $ciPagination->model->manager_id!='NULL' ) ) { ?>
                                            <option value="<?php echo $manager->id ?>" selected><?php echo $manager->first_name . ' ' . $manager->last_name ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $manager->id ?>"><?php echo $manager->first_name . ' ' . $manager->last_name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="manager_id">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="shipping_address" class="col-md-2 control-label">Shipping Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->shipping_address != null ) echo $ciPagination->model->shipping_address ?>" name="shipping_address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="shipping_address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="first_name" class="col-md-2 control-label">First Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->first_name != null ) echo $ciPagination->model->first_name ?>" name="first_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="first_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="last_name" class="col-md-2 control-label">Last Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->last_name != null ) echo $ciPagination->model->last_name ?>" name="last_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="last_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="email" class="col-md-2 control-label">Email Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->email != null ) echo $ciPagination->model->email ?>" name="email" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="email">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_name" class="col-md-2 control-label">Company Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->company_name != null ) echo $ciPagination->model->company_name ?>" name="company_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="company_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="mobile_phone" class="col-md-2 control-label">Mobile Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->mobile_phone != null ) echo $ciPagination->model->mobile_phone ?>" name="mobile_phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="mobile_phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="landline_phone" class="col-md-2 control-label">Landline Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->landline_phone != null ) echo $ciPagination->model->landline_phone ?>" name="landline_phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="landline_phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="fax_no" class="col-md-2 control-label">Fax Number</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->fax_no != null ) echo $ciPagination->model->fax_no ?>" name="fax_no" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="fax_no">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_total_amount_gst" class="col-md-2 control-label">Start Total Payable</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="start_total_amount_gst" name="start_total_amount_gst" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_total_amount_gst != null ) { echo $ciPagination->model->start_total_amount_gst; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="start_total_amount_gst_result" name="start_total_amount_gst" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_total_amount_gst != null ) echo $ciPagination->model->start_total_amount_gst ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_total_amount_gst">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_total_amount_gst" class="col-md-2 control-label">End Total Payable</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="end_total_amount_gst" name="end_total_amount_gst" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_total_amount_gst != null ) { echo $ciPagination->model->end_total_amount_gst; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="end_total_amount_gst_result" name="end_total_amount_gst" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_total_amount_gst != null ) echo $ciPagination->model->end_total_amount_gst ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_total_amount_gst">
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
<!--                    <a href="javascript:void(0);" id="delete_order_btn" class="btn btn-xs btn-info" style="color:#FFF;">Delete selected order with detail(s)</a>-->
                <?php } ?>
            </div>
            <div>
                <table class="table" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                        <thead >
                        <tr>
                            <th colspan="14" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="order_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                            <span class="pull-right">
                            Total Ordered: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            Filtered: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th rowspan="2">&nbsp;</th>
                            <th rowspan="2">Order ID</th>
                            <th rowspan="2">Ordered Date</th>
                            <th colspan="2" class="text-center">Shipping</th>
                            <th rowspan="2" style="width:20%;">Purchaser Detail</th>
                            <th rowspan="2" style="width:20%;">Receiver Detail</th>
                            <th colspan="3" class="text-center">Fees</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>Method</th>
                            <th style="text-align:right">Product&GST</th>
                            <th style="text-align:right">Shipping</th>
                            <th style="text-align:right">Total</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $ciPagination->content as $index => $order ):?>
                            <tr class="<?php echo $index%2==0 ? 'info' : '' ?>">
                                <td>
                                    <input type="checkbox" data-name="order_checkbox" data-order-id="<?php echo $order->id ?>" />
                                </td>
                                <td>
                                    <a href="/manager/remarketing/shipment/add/id/<?php echo $order->id ?>" class="btn btn-xs btn-info">
                                        <?php echo $order->id ?>
                                        <span class="glyphicon glyphicon-plus" ></span>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $order->ordered_date ?>
                                </td>
                                <td>
                                    <?php
                                        switch( $order->order_status )
                                        {
                                            case 'pending' : echo 'Pending'; break;
                                            case 'processing' : echo 'Processing'; break;
                                            case 'waiting_for_shipment' : echo 'Waiting For Shipment'; break;
                                            case 'shipped' : echo 'Shipped'; break;
                                            case 'completed' : echo 'Completed'; break;
                                            case 'cancelled' : echo 'Cancelled'; break;
                                            default : echo 'Unknown'; break;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $order->shipping_method ?>
                                </td>
                                <td>
                                    <strong>Company:</strong> <?php echo $order->company_name ?><br/>
                                    <strong>Name:</strong> <?php echo $order->first_name . ' ' . $order->last_name ?><br/>
                                    <strong>Landline:</strong> <?php echo $order->landline_phone ?><br/>
                                    <strong>Mobile:</strong> <?php echo $order->mobile_phone ?><br/>
                                    <strong>Fax:</strong> <?php echo $order->fax_no ?><br/>
                                    <strong>Email:</strong> <?php echo $order->email ?><br/>
                                    <strong>Address:</strong> <?php echo $order->shipping_address ?>
                                </td>
                                <td>
                                    <strong>Name:</strong> <?php echo $order->receiver_name ?><br/>
                                    <strong>Phone:</strong> <?php echo $order->receiver_phone ?><br/>
                                    <strong>Email:</strong> <?php echo $order->receiver_email ?><br/>
                                    <strong>Address:</strong> <?php echo $order->receiver_address . ', ' . $order->receiver_city . ', ' . $order->receiver_province . ', ' . $order->receiver_post . ', ' . $order->receiver_country ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->gst + $order->total_amount); ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->shipping_fee); ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->total_amount_gst); ?>
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
<script src="/resources/manager/js/remarketing/shipment/add_shipment_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->