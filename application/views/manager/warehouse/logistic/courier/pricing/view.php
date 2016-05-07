<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li class="active">Courier Pricing</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/logistic/courier/pricing/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Courier Pricing
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th></th>
							<th>Courier</th>
							<th>Shipping Area</th>
							<th>Charge Wholesaler Per KG</th>
							<th>Charge Customer Per KG</th>
                            <th>Is For Wholesaler</th>
                            <th>Is For Customer</th>
                            <th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $courierPricings as $courierPricing ) { ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <a href="/manager/warehouse/logistic/courier/pricing/edit/id/<?php echo $courierPricing->id ?>" class="btn btn-xs btn-success">
                                        <?php echo $courierPricing->courier['name'] ?>
                                        <span class="glyphicon glyphicon-pencil" ></span>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $courierPricing->shippingArea['name'] ?>
                                </td>
                                <td>
                                    <?php echo $courierPricing->charge_wholesaler_per_kg ?>
                                </td>
                                <td>
                                    <?php echo $courierPricing->charge_customer_per_kg ?>
                                </td>
                                <td>
                                    <?php echo strcasecmp( $courierPricing->is_for_wholesaler,'Y' )==0 ? 'Yes' : 'No' ?>
                                </td>
                                <td>
                                    <?php echo strcasecmp( $courierPricing->charge_customer_per_kg,'Y' )==0 ? 'Yes' : 'No' ?>
                                </td>
                                <td style="text-align:center;">
                                 <a href="javascript:void(0);" data-name="delete_courier_pricing" data-courier-pricing-id="<?php echo $courierPricing->id ?>" class="btn btn-sm btn-danger">
                                     <span class="glyphicon glyphicon-trash"></span>
                                 </a>
                                </td>
                            </tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCourierPricingModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourierPricingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCourierPricingModalLabel">Delete courier pricing</h4>
      </div>
      <div class="modal-body">
        Sure to delete this courier pricing?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteCourierPricingConfirm">Delete</button>
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
<script src="/resources/manager/js/warehouse/logistic/courier/pricing/view_courier_pricing.js"></script>
<!-- END CUSTOMIZED LIB -->
