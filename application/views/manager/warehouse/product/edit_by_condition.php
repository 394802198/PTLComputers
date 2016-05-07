
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editProductByConditionAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li class="active">Edit Product By Condition</li>
                    </ol>
                </div>
                <div id="collapseEditProductByCondition" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <h3>Specify one or more conditions</h3>
                        <hr/>
                        <div class="form-group">
                            <label for="job_number" class="control-label col-md-2">Job Number</label>
                            <div class="col-md-3">
                                <select name="job_number" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionJobNumbers as $conditionJobNumber) { ?>
                                        <option value="<?php echo $conditionJobNumber->job_number ?>"><?php echo $conditionJobNumber->job_number ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_status" class="control-label col-md-2">Product Status</label>
                            <div class="col-md-3">
                                <select name="product_status_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionProductStatus as $conditionProductState) { ?>
                                        <?php if( strcasecmp( $conditionProductState->product_status, 'sold' )!=0 ){ ?>
                                            <option value="<?php echo $conditionProductState->product_status ?>"><?php echo $conditionProductState->product_status ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="type" class="control-label col-md-2">Product Type</label>
                            <div class="col-md-3">
                                <select name="type_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionTypes as $conditionType) { ?>
                                    <option value="<?php echo $conditionType->type ?>"><?php echo $conditionType->type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_name" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select name="manufacturer_name_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionManufacturers as $conditionManufacturer) { ?>
                                    <option value="<?php echo $conditionManufacturer->manufacturer_name ?>"><?php echo $conditionManufacturer->manufacturer_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <select name="location_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionLocations as $conditionLocation) { ?>
                                    <option value="<?php echo $conditionLocation->location ?>"><?php echo $conditionLocation->location ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visual_status" class="control-label col-md-2">Visual Status</label>
                            <div class="col-md-3">
                                <select name="visual_status_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionVisualStatus as $conditionVisualState) { ?>
                                    <option value="<?php echo $conditionVisualState->visual_status ?>"><?php echo $conditionVisualState->visual_status ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="performance_status" class="control-label col-md-2">Performance Status</label>
                            <div class="col-md-3">
                                <select name="performance_status_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionPerformanceStatus as $conditionPerformanceState) { ?>
                                    <option value="<?php echo $conditionPerformanceState->performance_status ?>"><?php echo $conditionPerformanceState->performance_status ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="price_condition" class="form-control" data-contidion-field/>
                                </div>
                            </div>
                            <label for="weight" class="control-label col-md-2">Weight</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                                    <input type="text" name="weight_condition" class="form-control" data-contidion-field/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="screen_size" class="control-label col-md-2">Screen Size</label>
                            <div class="col-md-3">
                                <select name="screen_size_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionScreenSizes as $conditionScreenSize) { ?>
                                        <option value="<?php echo $conditionScreenSize->screen_size ?>"><?php echo $conditionScreenSize->screen_size ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="model" class="control-label col-md-2">Model</label>
                            <div class="col-md-3">
                                <select name="model_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionModels as $conditionModel) { ?>
                                        <option value="<?php echo $conditionModel->model ?>"><?php echo $conditionModel->model ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="processor" class="control-label col-md-2">Processor</label>
                            <div class="col-md-3">
                                <select name="processor_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionProcessors as $conditionProcessor) { ?>
                                        <option value="<?php echo $conditionProcessor->processor ?>"><?php echo $conditionProcessor->processor ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="processor_speed" class="control-label col-md-2">Processor Speed</label>
                            <div class="col-md-3">
                                <select name="processor_speed_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionProcessorSpeeds as $conditionProcessorSpeed) { ?>
                                        <option value="<?php echo $conditionProcessorSpeed->processor_speed ?>"><?php echo $conditionProcessorSpeed->processor_speed ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mem_size" class="control-label col-md-2">Mem Size</label>
                            <div class="col-md-3">
                                <select name="mem_size_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionMemSizes as $conditionMemSize) { ?>
                                        <option value="<?php echo $conditionMemSize->mem_size ?>"><?php echo $conditionMemSize->mem_size ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="hdd_size" class="control-label col-md-2">HDD Size</label>
                            <div class="col-md-3">
                                <select name="hdd_size_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionHDDSizes as $conditionHDDSize) { ?>
                                        <option value="<?php echo $conditionHDDSize->hdd_size ?>"><?php echo $conditionHDDSize->hdd_size ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="optical_drive" class="control-label col-md-2">Optical Drive</label>
                            <div class="col-md-3">
                                <select name="optical_drive_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionOpticalDrives as $conditionOpticalDrive) { ?>
                                        <option value="<?php echo $conditionOpticalDrive->optical_drive ?>"><?php echo $conditionOpticalDrive->optical_drive ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="system_license" class="control-label col-md-2">System License</label>
                            <div class="col-md-3">
                                <select name="system_license_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <?php foreach ($conditionSystemLicenses as $conditionSystemLicense) { ?>
                                        <option value="<?php echo $conditionSystemLicense->system_license ?>"><?php echo $conditionSystemLicense->system_license ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_power_supply" class="control-label col-md-2">Is Power Supply</label>
                            <div class="col-md-3">
                                <select name="is_power_supply_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                            <label for="is_web_cam" class="control-label col-md-2">Is Web Cam</label>
                            <div class="col-md-3">
                                <select name="is_web_cam_condition" class="form-control" data-contidion-field>
                                    <option></option>
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label col-md-2">Notes</label>
                            <div class="col-md-8">
                                <textarea name="notes_condition" class="form-control" rows="10" data-contidion-field></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faults" class="control-label col-md-2">Faults</label>
                            <div class="col-md-8">
                                <textarea name="faults_condition" class="form-control" rows="10" data-contidion-field></textarea>
                            </div>
                        </div>

                        <hr/>
                        <h3>Data you provided below will replace the old one</h3>
                        <hr/>

                        <div class="form-group">
                            <label for="job_number" class="control-label col-md-2">Job Number</label>
                            <div class="col-md-3">
                                <select name="job_number" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalJobNumbers as $finalJobNumber) { ?>
                                        <option value="<?php echo $finalJobNumber->name ?>"><?php echo $finalJobNumber->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_status" class="control-label col-md-2">Product Status</label>
                            <div class="col-md-3">
                                <select name="product_status" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalProductStatus as $finalProductState) { ?>
                                        <option value="<?php echo $finalProductState->name ?>"><?php echo $finalProductState->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="type" class="control-label col-md-2">Product Type</label>
                            <div class="col-md-3">
                                <select name="type" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalTypes as $finalType) { ?>
                                        <option value="<?php echo $finalType->name ?>"><?php echo $finalType->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_name" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select name="manufacturer_name" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalManufacturers as $finalManufacturer) { ?>
                                        <option value="<?php echo $finalManufacturer->name ?>"><?php echo $finalManufacturer->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <select name="location" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalLocations as $finalLocation) { ?>
                                        <option value="<?php echo $finalLocation->name ?>"><?php echo $finalLocation->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visual_status" class="control-label col-md-2">Visual Status</label>
                            <div class="col-md-3">
                                <select name="visual_status" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalVisualStatus as $finalVisualState) { ?>
                                        <option value="<?php echo $finalVisualState->name ?>"><?php echo $finalVisualState->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="performance_status" class="control-label col-md-2">Performance Status</label>
                            <div class="col-md-3">
                                <select name="performance_status" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalPerformanceStatus as $finalPerformanceState) { ?>
                                        <option value="<?php echo $finalPerformanceState->name ?>"><?php echo $finalPerformanceState->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="price" class="form-control" data-final-field/>
                                </div>
                            </div>
                            <label for="weight" class="control-label col-md-2">Weight</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></span>
                                    <input type="text" name="weight" class="form-control" data-final-field/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="screen_size" class="control-label col-md-2">Screen Size</label>
                            <div class="col-md-3">
                                <select name="screen_size" class="form-control" data-final-field>
                                    <option></option>
                                    <?php foreach ($finalScreenSizes as $finalScreenSize) { ?>
                                        <option value="<?php echo $finalScreenSize->name ?>"><?php echo $finalScreenSize->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="model" class="control-label col-md-2">Model</label>
                            <div class="col-md-3">
                                <input type="text" name="model" class="form-control" data-final-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="processor" class="control-label col-md-2">Processor</label>
                            <div class="col-md-3">
                                <input type="text" name="processor" class="form-control" data-final-field/>
                            </div>
                            <label for="processor_speed" class="control-label col-md-2">Processor Speed</label>
                            <div class="col-md-3">
                                <input type="text" name="processor_speed" class="form-control" data-final-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mem_size" class="control-label col-md-2">Mem Size</label>
                            <div class="col-md-3">
                                <input type="text" name="mem_size" class="form-control" data-final-field/>
                            </div>
                            <label for="hdd_size" class="control-label col-md-2">HDD Size</label>
                            <div class="col-md-3">
                                <input type="text" name="hdd_size" class="form-control" data-final-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="optical_drive" class="control-label col-md-2">Optical Drive</label>
                            <div class="col-md-3">
                                <input type="text" name="optical_drive" class="form-control" data-final-field/>
                            </div>
                            <label for="system_license" class="control-label col-md-2">System License</label>
                            <div class="col-md-3">
                                <input type="text" name="system_license" class="form-control" data-final-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_power_supply" class="control-label col-md-2">Is Power Supply</label>
                            <div class="col-md-3">
                                <select name="is_power_supply" class="form-control" data-contidion-field>
                                    <option></option>
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                            <label for="is_web_cam" class="control-label col-md-2">Is Web Cam</label>
                            <div class="col-md-3">
                                <select name="is_web_cam" class="form-control" data-contidion-field>
                                    <option></option>
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label col-md-2">Notes</label>
                            <div class="col-md-8">
                                <textarea name="notes" class="form-control" rows="10" data-final-field></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faults" class="control-label col-md-2">Faults</label>
                            <div class="col-md-8">
                                <textarea name="faults" class="form-control" rows="10" data-final-field></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_product_by_condition" class="btn btn-success btn-lg">Edit</a>
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
<script src="/resources/manager/js/warehouse/product/edit_product_by_condition.js"></script>
<!-- END CUSTOMIZED LIB -->
