
<?php include 'includes/remarketing/header.php'; ?>

<style>
.form-horizontal .form-group{
	margin:0;
}
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="viewOrderAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/remarketing" class="text-info">Home</a></li>
                        <li><a href="/remarketing/order/view" class="text-info">View Order</a></li>
                        <li class="active">View Order Detail</li>
                    </ol>
                </div>
                <div id="collapseViewOrder" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="hidden" id="order_id" value="<?php echo $order['id'] ?>" />
                            <label for="order_id" class="control-label col-md-2">Order Id</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['id'] ?></p>
                            </div>
                            <label for="order_by" class="control-label col-md-2">Order By</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                    <?php if($order['manager_id']){ ?>
                                        <?php echo $manager['first_name'] ?>&nbsp;<?php echo $manager['last_name'] ?>
                                    <?php } else { ?>
                                        My Self
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ordered_date" class="control-label col-md-2">Ordered Date</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['ordered_date'] ?></p>
                            </div>
                            <label for="order_status" class="control-label col-md-2">Order Status</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                    <?php
                                        switch( $order['order_status'] )
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
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_method" class="control-label col-md-2">Shipping Method</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['shipping_method'] ?></p>
                            </div>
                            <label for="total_weight" class="control-label col-md-2">Total Weight (Gram)</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['total_weight'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_area" class="control-label col-md-2">Shipping Area</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['shipping_area'] ?></p>
                            </div>
                            <label for="courier" class="control-label col-md-2">Courier</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                    <?php if( $order['courier_id'] ){ ?>
                                        <?php echo $courier['name'] ?>
                                    <?php } else { ?>
                                        No
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                        <?php if( strcasecmp( $order['shipping_method'], 'shipping' ) == 0 ) { ?>
                            <div class="form-group">
                                <label for="shipping_area" class="control-label col-md-2">Tracking Codes</label>
                                <div class="col-md-10">
                                    <?php
                                            $tracking_codes_arr = explode( ',', $order['tracking_codes'] );
                                            if( count( $tracking_codes_arr ) > 0 )
                                            {
                                                foreach( $tracking_codes_arr as $index => $tracking_code )
                                                {
                                                    $final_tracking_code = trim( $tracking_code );
                                                    if( $final_tracking_code != '' )
                                                    {
                                                        if( $index > 0 )
                                                        {
                                                            echo '&nbsp;';
                                                        }
                                                        echo '<a target="_blank" href="http://www.castleparcels.co.nz/cpl/servlet/ITNG_TAndTServlet?page=1&customer_number=12804405&consignment_id=' . $final_tracking_code . '&request_id=3" class="btn btn-info btn-xs">' . $final_tracking_code . '</a>';
                                                    }
                                                }
                                            }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <hr/>
                        <div class="form-group">
                            <h3>Purchaser Detail</h3>
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="control-label col-md-2">Company Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['company_name'] ?></p>
                            </div>
                            <label for="email" class="control-label col-md-2">Email</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['email'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label col-md-2">First Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['first_name'] ?></p>
                            </div>
                            <label for="mobile_phone" class="control-label col-md-2">Mobile Phone</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['mobile_phone'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['last_name'] ?></p>
                            </div>
                            <label for="landline_phone" class="control-label col-md-2">Landline Phone</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['landline_phone'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5"></div>
                            <label for="fax_no" class="control-label col-md-2">Fax No</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['fax_no'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_address" class="control-label col-md-2">Shipping Address</label>
                            <div class="col-md-10">
                                <p class="form-control-static"><?php echo $order['shipping_address'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3>Receiver Detail</h3>
                        </div>
                        <div class="form-group">
                            <label for="receiver_name" class="control-label col-md-2">Receiver Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_name'] ?></p>
                            </div>
                            <label for="receiver_email" class="control-label col-md-2">Receiver Email</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_email'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5"></div>
                            <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_phone'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                            <div class="col-md-10">
                                <p class="form-control-static"><?php echo $order['receiver_address'] . ', ' . $order['receiver_city'] . ', ' . $order['receiver_province'] . ', ' . $order['receiver_post'] . ', ' . $order['receiver_country'] ?></p>
                            </div>
                        </div>
                        <hr/>
                        <div class="pull-right" style="padding-right: 4px;"><h3>Item Ordered: <?php echo $orderDetailCount ?></h3></div>
                        <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Item Code</th>
                                        <th>Location</th>
                                        <th>Manufacturer</th>
                                        <th>Type</th>
                                        <th>Refund</th>
                                        <th style="text-align:right;">Price (NZ$)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderDetails as $orderDetail):?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <a href="/remarketing/product/view_by/id/<?php echo $orderDetail->product_id ?>">
                                                <?php echo $orderDetail->item_code ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $orderDetail->location ?>
                                        </td>
                                        <td>
                                            <?php echo $orderDetail->manufacturer_name ?>
                                        </td>
                                        <td>
                                            <?php echo $orderDetail->type ?>
                                        </td>
                                        <td>
                                            <?php echo strcasecmp( $orderDetail->is_refund,'Y' )==0 ? 'Yes' : 'No' ?>
                                        </td>
                                        <td style="text-align:right;">
                                            $&nbsp;<?php echo sprintf("%01.2f",$orderDetail->price); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td colspan="2">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="total_amount" class="control-label col-md-8">Net charges</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="total_amount" value="<?php echo $order['total_amount'] ?>" />
                                                <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$order['total_amount']); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="gst" class="control-label col-md-8">GST at 15%</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="gst" value="<?php echo $order['gst'] ?>" />
                                                <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$order['gst']); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <hr style="margin:0px;">
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="total_product_amount_gst" class="control-label col-md-8">Product charges</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="total_product_amount_gst" value="<?php echo $order['total_amount_gst'] - $order['shipping_fee'] ?>" />
                                                <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['total_amount_gst'] - $order['shipping_fee']); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="shipping_fee" class="control-label col-md-8">Shipping Fee</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="shipping_fee" value="<?php echo $order['shipping_fee'] ?>" />
                                                <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['shipping_fee']); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="total_amount_gst" class="control-label col-md-8">Total charges</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="total_amount_gst" value="<?php echo $order['total_amount_gst'] ?>" />
                                                <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['total_amount_gst']); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label for="refund_amount" class="control-label col-md-8">Refund Amount</label>
                                            <div class="col-md-4" style="padding-right:0;">
                                                <input type="hidden" id="refund_amount" value="<?php echo $order['refund_amount'] ?>" />
                                                <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['refund_amount']); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="pull-right">
                                <input type="hidden" name="shipping_method" value="Pick Up" />
                                <strong>Shipping method:</strong>
                                <label><input type="radio" name="shipping_method_radio" value="Pick Up" disabled="disabled" />&nbsp;<span style="font-weight:normal;">Pick Up</span></label>&nbsp;
                                <label><input type="radio" name="shipping_method_radio" value="Shipping" disabled="disabled" />&nbsp;<span style="font-weight:normal;">Shipping</span></label>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="col-md-2 pull-right">
                                <a href="javascript:void(0);" class="btn btn-success btn-lg btn-block" onclick="history.go(-1);">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<!-- BEGIN FOOTER -->
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script type="text/javascript" src="/resources/global/bootstrap/js/icheck.min.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script>
    var shipping_method = '<?php echo $order['shipping_method'] ?>';
</script>
<script src="/resources/remarketing/js/order/view_order_by_wholesaler_id.js"></script>
<!-- END CUSTOMIZED LIB -->
