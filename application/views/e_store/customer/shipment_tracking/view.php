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
                                <li class="active">Shipment Tracking</li>
                                <!--                        <li class="pull-right" id="breadcrumb-li">-->
                                <!--                            <a href="--><?php //echo ROOT_PATH ?><!--/e_store/customer/receiver_address/add" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Add New Receiver Address">-->
                                <!--                                <i class="fa fa-plus"></i>-->
                                <!--                                New Address-->
                                <!--                            </a>-->
                                <!--                        </li>-->
                            </ol>
                        </div>

                        <div class="form-group ml-hide">
                            <a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-xs" style="background-color:#286090; color:#FFF; margin-bottom:1px;">
                                <i class="fa fa-hand-o-left"></i>
                                Dash Board
                            </a>
                        </div>

                        <!--                <div class="form-group ml-hide text-center">-->
                        <!--                    <a href="--><?php //echo ROOT_PATH ?><!--/e_store/customer/receiver_address/add" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Add New Receiver Address">-->
                        <!--                        <i class="fa fa-plus"></i>-->
                        <!--                        New Address-->
                        <!--                    </a>-->
                        <!--                </div>-->

                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-2 ml-show">
                                    <strong>Order Id</strong>
                                </div>
                                <div class="col-md-2 ml-show">
                                    <strong>Receiver</strong>
                                </div>
                                <div class="col-md-2 text-center ml-show">
                                    <strong>Status</strong>
                                </div>
                                <div class="col-md-2 text-right ml-show">
                                    <strong>Shipping Fee</strong>
                                </div>
                                <div class="col-md-4 text-center ml-show">
                                    <strong>Tracking Codes</strong>
                                </div>
                            </div>
                            <?php if( count( $orderObj ) > 0 ) { ?>
                                <?php foreach( $orderObj as $index => $order ) { ?>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <strong class="ml-hide">Id</strong><br/>
                                            <?php echo $order->id ?>
                                        </div>
                                        <div class="col-md-2" style="word-break:break-all;">
                                            <strong class="ml-hide">Receiver</strong><br/>
                                            <i class="fa fa-user"></i> <?php echo $order->receiver_name ?><br/>
                                            <i class="fa fa-phone"></i> <?php echo $order->receiver_phone ?>
                                        </div>
                                        <div class="col-md-2 text-center" style="word-break:break-all;">
                                            <strong class="ml-hide">Status</strong><br/>
                                            <strong>Order</strong><br/>
                                            <?php
                                            switch( $order->order_status )
                                            {
                                                case 1 : echo 'Pending'; break;
                                                case 2 : echo 'Processing'; break;
                                                case 3 : echo 'Waiting for shipment'; break;
                                                case 4 : echo 'Shipped'; break;
                                                case 5 : echo 'Completed'; break;
                                                case 6 : echo 'Cancelled'; break;
                                                case 7 : echo 'Refunded'; break;
                                                default : echo 'Unknown';
                                            }
                                            ?>
                                            <br/>
                                            <strong>Payment</strong><br/>
                                            <?php
                                            switch( $order->payment_status )
                                            {
                                                case 1 : echo 'Unpaid'; break;
                                                case 2 : echo 'Paid'; break;
                                                default : echo 'Unknown';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <strong class="ml-hide">Shipping Fee</strong><br/>
                                            <?php echo $order->shipping_fee ?>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <strong class="ml-hide">Tracking Codes</strong><br/>
                                            <?php
                                            $tracking_codes_arr = explode( ',', $order->tracking_codes );
                                            if( count( $tracking_codes_arr ) > 0 )
                                            {
                                                foreach( $tracking_codes_arr as $tracking_code )
                                                {
                                                    $final_tracking_code = trim( $tracking_code );
                                                    if( $final_tracking_code != '' )
                                                    {
                                                        echo '<a target="_blank" href="http://www.castleparcels.co.nz/cpl/servlet/ITNG_TAndTServlet?page=1&customer_number=12804405&consignment_id=' . $final_tracking_code . '&request_id=3" class="btn btn-info btn-xs">' . $final_tracking_code . '</a>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php $index++; if( $index > 0 && $index < count( $orderObj ) ) { ?>
                                            <hr width="100%" style="float:left; margin:20px 0;"/>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="alert alert-info text-center" role="alert" style="font-weight:bold;">
                                    Your Shipment List is empty, let's go
                                    <a href="<?php ROOT_PATH ?>/e_store/commodity/search" class="btn btn-xs btn-primary" style="font-style:oblique;">
                                        Shopping
                                    </a>
                                </div>
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