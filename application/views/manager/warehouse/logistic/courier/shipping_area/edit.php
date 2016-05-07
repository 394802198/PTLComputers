
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCourierShippingAreaAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/logistic/courier/shipping_area/view" class="text-success">Courier Shipping Area</a></li>
                        <li class="active">Edit Courier Shipping Area</li>
                    </ol>
                </div>
                <div id="collapseAddCourierShippingArea" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="hidden" id="shipping_area_id" value="<?php echo $courierShippingArea['id'] ?>" />
                                <input type="text" id="name" value="<?php echo $courierShippingArea['name'] ?>" class="form-control" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_courier_shipping_area" class="btn btn-success btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/warehouse/logistic/courier/shipping_area/edit_courier_shipping_area.js"></script>
<!-- END CUSTOMIZED LIB -->
