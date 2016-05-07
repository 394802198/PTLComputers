
<?php include 'includes/remarketing/header.php'; ?>

<style>
.form-horizontal .form-group{
	margin:0;
}
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="viewCartAccordion">
            <div class="panel panel-info">
                <?php if(!empty($cart)){ ?>
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/remarketing" class="text-info">Home</a></li>
                        <li class="active">View Cart Detail</li>
                    </ol>
                    <hr/>
                    <h4 class="panel-title">
                        <a href="javascript:void(0);" data-name="emptyCart" style="color:red;" data-toggle="tooltip" data-placement="right" data-original-title="Empty cart"><span class="glyphicon glyphicon-trash" style="font-weight:bold;"></span></a>
                        <span class="pull-right" style="color:#000;">Cart Created Date:&nbsp;<?php echo $cart['create_date'] ?>&nbsp;</span>
                    </h4>
                </div>
                <div id="collapseViewCart" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Operation</th>
                                        <th>Item Code</th>
                                        <th>In Cart Date</th>
                                        <th>Location</th>
                                        <th>Manufacturer</th>
                                        <th>Type</th>
                                        <th style="text-align:right;">Price (NZ$)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartDetails as $cartDetail):?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <a href="javascript:void(0);" data-cart-detail-id="<?php echo $cartDetail->id ?>" data-name="deleteCartDetail" data-toggle="tooltip" data-placement="right" data-original-title="Remove this from cart" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove" style="color:#FFF;"></span>
                                            </a>
                                        </td>
                                        <td data-product data-product-id="<?php echo $cartDetail->product_id ?>">
                                            <a href="/remarketing/product/view_by/id/<?php echo $cartDetail->product_id ?>" class="btn btn-xs btn-info">
                                                <?php echo $cartDetail->item_code ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $cartDetail->create_date ?>
                                        </td>
                                        <td>
                                            <?php echo $cartDetail->location ?>
                                        </td>
                                        <td>
                                            <?php echo $cartDetail->manufacturer_name ?>
                                        </td>
                                        <td>
                                            <?php echo $cartDetail->type ?>
                                        </td>
                                        <td style="text-align:right;">
                                            $&nbsp;<?php echo sprintf("%01.2f",$cartDetail->price); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="pull-right">
                                                <input type="hidden" name="shipping_method" value="Pick Up" />
                                                <strong>Shipping method:</strong>
                                                <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Pick Up" />&nbsp;<span style="font-weight:normal;">Pick Up</span></label>&nbsp;
                                                <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Shipping" />&nbsp;<span style="font-weight:normal;">Shipping</span></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <input type="hidden" name="shipping_area" />
                                            <input type="hidden" name="receiver_address" />
                                            <label class="col-md-4 control-label">Shipping Area</label>
                                            <div class="col-md-8">
                                                <div class="col-md-12" id="shipping_area_div"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <input type="hidden" name="courier_and_pricing" />
                                            <label class="col-md-4 control-label">Courier And Charge per KG</label>
                                            <div class="col-md-8">
                                                <div class="col-md-12" id="courier_and_pricing_div"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <div class="col-md-12">
                                                <div class="col-md-12" style="margin-bottom:0px;">
                                                    <label class="control-label col-md-9">Net charges</label>
                                                    <div class="col-md-3" style="padding-right:0;">
                                                        <p class="form-control-static pull-right" id="total_amount_p"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom:0px;">
                                                    <label class="control-label col-md-9">GST</label>
                                                    <div class="col-md-3" style="padding-right:0;">
                                                        <p class="form-control-static pull-right" id="gst_p"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom:0px;">
                                                    <label class="control-label col-md-9">Shipping Fee</label>
                                                    <div class="col-md-3" style="padding-right:0;">
                                                        <p class="form-control-static pull-right" id="shipping_fee_p"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom:0px;">
                                                    <label class="control-label col-md-9">Product Include GST</label>
                                                    <div class="col-md-3" style="padding-right:0;">
                                                        <p class="form-control-static pull-right" id="total_amount_gst_p"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom:0px;">
                                                    <label class="control-label col-md-9">Total Amount</label>
                                                    <div class="col-md-3" style="padding-right:0;">
                                                        <p class="form-control-static pull-right" id="total_amount_gst_shipping_fee_p"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr/>
                        <div class="form-group">
                        </div>
                        <br/>
                        <div class="form-group">
                        </div>
                        <br/>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="col-md-2 pull-right">
                                <button id="orderBtn" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#orderModal">Order</button>
                            </div>
                        </div>
                    </div>
                </div>


<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="orderModalLabel">Confirm to order</h4>
      </div>
      <div class="modal-body">
        Sure to make this online order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="orderConfirm" data-cart-id="<?php echo $cart['id'] ?>">YES! Order them</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCartDetailModal" tabindex="-1" role="dialog" aria-labelledby="deleteCartDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCartDetailModalLabel">Remove cart detail</h4>
      </div>
      <div class="modal-body">
        Sure to remove this detail?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" data-cart-id="<?php echo $cart['id'] ?>" id="removeCartDetailConfirm">Remove</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="emptyCartModal" tabindex="-1" role="dialog" aria-labelledby="emptyCartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="emptyCartModalLabel">Empty cart</h4>
      </div>
      <div class="modal-body">
        Sure to empty cart?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-cart-id="<?php echo $cart['id'] ?>" id="emptyCartConfirm">Empty cart</button>
      </div>
    </div>
  </div>
</div>

                <?php } else { ?>
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/remarketing" class="text-info">Home</a></li>
                            <li class="active">View Cart Detail</li>
                        </ol>
                    </div>
                    <div id="collapseViewCart" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="alert alert-warning">Cart is empty, click <a href="/remarketing/product/view_by/pagination" style="font-weight:bold;">Here</a> to add some products.</div>
                        </div>
                    </div>
                <?php } ?>
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
<script src="/resources/remarketing/js/cart/view.js"></script>
<!-- END CUSTOMIZED LIB -->
