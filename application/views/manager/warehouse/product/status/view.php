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
                        <li class="active">Product Status</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/product/status/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Status
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th>&nbsp;</th>
							<th>Name</th>
                            <th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($productStatus as $productState):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/warehouse/product/status/edit/id/<?php echo $productState->id ?>" class="btn btn-xs btn-success">
									<?php echo $productState->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
                            <td>
                                <a href="javascript:void(0);" data-name="delete_status_btn" data-id="<?php echo $productState->id ?>" class="btn btn-xs btn-danger" style="color:#FFF;">
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
<div class="modal fade" id="deleteStatusModal" tabindex="-1" role="dialog" aria-labelledby="deleteStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteStatusModalLabel">Delete Status</h4>
            </div>
            <div class="modal-body">
                Sure to delete status?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="deleteStatusConfirm">Sure</button>
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

    $('a[data-name="delete_status_btn"]').click(function(){
        $('#deleteStatusConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteStatusModal').modal('show');
    });

    $('#deleteStatusConfirm').click(function()
    {
        var status_id = $(this).attr('data-id');

        var data = {
            'id':status_id
        };

        $.post('/manager/warehouse/product/status/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
        }, 'json');

    });
</script>

