
<?php include 'includes/remarketing/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addMyReceiverAddressAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/remarketing" class="text-info">Home</a></li>
                        <li><a href="/remarketing/wholesaler/edit_my_profile" class="text-info">Edit My Profile</a></li>
                        <li class="active">Add Receiver Address</li>
                    </ol>
                </div>
                <div id="collapseAddMyReceiverAddress" class="panel-collapse collapse in">
                    <div class="panel-body">
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
                            <label for="is_use_wholesaler_address" class="control-label col-md-2">Use My Address</label>
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
                                <input type="text" id="receiver_name" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['first_name'] . ' ' . $_SESSION['wholesaler']['last_name'] ?>" class="form-control" placeholder="*"/>
                            </div>
                            <label for="is_default" class="control-label col-md-2">Set As Default</label>
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
                                <input type="text" id="receiver_email" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['email'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_phone" class="control-label col-md-2">Receiver Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_phone" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['landline_phone'] != '' ? $_SESSION['wholesaler']['landline_phone'] : $_SESSION['wholesaler']['mobile_phone'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_province" class="control-label col-md-2">Receiver province</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_province" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['city'] ?>" class="form-control"/>
                            </div>
                            <label for="receiver_country" class="control-label col-md-2">Receiver Country</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_country" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['country'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_post" class="control-label col-md-2">Receiver Post</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_post" class="form-control"/>
                            </div>
                            <label for="receiver_city" class="control-label col-md-2">Receiver City</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_city" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['area'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_address" class="control-label col-md-2">Receiver Address</label>
                            <div class="col-md-8">
                                <input type="text" id="receiver_address" data-from-wholesaler="<?php echo $_SESSION['wholesaler']['street'] . ', ' . $_SESSION['wholesaler']['area'] . ', ' . $_SESSION['wholesaler']['city'] . ', ' . $_SESSION['wholesaler']['country'] ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_my_receiver_address" class="btn btn-info btn-lg btn-block">Save</a>
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
<script src="/resources/remarketing/js/wholesaler/receiver_address/add_my_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
