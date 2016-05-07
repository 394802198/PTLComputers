
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addWholesalerAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-info">Home</a></li>
                        <li><a href="/manager#remarketing_panel" class="text-info">Remarketing</a></li>
                        <li><a href="/manager/remarketing/wholesaler/view" class="text-info">Wholesaler</a></li>
                        <li class="active">Add Wholesaler</li>
                    </ol>
                </div>
                <div id="collapseAddWholesaler" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="login_account" class="control-label col-md-2">Login Account</label>
                            <div class="col-md-3">
                                <input type="text" id="login_account" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="first_name" class="control-label col-md-2">First Name</label>
                            <div class="col-md-3">
                                <input type="text" id="first_name" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control-label col-md-2">Login Password</label>
                            <div class="col-md-3">
                                <input type="text" id="login_password" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="last_name" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-3">
                                <input type="text" id="last_name" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-2">Email</label>
                            <div class="col-md-3">
                                <input type="text" id="email" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="company_name" class="control-label col-md-2">Company Name</label>
                            <div class="col-md-3">
                                <input type="text" id="company_name" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="landline_phone" class="control-label col-md-2">Landline Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="landline_phone" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="street" class="control-label col-md-2">Street</label>
                            <div class="col-md-3">
                                <input type="text" id="street" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone" class="control-label col-md-2">Mobile Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="mobile_phone" class="form-control" placeholder="*" data-error-field/>
                            </div>
                            <label for="area" class="control-label col-md-2">Area</label>
                            <div class="col-md-3">
                                <input type="text" id="area" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax_no" class="control-label col-md-2">Fax No</label>
                            <div class="col-md-3">
                                <input type="text" id="fax_no" class="form-control" data-error-field/>
                            </div>
                            <label for="city" class="control-label col-md-2">City</label>
                            <div class="col-md-3">
                                <input type="text" id="city" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5"></div>
                            <label for="country" class="control-label col-md-2">Country</label>
                            <div class="col-md-3">
                                <input type="text" id="country" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="security_question" class="control-label col-md-2">Security Question</label>
                            <div class="col-md-8">
                                <input type="text" id="security_question" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="security_answer" class="control-label col-md-2">Security Answer</label>
                            <div class="col-md-8">
                                <input type="text" id="security_answer" class="form-control" placeholder="*" data-error-field/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_wholesaler" class="btn btn-info btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/remarketing/wholesaler/add_wholesaler.js"></script>
<!-- END CUSTOMIZED LIB -->
