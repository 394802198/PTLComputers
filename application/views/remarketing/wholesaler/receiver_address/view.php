<!-- BEGIN HEADER -->
<?php include 'includes/remarketing/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/remarketing" class="text-info">Home</a></li>
                    <li><a href="/remarketing/wholesaler/edit_my_profile" class="text-info">Edit My Profile</a></li>
                    <li class="active">View Receiver Address</li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th></th>
                        <th>Shipping Area</th>
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
                    <?php foreach ($myReceiverAddresses as $myReceiverAddress):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/remarketing/wholesaler/receiver_address/edit/id/<?php echo $myReceiverAddress->id ?>" target="_blank" class="btn btn-xs btn-info">
                                <?php echo $myReceiverAddress->shippingArea['name'] ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->is_default == 'Y' ? 'Yes' : 'No' ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_name ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_phone ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_email ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_country ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_province ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_city ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_address ?>
                        </td>
                        <td>
                            <?php echo $myReceiverAddress->receiver_post ?>
                        </td>
                        <td style="text-align:center;">
                            <a href="javascript:void(0);" class="btn btn-xs btn-info" data-name="delete_my_receiver_address" data-my-receiver-address-id="<?php echo $myReceiverAddress->id ?>" >Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteMyReceiverAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteMyReceiverAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteMyReceiverAddressModalLabel">Delete wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to delete this receiver address?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteMyReceiverAddressConfirm">Delete</button>
      </div>
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
<script src="/resources/remarketing/js/wholesaler/receiver_address/view_my_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
