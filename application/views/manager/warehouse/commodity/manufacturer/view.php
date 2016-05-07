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
                        <li class="active">Commodity Manufacturer</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/commodity/manufacturer/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Manufacturer
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th>&nbsp;</th>
							<th>Name</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($manufacturers as $manufacturer):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/warehouse/commodity/manufacturer/edit/id/<?php echo $manufacturer->id ?>" class="btn btn-xs btn-success">
									<?php echo $manufacturer->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
							<td>
                                <a href="javascript:void(0);" data-name="delete_manufacturer_btn" data-id="<?php echo $manufacturer->id ?>" class="btn btn-xs btn-danger" style="color:#FFF;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Delete
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
<div class="modal fade" id="deleteManufacturerModal" tabindex="-1" role="dialog" aria-labelledby="deleteManufacturerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteManufacturerModalLabel">Delete Manufacturer</h4>
            </div>
            <div class="modal-body">
                Sure to delete manufacturer?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="deleteManufacturerConfirm">Sure</button>
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

<script>

    $('a[data-name="delete_manufacturer_btn"]').click(function(){
        $('#deleteManufacturerConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteManufacturerModal').modal('show');
    });

    $('#deleteManufacturerConfirm').click(function()
    {
        var manufacturer_id = $(this).attr('data-id');

        var data = {
            'id':manufacturer_id
        };

        $.post('/manager/warehouse/commodity/manufacturer/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
        }, 'json');

    });
</script>
