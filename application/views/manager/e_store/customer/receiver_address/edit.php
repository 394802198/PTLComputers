
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
    <div class="container">
        <div class="col-md-12">
            <div class="panel-group" id="editCustomerReceiverAddressAccordion">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-warning">Home</a></li>
                            <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                            <li><a href="/manager/e_store/customer/view" class="text-warning">View Customer</a></li>
                            <li><a href="/manager/e_store/customer/edit/id/<?php echo $customerReceiverAddress['customer']['id'] ?>" class="text-warning">Edit Customer</a></li>
                            <li><a href="/manager/e_store/customer/receiver_address/view_by/customer_id/<?php echo $customerReceiverAddress['customer']['id'] ?>" class="text-warning">View Receiver Address</a></li>
                            <li class="active">Edit Receiver Address</li>
                        </ol>
                    </div>
                    <div id="collapseEditCustomerReceiverAddress" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="for_customer" class="control-label col-md-2">For Customer</label>
                                <div class="col-md-3">
                                    <input type="hidden" id="customer_receiver_address_id" value="<?php echo $customerReceiverAddress['id'] ?>"/>
                                    <input type="hidden" id="customer_id" value="<?php echo $customerReceiverAddress['customer']['id'] ?>"/>
                                    <p class="form-control-static"><?php echo $customerReceiverAddress['customer']['first_name'].' '.$customerReceiverAddress['customer']['last_name'] ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shipping_area_id" class="control-label col-md-2">Shipping Area</label>
                                <div class="col-md-3">
                                    <select id="shipping_area_id" class="form-control">
                                        <option></option>
                                        <?php foreach( $courierShippingAreas as $courierShippingArea ){ ?>
                                            <?php if( $courierShippingArea->id == $customerReceiverAddress['shipping_area_id'] ){ ?>
                                                <option value="<?php echo $courierShippingArea->id ?>" selected><?php echo $courierShippingArea->name ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $courierShippingArea->id ?>"><?php echo $courierShippingArea->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="is_use_customer_address" class="control-label col-md-2">Is Use Customer Address</label>
                                <div class="col-md-3">
                                    <select id="is_use_customer_address" class="form-control">
                                        <option value="N" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? 'selected' : '' ?>>No</option>
                                        <option value="Y" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'selected' : '' ?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receiver_name" class="control-label col-md-2">Receiver Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_name" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_name'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['customer']['first_name'] . ' ' . $customerReceiverAddress['customer']['last_name'] ?>" value="<?php echo $customerReceiverAddress['receiver_name'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control" placeholder="*"/>
                                </div>
                                <label for="is_default" class="control-label col-md-2">Is Default</label>
                                <div class="col-md-3">
                                    <select id="is_default" class="form-control">
                                        <option value="N" <?php echo strcasecmp( $customerReceiverAddress['is_default'],'N' )==0 ? 'selected' : '' ?>>No</option>
                                        <option value="Y" <?php echo strcasecmp( $customerReceiverAddress['is_default'],'Y' )==0 ? 'selected' : '' ?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receiver_email" class="control-label col-md-2">Receiver Email</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_email" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_email'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_email'] ?>" value="<?php echo $customerReceiverAddress['receiver_email'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control"/>
                                </div>
                                <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_phone" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_phone'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_phone'] ?>" value="<?php echo $customerReceiverAddress['receiver_phone'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control" placeholder="*"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receiver_province" class="control-label col-md-2">Receiver province</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_province" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_province'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_province'] ?>" value="<?php echo $customerReceiverAddress['receiver_province'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control"/>
                                </div>
                                <label for="receiver_country" class="control-label col-md-2">Receiver Country</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_country" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_country'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_country'] ?>" value="<?php echo $customerReceiverAddress['receiver_country'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receiver_post" class="control-label col-md-2">Receiver Post</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_post" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_post'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_post'] ?>" value="<?php echo $customerReceiverAddress['receiver_post'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control"/>
                                </div>
                                <label for="receiver_city" class="control-label col-md-2">Receiver City</label>
                                <div class="col-md-3">
                                    <input type="text" id="receiver_city" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_city'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_city'] ?>" value="<?php echo $customerReceiverAddress['receiver_city'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                                <div class="col-md-8">
                                    <input type="text" id="receiver_address" data-from-origin="<?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'N' )==0 ? $customerReceiverAddress['receiver_address'] : '' ?>" data-from-customer="<?php echo $customerReceiverAddress['receiver_address'] ?>" value="<?php echo $customerReceiverAddress['receiver_address'] ?>" <?php echo strcasecmp( $customerReceiverAddress['is_use_customer_address'],'Y' )==0 ? 'disabled' : '' ?> class="form-control" placeholder="*"/>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-2">
                                    <a id="edit_customer_receiver_address" class="btn btn-warning btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/e_store/customer/receiver_address/edit_customer_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
