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
                    <li><a href="/manager/remarketing/wholesaler/view" class="text-info">View Wholesaler</a></li>
                    <li><a href="/manager/remarketing/wholesaler/edit/id/<?php echo $wholesaler['id'] ?>" class="text-info">Edit Wholesaler</a></li>
                    <li class="active">View Receiver Address</li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th></th>
                        <th>Shipping Area</th>
                        <th>Wholesaler</th>
                        <th>Is Default</th>
                        <th>Receiver Name</th>
                        <th>Receiver Phone</th>
                        <th>Receiver Email</th>
                        <th>Receiver Country</th>
                        <th>Receiver Province</th>
                        <th>Receiver City</th>
                        <th>Receiver Address</th>
                        <th>Receiver Post</th>
                        <th style="text-align:center;">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wholesalerReceiverAddresses as $wholesalerReceiverAddress):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/manager/remarketing/wholesaler/receiver_address/edit/id/<?php echo $wholesalerReceiverAddress->id ?>" class="btn btn-xs btn-info">
                                <?php echo $wholesalerReceiverAddress->shippingArea['name'] ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->wholesaler['first_name'].' '.$wholesalerReceiverAddress->wholesaler['last_name'] ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->is_default == 'Y' ? 'Yes' : 'No' ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_name ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_phone ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_email ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_country ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_province ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_city ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_address ?>
                        </td>
                        <td>
                            <?php echo $wholesalerReceiverAddress->receiver_post ?>
                        </td>
                        <td style="text-align:center;">
                            <a href="javascript:void(0);" class="btn btn-xs btn-info" data-name="delete_wholesaler_receiver_address" data-wholesaler-receiver-address-id="<?php echo $wholesalerReceiverAddress->id ?>" data-wholesaler-id="<?php echo $wholesalerReceiverAddress->wholesaler_id ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteWholesalerReceiverAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteWholesalerReceiverAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteWholesalerReceiverAddressModalLabel">Delete wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to delete this wholesaler receiver address?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteWholesalerReceiverAddressConfirm">Delete</button>
      </div>
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

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/remarketing/wholesaler/receiver_address/view_wholesaler_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
