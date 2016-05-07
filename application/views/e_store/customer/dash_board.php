<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="/resources/e_store/css/customer/dash_board.css" />

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

                <div class="col-md-12 text-center" style="background:#FFF;">
                    <div style="padding:20px;">

                        <div class="form-group ml-show">
                            <ol class="breadcrumb" style="margin: 0;">
                                <li class="active"><strong>Dash Board</strong></li>
                            </ol>
                        </div>

                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/view" class="btn btn-lg btn-info btn-block dash_board_notification_title">
                                        <i class="fa fa-child pull-left"></i> Receiver Address
                                <span>
                                    <span class="badge dash_board_badge pull-right">
                                        <?php echo $receiver_address_count ?>
                                    </span>
                                </span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/shipment_tracking" class="btn btn-lg btn-info btn-block dash_board_notification_title" >
                                        <i class="fa fa-fighter-jet pull-left"></i> Shipment Tracking
                                <span>
                                    <span class="badge dash_board_badge pull-right">
                                        <?php echo $shipping_order_count ?>
                                    </span>
                                </span>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/my_cart" class="btn btn-lg btn-info btn-block dash_board_notification_title">
                                        <i class="fa fa-shopping-cart pull-left"></i> My Cart
                                <span>
                                    <span class="badge dash_board_badge pull-right">
                                        <?php echo $cartTotal ?>
                                    </span>
                                </span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/my_order" class="btn btn-lg btn-info btn-block dash_board_notification_title">
                                        <i class="fa fa-phone pull-left"></i> My Order
                                <span>
                                    <span class="badge dash_board_badge pull-right">
                                        <?php echo $order_count ?>
                                    </span>
                                </span>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/my_wish_list" class="btn btn-lg btn-info btn-block dash_board_notification_title">
                                        <i class="fa fa-heart pull-left"></i> My Wish List
                                <span>
                                    <span class="badge dash_board_badge pull-right">
                                        <?php echo $favouriteTotal ?>
                                    </span>
                                </span>
                                    </a>
                                </div>
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


<!--        My Cart-->
<!--        My Order-->
<!--        My Wish List-->
<!--        Shipment Tracking-->
<!--        Receiver Address-->
<!--        Change Password-->

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