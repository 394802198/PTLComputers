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
                                <li class="active">Change Credential</li>
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
                                <label for="email" class="control-label col-md-3 text-success">Current Credential:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-key" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                        <input type="password" id="current_credential" class="form-control" placeholder="* Current Credential" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 text-success">New Credential:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-key" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                        <input type="password" id="new_credential" class="form-control" placeholder="* New Credential" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-3 text-success">Confirm New Credential:</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-key" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                        <input type="password" id="confirm_new_credential" class="form-control" placeholder="* Confirm New Credential" style="border-color:#4cae4c;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-xs btn-primary" id="changeCredentialBtn">Change Credential</a>
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
<script src="/resources/e_store/js/customer/change_credential.js"></script>
<!-- END CUSTOMIZED LIB -->