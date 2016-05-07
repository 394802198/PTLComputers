
<div class="col-md-3">
    <!-- Product Module -->
    <div class="panel panel-primary xerp-row-panel-medium-large">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Service Record</strong></h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled col-md-12">
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=100" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        New
                        <span class="badge"><?php echo $newRecordCountService ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=101" class="btn btn-info btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Processing
                        <span class="badge"><?php echo $processingRecordCountService ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=102" class="btn btn-success btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Success
                        <span class="badge"><?php echo $successRecordCountService ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=103" class="btn btn-success btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Shipped
                        <span class="badge"><?php echo $shippedRecordCountService ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=104" class="btn btn-danger btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Failed
                        <span class="badge"><?php echo $failedRecordCountService ?></span>
                    </a>
                </li>
                <hr/>
                <li>
                    <a href="/manager/service/record/view_by/pagination?status=105" class="btn btn-default btn-sm btn-block">
                        <span class="glyphicon glyphicon-bell pull-left" ></span>
                        Cancelled
                        <span class="badge"><?php echo $cancelledRecordCountService ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>