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
                        <li class="active">Courier Shipping Area</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/logistic/courier/shipping_area/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Courier Shipping Area
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th>&nbsp;</th>
							<th>Name</th>
                            <th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($courierShippingAreas as $courierShippingArea):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
                                <a href="/manager/warehouse/logistic/courier/shipping_area/edit/id/<?php echo $courierShippingArea->id ?>" class="btn btn-xs btn-success">
                                    <?php echo $courierShippingArea->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
                                </a>
							</td>
							<td style="text-align:center;">
							 <a href="javascript:void(0);" data-name="delete_courier_shipping_area" data-courier-shipping-area-id="<?php echo $courierShippingArea->id ?>" class="btn btn-sm btn-success">
							     <span class="glyphicon glyphicon-trash"></span>
							 </a>
							</td>
						</tr>
                        <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCourierShippingAreaModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourierShippingAreaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCourierShippingAreaModalLabel">Delete courier shipping area</h4>
      </div>
      <div class="modal-body">
        Sure to delete this courier shipping area?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteCourierShippingAreaConfirm">Delete</button>
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
<script src="/resources/manager/js/warehouse/logistic/courier/shipping_area/view_courier_shipping_area.js"></script>
<!-- END CUSTOMIZED LIB -->
