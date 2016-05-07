
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editCustomPageAccordion">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-primary">Home</a></li>
                        <li><a href="/manager#service_panel" class="text-primary">Service</a></li>
                        <li><a href="/manager/service/external_service_provider/view_by/pagination" class="text-primary">External Service provider</a></li>
                        <li class="active">Edit External Service Provider</li>
                    </ol>
                </div>
                <div id="collapseEditExternalServiceProvider" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="hidden" id="external_service_provider_id" value="<?php echo $externalServiceProvider['id'] ?>" />
                                <input type="text" id="name" value="<?php echo $externalServiceProvider['name'] ?>" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="control-label col-md-2">Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="phone" value="<?php echo $externalServiceProvider['phone'] ?>" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label col-md-2">Email</label>
                            <div class="col-md-3">
                                <input type="text" id="email" value="<?php echo $externalServiceProvider['email'] ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="control-label col-md-2">Address</label>
                            <div class="col-md-3">
                                <input type="text" id="address" value="<?php echo $externalServiceProvider['address'] ?>" class="form-control" />
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_external_service_provider" class="btn btn-primary btn-lg">Edit</a>
                                <a class="btn btn-default btn-lg" href="javascript:history.go( -1 );">Return</a>
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
<script src="/resources/manager/js/service/external_service_provider/edit.js"></script>
<!-- END CUSTOMIZED LIB -->
