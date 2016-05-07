
<div class="col-md-3">
    <!-- Product Module -->
    <div class="panel panel-info xerp-row-panel-medium-large">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Remarketing Order</strong></h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=pending" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" style="line-height: normal;"></span>
                        Pending
                        <span class="badge"><?php echo $pendingOrderCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=processing" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" style="line-height: normal;"></span>
                        Processing
                        <span class="badge"><?php echo $processingOrderCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=waiting_for_shipment" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Wait for shipment
                        <span class="badge"><?php echo $waitingForShipmentOrderCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=shipped" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Shipped
                        <span class="badge"><?php echo $shippedOrderCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=completed" class="btn btn-success btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Completed
                        <span class="badge"><?php echo $completeOrderCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/remarketing/order/view_by/pagination?order_status=cancelled" class="btn btn-default btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Cancelled
                        <span class="badge"><?php echo $cancelledOrderCount ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>