
<?php include 'includes/manager/header.php'; ?>

<style>
.form-horizontal .form-group{
	margin:0;
}
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="viewOrderAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager" class="text-warning">EStore</a></li>
                        <li><a href="/manager/e_store/order/view_by/pagination" class="text-warning">View Order</a></li>
                        <li class="active">Edit Order</li>
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
                        </div>
                        <div class="form-group">
                            <label for="payment_status" class="control-label col-md-2">Payment Status</label>
                            <div class="col-md-3">
                                <?php
                                        $payment_method_arr = array
                                        (
                                            1   =>  'DPS Payment Express',
                                            2   =>  'Online Banking',
                                            3   =>  'Phone Ordering'
                                        );
                                ?>
                                <select data-name="payment_status_selector" class="form-control input-sm">
                                    <?php foreach ( $payment_method_arr as $key => $payment_method ) { ?>
                                        <?php if( $key == $order['payment_method'] ){ ?>
                                            <option value="<?php echo $key ?>" selected="selected"><?php echo $payment_method ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $payment_method ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="payment_status" class="control-label col-md-2">Payment Status</label>
                            <div class="col-md-3">
                                <?php
                                        $payment_status_arr = array
                                        (
                                            1   =>  'Unpaid',
                                            2   =>  'Paid'
                                        );
                                ?>
                                <select data-name="payment_status_selector" class="form-control input-sm">
                                    <?php foreach ( $payment_status_arr as $key => $payment_status ) { ?>
                                        <?php if( $key == $order['payment_status'] ){ ?>
                                            <option value="<?php echo $key ?>" selected="selected"><?php echo $payment_status ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $payment_status ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="create_time" class="control-label col-md-2">Create Time</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['create_time'] ?></p>
                            </div>
                            <label for="order_status" class="control-label col-md-2">Order Status</label>
                            <div class="col-md-3">
                                <?php
                                        $order_status_arr = array
                                        (
                                            1   =>  'Pending',
                                            2   =>  'Processing',
                                            3   =>  'Waiting For Shipment',
                                            4   =>  'Shipped',
                                            5   =>  'Completed',
                                            6   =>  'Cancelled',
                                            7   =>  'Refunded'
                                        );
                                ?>
                                <?php if( $order['order_status'] != 6 && $order['order_status'] != 7 ) { ?>
                                    <select data-name="order_status_selector" class="form-control input-sm">
                                        <?php foreach ($order_status_arr as $key => $order_status) { ?>
                                            <?php if( $key == $order['order_status'] ){ ?>
                                            <option value="<?php echo $key ?>" selected="selected"><?php echo $order_status ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $order_status ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <p class="form-control-static"><?php echo $order_status_arr[ $order['order_status'] ] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="delivery_method" class="control-label col-md-2">Delivery Method</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                    <?php
                                            switch( $order['delivery_method'] )
                                            {
                                                case 1 : echo 'Pickup'; break;
                                                case 2 : echo 'Shipping'; break;
                                                default : echo 'Unknown';
                                            }
                                    ?>
                                </p>
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
                            <label for="shipping_area" class="control-label col-md-2">Courier</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $courier['name'] ?></p>
                            </div>
                        </div>
                        <?php if( $order['delivery_method'] == 2 ) { ?>
                            <div class="form-group">
                                <label for="tracking_codes" class="control-label col-md-2">Tracking Codes</label>
                                <div class="col-md-10">
                                    <textarea id="tracking_codes" class="form-control" rows="5"><?php echo $order['tracking_codes'] ?></textarea>
                                    <a href="javascript:void(0);" id="update_tracking_codes" class="btn btn-primary btn-xs pull-right">Update Tracking Codes</a>
                                </div>
                            </div>
                        <?php } ?>
                        <hr/>
                        <div class="form-group">
                            <h3>Receiver</h3>
                        </div>
                        <div class="form-group">
                            <label for="receiver_name" class="control-label col-md-2">Receiver Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_name'] ?></p>
                            </div>
                            <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_address'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_phone'] ?></p>
                            </div>
                            <label for="receiver_city" class="control-label col-md-2">Receiver City</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_city'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_email" class="control-label col-md-2">Receiver Email</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_email'] ?></p>
                            </div>
                            <label for="receiver_province" class="control-label col-md-2">Receiver Province</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_province'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_post" class="control-label col-md-2">Receiver Post</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_post'] ?></p>
                            </div>
                            <label for="receiver_country" class="control-label col-md-2">Receiver Country</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['receiver_country'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3>Sender</h3>
                        </div>
                        <div class="form-group">
                            <label for="sender_name" class="control-label col-md-2">Sender Name</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['sender_name'] ?></p>
                            </div>
                            <label for="sender_address" class="control-label col-md-2">Sender Address</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['sender_address'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sender_phone" class="control-label col-md-2">Sender Phone</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['sender_phone'] ?></p>
                            </div>
                            <label for="sender_email" class="control-label col-md-2">Sender Email</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['sender_email'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sender_post" class="control-label col-md-2">Sender Post</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['sender_post'] ?></p>
                            </div>
                        </div>
                        <hr/>
                        <?php if( strcasecmp( $_SESSION['manager']['role'],'administrator' )==0 && ( $order['order_status'] == 1 || $order['order_status'] == 2 ) ){ ?>
                           <a href="javascript:void(0);" id="deleteOrderDetail" class="btn btn-xs btn-danger" style="color:#FFF;">Delete selected detail(s)</a>
                        <?php } ?>
                        <?php if( $order['payment_status'] == 2 ) { ?>
                            <a href="javascript:void(0);" id="refundOrderDetail" class="btn btn-xs btn-warning" style="color:#FFF;">Refund selected detail(s)</a>
                        <?php } ?>
                       <div class="pull-right" style="padding-right: 4px;"><h3>Total Items: <?php echo $orderItemCount ?></h3></div>
                        <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">&nbsp;</th>
                                        <th rowspan="2">EStore Sku</th>
                                        <th rowspan="2">Name</th>
                                        <th rowspan="2">Weight</th>
                                        <th rowspan="2" class="text-right">Price (NZ$)</th>
                                        <th colspan="4" class="text-center">Qty</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Ordered</th>
                                        <th class="text-center">Shipped</th>
                                        <th class="text-center">Refunded</th>
                                        <th class="text-center">Cancelled</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach( $orderItems as $orderItem ) { ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" data-name="order_item_checkbox" data-order-detail-id="<?php echo $orderItem->id ?>" />
                                            </td>
                                            <td>
                                                <a href="/manager/warehouse/commodity/edit/id/<?php echo $orderItem->commodity_id ?>" class="btn btn-xs btn-warning">
                                                    <?php echo $orderItem->e_store_sku ?>
                                                </a>
                                            </td>
                                            <td style="word-break:break-all;">
                                                <?php echo $orderItem->name ?>
                                            </td>
                                            <td>
                                                <?php echo $orderItem->unit_weight ?>
                                            </td>
                                            <td class="text-right">
                                                $&nbsp;<?php echo sprintf("%01.2f",$orderItem->unit_price); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $orderItem->qty_ordered ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $orderItem->qty_shipped ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $orderItem->qty_refunded ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $orderItem->qty_cancelled ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="3">
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="subtotal" class="control-label col-md-8">Net charges</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="subtotal" value="<?php echo $order['subtotal'] ?>" />
                                                    <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$order['subtotal']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="tax" class="control-label col-md-8">GST at 15%</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="tax" value="<?php echo $order['tax'] ?>" />
                                                    <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$order['tax']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <hr style="margin:0px;">
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="total_product_amount_gst" class="control-label col-md-8">Product charged</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="total_product_amount_gst" value="<?php echo $order['subtotal'] - $order['shipping_fee'] ?>" />
                                                    <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['subtotal'] - $order['shipping_fee']); ?></p>
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
                                                <label for="grand_total" class="control-label col-md-8">Grand Total</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="grand_total" value="<?php echo $order['grand_total'] ?>" />
                                                    <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['grand_total']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="total_paid" class="control-label col-md-8">Total Paid</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="total_paid" value="<?php echo $order['total_paid'] ?>" />
                                                    <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['total_paid']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="total_refunded" class="control-label col-md-8">Total Refunded</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="total_refunded" value="<?php echo $order['total_refunded'] ?>" />
                                                    <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$order['total_refunded']); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr/>
<!--                        <div class="form-group">-->
<!--                            <div class="pull-right">-->
<!--                                <input type="hidden" name="shipping_method" value="Pick Up" />-->
<!--                                <strong>Shipping method:</strong>-->
<!--                                <label><input type="radio" name="shipping_method_radio" value="Pick Up" disabled="disabled" />&nbsp;<span style="font-weight:normal;">Pick Up</span></label>&nbsp;-->
<!--                                <label><input type="radio" name="shipping_method_radio" value="Shipping" disabled="disabled" />&nbsp;<span style="font-weight:normal;">Shipping</span></label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <br/>-->
                        <div class="form-group">
                            <div class="col-md-2 pull-right">
                                <a href="javascript:void(0);" class="btn btn-warning btn-lg btn-block" onclick="history.go(-1);">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
</form>

<!-- Update payment status Modal -->
<div class="modal fade" id="updatePaymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="updatePaymentStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="updatePaymentStatusModalLabel">Update Payment Status</h4>
            </div>
            <div class="modal-body">
                Sure to update payment status to chosen one?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" data-order-id="<?php echo $order['id'] ?>" id="updatePaymentStatusConfirm">YES</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateOrderStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateOrderStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="changeOrderStatusModalLabel">Update order status</h4>
      </div>
      <div class="modal-body">
          Sure to update order status to chosen one?
          <br/><br/>
          <strong>Caution</strong>: If you are changing to <strong>Cancelled</strong> or <strong>Refunded</strong>, then all the related items will be automatically cancelled / refunded, and stocks will be recover.
          <br/><br/>
          <strong>Cancelled / Refunded Orders</strong> can't be recover.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" data-order-id="<?php echo $order['id'] ?>" id="updateOrderStatusConfirm">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateTrackingCodesModal" tabindex="-1" role="dialog" aria-labelledby="updateTrackingCodesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="updateTrackingCodesModalLabel">Update Tracking Codes</h4>
            </div>
            <div class="modal-body">
                Sure to update tracking codes?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" data-order-id="<?php echo $order['id'] ?>" id="updateTrackingCodesConfirm">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteOrderItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteOrderItemModalLabel">Remove order item(s)</h4>
      </div>
      <div class="modal-body">
        Sure to remove selected item(s)? Related stocks will be recover.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" data-order-id="<?php echo $order['id'] ?>" id="removeOrderItemConfirm">YES</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refundOrderDetailModal" tabindex="-1" role="dialog" aria-labelledby="refundOrderDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="refundOrderDetailModalLabel">Refund order item(s)</h4>
            </div>
            <div class="modal-body">
                Sure to refund selected item(s)? This action will refresh the EStore commodity inventory, will be need to take some time to process.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-order-id="<?php echo $order['id'] ?>" id="refundOrderDetailConfirm">Refund</button>
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

<script type="text/javascript" src="/resources/global/bootstrap/js/icheck.min.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script>
    var order_status = '<?php echo $order['order_status'] ?>';
    var payment_status = '<?php echo $order['payment_status'] ?>';
</script>
<script src="/resources/manager/js/e_store/order/edit_order.js"></script>
<!-- END CUSTOMIZED LIB -->
