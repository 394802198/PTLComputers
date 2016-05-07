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
                    <li class="active">Wholesaler</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/remarketing/wholesaler/add" class="btn btn-xs btn-info">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Wholesaler
                        </a>
                    </li>
                </ol>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Landline</th>
                        <th>Mobile</th>
                        <th style="text-align:center;">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wholesalers as $wholesaler):?>
                    <tr class="">
                        <td>&nbsp;</td>
                        <td>
                            <a href="/manager/remarketing/wholesaler/edit/id/<?php echo $wholesaler->id ?>" class="btn btn-xs btn-info">
                                <?php echo $wholesaler->id ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $wholesaler->first_name ?>
                        </td>
                        <td>
                            <?php echo $wholesaler->last_name ?>
                        </td>
                        <td>
                            <?php echo $wholesaler->company_name ?>
                        </td>
                        <td>
                            <?php echo $wholesaler->landline_phone ?>
                        </td>
                        <td>
                            <?php echo $wholesaler->mobile_phone ?>
                        </td>
                        <td style="text-align:center;">
                         <a href="javascript:void(0);" class="btn btn-xs btn-info" data-name="delete_wholesaler" data-wholesaler-id="<?php echo $wholesaler->id ?>">Delete</a>&nbsp;
                         <?php if(!$wholesaler->is_activated){ ?>
                             <a href="javascript:void(0);" class="btn btn-xs btn-info" data-name="activate_wholesaler" data-wholesaler-id="<?php echo $wholesaler->id ?>" data-toggle="tooltip" data-placement="right" data-original-title="Click to activate. Able to login">Activate</a>
                         <?php } else { ?>
                             <a href="javascript:void(0);" class="btn btn-xs btn-info" data-name="inactivate_wholesaler" data-wholesaler-id="<?php echo $wholesaler->id ?>" data-toggle="tooltip" data-placement="right" data-original-title="Click to inactivate. Unable to login">Inactivate</a>
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
<div class="modal fade" id="deleteWholesalerModal" tabindex="-1" role="dialog" aria-labelledby="deleteWholesalerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteWholesalerModalLabel">Delete wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to delete this wholesaler?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteWholesalerConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="activateWholesalerModal" tabindex="-1" role="dialog" aria-labelledby="activateWholesalerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="activateWholesalerModalLabel">Activate wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to activate this wholesaler?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-info" data-dismiss="modal" id="activateWholesalerConfirm">Activate</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inactivateWholesalerModal" tabindex="-1" role="dialog" aria-labelledby="inactivateWholesalerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="inactivateWholesalerModalLabel">Inactivate wholesaler</h4>
      </div>
      <div class="modal-body">
        Sure to inactivate this wholesaler?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="inactivateWholesalerConfirm">Inactivate</button>
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
<script src="/resources/manager/js/remarketing/wholesaler/view_wholesaler.js"></script>
<!-- END CUSTOMIZED LIB -->
