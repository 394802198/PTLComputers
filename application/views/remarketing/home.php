<!-- BEGIN HEADER -->
<?php include 'includes/remarketing/header.php'; ?>
<link rel="stylesheet" href="/resources/remarketing/css/home.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->
<style>
.panel-success {
	min-height: 240px;
}
.first-row-panel-success {
	min-height: 300px;
}
.third-row-panel-success {
	min-height: 400px;
}
hr {
	margin:0 0 5px 0;
}
</style>

<div class="container">
	<!-- BEGIN LEFT COLUMN -->
	<!-- BEGIN LEFT FIRST COLUMN -->
    <div class="col-md-12">
        <div class="col-md-3">
            <!-- Product Module -->
            <div class="panel panel-info first-row-panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Product</strong></h3>
                </div>
                <div class="panel-body">
                    <p>Search purchasable products</p>
                    <ul class="list-unstyled">
                        <li>
                            <span class="glyphicon glyphicon-list" ></span>
                            <a href="/remarketing/product/view_by/pagination">View Product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // Product Module -->
        </div>
        <div class="col-md-3">
            <!-- Order Module -->
            <div class="panel panel-info first-row-panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order</strong></h3>
                </div>
                <div class="panel-body">
                    <p>Managing online orders</p>
                    <ul class="list-unstyled">
                        <li>
                            <span class="glyphicon glyphicon-list" ></span>
                            <a href="/remarketing/order/view">View My Order</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // Order Module -->
        </div>
        <div class="col-md-3">
            <!-- Cart Module -->
            <div class="panel panel-info first-row-panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Cart</strong></h3>
                </div>
                <div class="panel-body">
                    <p>Managing cart details.</p>
                    <ul class="list-unstyled">
                        <li>
                            <span class="glyphicon glyphicon-list" ></span>
                            <a href="/remarketing/cart/view">View My Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // Cart Module -->
        </div>
        <div class="col-md-3">
            <!-- Manager Module -->
            <div class="panel panel-info first-row-panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Wholesaler</strong></h3>
                </div>
                <div class="panel-body">
                    <p>Managing account details</p>
                    <ul class="list-unstyled">
                        <li>
                            <span class="glyphicon glyphicon-list" ></span>
                            <a href="/remarketing/wholesaler/edit_my_profile">Edit My Account Details</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // Manager Module -->
        </div>
    </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/remarketing/js/home.js"></script>
<!-- END CUSTOMIZED LIB -->