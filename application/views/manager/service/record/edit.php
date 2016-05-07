
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
    <div class="container">
        <div class="col-md-12">
            <div class="panel-group" id="editRecordAccordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-primary">Home</a></li>
                            <li><a href="/manager#service_panel" class="text-primary">Service</a></li>
                            <li><a href="/manager/service/record/view_by/pagination" class="text-primary">Record & Comment</a></li>
                            <li class="active">Edit Record & Comment</li>
                        </ol>
                    </div>
                    <div id="collapseEditRecord" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="type" class="control-label col-md-2">Type</label>
                                <div class="col-md-3">
                                    <input type="hidden" id="record_id" value="<?php echo $record['id'] ?>" />
                                    <select class="form-control" id="type">
                                        <option value="100" <?php echo $record['type'] == 100 ? 'selected' : '' ?> >Internal Service</option>
                                        <option value="101" <?php echo $record['type'] == 101 ? 'selected' : '' ?> >External Service</option>
                                    </select>
                                    <select class="form-control" id="external_service_provider_id" <?php echo $record['type']==100 ? 'style="display:none;"' : ''; ?>>
                                        <option value="">* Choose One Service Provider</option>
                                        <?php if (isset($externalServiceProviders) && count($externalServiceProviders) > 0) { ?>
                                            <?php foreach ($externalServiceProviders as $externalServiceProvider) { ?>
                                                <option value="<?php echo $externalServiceProvider->id ?>" <?php echo $externalServiceProvider->id==$record['external_service_provider_id'] ? 'selected' : '' ?>><?php echo $externalServiceProvider->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="service_number" class="control-label col-md-2">Service Number</label>
                                <div class="col-md-3">
                                    <p id="service_number" class="form-control-static"><?php echo $record['id'] ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="control-label col-md-2">Status</label>
                                <div class="col-md-3">
                                    <?php
                                    $statuses = array(
                                        100 => 'New',
                                        101 => 'Processing',
                                        102 => 'Success',
                                        103 => 'Shipped',
                                        104 => 'Failed',
                                        105 => 'Cancelled'
                                    );
                                    ?>
                                    <select class="form-control" id="status">
                                        <?php foreach ($statuses as $key => $status) { ?>
                                            <option value="<?php echo $key ?>" <?php echo $record['status']==$key ? 'selected' : '' ?> ><?php echo $status ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="check_in_date" class="control-label col-md-2">Check In Date</label>
                                <div class="col-md-3">
                                    <input type="text" id="check_in_date" value="<?php echo $record['check_in_date'] ?>" class="form-control" placeholder="(Optional)" />
                                </div>
                                <label for="check_out_date" class="control-label col-md-2">Check Out Date</label>
                                <div class="col-md-3">
                                    <input type="text" id="check_out_date" value="<?php echo $record['check_out_date'] ?>" class="form-control" placeholder="(Optional)" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_name" class="control-label col-md-2">Customer Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="customer_name" value="<?php echo $record['customer_name'] ?>" class="form-control" placeholder="*" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_phone" class="control-label col-md-2">Customer Phone</label>
                                <div class="col-md-3">
                                    <input type="text" id="customer_phone" value="<?php echo $record['customer_phone'] ?>" class="form-control" />
                                </div>
                                <label for="customer_email" class="control-label col-md-2">Customer Email</label>
                                <div class="col-md-3">
                                    <input type="text" id="customer_email" value="<?php echo $record['customer_email'] ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customer_address" class="control-label col-md-2">Customer Address</label>
                                <div class="col-md-8">
                                    <input type="text" id="customer_address" value="<?php echo $record['customer_address'] ?>" class="form-control" placeholder="(Optional)" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="item_name" class="control-label col-md-2">Item Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="item_name" value="<?php echo $record['item_name'] ?>" class="form-control" placeholder="*" />
                                </div>
                                <label for="item_model" class="control-label col-md-2">Item Model</label>
                                <div class="col-md-3">
                                    <input type="text" id="item_model" value="<?php echo $record['item_model'] ?>" class="form-control" placeholder="(Optional)" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="item_sn" class="control-label col-md-2">Item SN</label>
                                <div class="col-md-5">
                                    <input type="text" id="item_sn" value="<?php echo $record['item_sn'] ?>" class="form-control" placeholder="(Optional)" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="appraisal" class="control-label col-md-2">Appraisal</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" id="appraisal" value="<?php echo $record['appraisal'] ?>" class="form-control" placeholder="(Optional)" >
                                    </div>
                                </div>
                                <label for="payable" class="control-label col-md-2">Payable</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" id="payable" value="<?php echo $record['payable'] ?>" class="form-control" placeholder="(Optional)" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cost" class="control-label col-md-2">Cost</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" id="cost" value="<?php echo $record['cost'] ?>" class="form-control" placeholder="(Optional)" >
                                    </div>
                                </div>
                                <label for="paid" class="control-label col-md-2">Paid</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" id="paid" value="<?php echo $record['paid'] ?>" class="form-control" placeholder="(Optional)" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="problem_description" class="control-label col-md-2">Problem Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="problem_description" rows="5" style="resize:none;"><?php echo $record['problem_description'] ?></textarea>
                                </div>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <a id="edit_record" class="btn btn-primary btn-lg">Edit</a>
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
<script src="/resources/manager/js/service/record/edit.js"></script>
<!-- END CUSTOMIZED LIB -->
