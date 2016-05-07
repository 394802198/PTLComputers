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
                        <li class="active">Product Job Number</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/product/job_number/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Job Number
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
						<?php foreach ($jobNumbers as $jobNumber):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/warehouse/product/job_number/edit/id/<?php echo $jobNumber->id ?>" class="btn btn-xs btn-success">
									<?php echo $jobNumber->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
							<td>
                                <a href="javascript:void(0);" id="delete_job_number_btn" data-id="<?php echo $jobNumber->id ?>" class="btn btn-xs btn-danger" style="color:#FFF;">
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
<div class="modal fade" id="deleteJobNumberModal" tabindex="-1" role="dialog" aria-labelledby="deleteJobNumberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteJobNumberModalLabel">Delete Job Number</h4>
            </div>
            <div class="modal-body">
                Sure to delete job number?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="deleteJobNumberConfirm">Sure</button>
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

    $('a[data-name="delete_job_number_btn"]').click(function(){
        $('#deleteJobNumberConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteJobNumberModal').modal('show');
    });

    $('#deleteJobNumberConfirm').click(function()
    {
        var job_number_id = $(this).attr('data-id');

        var data = {
            'id':job_number_id
        };

        $.post('/manager/warehouse/product/job_number/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
        }, 'json');

    });
</script>