
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCourierPriceAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/logistic/courier/pricing/view" class="text-success">Courier Pricing</a></li>
                        <li class="active">Add Courier Pricing</li>
                    </ol>
                </div>
                <div id="collapseAddCourierPrice" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="courier_id" class="control-label col-md-2">Courier</label>
                            <div class="col-md-3">
                                <select id="courier_id" class="form-control">
                                    <option></option>
                                    <?php foreach( $couriers as $courier ){ ?>
                                        <option value="<?php echo $courier->id ?>"><?php echo $courier->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="shipping_area_id" class="control-label col-md-2">Shipping Area</label>
                            <div class="col-md-3">
                                <select id="shipping_area_id" class="form-control">
                                    <option></option>
                                    <?php foreach( $courierShippingAreas as $courierShippingArea ){ ?>
                                        <option value="<?php echo $courierShippingArea->id ?>"><?php echo $courierShippingArea->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="charge_wholesaler_per_kg" class="control-label col-md-2">Charge Wholesaler Per KG</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="number" id="charge_wholesaler_per_kg" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                            <label for="charge_customer_per_kg" class="control-label col-md-2">Charge Customer Per KG</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="number" id="charge_customer_per_kg" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_for_wholesaler" class="control-label col-md-2">Is For Wholesaler</label>
                            <div class="col-md-3">
                                <select id="is_for_wholesaler" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                            <label for="is_for_customer" class="control-label col-md-2">Is For Customer</label>
                            <div class="col-md-3">
                                <select id="is_for_customer" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_courier_pricing" class="btn btn-success btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/warehouse/logistic/courier/pricing/add_courier_pricing.js"></script>
<!-- END CUSTOMIZED LIB -->
