<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/css/view_by_page.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity/detail.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity-list.css" />

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

                    <br/><br/>

                    <div class="col-md-12 detail_panel">

                        <form class="form-horizontal">

                            <div class="form-group">

                                <div class="col-md-6">
                                    <div class="name">
                                        <?php echo $commodity['name'] ?>
                                    </div>
                                    <br/>
                                    <div class="detail_content">
                                        <table width="100%">
                                            <thead>
                                            <tr>
                                                <th width="35%"></th>
                                                <th width="65%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="title">EStore Sku:</td>
                                                <td class="content_color_b8b8b8">
                                                    <?php echo $commodity['e_store_sku'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title">Brand:</td>
                                                <td class="content_color_b8b8b8">
                                                    <?php echo $commodity['manufacturer'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title">Model:</td>
                                                <td class="content_color_b8b8b8">
                                                    <?php echo $commodity['inventory']['model'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <?php if( strcasecmp( $commodity['is_weight_shown'], 'Y' )==0 ) { ?>
                                                <tr>
                                                    <td class="title">Weight(gram):</td>
                                                    <td class="content_bold_color_f0ad4e">
                                                        <?php echo $commodity['weight'] ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="title">Price:</td>
                                                <td class="content_bold_color_f0ad4e">
                                                    NZ$ <?php echo sprintf("%01.2f", $commodity['price']) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title">Ext GST:</td>
                                                <td class="content_color_f0ad4e">
                                                    NZ$ <?php echo sprintf("%01.2f", $commodity['price'] / 1.15 ) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="title stock">Stock:</td>
                                                <td class="content_color_f0ad4e stock">
                                                    <?php echo $commodity['inventory']['stock'] > 30 ? '30+' : $commodity['inventory']['stock'] ?>
                                                </td>
                                            </tr>
                                            <!--                                        <tr>-->
                                            <!--                                            <td class="title">Sold Qty:</td>-->
                                            <!--                                            <td class="content_color_b8b8b8">-->
                                            <!--                                                N/A-->
                                            <!--                                            </td>-->
                                            <!--                                        </tr>-->
                                            <tr>
                                                <td class="title">Purchase Qty:</td>
                                                <td class="content_color_b8b8b8">
                                                    <div>
                                                        <?php if( $commodity['inventory']['stock'] > 0 ) { ?>
                                                            <input type="number" pattern="[0-9]" value="1" id="qty_purchased" style="border:1px solid #dcf24a; float:left; text-indent: 4px; line-height:23px; width:70%; height:30px; outline-color:#ffff00;" placeholder="Choose a qty">
                                                        <?php } else { ?>
                                                            <input type="text" disabled="disabled" value="Out Of Stock" id="qty_purchased" style="border:1px solid #dcf24a; float:left; text-indent: 4px; line-height:23px; width:70%; height:30px;">
                                                        <?php } ?>
                                                        <button type="button" <?php echo $commodity['inventory']['stock'] > 0 ? '' : 'disabled' ?> data-on-click="add_to_cart" data-commodity-id="<?php echo $commodity['id'] ?>" data-e-store-sku="<?php echo $commodity['e_store_sku'] ?>" style="border:none; float:left; font-size:25px; color:#FFF; background:#dcf24a; outline:none; height:30px;" data-toggle="tooltip" data-placement="top" data-original-title="To Cart">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6 main_img_div">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th width="30%"></th>
                                            <th width="70%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <?php if( isset( $commodity['pictures'] ) && count( $commodity['pictures'] ) > 1 ) { ?>
                                                        <?php foreach( $commodity['pictures'] as $index => $picture ) { ?>
                                                            <li class="list_img_li">
                                                                <img class="list_img <?php echo $commodity['main_picture']['id'] == $picture->id ? 'selected_img' : '' ?>" src="<?php echo $picture->pic_path ? ROOT_PATH . '/' . $picture->pic_path : ROOT_PATH . '/resources/global/image/default_img.svg' ?>" />
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <?php if( strcasecmp( $commodity['is_on_sale'], 'Y' )==0 ) { ?>
                                                    <img src="<?php echo ROOT_PATH ?>/resources/e_store/image/onSale.png" style="position:absolute; width:100px;"/>
                                                <?php } ?>
                                                <img class="main_img" src="<?php echo $commodity['main_picture']['pic_path'] ? ROOT_PATH . '/' . $commodity['main_picture']['pic_path'] : ROOT_PATH . '/resources/global/image/default_img.svg' ?>" />
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="form-group add_2_favourite_div">
                                <div class="col-md-12">
                                    <?php
                                    $is_in_wish_list = false;

                                    if( isset( $wishListObj ) )
                                    {
                                        foreach( $wishListObj as $wishList )
                                        {
                                            if( $wishList->commodity_id == $commodity['id'] )
                                            {
                                                $is_in_wish_list = true;
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if( $is_in_wish_list ) { ?>
                                        <!-- Remove From WishList -->
                                        <a href="javascript:void(0);" data-on-click="remove_favourite" data-commodity-id="<?php echo $commodity['id'] ?>" class="btn btn-lg" style="background:#f2a7a7; color:#FFF;" data-toggle="tooltip" data-placement="right" data-original-title="Remove From WishList">
                                            <i class="fa fa-heart" style="font-size:24px;"></i> Remove
                                        </a>
                                    <?php } else { ?>
                                        <!-- Add To WishList -->
                                        <a href="javascript:void(0);" data-on-click="favourite" data-commodity-id="<?php echo $commodity['id'] ?>" data-e-store-sku="<?php echo $commodity['e_store_sku'] ?>" class="btn btn-lg" style="background:#f2a7a7; color:#FFF;" data-toggle="tooltip" data-placement="top" data-original-title="Add To WishList">
                                            <i class="fa fa-heart-o" style="font-size:24px;"></i> Favourite
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <hr style="color:#c8c8c8; border:1px solid;"/>
                            </div>

                            <div class="form-group">
                                <h2>
                                    Feature
                                </h2>
                                <div class="col-md-12">
                                    <?php echo urldecode( $commodity['description'] ) ?>
                                </div>
                            </div>

                            <br class="ml-hide"/>

                        </form>

                    </div>

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
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/commodity/detail.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/left_side.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/wish_list.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/cart.js"></script>
<!-- END CUSTOMIZED LIB -->