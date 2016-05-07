
<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity-list.css" />

    <?php if( isset( $carouselHeaderBottomObj ) && count( $carouselHeaderBottomObj ) > 0 ) { ?>

        <div id="home_carousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php foreach( $carouselHeaderBottomObj as $index => $carouselHeaderBottom ) { ?>
                    <li data-target="#home_carousel" data-slide-to="<?php echo $index ?>" <?php echo $index==0 ? 'class="active"' : '' ?>></li>
                <?php } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php foreach( $carouselHeaderBottomObj as $index => $carouselHeaderBottom ) { ?>
                    <div class="item <?php echo $index==0 ? 'active' : '' ?>">
                        <?php if( strcasecmp( $carouselHeaderBottom->is_activate_linkage, 'Y' )==0 ) { ?>
                            <a href="<?php echo $carouselHeaderBottom->linkage ?>" target="_blank">
                        <?php } ?>
                        <img src="<?php echo ROOT_PATH . '/' . $carouselHeaderBottom->img_path ?>" width="100%" alt="<?php echo $carouselHeaderBottom->brief_introduction ?>" title="<?php echo $carouselHeaderBottom->brief_introduction ?>">
                        <?php if( strcasecmp( $carouselHeaderBottom->is_activate_linkage, 'Y' )==0 ) { ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

        </div>

    <?php } ?>

<div class="panel-body" style="background:#00a0e9;">

    <div class="panel_body">

        <!-- BEGIN SIDE DROP DOWN MENU -->
        <?php include 'includes/e_store/side_dropdown_menu.php'; ?>
        <!-- END SIDE DROP DOWN MENU -->

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

                    <ul style="padding:20px 0;">
                        <?php if( count( $commodities ) > 0 ) { ?>
                            <?php foreach( $commodities as $index => $commodity ) { ?>
                                <?php
                                $typeParam = '';
                                $manufacturerParam = '';
                                if ( $commodity->type )
                                {
                                    $typeParam .= '&type=' . $commodity->type;
                                }
                                if ( $commodity->manufacturer )
                                {
                                    $manufacturerParam .= '&manufacturer=' . $commodity->manufacturer;
                                }
                                ?>
                                <?php if( $index > 0 ) { ?>
                                    <li>
                                        <hr class="commodity-separator"/>
                                    </li>
                                <?php } ?>
                                <li class="text-center commodity-list">
                                    <div class="col-md-4">
                                        <a href="<?php echo ROOT_PATH ?>/e_store/commodity/get_by/e_store_sku/<?php echo $commodity->e_store_sku . '?' . $typeParam . $manufacturerParam ?>">
                                            <?php if( strcasecmp( $commodity->is_on_sale, 'Y' )==0 ) { ?>
                                                <img src="<?php echo ROOT_PATH ?>/resources/e_store/image/onSale.png" style="position:absolute; width:100px;"/>
                                            <?php } ?>
                                            <img class="commodity-img" style="width:130px; height:130px;" src="<?php echo $commodity->main_picture['pic_path'] ? ROOT_PATH . '/' . $commodity->main_picture['pic_path'] : ROOT_PATH . '/resources/global/image/default_img.svg' ?>" />
                                        </a>
                                    </div>
                                    <div class="col-md-6" style="padding:10px 0;">
                                        <a href="<?php echo ROOT_PATH ?>/e_store/commodity/get_by/e_store_sku/<?php echo $commodity->e_store_sku . '?' . $typeParam . $manufacturerParam ?>" style="color:#c64b4b; font-weight:bold;">
                                            <i class="fa fa-hand-o-right"></i>&nbsp;<?php echo $commodity->name ?>
                                        </a>
                                        <div style="margin-top:10px; color:#7e7e7e;" class="xs-hide">
                                            <?php echo urldecode( $commodity->short_description ) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="col-md-12">
                                    <span class="text-success" style="font-weight:bold;">
                                        $<?php echo sprintf("%01.2f", $commodity->price); ?>
                                    </span>
                                    <span class="text-danger" style="font-weight:bold; font-style:oblique; <?php echo $commodity->inventory['stock'] > 0 ? '' : 'color:#c8c8c8; text-decoration:line-through;' ?>">
                                        Stock:
                                        <?php echo $commodity->inventory['stock'] > 30 ? '30+' : $commodity->inventory['stock'] ?>
                                    </span>
                                        </div>
                                        <?php
                                        $is_in_wish_list = false;

                                        if( isset( $wishListObj ) )
                                        {
                                            foreach( $wishListObj as $wishList )
                                            {
                                                if( $wishList->commodity_id == $commodity->id )
                                                {
                                                    $is_in_wish_list = true;
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="col-md-12" style="margin-top:20px;">
                                            <a href="javascript:void(0);" data-on-click="add_to_cart" data-commodity-id="<?php echo $commodity->id ?>" data-e-store-sku="<?php echo $commodity->e_store_sku ?>" class="btn btn-xs" style="background:#dcf24a; color:#FFF;" data-toggle="tooltip" data-placement="right" data-original-title="Add To Cart">
                                                <i class="fa fa-cart-plus" style="font-size:24px;"></i>
                                            </a>
                                            <?php if( $is_in_wish_list ) { ?>
                                                <!-- Remove From WishList -->
                                                <a href="javascript:void(0);" data-on-click="remove_favourite" data-commodity-id="<?php echo $commodity->id ?>" class="btn btn-xs ml-hide" style="background:#f2a7a7; color:#FFF;" data-toggle="tooltip" data-placement="right" data-original-title="Remove From Wishlist">
                                                    <i class="fa fa-heart" style="font-size:24px;"></i>
                                                </a>
                                            <?php } else { ?>
                                                <!-- Add To WishList -->
                                                <a href="javascript:void(0);" data-on-click="favourite" data-commodity-id="<?php echo $commodity->id ?>" data-e-store-sku="<?php echo $commodity->e_store_sku ?>" class="btn btn-xs ml-hide" style="background:#f2a7a7; color:#FFF;" data-toggle="tooltip" data-placement="right" data-original-title="Add To Wishlist">
                                                    <i class="fa fa-heart-o" style="font-size:24px;"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12 ml-show" style="margin-top:20px;">
                                            <?php if( $is_in_wish_list ) { ?>
                                                <!-- Remove From WishList -->
                                                <a href="javascript:void(0);" data-on-click="remove_favourite" data-commodity-id="<?php echo $commodity->id ?>" class="btn btn-xs" style="background:#f2a7a7; color:#FFF;"data-toggle="tooltip" data-placement="right" data-original-title="Remove From WishList">
                                                    <i class="fa fa-heart" style="font-size:24px;"></i>
                                                </a>
                                            <?php } else { ?>
                                                <!-- Add To WishList -->
                                                <a href="javascript:void(0);" data-on-click="favourite" data-commodity-id="<?php echo $commodity->id ?>" data-e-store-sku="<?php echo $commodity->e_store_sku ?>" class="btn btn-xs" style="background:#f2a7a7; color:#FFF;"data-toggle="tooltip" data-placement="right" data-original-title="Add To WishList">
                                                    <i class="fa fa-heart-o" style="font-size:24px;"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <?php if( isset( $footerTopAdvertisement ) && strcasecmp( $footerTopAdvertisement->is_visible, 'Y' )==0 ) { ?>
                    <div data-advertisement-div class="col-md-12" style="padding:0;">
                        <br/>
                        <?php if( strcasecmp( $footerTopAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
                        <a href="<?php echo $footerTopAdvertisement->linkage ?>" target="_blank">
                            <?php } ?>
                            <img src="/<?php echo $footerTopAdvertisement->img_path ?>" width="100%" alt="<?php echo $footerTopAdvertisement->brief_introduction ?>" title="<?php echo $footerTopAdvertisement->brief_introduction ?>" />
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
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/left_side.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/home.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/wish_list.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/cart.js"></script>
<!-- END CUSTOMIZED LIB -->