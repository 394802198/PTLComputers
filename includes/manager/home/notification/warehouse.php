
<div class="col-md-6">
    <!-- Product Module -->
    <div class="panel panel-success xerp-row-panel-medium">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Warehouse</strong></h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled col-md-6">
                <li>
                    <p>Remarketing Shipment</p>
                </li>
                <li>
                    <a href="/manager/warehouse/shipment/remarketing/view_by/pagination?ship_status=1" class="btn btn-warning btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        <strong>Wait to ship</strong>
                        <span class="badge pull-right"><?php echo $pendingShipmentCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/warehouse/shipment/remarketing/view_by/pagination?ship_status=2" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        <strong>Wait for signed</strong>
                        <span class="badge pull-right"><?php echo $dispatchedShipmentCount ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/warehouse/shipment/remarketing/view_by/pagination?ship_status=4" class="btn btn-danger btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        <strong>Wait for handle</strong>
                        <span class="badge pull-right"><?php echo $exceptionShipmentCount ?></span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled col-md-6">
                <li>
                    <p>EStore Shipment</p>
                </li>
<!--                <li>-->
<!--                    <a href="/manager/warehouse/shipment/remarketing/add_by/pagination" class="btn btn-success btn-sm btn-block">-->
<!--                        <span class="glyphicon glyphicon-bell pull-left" ></span>-->
<!--                        Waiting To Ship-->
<!--                        <span class="badge pull-right">--><?php //echo $waitingForShipmentOrderCount ?><!--</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <hr/>-->
<!--                <li>-->
<!--                    <a href="/manager/warehouse/shipment/remarketing/add_by/pagination" class="btn btn-success btn-sm btn-block">-->
<!--                        <span class="glyphicon glyphicon-bell pull-left" ></span>-->
<!--                        Waiting To Ship-->
<!--                        <span class="badge pull-right">--><?php //echo $waitingForShipmentOrderCount ?><!--</span>-->
<!--                    </a>-->
<!--                </li>-->
            </ul>
        </div>
    </div>
</div>