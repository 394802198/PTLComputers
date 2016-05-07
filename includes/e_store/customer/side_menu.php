<ul class="col-md-3">
    <li class="text-center">

        <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/customer/left_side.css" />

        <?php
        $dash_board_redirect_url            =   ROOT_PATH . '/e_store/customer/dash_board';
        $my_profile_redirect_url            =   ROOT_PATH . '/e_store/customer/my_profile';
        $change_credential_redirect_url     =   ROOT_PATH . '/e_store/customer/change_credential';
        $my_order_redirect_url              =   ROOT_PATH . '/e_store/customer/my_order';
        $receiver_address_redirect_url      =   ROOT_PATH . '/e_store/customer/receiver_address/view';
        $my_cart_redirect_url               =   ROOT_PATH . '/e_store/customer/my_cart';
        $shipment_tracking_redirect_url     =   ROOT_PATH . '/e_store/customer/shipment_tracking';
        $my_wish_list_redirect_url          =   ROOT_PATH . '/e_store/customer/my_wish_list';

        ?>

        <ul class="ml-show" style="padding:0; width:218px; margin-left:45px; margin-bottom:15px;">
            <li>
                <a <?php echo strcasecmp( $current_on, 'dash_board' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $dash_board_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'dash_board' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-dashboard"></i> Dash Board
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:94%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_profile' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_profile_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'my_profile' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-user-secret"></i> My Profile
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'change_credential' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $change_credential_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'change_credential' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-key"></i> Change Credential
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:94%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_order' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_order_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'my_order' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-phone"></i> My Order
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'receiver_address' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $receiver_address_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'receiver_address' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-child"></i> Receiver Address
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:94%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_cart' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_cart_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'my_cart' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-shopping-cart"></i> My Cart
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'shipment_tracking' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $shipment_tracking_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'shipment_tracking' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-fighter-jet"></i> Shipment Tracking
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:94%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_wish_list_redirect_url . '"'  ?> class="btn btn-lg btn-<?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left; <?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? '' : 'background:#f2a7a7;'  ?>">
                    <i class="fa fa-heart"></i> My Wish List
                </a>
            </li>
        </ul>

        <ul class="ml-hide" style="padding:0; margin-top:15px; margin-bottom:15px;">
            <li>
                <a <?php echo strcasecmp( $current_on, 'dash_board' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $dash_board_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'dash_board' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-dashboard"></i> Dash Board
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:98%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_profile' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_profile_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'my_profile' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-user-secret"></i> My Profile
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'change_credential' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $change_credential_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'change_credential' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-key"></i> Change Credential
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:98%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_order' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_order_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'my_order' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-phone"></i> My Order
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'receiver_address' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $receiver_address_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'receiver_address' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-child"></i> Receiver Address
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:98%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_cart' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_cart_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'my_cart' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-shopping-cart"></i> My Cart
                </a>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'shipment_tracking' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $shipment_tracking_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'shipment_tracking' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left;">
                    <i class="fa fa-fighter-jet"></i> Shipment Tracking
                </a>
            </li>
            <li>
                <hr style="border-color:#FFF; width:98%; margin:0 auto;"/>
            </li>
            <li>
                <a <?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? 'href="javascript:void(0);"' : 'href="' . $my_wish_list_redirect_url . '"'  ?> class="btn btn-sm btn-<?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? 'default' : 'primary'  ?> btn-block" style="text-align:left; <?php echo strcasecmp( $current_on, 'my_wish_list' ) == 0 ? '' : 'background:#f2a7a7;'  ?>">
                    <i class="fa fa-heart"></i> My Wish List
                </a>
            </li>
        </ul>

    </li>
</ul>