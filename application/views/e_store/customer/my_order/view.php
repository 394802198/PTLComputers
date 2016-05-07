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
                                <li class="active">My Order</li>
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
                                    <strong>Id</strong>
                                </div>
                                <div class="col-md-2 ml-show">
                                    <strong>Receiver</strong>
                                </div>
                                <div class="col-md-2 text-center ml-show">
                                    <strong>Time</strong>
                                </div>
                                <div class="col-md-2 text-center ml-show">
                                    <strong>Status</strong>
                                </div>
                                <div class="col-md-2 text-center ml-show">
                                    <strong>Method</strong>
                                </div>
                                <div class="col-md-2 text-right ml-show">
                                    <strong>Qty & Fees</strong>
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
                                            <i class="fa fa-phone"></i> <?php echo $order->receiver_phone ?><br/>
                                            <?php echo isset( $order->receiver_address ) ? '<i class="fa fa-globe"></i> ' . $order->receiver_address . '<br/>' : '' ?>
                                            <?php echo isset( $order->receiver_city ) ? '<i class="fa fa-globe"></i> ' . $order->receiver_city . '<br/>' : '' ?>
                                            <?php echo isset( $order->receiver_province ) ? '<i class="fa fa-globe"></i> ' . $order->receiver_province . '<br/>' : '' ?>
                                            <?php echo isset( $order->receiver_country ) ? '<i class="fa fa-globe"></i> ' . $order->receiver_country : '' ?>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <strong class="ml-hide" style="margin:6px 0 2px 0;">Time</strong><br/>
                                            <strong>Create</strong><br/>
                                            <?php echo $order->create_time ?>
                                            <br/>
                                            <strong>Update</strong><br/>
                                            <?php echo $order->last_update ?>
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
                                        <div class="col-md-2 text-center">
                                            <strong class="ml-hide">Method</strong><br/>
                                            <strong>Payment</strong><br/>
                                            <?php
                                            switch( $order->payment_method )
                                            {
                                                case 1 : echo 'DPS Payment Express'; break;
                                                case 2 : echo 'Online Banking'; break;
                                                case 3 : echo 'Phone Ordering'; break;
                                                default : echo 'Unknown';
                                            }
                                            ?>
                                            <br/>
                                            <strong>Delivery</strong><br/>
                                            <?php
                                            switch( $order->delivery_method )
                                            {
                                                case 1 : echo 'Pickup'; break;
                                                case 2 : echo 'Shipping'; break;
                                                default : echo 'Unknown';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <strong class="ml-hide">Qty & Fees</strong><br/>
                                            <strong>Qty Ordered</strong><br/>
                                            <?php echo $order->qty_total_item_ordered ?><br/>
                                            <strong>Shipping Fee</strong><br/>
                                            <?php echo $order->shipping_fee ?><br/>
                                            <strong>Grand Total</strong><br/>
                                            <?php echo $order->grand_total ?>
                                        </div>
                                        <?php $index++; if( $index > 0 && $index < count( $orderObj ) ) { ?>
                                            <hr width="100%" style="float:left; margin:20px 0;"/>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="alert alert-info text-center" role="alert" style="font-weight:bold;">
                                    Your Order List is empty, let's go
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