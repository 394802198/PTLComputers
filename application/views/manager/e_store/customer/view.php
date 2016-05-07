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
                    <li class="active">Customer</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/e_store/customer/add" class="btn btn-xs btn-warning">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Customer
                        </a>
                    </li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th></th>
                        <th>Account</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Fixed</th>
                        <th>Mobile</th>
                        <th>Company</th>
                        <th style="text-align:center;">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $customers as $customer ):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/manager/e_store/customer/edit/id/<?php echo $customer->id ?>" class="btn btn-xs btn-warning">
                                <?php echo $customer->account ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $customer->first_name . ' ' . $customer->last_name ?>
                        </td>
                        <td>
                            <?php echo $customer->email ?>
                        </td>
                        <td>
                            <?php echo $customer->fixed_phone ?>
                        </td>
                        <td>
                            <?php echo $customer->mobile_phone ?>
                        </td>
                        <td>
                            <?php echo $customer->company_name ?>
                        </td>
                        <td style="text-align:center;">
                         <a href="javascript:void(0);" class="btn btn-xs btn-warning" data-name="delete_customer" data-customer-id="<?php echo $customer->id ?>">Delete</a>&nbsp;
                         <?php if( strcasecmp( $customer->is_activated, 'N' )==0 ) { ?>
                             <a href="javascript:void(0);" class="btn btn-xs btn-warning" data-name="activate_customer" data-customer-id="<?php echo $customer->id ?>" data-toggle="tooltip" data-placement="right" data-original-title="Click to activate. Able to login">Activate</a>
                         <?php } else { ?>
                             <a href="javascript:void(0);" class="btn btn-xs btn-warning" data-name="inactivate_customer" data-customer-id="<?php echo $customer->id ?>" data-toggle="tooltip" data-placement="right" data-original-title="Click to inactivate. Unable to login">Inactivate</a>
                         <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCustomerModalLabel">Delete Customer</h4>
      </div>
      <div class="modal-body">
        Sure to delete this customer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteCustomerConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="activateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="activateCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="activateCustomerModalLabel">Activate customer</h4>
      </div>
      <div class="modal-body">
        Sure to activate this customer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="activateCustomerConfirm">Activate</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inactivateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="inactivateCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="inactivateCustomerModalLabel">Inactivate customer</h4>
      </div>
      <div class="modal-body">
        Sure to inactivate this customer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="inactivateCustomerConfirm">Inactivate</button>
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
<script src="/resources/manager/js/e_store/customer/view_customer.js"></script>
<!-- END CUSTOMIZED LIB -->
