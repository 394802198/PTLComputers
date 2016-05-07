<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity-list.css" />

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
                                <li class="active">Receiver Address</li>
                                <li class="pull-right" id="breadcrumb-li">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/add" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Add New Receiver Address">
                                        <i class="fa fa-plus"></i>
                                        New Address
                                    </a>
                                </li>
                            </ol>
                        </div>

                        <div class="form-group ml-hide">
                            <a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF; margin-bottom:1px;">
                                <i class="fa fa-hand-o-left"></i>
                                Dash Board
                            </a>
                        </div>

                        <div class="form-group ml-hide text-center">
                            <a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/add" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Add New Receiver Address">
                                <i class="fa fa-plus"></i>
                                New Address
                            </a>
                        </div>

                        <form class="form-horizontal text-center">
                            <div class="form-group">
                                <div class="col-md-2 ml-show">
                                    <strong>Shipping Area</strong>
                                </div>
                                <div class="col-md-2 ml-show">
                                    <strong>Receiver</strong>
                                </div>
                                <div class="col-md-2 ml-show">
                                    <strong>Contact</strong>
                                </div>
                                <div class="col-md-3 ml-show">
                                    <strong>Address</strong>
                                </div>
                                <div class="col-md-1 ml-show">
                                    <strong>Is Default</strong>
                                </div>
                                <div class="col-md-2 ml-show">
                                    <strong>Operation</strong>
                                </div>
                            </div>
                            <?php if( count( $receiverAddressObj ) > 0 ) { ?>
                                <?php foreach( $receiverAddressObj as $index => $receiverAddress ) { ?>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <strong class="ml-hide">Shipping Area</strong><br/>
                                            <a href="<?php ROOT_PATH ?>/e_store/customer/receiver_address/edit/id/<?php echo $receiverAddress->id ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Update Receiver Address">
                                                <?php echo $receiverAddress->shipping_area_name ?>
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2" style="word-break:break-all;">
                                            <strong class="ml-hide">Receiver</strong><br/>
                                            <i class="fa fa-user"></i> <?php echo $receiverAddress->receiver_name ?>
                                        </div>
                                        <div class="col-md-2" style="word-break:break-all;">
                                            <strong class="ml-hide" style="margin:6px 0 2px 0;">Contact</strong><br/>
                                            <i class="fa fa-phone"></i> <?php echo $receiverAddress->receiver_phone ?><br/>
                                            <i class="fa fa-envelope"></i> <?php echo $receiverAddress->receiver_email ?>
                                        </div>
                                        <div class="col-md-3" style="word-break:break-all;">
                                            <strong class="ml-hide">Address</strong><br/>
                                            <?php echo isset( $receiverAddress->receiver_address ) ? $receiverAddress->receiver_address . '<br/>' : '' ?>
                                            <?php echo isset( $receiverAddress->receiver_city ) ? $receiverAddress->receiver_city . '<br/>' : '' ?>
                                            <?php echo isset( $receiverAddress->receiver_province ) ? $receiverAddress->receiver_province . '<br/>' : '' ?>
                                            <?php echo isset( $receiverAddress->receiver_country ) ? $receiverAddress->receiver_country : '' ?>
                                        </div>
                                        <div class="col-md-1">
                                            <strong class="ml-hide">Is Default</strong><br/>
                                            <?php echo strcasecmp( $receiverAddress->is_default, 'Y' )==0 ? '<i class="fa fa-thumbs-up" style="font-size:30px;"></i>' : '<a class="btn btn-primary btn-md" data-name="set_as_default_receiver_address" data-id="' . $receiverAddress->id . '"><i class="fa fa-hand-o-up"></i></a>' ?>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:void(0);" data-name="delete_receiver_address" data-id="<?php echo $receiverAddress->id ?>" class="btn btn-danger btn-md" data-toggle="tooltip" data-placement="top" data-original-title="Remove Receiver Address">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <?php $index++; if( $index > 0 && $index < count( $receiverAddressObj ) ) { ?>
                                        <hr width="100%" style="float:left; margin:20px 0;"/>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { ?>
                                Receiver Address is currently empty, create your <a href="<?php echo ROOT_PATH ?>/e_store/customer/receiver_address/add" class="btn btn-xs btn-success">Receiver Address</a>
                            <?php } ?>
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
<script src="/resources/e_store/js/customer/receiver_address/view.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<!--<script src="--><?php //echo ROOT_PATH ?><!--/resources/e_store/js/cart.js"></script>-->
<!-- END CUSTOMIZED LIB -->