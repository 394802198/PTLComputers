

	<!-- /END THE FEATURETTES -->
	<!-- FOOTER -->
	<footer class="panel-body"  style="background:#434343; color:#FFF;">
        <div class="footer_panel text-center">
            <ul class="col-md-4">
                <li>
                    <h3>Information</h3>
                </li>
                <li>
                    <?php if( isset( $aboutUsUrl ) ) { ?>
                        <a href="<?php echo $aboutUsUrl ?>" style="color:#edfc87;"><?php echo $aboutUsName ?></a>
                    <?php } else { ?>
                        <span style="color:#ccc;">About Us</span>
                    <?php } ?>
                </li>
                <li>
                    <?php if( isset( $whereToBuyUrl ) ) { ?>
                        <a href="<?php echo $whereToBuyUrl ?>" style="color:#edfc87;"><?php echo $whereToBuyName ?></a>
                    <?php } else { ?>
                        <span style="color:#ccc;">Where to buy</span>
                    <?php } ?>
                </li>
                <li>
                    <?php if( isset( $termsConditionsUrl ) ) { ?>
                        <a href="<?php echo $termsConditionsUrl ?>" style="color:#edfc87;"><?php echo $termsConditionsName ?></a>
                    <?php } else { ?>
                        <span style="color:#ccc;">Terms & Conditions</span>
                    <?php } ?>
                </li>
            </ul>
            <ul class="col-md-4">
                <li>
                    <h3>Customer Service</h3>
                </li>
                <li>
                    <a href="<?php ROOT_PATH ?>/e_store/contact_us/view" style="color:#edfc87;">Contact Us</a>
                </li>
                <li>
                    <?php if( isset( $returnsUrl ) ) { ?>
                        <a href="<?php echo $returnsUrl ?>" style="color:#edfc87;"><?php echo $returnsName ?></a>
                    <?php } else { ?>
                        <span style="color:#ccc;">Returns</span>
                    <?php } ?>
                </li>
                <li>
                    <?php if( isset( $servicesUrl ) ) { ?>
                        <a href="<?php echo $servicesUrl ?>" style="color:#edfc87;"><?php echo $servicesName ?></a>
                    <?php } else { ?>
                        <span style="color:#ccc;">Services</span>
                    <?php } ?>
                </li>
            </ul>
            <ul class="col-md-4">
                <li>
                    <h3>Control Panel</h3>
                </li>
                <li>
                    <a href="javascript:void(0);" data-check-customer-authentication-and-redirect data-url="<?php ROOT_PATH ?>/e_store/customer/dash_board" style="color:#edfc87;">My Account</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-check-customer-authentication-and-redirect data-url="<?php ROOT_PATH ?>/e_store/customer/my_order" style="color:#edfc87;">Order History</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-check-customer-authentication-and-redirect data-url="<?php ROOT_PATH ?>/e_store/customer/shipment_tracking" style="color:#edfc87;">Shipment Tracking</a>
                </li>
                <li>
                    <a href="javascript:void(0);" data-check-customer-authentication-and-redirect data-url="<?php ROOT_PATH ?>/e_store/customer/my_wish_list" style="color:#edfc87;">Wish List</a>
                </li>
            </ul>
        </div>
	</footer>

    <hr style="margin:0;"/>

    <div class="panel-body text-center" style="background:#00a0e9; color:#FFF; padding:10px; 0;">
        <div class="copyright_panel">
            Copyright &copy; PTL Computers Ltd 2003-2016 All rights reserved. Powered By XERP
        </div>
    </div>

    </body>

    <?php if( isset( $pageBottomAdvertisement ) && strcasecmp( $pageBottomAdvertisement->is_visible, 'Y' )==0 ) { ?>
        <div data-advertisement-div
             data-is-auto-hide-activate="<?php echo strcasecmp( $pageBottomAdvertisement->is_auto_hide_count_down_activate, 'Y' ) ? 'true' : 'false' ?>"
             data-auto-hide-count-down-seconds="<?php echo $pageBottomAdvertisement->auto_hide_count_down_seconds ?>">
            <?php if( strcasecmp( $pageBottomAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
            <a href="<?php echo $pageBottomAdvertisement->linkage ?>" target="_blank">
                <?php } ?>
                <img src="/<?php echo $pageBottomAdvertisement->img_path ?>" width="100%" />
                <?php if( strcasecmp( $pageBottomAdvertisement->is_activate_linkage, 'Y' )==0 ) { ?>
            </a>
        <?php } ?>
            <a href="javascript:void(0);" class="btn btn-xs btn-default btn-block" data-advertisement-hide data-manual-hide-count-down-seconds="<?php echo $pageBottomAdvertisement->manual_hide_count_down_seconds ?>" data-auto-hide-count-down-seconds="<?php echo $pageBottomAdvertisement->auto_hide_count_down_seconds ?>" data-is-auto-hide-activate="<?php echo strcasecmp( $pageBottomAdvertisement->is_auto_hide_count_down_activate, 'Y' )==0 ? 'true' : 'false' ?>" data-toggle="tooltip" data-placement="top" data-original-title="Temporarily hide this advertisement">
                Hide <i class="fa fa-close"></i> <span data-count-down-span></span>
            </a>
        </div>
    <?php } ?>

    <script>
        var isCustomerLoggedIn = '<?php echo isset( $_SESSION["customer"] ) ? 'YES' : 'NO' ?>';
        var ROOT_PATH = '<?php echo ROOT_PATH ?>';
    </script>
    <script src="<?php echo ROOT_PATH ?>/resources/e_store/js/header.js"></script>

</html>