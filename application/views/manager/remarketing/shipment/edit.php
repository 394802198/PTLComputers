
<?php include 'includes/manager/header.php'; ?>

<style>
.form-horizontal .form-group:not(.shipment-detail){
	margin:0;
}
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editShipmentAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager#remarketing_panel" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/remarketing/shipment/view_by/pagination" class="text-info">Shipment</a></li>
                        <li class="active">Edit Shipment</li>
                    </ol>
                </div>
                <div id="collapseEditOrder" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-3">
                                <h4 class="text-info text-right"><strong>Order Detail</strong></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="shipment_id" value="<?php echo $shipment['id'] ?>" />
                            <input type="hidden" id="order_id" value="<?php echo $order['id'] ?>" />
                            <label for="order_id" class="control-label col-md-3">Order Id</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $order['id'] ?></p>
                            </div>
                            <label for="order_by" class="control-label col-md-2">Order By</label>
                            <div class="col-md-3">
                                <p class="form-control-static">
                                    <?php if( $order['manager_id'] ){ ?>
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
                                <p class="form-control-static"><?php echo isset( $order['order_status'] ) ? $order_status_arr[ $order['order_status'] ] : '' ?></p>
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
                                                <?php $shipmentItems = $shipment['items'];  ?>
                                                <?php foreach( $shipmentItems as $shipmentItem ){ ?>
                                                    <?php if( $orderDetail->id == $shipmentItem->order_item_id ){ ?>
                                                        <?php echo 'checked'  ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                   data-order-detail-id="<?php echo $orderDetail->id ?>" data-name="order_detail_checkbox" />
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
                                <input type="text" class="form-control" id="shipping_fee" value="<?php echo $shipment['shipping_fee'] ?>" />
                            </div>
                            <label for="shipping_cost" class="control-label col-md-2">Shipping Cost</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="shipping_cost" value="<?php echo $shipment['shipping_fee'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="courier_id" class="control-label col-md-3">Courier *</label>
                            <div class="col-md-3">
                                <select class="form-control" id="courier_id">
                                    <?php foreach( $couriers as $courier ) { ?>
                                        <option value="<?php echo $courier->id ?>" <?php echo $courier->id == $shipment['courier_id'] ? 'selected' : '' ?>>
                                            <?php echo $courier->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="ship_number" class="control-label col-md-2">Ship Number *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="ship_number" value="<?php echo $shipment['ship_number'] ?>" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="receive_name" class="control-label col-md-3">Receive Name *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_name" value="<?php echo $shipment['receive_name'] ?>" />
                            </div>
                            <label for="receive_phone" class="control-label col-md-2">Receive Phone *</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_phone" value="<?php echo $shipment['receive_phone'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_country" class="control-label col-md-3">Receive Country</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_country" value="<?php echo $shipment['receive_country'] ?>" />
                            </div>
                            <label for="receive_province" class="control-label col-md-2">Receive Province</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_province" value="<?php echo $shipment['receive_province'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_city" class="control-label col-md-3">Receive City</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_city" value="<?php echo $shipment['receive_city'] ?>" />
                            </div>
                            <label for="receive_post" class="control-label col-md-2">Receive Post</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_post" value="<?php echo $shipment['receive_post'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_email" class="control-label col-md-3">Receive Email</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="receive_email" value="<?php echo $shipment['receive_email'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="receive_address" class="control-label col-md-3">Receive Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="receive_address" value="<?php echo $shipment['receive_address'] ?>" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="sender_name" class="control-label col-md-3">Sender Name</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_name" value="<?php echo $shipment['sender_name'] ?>" />
                            </div>
                            <label for="sender_phone" class="control-label col-md-2">Sender Phone</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_phone" value="<?php echo $shipment['sender_phone'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="sender_email" class="control-label col-md-3">Sender Email</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="sender_email" value="<?php echo $shipment['sender_email'] ?>" />
                            </div>
                        </div>
                        <div class="form-group shipment-detail">
                            <label for="sender_address" class="control-label col-md-3">Sender Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="sender_address" value="<?php echo $shipment['sender_address'] ?>" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group shipment-detail">
                            <label for="memo" class="control-label col-md-3">Memo</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="memo" rows="5"><?php echo $shipment['memo'] ?></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="javascript:void(0);" class="btn btn-info btn-lg" id="edit_shipment">Edit Shipment</a>
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
<div class="modal fade" id="editShipmentModal" tabindex="-1" role="dialog" aria-labelledby="editShipmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editShipmentModalLabel">Edit Shipment</h4>
      </div>
      <div class="modal-body">
          <h4 class="text-danger"><strong>Please read carefully before generate the shipment:</strong></h4>
          <p>&nbsp;&nbsp;&nbsp;If order items are all shipped, then system will switch Order Status to Shipped automatically.</p>
          <p>&nbsp;&nbsp;&nbsp;If Shipments which related to this Order have been Signed by Receiver, then you have to manually switch Shipment Status to Signed and switch Order Status to Completed, and this Order is done. Make sure all related shipments are Signed before Complete the order.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-info" data-dismiss="modal" id="editShipmentConfirm">Edit Shipment</button>
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

<script src="/resources/manager/js/remarketing/shipment/edit_shipment.js"></script>
<!-- END CUSTOMIZED LIB -->
