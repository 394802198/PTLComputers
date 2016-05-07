
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCustomerReceiverAddressAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                        <li><a href="/manager/e_store/customer/view" class="text-warning">View Customer</a></li>
                        <li><a href="/manager/e_store/customer/edit/id/<?php echo $customer['id'] ?>" class="text-warning">Edit Customer</a></li>
                        <li class="active">Add Receiver Address</li>
                    </ol>
                </div>
                <div id="collapseAddCustomerReceiverAddress" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="for_customer" class="control-label col-md-2">For Customer</label>
                            <div class="col-md-3">
                                <input type="hidden" id="customer_id" value="<?php echo $customer['id'] ?>"/>
                                <p class="form-control-static"><?php echo $customer['first_name'].' '.$customer['last_name'] ?></p>
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
                            <label for="is_use_customer_address" class="control-label col-md-2">Is Use Customer Address</label>
                            <div class="col-md-3">
                                <select id="is_use_customer_address" class="form-control">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_name" class="control-label col-md-2">Receiver Name</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_name" data-from-customer="<?php echo $customer['first_name'] . ' ' . $customer['last_name'] ?>" class="form-control" placeholder="*"/>
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
                                <input type="text" id="receiver_email" data-from-customer="<?php echo $customer['email'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_phone" data-from-customer="<?php echo $customer['fixed_phone'] != '' ? $customer['fixed_phone'] : $customer['mobile_phone'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_province" class="control-label col-md-2">Receiver province</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_province" data-from-customer="<?php echo $customer['province'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_country" class="control-label col-md-2">Receiver Country</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_country" data-from-customer="<?php echo $customer['country'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_post" class="control-label col-md-2">Receiver Post</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_post" data-from-customer="<?php echo $customer['post'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_city" class="control-label col-md-2">Receiver City</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_city" data-from-customer="<?php echo $customer['city'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                            <div class="col-md-8">
                                <input type="text" id="receiver_address" data-from-customer="<?php echo $customer['address'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_customer_receiver_address" class="btn btn-warning btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/e_store/customer/receiver_address/add_customer_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
