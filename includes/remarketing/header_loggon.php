
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
				    <li class="dropdown">
    			         <a class="navbar-brand" href="/remarketing">Home</a>
				    </li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Product <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/remarketing/product/view_by/pagination">
									<span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
									View Product
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Order <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/remarketing/order/view">
									<span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
									View My Order
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Cart <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/remarketing/cart/view">
									<span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
									View My Cart
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Wholesaler <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/remarketing/wholesaler/edit_my_profile">
									<span class="glyphicon glyphicon-list" style="padding-right:10px;"></span>
									Edit My Account Details
								</a>
							</li>
						</ul>
					</li>
				</ul>
				
				<p class="navbar-text pull-right">
					<a href="/remarketing/wholesaler/edit_my_profile" class="navbar-link" style="margin-right:10px; text-decoration:none;">
                        <span class="glyphicon glyphicon-user" style="margin-right:10px;"></span>
                        <?php echo $_SESSION["wholesaler"]["first_name"].'&nbsp;'.$_SESSION["wholesaler"]["last_name"]; ?>
<!--						|&nbsp;&nbsp;My ID: --><?php //echo $_SESSION["wholesaler"]["id"]; ?>
					</a>
					<a href="/remarketing/wholesaler/action/logout" data-toggle="tooltip" data-placement="bottom" data-original-title="Sign out">
						<span class="glyphicon glyphicon-log-out" style="margin-right:10px;"></span>
					</a>
				</p>
			</div>