
<div class="col-md-3">
    <!-- Product Module -->
    <div class="panel panel-warning xerp-row-panel-medium-medium-large">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>EStore Order</strong></h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=1" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" style="line-height: normal;"></span>
                        Pending
                        <span class="badge"><?php echo $pendingOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=2" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" style="line-height: normal;"></span>
                        Processing
                        <span class="badge"><?php echo $processingOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=3" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Wait for shipment
                        <span class="badge"><?php echo $waitingForShipmentOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=4" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Shipped
                        <span class="badge"><?php echo $shippedOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=5" class="btn btn-success btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Completed
                        <span class="badge"><?php echo $completeOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=6" class="btn btn-default btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Cancelled
                        <span class="badge"><?php echo $cancelledOrderCountEStore ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/e_store/order/view_by/pagination?order_status=7" class="btn btn-default btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Refunded
                        <span class="badge"><?php echo $refundedOrderCountEStore ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>