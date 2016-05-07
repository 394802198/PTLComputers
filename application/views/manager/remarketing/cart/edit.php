
<?php include 'includes/manager/header.php'; ?>

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
                <div class="panel-heading">
                    <ol class="breadcrumb">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/remarketing/cart/view" class="text-info">View Cart</a></li>
                        <li class="active">Edit Cart</li>
                    </ol>
                    <hr/>
                    <h4 class="panel-title">
                        <a href="javascript:void(0);" data-name="emptyCart" data-toggle="tooltip" data-placement="right" data-original-title="Empty cart" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash" style="color:#FFF;"></span>
                        </a>
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
                                            <a href="javascript:void(0);" data-cart-detail-id="<?php echo $cartDetail->id ?>" data-name="deleteCartDetail" data-toggle="tooltip" data-placement="right" data-original-title="Remove this from cart" class="text-danger">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/manager/warehouse/product/edit/id/<?php echo $cartDetail->product_id ?>" class="btn btn-xs btn-info">
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
                                        <td colspan="6"></td>
                                        <td colspan="2">
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="total_amount" class="control-label col-md-8">Net charges</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="total_amount" value="<?php echo $cart['total_amount'] ?>" />
                                                    <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$cart['total_amount']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="gst" class="control-label col-md-8">GST at 15%</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="gst" value="<?php echo $cart['gst'] ?>" />
                                                    <p class="form-control-static pull-right">$&nbsp;<?php echo sprintf("%01.2f",$cart['gst']); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <hr style="margin:0px;">
                                            </div>
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="total_amount_gst" class="control-label col-md-8">Product Total charges</label>
                                                <div class="col-md-4" style="padding-right:0;">
                                                    <input type="hidden" id="total_amount_gst" value="<?php echo $cart['total_amount_gst'] ?>" />
                                                    <p class="form-control-static pull-right" style="font-weight:bold;">$&nbsp;<?php echo sprintf("%01.2f",$cart['total_amount_gst']); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

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
<script src="/resources/manager/js/remarketing/cart/remove_from_cart.js"></script>
<!-- END CUSTOMIZED LIB -->
