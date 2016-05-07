<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-info">Home</a></li>
                    <li><a href="/manager#remarketing_panel" class="text-info">Remarketing</a></li>
                    <li class="active">View Cart</li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th>&nbsp;</th>
                        <th>Cart ID</th>
                        <th>Wholesaler ID</th>
                        <th>Created Date</th>
                        <th style="text-align:right">GST</th>
                        <th style="text-align:right">Total Before GST</th>
                        <th style="text-align:right">Total After GST</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carts as $cart):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/manager/remarketing/cart/edit/id/<?php echo $cart->id ?>" class="btn btn-xs btn-info">
                                <?php echo $cart->id ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $cart->wholesaler_id ?>
                        </td>
                        <td>
                            <?php echo $cart->create_date ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$cart->gst); ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$cart->total_amount); ?>
                        </td>
                        <td style="text-align:right">
                            $<?php echo sprintf("%01.2f",$cart->total_amount_gst); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->
