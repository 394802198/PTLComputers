
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addWholesalerReceiverAddressAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager#remarketing_panel" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/remarketing/wholesaler/view" class="text-info">View Wholesaler</a></li>
                        <li><a href="/manager/remarketing/wholesaler/edit/id/<?php echo $wholesaler['id'] ?>" class="text-info">Edit Wholesaler</a></li>
                        <li class="active">Add Receiver Address</li>
                    </ol>
                </div>
                <div id="collapseAddWholesalerReceiverAddress" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="for_wholesaler" class="control-label col-md-2">For Wholesaler</label>
                            <div class="col-md-3">
                                <input type="hidden" id="wholesaler_id" value="<?php echo $wholesaler['id'] ?>"/>
                                <p class="form-control-static"><?php echo $wholesaler['first_name'].' '.$wholesaler['last_name'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_area_id" class="control-label col-md-2">Shipping Area</label>
                            <div class="col-md-3">
                                <select id="shipping_area_id" class="form-control">
                                    <option></option>
                                    <?php foreach( $courierShippingAreas as $courierShippingArea ){ ?>
                                        <option value="<?php echo $courierShippingArea->id ?>"><?php echo $courierShippingArea->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="is_use_wholesaler_address" class="control-label col-md-2">Is Use Wholesaler Address</label>
                            <div class="col-md-3">
                                <select id="is_use_wholesaler_address" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_name" class="control-label col-md-2">Receiver Name</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_name" data-from-wholesaler="<?php echo $wholesaler['first_name'] . ' ' . $wholesaler['last_name'] ?>" class="form-control" placeholder="*"/>
                            </div>
                            <label for="is_default" class="control-label col-md-2">Is Default</label>
                            <div class="col-md-3">
                                <select id="is_default" class="form-control" <?php echo $isFirstReceiverAddress ? 'disabled' : '' ?>>
                                    <option value="N">No</option>
                                    <option value="Y" <?php echo $isFirstReceiverAddress ? 'selected' : '' ?>>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_email" class="control-label col-md-2">Receiver Email</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_email" data-from-wholesaler="<?php echo $wholesaler['email'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_phone" data-from-wholesaler="<?php echo $wholesaler['landline_phone'] != '' ? $wholesaler['landline_phone'] : $wholesaler['mobile_phone'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_province" class="control-label col-md-2">Receiver province</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_province" data-from-wholesaler="<?php echo $wholesaler['city'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_country" class="control-label col-md-2">Receiver Country</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_country" data-from-wholesaler="<?php echo $wholesaler['country'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_post" class="control-label col-md-2">Receiver Post</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_post" class="form-control"/>
                            </div>
                            <label for="receiver_city" class="control-label col-md-2">Receiver City</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_city" data-from-wholesaler="<?php echo $wholesaler['area'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                            <div class="col-md-8">
                                <input type="text" id="receiver_address" data-from-wholesaler="<?php echo $wholesaler['street'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_wholesaler_receiver_address" class="btn btn-info btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/remarketing/wholesaler/receiver_address/add_wholesaler_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
