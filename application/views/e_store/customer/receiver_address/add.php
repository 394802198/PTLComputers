<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="/resources/e_store/css/panel_body.css" />

<div class="panel-body" style="background:#00a0e9;">
    <div class="panel_body">

        <!-- BEGIN SIDE MENU -->
        <?php include 'includes/e_store/customer/side_menu.php'; ?>
        <!-- END SIDE MENU -->

        <div class="col-md-9" style="background:#FFF;">
            <div style="padding:20px;">

                <div class="form-group ml-show">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF;"><i class="fa fa-hand-o-left"></i> Dash Board</a></li>
                        <li><a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/view" class="btn btn-xs" style="background-color:#286090; color:#FFF;"><i class="fa fa-hand-o-left"></i> Receiver Address</a></li>
                        <li class="active">New Receiver Address</li>
                    </ol>
                </div>

                <div class="form-group ml-hide">
                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF; margin-bottom:1px;">
                        <i class="fa fa-hand-o-left"></i>
                        Dash Board
                    </a>
                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/view" class="btn btn-xs" style="background-color:#286090; color:#FFF;">
                        <i class="fa fa-hand-o-left"></i>
                        Receiver Address
                    </a>
                </div>

                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="is_use_customer_address" class="control-label col-md-3 text-success">Use My Address:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa fa-location-arrow" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <select id="is_use_customer_address" class="form-control" style="border-color:#4cae4c;">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_name" class="control-label col-md-3 text-success">Is Default:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-thumbs-up" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <select id="is_default" class="form-control" <?php echo $isFirstReceiverAddress ? 'disabled' : '' ?> style="border-color:#4cae4c;">
                                    <option value="N">No</option>
                                    <option value="Y" <?php echo $isFirstReceiverAddress ? 'selected' : '' ?>>Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="shipping_area_id" class="control-label col-md-3 text-success">Shipping Area:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <select id="shipping_area_id" class="form-control" style="border-color:#4cae4c;">
                                    <option></option>
                                    <?php foreach( $courierShippingAreas as $courierShippingArea ){ ?>
                                        <option value="<?php echo $courierShippingArea->id ?>"><?php echo $courierShippingArea->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_name" class="control-label col-md-3 text-success">Receiver Name:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-user" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_name" value="" class="form-control" placeholder="*" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_phone" class="control-label col-md-3 text-success">Receiver Phone:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-mobile-phone" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_phone" value="" class="form-control" placeholder="*" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['fixed_phone'] != '' ? $_SESSION['customer']['fixed_phone'] : $_SESSION['customer']['mobile_phone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_address" class="control-label col-md-3 text-success">Receiver Address:</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-location-arrow" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_address" value="" class="form-control" placeholder="*" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['address'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_email" class="control-label col-md-3 text-success">Receiver Email:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-envelope-o" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_email" value="" class="form-control" placeholder="" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_country" class="control-label col-md-3 text-success">Receiver Country:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_country" value="" class="form-control" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['country'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_province" class="control-label col-md-3 text-success">Receiver Province:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_province" value="" class="form-control" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['province'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_city" class="control-label col-md-3 text-success">Receiver City:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_city" value="" class="form-control" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['city'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="receiver_post" class="control-label col-md-3 text-success">Receiver Post:</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                    <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                </span>
                                <input type="text" id="receiver_post" value="" class="form-control" style="border-color:#4cae4c;" data-from-customer="<?php echo $_SESSION['customer']['post'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-xs btn-success pull-right" id="add_receiver_address">Add Receiver Address</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN FOOTER -->
<?php include 'includes/e_store/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/e_store/js/left_side.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/e_store/js/customer/receiver_address/add.js"></script>
<!-- END CUSTOMIZED LIB -->