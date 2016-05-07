<!-- BEGIN HEADER -->
<?php include 'includes/remarketing/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php if(!empty($orders)){ ?>
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/remarketing" class="text-info">Home</a></li>
                    <li class="active">View Order</li>
                </ol>
            </div>
            <table class="table" style="font-size:12px;">
                <thead >
                    <tr>
                       <th colspan="14">
                           <h3 class="pull-right">Total Ordered: <?php echo $total_rows ?>&nbsp;&nbsp;</h3>
                       </th>
                    </tr>
                    <tr>
                        <th rowspan="2">&nbsp;</th>
                        <th rowspan="2">Order ID</th>
                        <th rowspan="2">Ordered Date</th>
                        <th colspan="2" class="text-center">Shipping</th>
                        <th rowspan="2" style="width:20%;">Purchaser Detail</th>
                        <th rowspan="2" style="width:20%;">Receiver Detail</th>
                        <th colspan="3" class="text-center">Fees</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>Method</th>
                        <th style="text-align:right">Product&GST</th>
                        <th style="text-align:right">Shipping</th>
                        <th style="text-align:right">Total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/remarketing/order/view_by/id/<?php echo $order->id ?>" class="btn btn-xs btn-info">
                            <?php echo $order->id ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $order->ordered_date ?>
                        </td>
                        <td>
                            <?php
                                switch( $order->order_status )
                                {
                                    case 'pending' : echo 'Pending'; break;
                                    case 'processing' : echo 'Processing'; break;
                                    case 'waiting_for_shipment' : echo 'Waiting For Shipment'; break;
                                    case 'shipped' : echo 'Shipped'; break;
                                    case 'completed' : echo 'Completed'; break;
                                    case 'cancelled' : echo 'Cancelled'; break;
                                    default : echo 'Unknown'; break;
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo $order->shipping_method ?>
                        </td>
                        <td>
                            <strong>Company:</strong> <br/><?php echo $order->company_name ?><br/>
                            <strong>Name:</strong> <br/><?php echo $order->first_name . ' ' . $order->last_name ?><br/>
                            <strong>Email:</strong> <br/><?php echo $order->email ?><br/>
                            <strong>Landline:</strong> <br/><?php echo $order->landline_phone ?><br/>
                            <strong>Mobile:</strong> <br/><?php echo $order->mobile_phone ?><br/>
                            <strong>Fax:</strong> <br/><?php echo $order->fax_no ?><br/>
                            <strong>Address:</strong> <br/><?php echo $order->shipping_address ?>
                        </td>
                        <td>
                            <strong>Name:</strong> <br/><?php echo $order->receiver_name ?><br/>
                            <strong>Phone:</strong> <br/><?php echo $order->receiver_phone ?><br/>
                            <strong>Email:</strong> <br/><?php echo $order->receiver_email ?><br/>
                            <strong>Address:</strong> <br/><?php echo $order->receiver_address . ', ' . $order->receiver_city . ', ' . $order->receiver_province . ', ' . $order->receiver_post . ', ' . $order->receiver_country ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$order->gst + $order->total_amount); ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$order->shipping_fee); ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$order->total_amount_gst); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php } else { ?>
                <div class="panel-heading">
                    <h4 class="panel-title" style="color:rgb(16,67,171);">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#viewCartAccordion" href="#collapseViewCart">Order List</a>
                        <span class="pull-right" style="color:#000;"></span>
                    </h4>
                </div>
                <div id="collapseViewCart" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="alert alert-warning">Order List is empty, click <a href="/remarketing/product/view_by/pagination" style="font-weight:bold;">Here</a> to make an order.</div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->
