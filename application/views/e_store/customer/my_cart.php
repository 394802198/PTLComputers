<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/css/view_by_page.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity-list.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/my-cart.css" />

<style>
    @media ( min-width: 992px )
    {
        .fees-style
        {
            text-align:right;
        }
    }
    @media ( max-width: 991px )
    {
        .fees-style span
        {
            display:inline-block;
            width:50%;
            text-align:right;
        }
        #checkout
        {
            margin-right:10px;
        }
        .fees-style span:nth-child(n+1)
        {
            padding-right:10px;
        }
        .fees-style span:nth-child(n+2)
        {
            font-size:12px;
        }
        .payment_method_area .title,
        .shipping_method_area .title
        {
            font-size:14px;
        }
        .payment_method_area .content,
        .shipping_method_area .content
        {
            font-size:12px;
        }
    }
    .payment_method_area,
    .shipping_method_area
    {
        padding:10px !important;
        border-radius:10px;;
    }
    .payment_method_area .title,
    .shipping_method_area .title
    {
        cursor:pointer;
    }
    .payment_method_area .content,
    .shipping_method_area .content
    {
        padding-left:30px;
    }
</style>

<div class="panel-body" style="background:#00a0e9;">

    <div class="panel_body">

        <?php

            if( isset( $_SESSION['customer'] ) )
            {
                // BEGIN SIDE MENU
                include 'includes/e_store/customer/side_menu.php';
                // END SIDE MENU
            }
            else
            {
                // BEGIN SIDE DROP DOWN MENU
                include 'includes/e_store/side_dropdown_menu.php';
                // END SIDE DROP DOWN MENU
            }

        ?>
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

                    <?php if( isset( $cart ) ){ ?>
                        <div class="col-md-12" style="text-align:left; padding:20px 0; font-size:12px;">
                            <div class="alert alert-info col-md-12" role="alert" style="font-weight:bold; font-style:oblique;">
                                <div class="col-md-8 text-left">
                                    Product: <span data-name="product_total"><?php echo $productTotal ?></span>
                                    <br/>
                                    Total Qty: <span data-name="total_qty_purchased"><?php echo $cartItemTotal ?></span>
                                </div>
                                <br class="ml-hide"/>
                                <div class="col-md-4 text-left">
                                    Create Time: <?php echo $cart['create_time'] ?>
                                    <br/>
                                    Last Update: <span data-name="last_update"><?php echo $cart['last_update'] ?></span>
                                </div>
                                <?php
                                $is_any_item_insufficient = false;
                                if( isset( $cart ) && isset( $cart['items'] ) && count( $cart['items'] ) > 0 )
                                {
                                    foreach( $cart['items'] as $index => $item )
                                    {
                                        if( $item['inventory']['stock'] < $item['qty_ordered'] )
                                        {
                                            $is_any_item_insufficient = true;
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <?php if( $is_any_item_insufficient ) { ?>
                                    <div class="col-md-12">
                                        <a href="javascript:void(0);" data-name="adjust_qty_purchased" class="btn btn-xs btn-primary" style="font-style:oblique; margin-bottom:2px;" data-toggle="tooltip" data-placement="top" data-original-title="Adjusting your Purchase Qty to our maximum available stock">
                                            Auto Adjust All Insufficient Items
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <ul style="padding:20px 0;">
                        <?php if( isset( $cart ) && isset( $cart['items'] ) && count( $cart['items'] ) > 0 ){ ?>
                            <?php foreach( $cart['items'] as $index => $item ) { ?>

                                <?php
                                $typeParam = '';
                                $manufacturerParam = '';
                                if ( isset( $item['inventory'] ) && isset( $item['inventory']['type'] ) )
                                {
                                    $typeParam .= '&type=' . $item['inventory']['type'];
                                }
                                if ( isset( $item['inventory'] ) && isset( $item['inventory']['manufacturer_name'] ) )
                                {
                                    $manufacturerParam .= '&manufacturer=' . $item['inventory']['manufacturer_name'];
                                }
                                ?>
                                <?php if( $index > 0 ) { ?>
                                    <li data-removable="<?php echo $item['e_store_sku'] ?>">
                                        <hr class="commodity-separator"/>
                                    </li>
                                <?php } ?>

                                <li class="commodity-list" data-removable="<?php echo $item['e_store_sku'] ?>">
                                    <div class="col-md-2">
                                        <a href="<?php echo ROOT_PATH ?>/e_store/commodity/get_by/e_store_sku/<?php echo $item['e_store_sku'] . '?' . $typeParam . $manufacturerParam ?>">
                                            <img class="commodity-img" src="<?php echo isset( $item['main_picture'] ) && isset( $item['main_picture']['pic_path'] ) ? ROOT_PATH . '/' . $item['main_picture']['pic_path'] : ROOT_PATH . '/resources/global/image/default_img.svg' ?>" />
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td data-toggle="tooltip" data-placement="top" data-original-title="EStore Sku">
                                                    <i class="fa fa-anchor xs-hide" style="width:20px;"></i>
                                                    <span class="xs-hide">:</span>
                                                    <?php echo $item['e_store_sku'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-toggle="tooltip" data-placement="top" data-original-title="Product Name">
                                                    <i class="fa fa-tag xs-hide" style="width:20px;"></i>
                                                    <span class="xs-hide">:</span>
                                                    <?php echo $item['name'] ?>
                                                </td>
                                            </tr>
                                            <?php if( strcasecmp( $item['commodity']['is_weight_shown'], 'Y' )==0 ) { ?>
                                                <tr>
                                                    <td data-toggle="tooltip" data-placement="top" data-original-title="Product Weight" data-name="unit_weight">
                                                        <i class="fa fa-database xs-hide" style="width:20px;"></i>
                                                        <span class="xs-hide">:</span>
                                                        <?php echo sprintf("%01.0f", $item['unit_weight'] / 1000); ?> ( kg )
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td data-toggle="tooltip" data-placement="top" data-original-title="Current Stock" data-name="stock" data-val="<?php echo $item['inventory']['stock'] ?>" data-e-store-sku="<?php echo $item['e_store_sku'] ?>">
                                                    <i class="fa fa-cubes xs-hide" style="width:20px;"></i>
                                                    <span class="xs-hide">:</span>
                                                    <?php echo $item['inventory']['stock'] > 30 ? '30+' : $item['inventory']['stock'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-toggle="tooltip" data-placement="top" data-original-title="Current Price" data-name="unit_price">
                                                    <i class="fa fa-dollar xs-hide" style="width:20px;"></i>
                                                    <span class="xs-hide">:</span>
                                                    <?php echo sprintf("%01.2f", $item['unit_price']); ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <table>
                                            <tr>
                                                <td>
                                                    <button type="button" disabled="disabled" style="border:none; float:left; font-size:12px; color:#FFF; background:#337ab7; outline:none; height:30px;">
                                                        Qty
                                                    </button>
                                                    <input type="number" data-name="qty_purchased" value="<?php echo $item['qty_ordered'] ?>" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" style="border:1px solid #337ab7; float:left; text-indent: 4px; line-height:23px; width:50px; height:30px; outline-color:#337ab7;" placeholder="Choose a qty" data-toggle="tooltip" data-placement="top" data-original-title="Purchase Qty">
                                                    <button type="button" data-name="edit_cart_item_qty" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" style="border:none; float:left; font-size:20px; color:#FFF; background:#337ab7; outline:none; height:30px;" data-toggle="tooltip" data-placement="top" data-original-title="Click to Save Purchase Qty">
                                                        <i class="fa fa-check"></i>
                                                    </button>

                                                    <div style="width:100%; float:left;" data-name="stock_not_enough" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" >
                                                        <?php if( $item['qty_ordered'] > $item['inventory']['stock']  ) { ?>
                                                            <div class="alert alert-danger text-center" role="alert" style="font-weight:bold;">
                                                                <?php if( $item['inventory']['stock'] > 0 ) { ?>
                                                                    Inventory Insufficient, We can
                                                                    <a href="javascript:void(0);" data-name="adjust_qty_purchased" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" class="btn btn-xs btn-primary" style="font-style:oblique; margin-bottom:2px;" data-toggle="tooltip" data-placement="top" data-original-title="Adjusting your Purchase Qty to our maximum available stock">
                                                                        Auto Adjust
                                                                    </a>
                                                                    for You, or You can just
                                                                <?php } else { ?>
                                                                    Inventory Insufficient.
                                                                <?php } ?>
                                                                <a class="btn btn-xs btn-danger" data-name="remove_from_cart" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" data-toggle="tooltip" data-placement="top" data-original-title="Remove From Cart">
                                                                    <i class="fa fa-trash"></i> Remove
                                                                </a>
                                                                it from cart.
                                                            </div>
                                                        <?php } ?>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-1">
                                        <br class="ml-hide"/>
                                        <a class="btn btn-md btn-danger" data-name="remove_from_cart" data-e-store-sku="<?php echo $item['e_store_sku'] ?>" data-toggle="tooltip" data-placement="top" data-original-title="Remove From Cart">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </li>

                            <?php } ?>
                        <?php } else { ?>
                            <div class="alert alert-info text-center" role="alert" style="font-weight:bold;">
                                Your cart is empty, let's go
                                <a href="<?php ROOT_PATH ?>/e_store/commodity/search" class="btn btn-xs btn-primary" style="font-style:oblique;">
                                    Shopping
                                </a>
                            </div>
                        <?php } ?>
                    </ul>

                    <?php if( isset( $cart ) ){ ?>
                        <div class="col-md-12" style="padding:20px 0; font-size:14px;">
                            <div class="alert alert-info col-md-12" role="alert">

                                <!--

                                    BEGIN: Payment Method

                                -->
                                <div class="col-md-12 payment_method_area" style="border:2px solid #FFF;">
                                    <div class="col-md-12">
                                        <h4>Payment Method:</h4>
                                        <input type="hidden" name="payment_method" value="1" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="title">
                                            <input type="radio" checked="checked" name="payment_method_radio" value="1" />
                                            Payment Express (DPS) - PxPay
                                        </label><br/>
                                        <div class="content">
                                            Credit Card Payment
                                        </div>
                                        <br/>
                                        <label class="title">
                                            <input type="radio" name="payment_method_radio" value="2" />
                                            Online Banking
                                        </label><br/>
                                        <div class="content">
                                            Bank Name : ASB Bank Account Number : 12-3053-0588577-00
                                        </div>
                                        <br/>
                                        <label class="title">
                                            <input type="radio" name="payment_method_radio" value="3" />
                                            Phone Ordering
                                        </label><br/>
                                        <div class="content">
                                            Phone: (09) 4446611
                                        </div>
                                    </div>
                                </div>
                                <!--

                                    END: Payment Method

                                -->

                                <div class="col-md-12">
                                    <hr/>
                                </div>

                                <!--

                                    BEGIN: Shipping Method

                                -->
                                <div class="col-md-12 shipping_method_area" style="border:2px solid #FFF;">
                                    <h4>Shipping Method:</h4>
                                    <input type="hidden" name="shipping_method" value="1" />
                                    <label class="title">
                                        <input type="radio" checked="checked" name="shipping_method_radio" value="1" />
                                        Pick Up
                                    </label>

                                    <div class="col-md-12" id="pick_up_detail_outer_div">
                                        <label class="col-md-4 control-label">Pickup Detail</label>
                                        <div class="col-md-8">
                                            <div class="col-md-12" id="pick_up_detail_div">
                                                <div class="input-group" data-name="pick_up_group">
                                            <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                                <i class="fa fa-envelope" style="font-size:18px; color:#edfc87; width:15px;"></i>
                                            </span>
                                                    <input type="text" id="receiver_email" value="<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['email'] : '' ?>" class="form-control" placeholder="* My Email" style="border-color:#204d74;">
                                                </div>
                                                <div class="input-group" data-name="pick_up_group">
                                            <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                                <i class="fa fa-phone" style="font-size:18px; color:#edfc87; width:15px;"></i>
                                            </span>
                                                    <input type="text" id="receiver_phone" value="<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['mobile_phone'] : '' ?>" class="form-control" placeholder="* My Phone" style="border-color:#204d74;">
                                                </div>
                                                <div class="input-group" data-name="pick_up_group">
                                            <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                                <i class="fa fa-user" style="font-size:18px; color:#edfc87; width:15px;"></i>
                                            </span>
                                                    <input type="text" id="receiver_name" value="<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name'] : '' ?>" class="form-control" placeholder="* My Name" style="border-color:#204d74;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                    <label class="title">
                                        <input type="radio" name="shipping_method_radio" value="2" />
                                        Shipping
                                    </label>

                                    <div class="col-md-12" id="shipping_area_outer_div" style="display:none;">
                                        <input type="hidden" name="receiver_address" />
                                        <label class="col-md-4 control-label">Shipping Area</label>
                                        <div class="col-md-8">
                                            <div class="col-md-12" id="shipping_area_div">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="courier_and_pricing_outer_div" style="display:none;">
                                        <label class="col-md-4 control-label">Courier And Charge per KG</label>
                                        <div class="col-md-8">
                                            <div class="col-md-12" id="courier_and_pricing_div"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="shipping_address_outer_div" style="display:none;">
                                        <label class="col-md-4 control-label">Shipping Address</label>
                                        <div class="col-md-8">
                                            <div class="col-md-12" id="shipping_address_div"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--

                                    END: Shipping Method

                                -->

                                <div class="col-md-12">
                                    <hr/>
                                </div>

                                <div class="col-md-5 col-md-offset-4 text-right ml-show" style="font-weight:bold;">
                                    <!--                            Total weight:<br/>-->
                                    Net charges:<br/>
                                    GST:<br/>
                                    Shipping Fee:
                                </div>
                                <div class="col-md-1 ml-show" style="font-weight:bold;">
                                    <!--                            +<br/>-->
                                    +<br/>
                                    +<br/>
                                    +
                                </div>
                                <div class="col-md-2 fees-style" style="font-weight:bold;">
                                    <span class="ml-hide"></span><span id="exchange_rate" class="ml-hide">NZ$</span>
                                    <!--                            <span class="ml-hide">Total weight:</span><span id="total_weight"></span><br/>-->
                                    <span class="ml-hide">Net Charge:</span><span id="net_charges"></span><br/>
                                    <span class="ml-hide">GST:</span><span id="gst"></span><br/>
                                    <span class="ml-hide">Shipping Fee:</span><span id="shipping_fee"></span>
                                </div>
                                <div class="col-md-3 col-md-offset-9 text-right ml-show">
                                    <hr/>
                                </div>
                                <div class="col-md-12 text-right ml-hide">
                                    <hr/>
                                </div>
                                <div class="col-md-5 col-md-offset-4 text-right ml-show" style="font-weight:bold;">
                                    Grand Total:
                                </div>
                                <div class="col-md-1 ml-show" style="font-weight:bold;">
                                    =
                                </div>
                                <div class="col-md-2 fees-style" style="font-weight:bold;">
                                    <span class="ml-hide">Grand Total:</span><span id="order_total"></span>
                                </div>
                                <div class="col-md-12"><br/></div>


                                <div class="col-md-12 text-right" id="apply_confirm_btn">
                                    <a href="javascript:void(0);" class="btn btn-lg btn-success">Apply Confirm</a>
                                </div>
                                <div class="col-md-12"><br/></div>
                            </div>
                        </div>
                    <?php } ?>

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


<form class="form-horizontal">
    <!-- Apply Confirm -->
    <div class="modal fade" id="applyConfirmModal" tabindex="-1" role="dialog" aria-labelledby="applyConfirmModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-info text-center" id="applyConfirmModalLabel">Apply Confirm</h4>
                </div>
                <div class="modal-body" id="shipping_address_preview_div">
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default text-info" data-dismiss="modal">I want to double check my cart</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="applyConfirmBtn">Apply</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN FOOTER -->
<?php include 'includes/e_store/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/home.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/left_side.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/wish_list.js"></script>
<!-- END CUSTOMIZED LIB -->

<script>
    var is_customer = JSON.parse( '<?php echo isset( $_SESSION['customer'] ) ? 'true' : 'false' ?>' );
    var full_name = '<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name'] : '' ?>';
    var mobile_phone = '<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['mobile_phone'] : '' ?>';
    var email = '<?php echo isset( $_SESSION['customer'] ) ? $_SESSION['customer']['email'] : '' ?>';
</script>

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/customer/my_cart.js"></script>
<!-- END CUSTOMIZED LIB -->