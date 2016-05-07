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
    background: #f0ad4e;
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
    background: #f0ad4e;
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
        <div class="panel panel-warning">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-warning">Home</a></li>
                    <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                    <li class="active">Order</li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="start_create_time" class="col-md-2 control-label">Start Create Time</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_create_time != null ) echo $ciPagination->model->start_create_time ?>" class="form-control" name="start_create_time" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_create_time">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_create_time" class="col-md-2 control-label">End Create Time</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_create_time != null ) echo $ciPagination->model->end_create_time ?>" class="form-control" name="end_create_time" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_create_time">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="order_status" class="col-md-2 control-label">Order Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <?php
                                $orderStatus = array(
                                    1   =>  'Pending',
                                    2   =>  'Processing',
                                    3   =>  'Waiting for Shipment',
                                    4   =>  'Shipped',
                                    5   =>  'Completed',
                                    6   =>  'Cancelled',
                                    7   =>  'Refunded'
                                );
                                ?>
                                <select name="order_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->order_status != null && $ciPagination->model->order_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($orderStatus as $key => $orderState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->order_status != null && ( strcasecmp( $ciPagination->model->order_status, $key )==0 && $ciPagination->model->order_status!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $orderState ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $orderState ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="order_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-md-offset-8 col-md-2 control-label">Delivery Method</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <?php
                                        $deliveryMethods = array(
                                            1   =>  'Pickup',
                                            2   =>  'Shipping'
                                        );
                                ?>
                                <select name="delivery_method" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->delivery_method != null && $ciPagination->model->delivery_method=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($deliveryMethods as $key => $deliveryMethod) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->delivery_method != null && ( strcasecmp( $ciPagination->model->delivery_method, $key )==0 && $ciPagination->model->delivery_method!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $deliveryMethod ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $deliveryMethod ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="delivery_method">
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
                        <label for="sender_address" class="col-md-2 control-label">Sender Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_address != null ) echo $ciPagination->model->sender_address ?>" name="sender_address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="sender_phone" class="col-md-2 control-label">Sender Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_phone != null ) echo $ciPagination->model->sender_phone ?>" name="sender_phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="sender_email" class="col-md-2 control-label">Sender Email</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_email != null ) echo $ciPagination->model->sender_email ?>" name="sender_email" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_email">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="sender_post" class="col-md-2 control-label">Sender Post</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sender_post != null ) echo $ciPagination->model->sender_post ?>" name="sender_post" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sender_post">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="receiver_name" class="col-md-2 control-label">Receiver Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_name != null ) echo $ciPagination->model->receiver_name ?>" name="receiver_name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_name">
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
                        <label for="receiver_phone" class="col-md-2 control-label">Receiver Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_phone != null ) echo $ciPagination->model->receiver_phone ?>" name="receiver_phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_email" class="col-md-2 control-label">Receiver Email</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_email != null ) echo $ciPagination->model->receiver_email ?>" name="receiver_email" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_email">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_city" class="col-md-2 control-label">Receiver City</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_city != null ) echo $ciPagination->model->receiver_city ?>" name="receiver_city" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_city">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_province" class="col-md-2 control-label">Receiver Province</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_province != null ) echo $ciPagination->model->receiver_province ?>" name="receiver_province" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_province">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_post" class="col-md-2 control-label">Receiver Post</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_post != null ) echo $ciPagination->model->receiver_post ?>" name="receiver_post" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_post">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="receiver_country" class="col-md-2 control-label">Receiver Country</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->receiver_country != null ) echo $ciPagination->model->receiver_country ?>" name="receiver_country" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="receiver_country">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_status" class="col-md-2 control-label">Payment Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <?php
                                        $paymentStatus = array(
                                            1   =>  'Unpaid',
                                            2   =>  'Paid',
                                            3   =>  'Refunded'
                                        );
                                ?>
                                <select name="payment_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->payment_status != null && $ciPagination->model->payment_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($paymentStatus as $key => $paymentState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->payment_status != null && ( strcasecmp( $ciPagination->model->payment_status, $key )==0 && $ciPagination->model->payment_status!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $paymentState ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $paymentState ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="payment_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_grand_total" class="col-md-2 control-label">Start Grand Total</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="start_grand_total" name="start_grand_total" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_grand_total != null ) { echo $ciPagination->model->start_grand_total; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="start_grand_total_result" name="start_grand_total" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_grand_total != null ) echo $ciPagination->model->start_grand_total ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_grand_total">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_grand_total" class="col-md-2 control-label">End Grand Total</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="end_grand_total" name="end_grand_total" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_grand_total != null ) { echo $ciPagination->model->end_grand_total; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="end_grand_total_result" name="end_grand_total" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_grand_total != null ) echo $ciPagination->model->end_grand_total ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_grand_total">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-sm btn-warning">
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
                <?php if($_SESSION['manager']['role']=='administrator'){ ?>
                    <a href="javascript:void(0);" id="delete_order_btn" class="btn btn-sm btn-warning" style="color:#FFF;">
                        <span class="glyphicon glyphicon-trash"></span>
                        Delete selected order with detail(s)
                    </a>
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
                                <th rowspan="2" style="width:10%;">Payment Status</th>
                                <th colspan="4" class="text-center">Fees</th>
                                <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>Method</th>
                                <th style="text-align:right">Product&GST</th>
                                <th style="text-align:right">GST</th>
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
                                    <a href="/manager/e_store/order/edit/id/<?php echo $order->id ?>" class="btn btn-xs btn-warning">
                                        <?php echo $order->id ?>
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $order->create_time ?>
                                </td>
                                <td>
                                    <?php
                                            switch( $order->order_status )
                                            {
                                                case 1 : echo 'Pending'; break;
                                                case 2 : echo 'Processing'; break;
                                                case 3 : echo 'Waiting for Shipment'; break;
                                                case 4 : echo 'Shipped'; break;
                                                case 5 : echo 'Completed'; break;
                                                case 6 : echo 'Cancelled'; break;
                                                default : echo 'Unknown'; break;
                                            }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $order->delivery_method == 1 ? 'Pickup' : ' Shipping' ?>
                                </td>
                                <td>
                                    <strong>Sender Name:</strong> <?php echo $order->sender_name ?><br/>
                                    <strong>Sender Address:</strong> <?php echo $order->sender_address ?><br/>
                                    <strong>Sender Phone:</strong> <?php echo $order->sender_phone ?><br/>
                                    <strong>Sender Email:</strong> <?php echo $order->sender_email ?><br/>
                                    <strong>Sender Post:</strong> <?php echo $order->sender_post ?><br/>
                                </td>
                                <td>
                                    <strong>Receiver Name:</strong> <?php echo $order->receiver_name ?><br/>
                                    <strong>Receiver Phone:</strong> <?php echo $order->receiver_phone ?><br/>
                                    <strong>Receiver Email:</strong> <?php echo $order->receiver_email ?><br/>
                                    <strong>Receiver Address:</strong> <?php echo $order->receiver_address . ', ' . $order->receiver_city . ', ' . $order->receiver_province . ', ' . $order->receiver_post . ', ' . $order->receiver_country ?>
                                </td>
                                <td>
                                    <?php

                                            switch( $order->payment_status )
                                            {
                                                case 1 : echo 'Unpaid'; break;
                                                case 2 : echo 'Paid'; break;
                                                case 3 : echo 'Refunded'; break;
                                                default : echo 'Unknown'; break;
                                            }

                                    ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->subtotal); ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->tax); ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->shipping_fee); ?>
                                </td>
                                <td style="text-align:right">
                                    $<?php echo sprintf("%01.2f",$order->grand_total); ?>
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
<script src="/resources/manager/js/e_store/order/view_order_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->