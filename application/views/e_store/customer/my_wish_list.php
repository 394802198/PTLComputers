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
                                <li class="active">My Wish List</li>
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
                                <?php $is_any_commodity = false; ?>
                                <?php if( count( $wishListObj ) > 0 ) { ?>
                                    <?php foreach( $wishListObj as $index => $wishList ) { ?>
                                        <?php if( isset( $wishList->commodity ) ) { ?>
                                            <?php $is_any_commodity = true; ?>
                                            <div class="col-md-4">
                                                <a href="<?php echo ROOT_PATH . '/e_store/commodity/get_by/e_store_sku/' . $wishList->e_store_sku . '?&type=' . $wishList->commodity['type'] . '&manufacturer=' . $wishList->commodity['manufacturer'] ?>">
                                                    <img class="commodity-img" src="<?php echo $wishList->pic_path ? ROOT_PATH . '/' . $wishList->pic_path : ROOT_PATH . '/resources/global/image/default_img.svg' ?>" />
                                                </a>
                                                <p class="form-control-static my_wish_list_text" data-toggle="tooltip" data-placement="top" data-original-title="Create Time">
                                                    <i class="fa fa-calendar-plus-o xs-hide" style="width:20px;"></i><span class="xs-hide"> : </span><span style="font-size:12px;"><?php echo $wishList->create_time ?></span>
                                                </p>
                                                <p class="form-control-static my_wish_list_text" data-toggle="tooltip" data-placement="top" data-original-title="EStore Sku">
                                                    <i class="fa fa-anchor xs-hide" style="width:20px;"></i><span class="xs-hide"> : </span><span style="font-size:12px;"><?php echo $wishList->e_store_sku ?></span>
                                                </p>
                                                <p class="form-control-static my_wish_list_text" data-toggle="tooltip" data-placement="top" data-original-title="Commodity Name">
                                                    <i class="fa fa-tag xs-hide" style="width:20px;"></i><span class="xs-hide"> : </span><span style="font-size:12px;"><?php echo $wishList->commodity['name'] ?></span>
                                                </p>
                                                <p class="form-control-static my_wish_list_text" data-toggle="tooltip" data-placement="top" data-original-title="Current Stock">
                                                    <i class="fa fa-cubes xs-hide" style="width:20px;"></i><span class="xs-hide"> : </span><span style="font-size:12px;"><?php echo $wishList->commodity['inventory']['stock'] ?></span>
                                                </p>
                                                <div class="col-md-12 text-left">
                                                    <a href="javascript:void(0);" <?php echo $wishList->commodity['inventory']['stock'] > 0 ? '' : 'disabled' ?> data-on-click="add_to_cart" data-commodity-id="<?php echo $wishList->commodity['id'] ?>" data-e-store-sku="<?php echo $wishList->e_store_sku ?>" class="btn btn-xs" style="background:#dcf24a; color:#FFF; margin:10px 0 20px 0;" data-toggle="tooltip" data-placement="bottom" data-original-title="Add To Cart">
                                                        <i class="fa fa-cart-plus"></i> Add to Cart
                                                    </a>
                                                    <!-- Remove From WishList -->
                                                    <a href="javascript:void(0);" data-on-click="remove_favourite" data-commodity-id="<?php echo $wishList->commodity['id'] ?>" class="btn btn-xs" style="background:#f2a7a7; color:#FFF; margin:10px 0 20px 0;" data-toggle="tooltip" data-placement="bottom" data-original-title="Remove From WishList">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php $index++; if( $index % 3 == 0 && $is_any_commodity ) { ?>
                                            <hr class="ml-show" width="100%" style="float:left; margin:0 0 20px 0;"/>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    My Wish List is currently empty, continue finding my <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search" class="btn btn-xs btn-success">Favourite Products</a>
                                <?php } ?>
                                <?php if( ! $is_any_commodity && count( $wishListObj ) > 0 ) { ?>
                                    Your Wish List is currently empty, go and find your <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search" class="btn btn-xs btn-success">Favourite Products</a>
                                <?php } ?>
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
<script src="/resources/e_store/js/wish_list.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/cart.js"></script>
<!-- END CUSTOMIZED LIB -->