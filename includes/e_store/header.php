<!-- BEGIN HTML HEADER -->
<?php include 'includes/e_store/html_header.php'; ?>
<!-- END HTML HEADER -->

<?php if( isset( $pageTopAdvertisement ) && strcasecmp( $pageTopAdvertisement->is_visible, 'Y' )==0 ) { ?>
    <div data-advertisement-div>
        <?php if( strcasecmp( $pageTopAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        <a href="<?php echo $pageTopAdvertisement->linkage ?>" target="_blank">
            <?php } ?>
            <img src="/<?php echo $pageTopAdvertisement->img_path ?>" width="100%" />
            <?php if( strcasecmp( $pageTopAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        </a>
    <?php } ?>
        <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $pageTopAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $pageTopAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $pageTopAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
            Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
        </a>
    </div>
<?php } ?>

<?php if( isset( $pageLeftAdvertisement ) && strcasecmp( $pageLeftAdvertisement->is_visible, 'Y' )==0 ) { ?>
    <div data-advertisement-div data-advertisement-page-left-right-div style="position:fixed; left:0; z-index:99; border:1px solid #FFF;">

        <?php if( strcasecmp( $pageLeftAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        <a href="<?php echo $pageLeftAdvertisement->linkage ?>" target="_blank">
            <?php } ?>
            <img src="/<?php echo $pageLeftAdvertisement->img_path ?>" width="200px" height="300px" data-advertisement-page-left-right-img />
            <?php if( strcasecmp( $pageLeftAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        </a>
    <?php } ?>

        <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $pageLeftAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $pageLeftAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $pageLeftAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
            Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
        </a>
    </div>
<?php } ?>

<?php if( isset( $pageRightAdvertisement ) && strcasecmp( $pageRightAdvertisement->is_visible, 'Y' )==0 ) { ?>
    <div data-advertisement-div data-advertisement-page-left-right-div style="position:fixed; right:0; z-index:99; border:1px solid #FFF;">

        <?php if( strcasecmp( $pageRightAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        <a href="<?php echo $pageRightAdvertisement->linkage ?>" target="_blank">
            <?php } ?>
            <img src="/<?php echo $pageRightAdvertisement->img_path ?>" width="200px" height="300px" data-advertisement-page-left-right-img />
            <?php if( strcasecmp( $pageRightAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
        </a>
    <?php } ?>

        <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $pageRightAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $pageRightAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $pageRightAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
            Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
        </a>
    </div>
<?php } ?>
<hr style="margin:0;"/>

<div class="panel-body header_panel_bottom_outer" style="background:#00a0e9;">

    <div class="header_bottom_panel">

        <nav class="navbar navbar-default" style="background:#434343; width:93.5%; margin-left:5%;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--                    <a class="navbar-brand" href="/">-->
                    <!--                        <i class="fa fa-home"></i>-->
                    <!--                    </a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav col-md-8">

                        <li>
                            <a href="<?php echo ROOT_PATH ?>/home">
                                <i class="fa fa-home home_icon_i"></i>
                            </a>
                        </li>
                        <?php

                            if( isset( $customTopNavItems ) && count( $customTopNavItems ) > 0 )
                            {
                                foreach( $customTopNavItems as $customTopNavItem )
                                {
                                    ?>

                                    <li class="dropdown">
                                        <a <?php echo strcasecmp( $customTopNavItem->is_activate_linkage, 'Y' )==0 ? 'href="' . $customTopNavItem->linkage . '"' : '' ?>>
                                            <?php echo $customTopNavItem->name ?>
                                        </a>
                                    </li>

                                    <?php
//                                    var_dump( $customTopNavItem );
                                }
                            }

                        ?>
<!--                        <li class="dropdown">-->
<!--                            <a href="--><?php //echo ROOT_PATH ?><!--/home">-->
<!--                                Service-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="dropdown">-->
<!--                            <a href="--><?php //echo ROOT_PATH ?><!--/home">-->
<!--                                Service-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="dropdown">-->
<!--                            <a href="--><?php //echo ROOT_PATH ?><!--/home">-->
<!--                                Service-->
<!--                            </a>-->
<!--                        </li>-->

                    </ul>

                    <ul class="nav navbar-nav col-md-4 lg-show">

                        <li style="float:right;">
                            <div class="right-header" style="margin-top:10px;">
                                <div class="search_div">
                                    <input type="text" id="search_keyword" style="border:none; float:left; text-indent: 4px; line-height:25px; height:30px;" value="<?php echo isset( $_GET['keyword'] ) ? $_GET['keyword'] : '' ?>" placeholder="Search by sku, name, manufacturer, type" />
                                    <button type="button" id="searchByKeywordBtn" style="border:none; float:left; font-size:25px; color:#FFF; background:#286090; outline:none; height:30px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

    </div>

</div>

<div class="panel-body header_panel_top_outer" style="background:#00a0e9;">

    <div class="header_top_panel">

        <div class="col-md-12">
            <div class="col-md-6" style="padding-left:4%;">
                <a href="<?php echo ROOT_PATH ?>">
                    <img src="<?php echo ROOT_PATH ?>/resources/e_store/image/logo.png" class="logo_img" />
                </a>
            </div>
            <div class="col-md-6 right-header login_text_div" style="padding-right:3%;">

                <?php
                    if( isset( $_SESSION['customer'] ) )
                    {
                        $customer = $_SESSION['customer'];
                        ?>
                            <!-- Member -->
                            <h4>
                                <span style="color:#FFF;">
                                    Welcome back!
                                    <span style="color:#edfc87;">
                                        <?php echo $customer['account'] ?>
                                    </span>
                                </span>
                                <br/>
                                <a href="<?php echo ROOT_PATH ?>/e_store/customer/dash_board" class="btn btn-sm btn-info" style="font-weight:bold;">
                                    My Dash Board&nbsp;&nbsp;<i class="fa fa-dashboard"></i>
                                </a>
                                <a href="javascript:void(0);" id="customerLogoutBtn" class="btn btn-sm btn-warning">
                                    Sign Out&nbsp;&nbsp;<i class="fa fa-sign-out"></i>
                                </a>
                            </h4>
                        <?php
                    }
                    else
                    {
                        ?>
                            <!-- Guest -->
                            <h4>
                                <span style="color:#FFF; font-weight:bold;">
                                    <span class="xs-hide">
                                        Welcome to
                                    </span>
                                    Customer
                                </span>
                                <a href="javascript:void(0);" id="customerRegisterBtn" class="btn btn-xs btn-primary" style="color:#edfc87;">
                                    <i class="fa fa-user-plus"></i> Sign Up
                                </a>
                                <span style="color:#FFF;">/</span>
                                <a href="javascript:void(0);" id="customerLoginBtn" class="btn btn-xs btn-primary" style="color:#edfc87;">
                                    <i class="fa fa-sign-in"></i> Sign In
                                </a>
                            </h4>
                            <h4>
                                <span style="color:#FFF; font-weight:bold;">
                                    <span class="xs-hide">
                                        OR
                                    </span>
                                    Wholesaler
                                </span>
                                <a href="<?php echo ROOT_PATH ?>/remarketing/register_wholesaler" target="_blank" class="btn btn-xs btn-primary" style="color:#edfc87;">
                                    <i class="fa fa-user-plus"></i> Sign Up
                                </a>
                                <span style="color:#FFF;">/</span>
                                <a href="<?php echo ROOT_PATH ?>/remarketing" target="_blank" class="btn btn-xs btn-primary" style="color:#edfc87;">
                                    <i class="fa fa-sign-in"></i> Sign In
                                </a>
                            </h4>
                        <?php
                    }
                ?>
            </div>
        </div>

        <div class="col-md-12">
<!--            <div class="col-md-6 social_media_div" style="height:70px;">-->
<!--                <a href="https://www.facebook.com/PTLComputers-174204172623976/" target="_blank" style="color:#FFF; font-size:30px; text-decoration:none;">-->
<!--                    <i class="fa fa-facebook-square"></i>-->
<!--                </a>&nbsp;-->
<!--                <a href="#" target="_blank" style="color:#FFF; font-size:30px; text-decoration:none;">-->
<!--                    <i class="fa fa-twitter-square"></i>-->
<!--                </a>&nbsp;-->
<!--                <a href="#" target="_blank" style="color:#FFF; font-size:30px; text-decoration:none;">-->
<!--                    <i class="fa fa-google-plus-square"></i>-->
<!--                </a>&nbsp;-->
<!--                <a href="#" target="_blank" style="color:#FFF; font-size:30px; text-decoration:none;">-->
<!--                    <i class="fa fa-pinterest-square"></i>-->
<!--                </a>-->
<!--            </div>-->

            <div class="col-md-6 subscriber_div" style="padding-left:4%;">
                <input type="text" id="subscribe_email" style="border:none; float:left; text-indent: 4px; line-height:25px; height:30px;" placeholder="Subscribe our newsletter" />
                <button type="button" id="subscribeBtn" style="border:none; float:left; font-size:25px; color:#FFF; background:#434343; outline:none; height:30px;">
                    <i class="fa fa-envelope"></i>
                </button>
            </div>
<!--            <div style="width;100%; float:left;">-->
<!--                <hr/>-->
<!--            </div>-->

            <div class="col-md-6 right-header wishlist_shopping_cart_div text-center" style="padding-right:3%;">


                <div class="wishlist_shopping_cart_inner_div">
                    <!-- Cart -->
                    <a href="/e_store/customer/my_cart" style="color:#FFF; text-decoration:none; float:right;" >
                        <i class="fa fa-shopping-cart" style="float:left; color:#dcf24a; font-size:32px;">&nbsp;</i>
                        <span style="float:left;">
                            <span class="wishlist_shopping_cart_inner_badge_span" id="cartTotalQtyOrderedBadge">
                                <?php echo $cartTotal ?>
                            </span>
                        </span>
                    </a>

                    <span class="xs-hide" style="float:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                    <!-- Favourite -->
                    <a href="javascript:void(0);" style="color:#FFF; text-decoration:none; float:right;" id="to_my_wish_list" >
                        <i class="fa fa-heart" style="float:left; color:#f2a7a7; font-size:32px;">&nbsp;</i>
                        <span style="float:left;">
                            <span class="wishlist_shopping_cart_inner_badge_span">
                                <?php echo $favouriteTotal ?>
                            </span>
                        </span>
                    </a>
                </div>

                <div class="right-header lg-hide">
                    <div class="search_div">
                        <input type="text" id="search_keyword" style="border:none; float:left; text-indent: 4px; line-height:25px; height:30px;" value="<?php echo isset( $_GET['keyword'] ) ? $_GET['keyword'] : '' ?>" placeholder="Search by sku, name, manufacturer, type" />
                        <button type="button" id="searchByKeywordBtn" style="border:none; float:left; font-size:25px; color:#FFF; background:#434343; outline:none; height:30px;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

<!--        <br/>-->
<!--        <div class="col-md-12">-->
<!--        </div>-->

    </div>
</div>


<hr style="margin:0;"/>
<div class="panel-body header_panel_bottom_outer" style="background:#434343; ">

    <div class="header_bottom_panel">

        <nav class="navbar navbar-default" style="margin-left: 1%;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
<!--                    <a class="navbar-brand" href="/">-->
<!--                        <i class="fa fa-home"></i>-->
<!--                    </a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">

<!--                        <li>-->
<!--                            <a href="--><?php //echo ROOT_PATH ?><!--/home">-->
<!--                                <i class="fa fa-home home_icon_i"></i>-->
<!--                            </a>-->
<!--                        </li>-->

                        <?php
                            $priceRange = '';
                            if ( isset( $_GET['price_range'] ) )
                            {
                                $priceRange .= '&price_range=' . $_GET['price_range'];
                            }
                        ?>
                        <?php foreach( $shownTypes as $shownType ) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $shownType->name ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if( count( $shownType->manufacturerObjects ) > 1 ) { ?>
                                        <li class="text-center">
                                            <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search?type=<?php echo $shownType->name . $priceRange ?>" style="font-size:14px;">ALL</a>
                                        </li>
                                    <?php } ?>
                                    <?php foreach( $shownType->manufacturerObjects as $manufacturerObject ) { ?>
                                        <?php if( count( $shownType->manufacturerObjects ) > 1 ) { ?>
                                            <li class="divider"></li>
                                        <?php } ?>
                                        <li class="text-center">
                                            <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search?type=<?php echo $shownType->name ?>&manufacturer=<?php echo $manufacturerObject->manufacturer . $priceRange ?>" style="font-size:14px;">
                                                <?php echo $manufacturerObject->manufacturer ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                Etceteras
                                <i class="fa fa-hand-o-down"></i>
                            </a>
                            <ul class="dropdown-menu">


                                <?php foreach( $etcTypes as $etcType ) { ?>
                                <li class="xerp_drop_down_li">
                                    <a href="javascript:void(0);" class="xerp_drop_down_a" data-drop-product-type="<?php echo $etcType->name ?>" style="font-size:14px;">
                                        <?php echo $etcType->name ?>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="xerp_drop_down_ul" data-drop-product-type="<?php echo $etcType->name ?>" data-is-dropped="false">
                                        <?php if( count( $etcType->manufacturerObjects ) > 1 ) { ?>
                                            <li class="divider"></li>
                                            <li class="text-center">
                                                <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search?type=<?php echo $etcType->name . $priceRange ?>" style="font-size:14px;">ALL</a>
                                            </li>
                                        <?php } ?>
                                        <?php foreach( $etcType->manufacturerObjects as $manufacturerObject ) { ?>
                                            <li class="divider"></li>
                                            <li class="text-center">
                                                <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search?type=<?php echo $etcType->name ?>&manufacturer=<?php echo $manufacturerObject->manufacturer . $priceRange ?>" style="font-size:14px;">
                                                    <?php echo $manufacturerObject->manufacturer ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <li class="divider"></li>
                                    </ul>
                                </li>
                                <?php } ?>

                            </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

    </div>

</div>

<!-- Customer Forget Password -->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgetPasswordModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="forgetPasswordModalLabel">Forget Password</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="forget_password_email" class="control-label col-md-5 text-primary">Email:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                        <i class="fa fa-envelope" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="forget_password_email" class="form-control" placeholder="* Email" style="border-color:#204d74;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="forgetPasswordBtn">Get my password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="text-success text-center">
                    Have you got your password? Don't hesitate to <a class="btn btn-xs btn-success" id="switchFromForgetPasswordToSignIn">Sign In</a>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Customer Forget Account -->
<div class="modal fade" id="forgetAccountModal" tabindex="-1" role="dialog" aria-labelledby="forgetAccountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="forgetAccountModalLabel">Forget Account</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="forget_account_email" class="control-label col-md-5 text-primary">Email:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                        <i class="fa fa-envelope" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="forget_account_email" class="form-control" placeholder="* Email" style="border-color:#204d74;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="forgetAccountBtn">Get my account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="text-success text-center">
                    Have you got your account? Don't hesitate to <a class="btn btn-xs btn-success" id="switchFromForgetAccountToSignIn">Sign In</a>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Customer Sign In -->
<div class="modal fade" id="customerLoginModal" tabindex="-1" role="dialog" aria-labelledby="customerLoginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="customerLoginModalLabel">Sign In</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <p class="col-md-5 col-md-offset-5">Forget Account? Click <a href="javascript:void(0);" id="switchFromSignInToForgetAccount">Here</a></p>
                            <label for="sign_in_email_or_account" class="control-label col-md-5 text-primary">Email / Account:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                        <i class="fa fa-user-secret" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="sign_in_email_or_account" class="form-control" placeholder="* Email or Account" style="border-color:#204d74;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sign_in_credential" class="control-label col-md-5 text-primary">Credential:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">
                                        <i class="fa fa-key" style="font-size:15px; color:#edfc87;"></i>
                                    </span>
                                    <input type="password" id="sign_in_credential" placeholder="* Login Password" class="form-control" style="border-color:#204d74;" />
                                </div>
                            </div>
                            <p class="col-md-5 col-md-offset-5">Forget Password? Click <a href="javascript:void(0);" id="switchFromSignInToForgetPassword">Here</a></p>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="signInBtn">I am back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="text-success text-center">
                    Haven't got your own account? Don't hesitate to <a class="btn btn-xs btn-success" id="switchFromSignInToSignUp">Sign Up</a>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Customer Register -->
<div class="modal fade" id="customerRegisterModal" tabindex="-1" role="dialog" aria-labelledby="customerRegisterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-success text-center" id="customerLoginModalLabel">Sign Up</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="account" class="control-label col-md-5 text-success">Account:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-user" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="sign_up_account" class="form-control" placeholder="* Account" style="border-color:#4cae4c;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-5 text-success">Email:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-envelope-square" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="sign_up_email" class="form-control" placeholder="* Email" style="border-color:#4cae4c;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-md-5 text-success">Credential:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#5cb85c; border-color:#4cae4c;">
                                        <i class="fa fa-key" style="font-size:15px; color:#edfc87;"></i>
                                    </span>
                                    <input type="password" id="sign_up_credential" placeholder="* Login Password" class="form-control" style="border-color:#4cae4c;" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" id="signUpBtn">I want to join</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <p class="text-primary text-center">
                    Got an account? Let's <a class="btn btn-xs btn-primary" id="switchFromSignUpToSignIn">Sign In</a>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Customer Sign Out -->
<div class="modal fade" id="customerLogoutModal" tabindex="-1" role="dialog" aria-labelledby="customerLogoutModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="customerLogoutModalLabel">Sign Out</h4>
            </div>
            <div class="modal-body">
                Thanks for shopping with us, hope you have a nice day~
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-default text-info" data-dismiss="modal">I will stay for awhile</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="signOutBtn">See you again</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->