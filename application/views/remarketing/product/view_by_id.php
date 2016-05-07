
<?php include 'includes/remarketing/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="viewProductAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/remarketing" class="text-info">Home</a></li>
                        <li><a href="/remarketing/product/view_by/pagination" class="text-info">View Product</a></li>
                        <li class="active">View Product Detail</li>
                    </ol>
                </div>
                <div id="collapseViewProduct" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="hidden" id="product_id" value="<?php echo $product['id'] ?>" />
                            <label for="product_status" class="control-label col-md-2">Product Status</label>
                            <div class="col-md-3">
                                <input type="hidden" id="product_status" value="<?php echo $product['product_status'] ?>" />
                                <p class="form-control-static"><?php echo $product['product_status'] ?></p>
                            </div>
                            <label for="type" class="control-label col-md-2">Product Type</label>
                            <div class="col-md-3">
                                <input type="hidden" id="type" value="<?php echo $product['type'] ?>" />
                                <p class="form-control-static"><?php echo $product['type'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_name" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <input type="hidden" id="manufacturer_name" value="<?php echo $product['manufacturer_name'] ?>" />
                                <p class="form-control-static"><?php echo $product['manufacturer_name'] ?></p>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <input type="hidden" id="location" value="<?php echo $product['location'] ?>" />
                                <p class="form-control-static"><?php echo $product['location'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_code" class="control-label col-md-2">Item Code</label>
                            <div class="col-md-3">
                                <input type="hidden" id="item_code" value="<?php echo $product['item_code'] ?>" />
                                <p class="form-control-static"><?php echo $product['item_code'] ?></p>
                            </div>
                            <label for="visual_status" class="control-label col-md-2">Visual Status</label>
                            <div class="col-md-3">
                                <input type="hidden" id="visual_status" value="<?php echo $product['visual_status'] ?>" />
                                <p class="form-control-static"><?php echo $product['visual_status'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <input type="hidden" id="price" value="<?php echo $product['price'] ?>" />
                                <p class="form-control-static">$&nbsp;<?php echo $product['price'] ?></p>
                            </div>
                            <label for="weight" class="control-label col-md-2">Weight ( Gram )</label>
                            <div class="col-md-3">
                                <input type="hidden" id="weight" value="<?php echo $product['weight'] ?>" />
                                <p class="form-control-static"><?php echo $product['weight'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="screen_size" class="control-label col-md-2">Screen Size</label>
                            <div class="col-md-3">
                                <input type="hidden" id="screen_size" value="<?php echo $product['screen_size'] ?>" />
                                <p class="form-control-static"><?php echo $product['screen_size'] ?></p>
                            </div>
                            <label for="performance_status" class="control-label col-md-2">Performance Status</label>
                            <div class="col-md-3">
                                <input type="hidden" id="performance_status" value="<?php echo $product['performance_status'] ?>" />
                                <p class="form-control-static"><?php echo $product['performance_status'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label col-md-2">Model</label>
                            <div class="col-md-3">
                                <input type="hidden" id="model" value="<?php echo $product['model'] ?>" />
                                <p class="form-control-static"><?php echo $product['model'] ?></p>
                            </div>
                            <label for="sn" class="control-label col-md-2">SN</label>
                            <div class="col-md-3">
                                <input type="hidden" id="sn" value="<?php echo $product['sn'] ?>" />
                                <p class="form-control-static"><?php echo $product['sn'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="processor" class="control-label col-md-2">Processor</label>
                            <div class="col-md-3">
                                <input type="hidden" id="processor" value="<?php echo $product['processor'] ?>" />
                                <p class="form-control-static"><?php echo $product['processor'] ?></p>
                            </div>
                            <label for="processor_speed" class="control-label col-md-2">Processor Speed</label>
                            <div class="col-md-3">
                                <input type="hidden" id="processor_speed" value="<?php echo $product['processor_speed'] ?>" />
                                <p class="form-control-static"><?php echo $product['processor_speed'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mem_size" class="control-label col-md-2">Mem Size</label>
                            <div class="col-md-3">
                                <input type="hidden" id="mem_size" value="<?php echo $product['mem_size'] ?>" />
                                <p class="form-control-static"><?php echo $product['mem_size'] ?></p>
                            </div>
                            <label for="hdd_size" class="control-label col-md-2">HDD Size</label>
                            <div class="col-md-3">
                                <input type="hidden" id="hdd_size" value="<?php echo $product['hdd_size'] ?>" />
                                <p class="form-control-static"><?php echo $product['hdd_size'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="optical_drive" class="control-label col-md-2">Optical Drive</label>
                            <div class="col-md-3">
                                <input type="hidden" id="optical_drive" value="<?php echo $product['optical_drive'] ?>" />
                                <p class="form-control-static"><?php echo $product['optical_drive'] ?></p>
                            </div>
                            <label for="system_license" class="control-label col-md-2">System License</label>
                            <div class="col-md-3">
                                <input type="hidden" id="system_license" value="<?php echo $product['system_license'] ?>" />
                                <p class="form-control-static"><?php echo $product['system_license'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_power_supply" class="control-label col-md-2">Is Power Supply</label>
                            <div class="col-md-3">
                                <input type="hidden" id="is_power_supply" value="<?php echo $product['is_power_supply'] ?>" />
                                <p class="form-control-static"><?php echo strcasecmp( $product['is_power_supply'],'Y' )==0 ? 'Yes' : 'No' ?></p>
                            </div>
                            <label for="is_web_cam" class="control-label col-md-2">Is Web Cam</label>
                            <div class="col-md-3">
                                <input type="hidden" id="is_web_cam" value="<?php echo $product['is_web_cam'] ?>" />
                                <p class="form-control-static"><?php echo strcasecmp( $product['is_web_cam'],'Y' )==0 ? 'Yes' : 'No' ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label col-md-2">Notes</label>
                            <div class="col-md-8">
                                <textarea id="notes" class="form-control" rows="10" disabled="disabled"><?php echo $product['notes'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faults" class="control-label col-md-2">Faults</label>
                            <div class="col-md-8">
                                <textarea id="faults" class="form-control" rows="10" disabled="disabled"><?php echo $product['faults'] ?></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <?php if(strcasecmp($product['product_status'],'in stock')==0 || strcasecmp($product['product_status'],'returned')==0){ ?>
                                <a id="add_to_cart" class="btn btn-success btn-lg">Add to cart</a>&nbsp;
                                <?php } ?>
                                <a href="javascript:void(0);" class="btn btn-success btn-lg" onclick="history.go(-1);">Back</a>
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
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/remarketing/js/product/view_by_id.js"></script>
<!-- END CUSTOMIZED LIB -->
