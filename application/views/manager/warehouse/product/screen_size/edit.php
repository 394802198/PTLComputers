
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel-group" id="addScreenSizeAccordion">
				<div class="panel panel-success">
					<div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-success">Home</a></li>
                            <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                            <li><a href="/manager/warehouse/product/screen_size/view" class="text-success">Product Screen Size</a></li>
                            <li class="active">Edit Screen Size</li>
                        </ol>
					</div>
					<div id="collapseAddScreenSize" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-3">
								    <input type="hidden" id="screen_size_id" value="<?php echo $screenSize['id'] ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="control-label col-md-2">Name</label>
								<div class="col-md-3">
									<input type="text" id="name" value="<?php echo $screenSize['name'] ?>" class="form-control" data-error-field/>
								</div>
							</div>
							<hr/>
							<div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <a id="edit_screen_size" class="btn btn-success btn-lg">Edit</a>
                                    <a class="btn btn-default btn-lg" href="javascript:history.go( -1 );">Return</a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>

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
<script src="/resources/manager/js/warehouse/product/screen_size/edit_screen_size.js"></script>
<!-- END CUSTOMIZED LIB -->
