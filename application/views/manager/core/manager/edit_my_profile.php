
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editMyProfileAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager" class="text-danger">Core</a></li>
                        <li class="active">Edit My Profile</li>
                    </ol>
                </div>
                <div id="collapseEditMyProfile" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="login_account" class="control-label col-md-2">ID</label>
                            <div class="col-md-3">
                                <input type="hidden" id="manager_id" value="<?php echo $manager['id'] ?>" />
                                <p class="form-control-static"><?php echo $manager['id'] ?></p>
                            </div>
                            <label for="role" class="control-label col-md-2">Role</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $manager['role'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_account" class="control-label col-md-2">Login Account</label>
                            <div class="col-md-3">
                                <input type="text" id="login_account" value="<?php echo $manager['login_account'] ?>" class="form-control" data-error-field/>
                            </div>
                            <label for="login_password" class="control-label col-md-2">Login Password</label>
                            <div class="col-md-3">
                                <input type="text" id="login_password" value="<?php echo $manager['login_password'] ?>" class="form-control" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="control-label col-md-2">First Name</label>
                            <div class="col-md-3">
                                <input type="text" id="first_name" value="<?php echo $manager['first_name'] ?>" class="form-control" data-error-field/>
                            </div>
                            <label for="last_name" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-3">
                                <input type="text" id="last_name" value="<?php echo $manager['last_name'] ?>" class="form-control" data-error-field/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_manager" class="btn btn-danger btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/core/manager/edit_manager.js"></script>
<!-- END CUSTOMIZED LIB -->
