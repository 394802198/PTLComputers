
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
				    <li class="dropdown">
    			         <a class="navbar-brand" href="/manager">Home</a>
				    </li>
				</ul>

                <!-- Remarketing MODULE -->
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Remarketing <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
                            <li>
                                <a href="/manager/remarketing/order/view_by/pagination">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Order
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/remarketing/order/view_by/pagination?shipping_method=Shipping">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Shipment
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/remarketing/cart/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Cart
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/remarketing/wholesaler/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Wholesaler
                                </a>
                            </li>
						</ul>
					</li>
				</ul>
                <!-- Remarketing MODULE -->

                <!-- EStore MODULE -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            EStore <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/manager/e_store/order/view_by/pagination">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Order
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/e_store/order/view_by/pagination?delivery_method=2">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Shipment
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/e_store/customer/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Customer
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- EStore MODULE -->

                <!-- WAREHOUSE MODULE -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            WAREHOUSE <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/manager/warehouse/product/view_by/pagination">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Product
                                </a>
                            </li>
                            <li>
                                <a href="/manager/warehouse/product/batch_file/view">
                                    <span class="glyphicon glyphicon-folder-open" style="padding-right:10px;"></span>
                                    Product Batch File
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/warehouse/commodity/view_by/pagination">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Commodity
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/manager/warehouse/logistic/courier/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Courier
                                </a>
                            </li>
                            <li>
                                <a href="/manager/warehouse/logistic/courier/shipping_area/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Courier Area
                                </a>
                            </li>
                            <li>
                                <a href="/manager/warehouse/logistic/courier/pricing/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Courier Pricing
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- WAREHOUSE MODULE -->

                <!-- CORE MODULE -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            CORE <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/manager/core/manager/view">
                                    <span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
                                    Manager
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- CORE MODULE -->


<!--				<ul class="nav navbar-nav">-->
<!--					<li class="dropdown">-->
<!--						<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--							EStore <b class="caret"></b>-->
<!--						</a>-->
<!--						<ul class="dropdown-menu">-->
<!--							<li>-->
<!--								<a href="/manager/remarketing/order/view">-->
<!--									<span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>-->
<!--									View Order-->
<!--								</a>-->
<!--							</li>-->
<!--						</ul>-->
<!--					</li>-->
<!--				</ul>-->
				
				<p class="navbar-text pull-right">
					<a href="/manager/core/manager/edit_my_profile" class="navbar-link" style="margin-right:10px; text-decoration: none;" title="Edit my profile" >
                        <span class="glyphicon glyphicon-user" style="margin-right:10px;"></span>
                        <?php echo $_SESSION["manager"]["first_name"].'&nbsp;'.$_SESSION["manager"]["last_name"]; ?>
<!--						|&nbsp;&nbsp;My ID: --><?php //echo $_SESSION["manager"]["manager_id"]; ?>
					</a>
					<a href="/manager/core/manager/action/logout" data-toggle="tooltip" data-placement="bottom" data-original-title="Sign out" title="Log out" >
						<span class="glyphicon glyphicon-log-out" style="margin-right:10px;"></span>
					</a>
				</p>
			</div>