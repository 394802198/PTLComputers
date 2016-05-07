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
                        <li class="active">Commodity Type</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/warehouse/commodity/type/add" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Type
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th>&nbsp;</th>
							<th>Name</th>
                            <th width="12%">Operation</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($types as $type):?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/warehouse/commodity/type/edit/id/<?php echo $type->id ?>" class="btn btn-xs btn-success">
									<?php echo $type->name ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" data-sequence-input data-type-name="<?php echo $type->name ?>" value="<?php echo $type->sequence ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" data-name="update_sequence" data-type-name="<?php echo $type->name ?>" type="button">
                                            &nbsp;<span class="glyphicon glyphicon-ok"></span>&nbsp;
                                        </button>
                                    </span>
                                </div>
                            </td>
							<td>&nbsp;</td>
						</tr>
                        <?php endforeach;?>
					</tbody>
				</table>
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
<script src="/resources/manager/js/warehouse/commodity/type/view_type.js"></script>
<!-- END CUSTOMIZED LIB -->