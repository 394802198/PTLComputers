
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addProductAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/product/view_by/pagination" class="text-success">Product</a></li>
                        <li class="active">Add Product</li>
                    </ol>
                </div>
                <div id="collapseAddProduct" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="job_number" class="control-label col-md-2">Job Number</label>
                            <div class="col-md-3">
                                <select id="job_number" class="form-control">
                                    <option></option>
                                    <?php foreach ($jobNumbers as $jobNumber): ?>
                                        <option value="<?php echo $jobNumber->name ?>">
                                            <?php echo $jobNumber->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_status" class="control-label col-md-2">Product Status</label>
                            <div class="col-md-3">
                                <select id="product_status" class="form-control">
                                    <?php foreach ($productStatus as $productState): ?>
                                    <option value="<?php echo $productState->name ?>">
                                       <?php echo $productState->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="type" class="control-label col-md-2">Product Type</label>
                            <div class="col-md-3">
                                <select id="type" class="form-control">
                                    <?php foreach ($types as $type): ?>
                                    <option value="<?php echo $type->name ?>">
                                       <?php echo $type->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_name" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select id="manufacturer_name" class="form-control">
                                    <?php foreach ($manufacturers as $manufacturer): ?>
                                    <option value="<?php echo $manufacturer->name ?>">
                                       <?php echo $manufacturer->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <select id="location" class="form-control">
                                    <?php foreach ($locations as $location): ?>
                                    <option value="<?php echo $location->name ?>">
                                       <?php echo $location->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_code" class="control-label col-md-2">Item Code</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-screenshot"></span></span>
                                    <input type="text" id="item_code" class="form-control" placeholder="*" data-error-field/>
                                </div>
                            </div>
                            <label for="visual_status" class="control-label col-md-2">Visual Status</label>
                            <div class="col-md-3">
                                <select id="visual_status" class="form-control">
                                    <?php foreach ($visualStatus as $visualState): ?>
                                    <option value="<?php echo $visualState->name ?>">
                                       <?php echo $visualState->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" id="price" class="form-control" placeholder="*" data-error-field/>
                                </div>
                            </div>
                            <label for="weight" class="control-label col-md-2">Weight ( Gram )</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                                    <input type="text" id="weight" class="form-control" placeholder="*" data-error-field/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="screen_size" class="control-label col-md-2">Screen Size</label>
                            <div class="col-md-3">
                                <select id="screen_size" class="form-control">
                                    <?php foreach ($screenSizes as $screenSize): ?>
                                        <option value="<?php echo $screenSize->name ?>">
                                            <?php echo $screenSize->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="performance_status" class="control-label col-md-2">Performance Status</label>
                            <div class="col-md-3">
                                <select id="performance_status" class="form-control">
                                    <?php foreach ($performanceStatus as $performanceState): ?>
                                        <option value="<?php echo $performanceState->name ?>">
                                            <?php echo $performanceState->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label col-md-2">Model</label>
                            <div class="col-md-3">
                                <input type="text" id="model" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="sn" class="control-label col-md-2">SN</label>
                            <div class="col-md-3">
                                <input type="text" id="sn" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="processor" class="control-label col-md-2">Processor</label>
                            <div class="col-md-3">
                                <input type="text" id="processor" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                            <label for="processor_speed" class="control-label col-md-2">Processor Speed</label>
                            <div class="col-md-3">
                                <input type="text" id="processor_speed" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mem_size" class="control-label col-md-2">Mem Size</label>
                            <div class="col-md-3">
                                <input type="text" id="mem_size" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                            <label for="hdd_size" class="control-label col-md-2">HDD Size</label>
                            <div class="col-md-3">
                                <input type="text" id="hdd_size" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="optical_drive" class="control-label col-md-2">Optical Drive</label>
                            <div class="col-md-3">
                                <input type="text" id="optical_drive" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                            <label for="system_license" class="control-label col-md-2">System License</label>
                            <div class="col-md-3">
                                <input type="text" id="system_license" class="form-control" value="None" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_power_supply" class="control-label col-md-2">Is Power Supply</label>
                            <div class="col-md-3">
                                <select id="is_power_supply" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                            <label for="is_web_cam" class="control-label col-md-2">Is Web Cam</label>
                            <div class="col-md-3">
                                <select id="is_web_cam" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label col-md-2">Notes</label>
                            <div class="col-md-8">
                                <textarea id="notes" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faults" class="control-label col-md-2">Faults</label>
                            <div class="col-md-8">
                                <textarea id="faults" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_product" class="btn btn-success btn-lg">Save</a>
                                <a class="btn btn-default btn-lg" href="javascript:history.go( -1 );">Return</a>
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
<script src="/resources/manager/js/warehouse/product/add_product.js"></script>
<!-- END CUSTOMIZED LIB -->
