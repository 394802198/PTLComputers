<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-warning">Home</a></li>
                    <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                    <li><a href="/manager/e_store/customer/view" class="text-warning">View Customer</a></li>
                    <li><a href="/manager/e_store/customer/edit/id/<?php echo $customer['id'] ?>" class="text-warning">Edit Customer</a></li>
                    <li class="active">View Receiver Address</li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th></th>
                        <th>Shipping Area</th>
                        <th>Customer</th>
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
                    <?php foreach ( $customerReceiverAddresses as $customerReceiverAddress ):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/manager/e_store/customer/receiver_address/edit/id/<?php echo $customerReceiverAddress->id ?>" class="btn btn-xs btn-warning">
                                <?php echo $customerReceiverAddress->shippingArea['name'] ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->customer['first_name'].' '.$customerReceiverAddress->customer['last_name'] ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->is_default == 'Y' ? 'Yes' : 'No' ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_name ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_phone ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_email ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_country ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_province ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_city ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_address ?>
                        </td>
                        <td>
                            <?php echo $customerReceiverAddress->receiver_post ?>
                        </td>
                        <td style="text-align:center;">
                            <a href="javascript:void(0);" class="btn btn-xs btn-warning" data-name="delete_customer_receiver_address" data-customer-receiver-address-id="<?php echo $customerReceiverAddress->id ?>" data-customer-id="<?php echo $customerReceiverAddress->customer_id ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCustomerReceiverAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerReceiverAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCustomerReceiverAddressModalLabel">Delete wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to delete this customer receiver address?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteCustomerReceiverAddressConfirm">Delete</button>
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
<script src="/resources/manager/js/e_store/customer/receiver_address/view_customer_receiver_address.js"></script>
<!-- END CUSTOMIZED LIB -->
