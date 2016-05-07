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
                        <li class="active">Courier</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/logistic/courier/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Courier
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th></th>
							<th>Name</th>
							<th>Website</th>
							<th>Shipment Lookup Url</th>
							<th>Status</th>
                            <th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($couriers as $courier):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
                                <a href="/manager/warehouse/logistic/courier/edit/id/<?php echo $courier->id ?>" class="btn btn-xs btn-success">
                                    <?php echo $courier->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
                                </a>
							</td>
							<td>
								<?php echo $courier->website ?>
							</td>
							<td>
								<?php echo $courier->shipment_lookup_url ?>
							</td>
							<td>
								<?php
                                    switch( $courier->status )
                                    {
                                        case 1 : echo 'Available'; break;
                                        case 2 : echo 'Unavailable'; break;
                                        default : echo 'Unknown';
                                    }
                                ?>
							</td>
							<td style="text-align:center;">
							 <a href="javascript:void(0);" data-name="delete_courier" data-courier-id="<?php echo $courier->id ?>" class="btn btn-sm btn-danger">
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
<div class="modal fade" id="deleteCourierModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCourierModalLabel">Delete courier</h4>
      </div>
      <div class="modal-body">
        Sure to delete this courier?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteCourierConfirm">Delete</button>
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
<script src="/resources/manager/js/warehouse/logistic/courier/view_courier.js"></script>
<!-- END CUSTOMIZED LIB -->
