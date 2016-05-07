
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCourierAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/logistic/courier/view" class="text-success">Courier</a></li>
                        <li class="active">Edit Courier</li>
                    </ol>
                </div>
                <div id="collapseAddCourier" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="hidden" id="courier_id" value="<?php echo $courier['id'] ?>" />
                                <input type="text" id="name" value="<?php echo $courier['name'] ?>" class="form-control" />
                            </div>
                            <label for="website" class="control-label col-md-2">Website</label>
                            <div class="col-md-3">
                                <input type="text" id="website" value="<?php echo $courier['website'] ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label col-md-2">Status</label>
                            <div class="col-md-3">
                                <select id="status" class="form-control">
                                   <?php $status = array(
                                       1 => 'Available',
                                       2 => 'Unavailable'
                                   ); ?>
                                   <?php foreach ($status as $key=>$val):?>
                                   <?php
                                      if( $key == $courier['status'] )
                                      {
                                           echo '<option value="'.$key.'" selected="selected">'.$val.'</option>';
                                      } else {
                                           echo '<option value="'.$key.'">'.$val.'</option>';
                                      }
                                    ?>
                                   <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipment_lookup_url" class="control-label col-md-2">Shipment Lookup Url</label>
                            <div class="col-md-8">
                                <input type="text" id="shipment_lookup_url" value="<?php echo $courier['shipment_lookup_url'] ?>" class="form-control" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_courier" class="btn btn-success btn-lg btn-block">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

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
<script src="/resources/manager/js/warehouse/logistic/courier/edit_courier.js"></script>
<!-- END CUSTOMIZED LIB -->
