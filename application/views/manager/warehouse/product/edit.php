
<?php include 'includes/manager/header.php'; ?>

<?php $isNotAvailable = strcasecmp( $product['is_ordered'],'Y' )==0 ? true : false ?>
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
                        <li class="active">Edit Product</li>
                    </ol>
                </div>
                <div id="collapseAddProduct" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="imported_date" class="control-label col-md-2">Imported Date</label>
                            <div class="col-md-3">
                                <input type="hidden" id="imported_date" value="<?php echo $product['imported_date'] ?>" />
                                <p class="form-control-static"><?php echo $product['imported_date'] ?></p>
                            </div>
                            <label for="last_update" class="control-label col-md-2">Last Update</label>
                            <div class="col-md-3">
                                <input type="hidden" id="last_update" value="<?php echo $product['last_update'] ?>" />
                                <p class="form-control-static"><?php echo $product['last_update'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_id" class="control-label col-md-2">Product Id</label>
                            <div class="col-md-3">
                                <input type="hidden" id="product_id" value="<?php echo $product['id'] ?>" />
                                <p class="form-control-static"><?php echo $product['id'] ?></p>
                            </div>
                            <label for="ordered_date" class="control-label col-md-2">Ordered Date</label>
                            <div class="col-md-3">
                                <input type="hidden" id="ordered_date" value="<?php echo $product['ordered_date'] ?>" />
                                <p class="form-control-static"><?php echo $product['ordered_date'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_number" class="control-label col-md-2">Job Number</label>
                            <div class="col-md-3">
                                <select id="job_number" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <option></option>
                                    <?php foreach ($jobNumbers as $jobNumber): ?>
                                        <?php if( strcasecmp($product['job_number'], $jobNumber->name)==0 ){ ?>
                                            <option value="<?php echo $jobNumber->name ?>" selected="selected">
                                                <?php echo $jobNumber->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $jobNumber->name ?>">
                                                <?php echo $jobNumber->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_status" class="control-label col-md-2">Product Status</label>
                            <div class="col-md-3">
                                <select id="product_status" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($productStatus as $productState): ?>
                                        <?php if( strcasecmp($product['product_status'], $productState->name)==0 ){ ?>
                                            <option value="<?php echo $productState->name ?>" selected="selected">
                                               <?php echo $productState->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $productState->name ?>">
                                               <?php echo $productState->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="type" class="control-label col-md-2">Product Type</label>
                            <div class="col-md-3">
                                <select id="type" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($types as $type): ?>
                                        <?php if( strcasecmp($product['type'], $type->name)==0 ){ ?>
                                            <option value="<?php echo $type->name ?>" selected="selected">
                                               <?php echo $type->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $type->name ?>">
                                               <?php echo $type->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_name" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select id="manufacturer_name" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($manufacturers as $manufacturer): ?>
                                        <?php if( strcasecmp($product['manufacturer_name'], $manufacturer->name)==0 ){ ?>
                                            <option value="<?php echo $manufacturer->name ?>" selected="selected">
                                               <?php echo $manufacturer->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $manufacturer->name ?>">
                                               <?php echo $manufacturer->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <select id="location" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($locations as $location): ?>
                                        <?php if( strcasecmp($product['location'], $location->name)==0 ){ ?>
                                            <option value="<?php echo $location->name ?>" selected="selected">
                                               <?php echo $location->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $location->name ?>">
                                               <?php echo $location->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_code" class="control-label col-md-2">Item Code</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-screenshot"></span></span>
                                    <input type="text" id="item_code" value="<?php echo $product['item_code'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                                </div>
                            </div>
                            <label for="visual_status" class="control-label col-md-2">Visual Status</label>
                            <div class="col-md-3">
                                <select id="visual_status" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($visualStatus as $visualState): ?>
                                        <?php if( strcasecmp($product['visual_status'], $visualState->name)==0 ){ ?>
                                            <option value="<?php echo $visualState->name ?>" selected="selected">
                                               <?php echo $visualState->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $visualState->name ?>">
                                               <?php echo $visualState->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" id="price" value="<?php echo sprintf("%01.2f", $product['price']); ?>" class="form-control"  <?php echo $isNotAvailable || $_SESSION['manager']['role']!='administrator' ? 'disabled' : '' ?>/>
                                </div>
                            </div>
                            <label for="weight" class="control-label col-md-2">Weight ( Gram )</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                                    <input type="text" id="weight" value="<?php echo sprintf("%01.2f", $product['weight']); ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="screen_size" class="control-label col-md-2">Screen Size</label>
                            <div class="col-md-3">
                                <select id="screen_size" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <option></option>
                                    <?php foreach ($screenSizes as $screenSize): ?>
                                        <?php if( strcasecmp($product['screen_size'], $screenSize->name)==0 ){ ?>
                                            <option value="<?php echo $screenSize->name ?>" selected="selected">
                                                <?php echo $screenSize->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $screenSize->name ?>">
                                                <?php echo $screenSize->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="performance_status" class="control-label col-md-2">Performance Status</label>
                            <div class="col-md-3">
                                <select id="performance_status" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <?php foreach ($performanceStatus as $performanceState): ?>
                                        <?php if( strcasecmp($product['performance_status'], $performanceState->name)==0 ){ ?>
                                            <option value="<?php echo $performanceState->name ?>" selected="selected">
                                                <?php echo $performanceState->name ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $performanceState->name ?>">
                                                <?php echo $performanceState->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label col-md-2">Model</label>
                            <div class="col-md-3">
                                <input type="text" id="model" value="<?php echo $product['model'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                            <label for="sn" class="control-label col-md-2">SN</label>
                            <div class="col-md-3">
                                <input type="text" id="sn" value="<?php echo $product['sn'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="processor" class="control-label col-md-2">Processor</label>
                            <div class="col-md-3">
                                <input type="text" id="processor" value="<?php echo $product['processor'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                            <label for="processor_speed" class="control-label col-md-2">Processor Speed</label>
                            <div class="col-md-3">
                                <input type="text" id="processor_speed" value="<?php echo $product['processor_speed'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mem_size" class="control-label col-md-2">Mem Size</label>
                            <div class="col-md-3">
                                <input type="text" id="mem_size" value="<?php echo $product['mem_size'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                            <label for="hdd_size" class="control-label col-md-2">HDD Size</label>
                            <div class="col-md-3">
                                <input type="text" id="hdd_size" value="<?php echo $product['hdd_size'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="optical_drive" class="control-label col-md-2">Optical Drive</label>
                            <div class="col-md-3">
                                <input type="text" id="optical_drive" value="<?php echo $product['optical_drive'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                            <label for="system_license" class="control-label col-md-2">System License</label>
                            <div class="col-md-3">
                                <input type="text" id="system_license" value="<?php echo $product['system_license'] ?>" class="form-control"  <?php echo $isNotAvailable ? 'disabled' : '' ?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_power_supply" class="control-label col-md-2">Is Power Supply</label>
                            <div class="col-md-3">
                                <select id="is_power_supply" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <option value="N" <?php echo strcasecmp( $product['is_power_supply'], 'N' ) == 0 ? 'selected' : '' ?>>No</option>
                                    <option value="Y" <?php echo strcasecmp( $product['is_power_supply'], 'Y' ) == 0 ? 'selected' : '' ?>>Yes</option>
                                </select>
                            </div>
                            <label for="is_web_cam" class="control-label col-md-2">Is Web Cam</label>
                            <div class="col-md-3">
                                <select id="is_web_cam" class="form-control" <?php echo $isNotAvailable ? 'disabled' : '' ?>>
                                    <option value="N" <?php echo strcasecmp( $product['is_web_cam'], 'N' ) == 0 ? 'selected' : '' ?>>No</option>
                                    <option value="Y" <?php echo strcasecmp( $product['is_web_cam'], 'Y' ) == 0 ? 'selected' : '' ?>>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label col-md-2">Notes</label>
                            <div class="col-md-8">
                                <textarea id="notes" class="form-control" rows="10"><?php echo $product['notes'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faults" class="control-label col-md-2">Faults</label>
                            <div class="col-md-8">
                                <textarea id="faults" class="form-control" rows="10"><?php echo $product['faults'] ?></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_product" class="btn btn-success btn-lg">Edit</a>
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
<script src="/resources/manager/js/warehouse/product/edit_product.js"></script>
<!-- END CUSTOMIZED LIB -->
