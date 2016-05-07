<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li class="active">Manager</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/core/manager/add" class="btn btn-xs btn-danger">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Manager
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th></th>
							<th>ID</th>
							<th>Login Account</th>
							<th>Login Password</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Role</th>
							<th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($managers as $manager):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/core/manager/edit/id/<?php echo $manager->id ?>" class="btn btn-xs btn-danger">
									<?php echo $manager->id ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
							<td>
								<?php echo $manager->login_account ?>
							</td>
							<td>
								<?php echo $manager->login_password ?>
							</td>
							<td>
								<?php echo $manager->first_name ?>
							</td>
							<td>
								<?php echo $manager->last_name ?>
							</td>
							<td>
								<?php echo $manager->role ?>
							</td>
							<td style="text-align:center;">
							 <a href="javascript:void(0);" data-name="delete_manager" data-manager-id="<?php echo $manager->id ?>" class="btn btn-sm btn-danger">
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
<div class="modal fade" id="deleteManagerModal" tabindex="-1" role="dialog" aria-labelledby="deleteManagerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteManagerModalLabel">Delete manager</h4>
      </div>
      <div class="modal-body">
        Sure to delete this manager?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteManagerConfirm">Delete</button>
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
<script src="/resources/manager/js/core/manager/view_manager.js"></script>
<!-- END CUSTOMIZED LIB -->
