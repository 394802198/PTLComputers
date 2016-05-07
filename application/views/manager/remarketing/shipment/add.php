
<?php include 'includes/manager/header.php'; ?>

<style>
.form-horizontal .form-group:not(.shipment-detail){
	margin:0;
}
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addShipmentAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager" class="text-info">Warehouse</a></li>
                        <li><a href="/manager" class="text-info">Shipment</a></li>
                        <li><a href="/manager" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/warehouse/shipment/remarketing/add_by/pagination" class="text-info">Add Shipment Pagination</a></li>
                        <li class="active">Add Shipment</li>
                    </ol>
                </div>
                <div id="collapseViewOrder" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-3">
                                <h4 class="text-info text-right"><strong>Order Detail</strong></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="order_id" value="<?php echo $order['id'] ?>" />
                            <label for="order_id" class="control-label col-md-3">Order Id</label>
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
                            <label for="ordered_date" class="control-label col-md-3">Ordered Date</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['ordered_date'] ?></p>
                            </div>
                            <label for="order_status" class="control-label col-md-2">Order Status</label>
                            <div class="col-md-3">
                                <?php $order_status_arr = array('pending'=>'Pending','processing'=>'Processing', 'waiting_for_shipment'=>'Waiting For Shipment', 'shipped'=>'Shipped','completed'=>'Completed','cancelled'=>'Cancelled'); ?>
                                <p class="form-control-static"><?php echo $order_status_arr[ $order['order_status'] ] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_method" class="control-label col-md-3">Shipping Method</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['shipping_method'] ?></p>
                            </div>
                            <label for="total_weight" class="control-label col-md-2">Total Weight (Gram)</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['total_weight'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_area" class="control-label col-md-3">Shipping Area</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['shipping_area'] ?></p>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th colspan="14" style="font-size:20px; line-height:30px;">
                                        <input type="checkbox" data-name="order_detail_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                        <span class="pull-right">Total Items: <?php echo $orderDetailCount ?></span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Item Code</th>
                                    <th>Location</th>
                                    <th>Manufacturer</th>
                                    <th>Type</th>
                                    <th>Refund</th>
                                    <th>Shipped</th>
                                    <th style="text-align:right;">Weight (Gram)</th>
                                    <th style="text-align:right;">Price (NZ$)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orderDetails as $orderDetail):?>
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                                <?php if( strcasecmp( $orderDetail->is_shipped, 'N' )==0 ){ ?>
                                                    <?php echo 'checked'  ?>
                                                <?php } ?>
                                                   data-name="order_detail_checkbox" data-order-detail-id="<?php echo $orderDetail->id ?>" />
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
                                        <td>
                                            <?php echo strcasecmp( $orderDetail->is_shipped,'Y' )==0 ? 'Yes' : 'No' ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php echo $orderDetail->weight ?>
                                        </td>
                                        <td style="text-align:right;">
                                            $&nbsp;<?php echo sprintf("%01.2f",$orderDetail->price); ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-3">
                                <h4 class="text-info text-right"><strong>Shipment Detail</strong></h4>
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="shipping_fee" class="control-label col-md-3">Shipping Fee</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="shipping_fee" value="<?php echo $order['shipping_fee'] ?>" />
                            </div>
                            <label for="shipping_cost" class="control-label col-md-2">Shipping Cost</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="shipping_cost" value="<?php echo $order['shipping_fee'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="courier_id" class="control-label col-md-3">Courier *</label>
                            <div class="col-md-3">
                                <select class="form-control" id="courier_id">
                                    <?php foreach( $couriers as $courier ) { ?>
                                        <option value="<?php echo $courier->id ?>" <?php echo $courier->id == $order['courier_id'] ? 'selected' : '' ?>>
                                            <?php echo $courier->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="ship_number" class="control-label col-md-2">Ship Number *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="ship_number" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="receive_address" class="control-label col-md-3">Receive Address *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="receive_address" value="<?php echo $order['receiver_address'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_name" class="control-label col-md-3">Receive Name *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_name" value="<?php echo $order['receiver_name'] ?>" />
                            </div>
                            <label for="receive_phone" class="control-label col-md-2">Receive Phone *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_phone" value="<?php echo $order['receiver_phone'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_country" class="control-label col-md-3">Receive Country</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_country" value="<?php echo $order['receiver_country'] ?>" />
                            </div>
                            <label for="receive_province" class="control-label col-md-2">Receive Province</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_province" value="<?php echo $order['receiver_province'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_city" class="control-label col-md-3">Receive City</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_city" value="<?php echo $order['receiver_city'] ?>" />
                            </div>
                            <label for="receive_post" class="control-label col-md-2">Receive Post</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_post" value="<?php echo $order['receiver_post'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_email" class="control-label col-md-3">Receive Email</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_email" value="<?php echo $order['receiver_email'] ?>" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="sender_name" class="control-label col-md-3">Sender Name</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_name" value="<?php echo $order['first_name'] . ' ' . $order['last_name'] ?>" />
                            </div>
                            <label for="sender_phone" class="control-label col-md-2">Sender Phone</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_phone" value="<?php echo $order['landline_phone'] ? $order['landline_phone'] : $order['mobile_phone'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="sender_email" class="control-label col-md-3">Sender Email</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_email" value="<?php echo $order['email'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="sender_address" class="control-label col-md-3">Sender Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="sender_address" value="<?php echo $order['shipping_address'] ?>" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="memo" class="control-label col-md-3">Memo</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="memo" rows="5"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="javascript:void(0);" class="btn btn-info btn-lg" id="add_shipment">Add Shipment</a>
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
<div class="modal fade" id="addShipmentModal" tabindex="-1" role="dialog" aria-labelledby="addShipmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addShipmentModalLabel">Add Shipment</h4>
      </div>
      <div class="modal-body">
          <h4 class="text-danger"><strong>Please read carefully before generate the shipment:</strong></h4>
          <p>&nbsp;&nbsp;&nbsp;If order items are all shipped, then system will switch Order Status to Shipped automatically.</p>
          <p>&nbsp;&nbsp;&nbsp;If Shipments which related to this Order have been Signed by Receiver, then you have to manually switch Shipment Status to Signed and switch Order Status to Completed, and this Order is done. Make sure all related shipments are Signed before Complete the order.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-info" data-dismiss="modal" id="addShipmentConfirm">Generate Shipment</button>
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
<script src="/resources/manager/js/remarketing/shipment/add_shipment.js"></script>
<!-- END CUSTOMIZED LIB -->
