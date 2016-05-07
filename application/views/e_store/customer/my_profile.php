<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="/resources/e_store/css/panel_body.css" />

<div class="panel-body" style="background:#00a0e9;">
    <div class="panel_body">

        <!-- BEGIN SIDE MENU -->
        <?php include 'includes/e_store/customer/side_menu.php'; ?>
        <!-- END SIDE MENU -->

        <ul class="col-md-9">
            <li>

                <?php if( isset( $headerBottomAdvertisement ) && strcasecmp( $headerBottomAdvertisement->is_visible, 'Y' )==0 ) { ?>
                    <div data-advertisement-div class="col-md-12" style="padding:0;">
                        <?php if( strcasecmp( $headerBottomAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
                        <a href="<?php echo $headerBottomAdvertisement->linkage ?>" target="_blank">
                            <?php } ?>
                            <img src="/<?php echo $headerBottomAdvertisement->img_path ?>" width="100%" alt="<?php echo $headerBottomAdvertisement->brief_introduction ?>" title="<?php echo $headerBottomAdvertisement->brief_introduction ?>" />
                            <?php if( strcasecmp( $headerBottomAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
                        </a>
                    <?php } ?>
                        <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $headerBottomAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $headerBottomAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $headerBottomAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
                            Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
                        </a>
                        <br/>
                    </div>
                <?php } ?>

                <div class="col-md-12" style="background:#FFF;">
                    <div style="padding:20px;">

                        <div class="form-group ml-show">
                            <ol class="breadcrumb" style="margin: 0;">
                                <li><a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF;"><i class="fa fa-hand-o-left"></i> Dash Board</a></li>
                                <li class="active">My Profile</li>
                            </ol>
                        </div>

                        <div class="form-group ml-hide">
                            <a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF; margin-bottom:1px;">
                                <i class="fa fa-hand-o-left"></i>
                                Dash Board
                            </a>
                        </div>

                        <form class="form-horizontal text-center">
                            <div class="form-group">
                                <label for="company_name" class="control-label col-md-3 text-success">Company Name:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-institution" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="company_name" value="<?php echo $myProfile['company_name'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="first_name" class="control-label col-md-3 text-success">First Name:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-star-half-o" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="first_name" value="<?php echo $myProfile['first_name'] ?>" class="form-control" placeholder="*" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="control-label col-md-3 text-success">Last Name:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-star-half-o" style="font-size:18px; color:#edfc87; width:18px; -webkit-transform:rotateY(180deg); -moz-transform:rotateY(180deg); -o-transform:rotateY(180deg); -ms-transform:rotateY(180deg);"></i>
                                    </span>
                                        <input type="text" id="last_name" value="<?php echo $myProfile['last_name'] ?>" class="form-control" placeholder="*" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 text-success">Email:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-envelope-o" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="email" value="<?php echo $myProfile['email'] ?>" class="form-control" placeholder="*" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile_phone" class="control-label col-md-3 text-success">Mobile Phone:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-mobile-phone" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="mobile_phone" value="<?php echo $myProfile['mobile_phone'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fixed_phone" class="control-label col-md-3 text-success">Fixed Phone:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-phone" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="fixed_phone" value="<?php echo $myProfile['fixed_phone'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fax_no" class="control-label col-md-3 text-success">Fax No:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-fax" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="fax_no" value="<?php echo $myProfile['fax_no'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country" class="control-label col-md-3 text-success">Country:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="country" value="<?php echo $myProfile['country'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="province" class="control-label col-md-3 text-success">Province:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="province" value="<?php echo $myProfile['province'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="control-label col-md-3 text-success">City:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-globe" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="city" value="<?php echo $myProfile['city'] ?>" class="form-control" placeholder="" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label col-md-3 text-success">Address:</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-location-arrow" style="font-size:18px; color:#edfc87; width:18px;"></i>
                                    </span>
                                        <input type="text" id="address" value="<?php echo $myProfile['address'] ?>" class="form-control" placeholder="*" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-xs btn-primary" id="updateMyProfileBtn">Update My Profile</a>
                            </div>
                        </form>

                    </div>
                </div>

                <?php if( isset( $footerTopAdvertisement ) && strcasecmp( $footerTopAdvertisement->is_visible, 'Y' )==0 ) { ?>
                    <div data-advertisement-div class="col-md-12" style="padding:0;">
                        <br/>
                        <?php if( strcasecmp( $footerTopAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
                        <a href="<?php echo $footerTopAdvertisement->linkage ?>" target="_blank">
                            <?php } ?>
                            <img src="/<?php echo $footerTopAdvertisement->img_path ?>" width="100%" alt="<?php echo $footerTopAdvertisement->brief_introduction ?>" title="<?php echo $footerTopAdvertisement->brief_introduction ?>"/>
                            <?php if( strcasecmp( $footerTopAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
                        </a>
                    <?php } ?>
                        <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $footerTopAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $footerTopAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $footerTopAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
                            Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
                        </a>
                        <br/>
                    </div>
                <?php } ?>

            </li>
        </ul>

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
<script src="/resources/e_store/js/customer/my_profile.js"></script>
<!-- END CUSTOMIZED LIB -->