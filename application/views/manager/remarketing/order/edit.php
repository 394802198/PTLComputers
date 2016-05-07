
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
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/remarketing/order/view_by/pagination" class="text-info">View Order</a></li>
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
                            <label for="order_by" class="control-label col-md-2">Order By</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                <?php if($order['manager_id']){ ?>
                                    <?php echo $manager['first_name'] ?>&nbsp;<?php echo $manager['last_name'] ?>
                                <?php } else { ?>
                                    Wholesaler
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
                                <?php $order_status_arr = array('pending'=>'Pending','processing'=>'Processing', 'waiting_for_shipment'=>'Waiting For Shipment', 'shipped'=>'Shipped','completed'=>'Completed','cancelled'=>'Cancelled'); ?>
                                <?php if( strcasecmp($order['order_status'], 'cancelled')==0 || strcasecmp($order['order_status'], 'completed')==0 ){ ?>
                                <p class="form-control-static"><?php echo $order_status_arr[ $order['order_status'] ] ?></p>
                                <?php } else { ?>
                                <select data-name="order_status_selector" class="form-control">
                                    <?php foreach ($order_status_arr as $key=>$order_status) { ?>
                                        <?php if($key==$order['order_status']){ ?>
                                        <option value="<?php echo $key ?>" selected="selected"><?php echo $order_status ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $key ?>"><?php echo $order_status ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                <span id="order_status_selector_msg"></span>
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
                            <label for="shipping_area" class="control-label col-md-2">Courier</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $courier['name'] ?></p>
                            </div>
                        </div>
                        <?php if( $order['shipping_method'] == 'Shipping' ) { ?>
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
                        <?php if( strcasecmp( $_SESSION['manager']['role'],'administrator' )==0 && ( strcasecmp( $order['order_status'],'pending' )==0 || strcasecmp( $order['order_status'],'processing' )==0 ) ){ ?>
                           <a href="javascript:void(0);" id="deleteOrderDetail" class="btn btn-xs btn-danger" style="color:#FFF;">Delete selected detail(s)</a>
                       <?php } else if( strcasecmp( $_SESSION['manager']['role'],'administrator' )==0 && ( strcasecmp( $order['order_status'],'waiting_for_shipment' )==0 || strcasecmp( $order['order_status'],'shipped' )==0 || strcasecmp( $order['order_status'],'completed' )==0 ) ){ ?>
                           <a href="javascript:void(0);" id="refundOrderDetail" class="btn btn-xs btn-warning" style="color:#FFF;">Refund selected detail(s)</a>
                       <?php } ?>
                       <div class="pull-right" style="padding-right: 4px;"><h3>Total Items: <?php echo $orderDetailCount ?></h3></div>
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
                                        <td>
                                            <?php if( strcasecmp( $_SESSION['manager']['role'],'administrator' )==0 && ( strcasecmp( $order['order_status'],'pending' )==0 || strcasecmp( $order['order_status'],'processing' )==0 || strcasecmp( $order['order_status'],'completed' )==0 ) ){ ?>
                                                <input type="checkbox" data-name="order_detail_checkbox" data-order-detail-id="<?php echo $orderDetail->id ?>" />
                                            <?php } else { ?>
                                                &nbsp;
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="/manager/warehouse/product/edit/id/<?php echo $orderDetail->product_id ?>" class="btn btn-xs btn-info">
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
                                <a href="javascript:void(0);" class="btn btn-info btn-lg btn-block" onclick="history.go(-1);">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
</form>

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
<div class="modal fade" id="updateOrderStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateOrderStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="changeOrderStatusModalLabel">Update order status</h4>
      </div>
      <div class="modal-body">
          <ul
              <li><hr/></li>
              <li><strong>Pending:</strong> Wholesaler ordered default status. <strong>Status still changeable</strong></li>
              <li><hr/></li>
              <li><strong>Processing:</strong> Manager ordered default status. <strong>Status still changeable</strong></li>
              <li><hr/></li>
              <li><strong>Waiting For Shipment:</strong> Ordered products switch to Sold and Unlocked, and appeared in <strong>[Add Remarketing Shipment]</strong> page. <strong>Status still changeable</strong></li>
              <li><hr/></li>
              <li><strong>Shipped:</strong> Ordered products switch to Sold and Unlocked. <strong>Status still changeable</strong></li>
              <li><hr/></li>
              <li><strong>Completed:</strong> Ordered products switch to Sold and Unlocked. <strong>Status will be unchangeable</strong></li>
              <li><hr/></li>
              <li><strong>Cancelled:</strong> Ordered product switch to In Stock and Unlocked. <strong>Status will be unchangeable</strong></li>
          </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="updateOrderStatusConfirm">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteOrderDetailModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteOrderDetailModalLabel">Remove order detail(s)</h4>
      </div>
      <div class="modal-body">
        Sure to remove selected item(s)? This action will unlock the locked product(s).
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-order-id="<?php echo $order['id'] ?>" id="removeOrderDetailConfirm">Remove</button>
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
</script>
<script src="/resources/manager/js/remarketing/order/edit_order.js"></script>
<!-- END CUSTOMIZED LIB -->
