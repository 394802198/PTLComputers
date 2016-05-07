
<?php include 'includes/remarketing/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editWholesalerAccordion">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/remarketing" class="text-info">Home</a></li>
                        <li class="active">Edit My Profile</li>
                    </ol>
                </div>
                <div id="collapseEditWholesaler" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="wholsaler_id" class="control-label col-md-2">ID</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $wholesaler['id'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_account" class="control-label col-md-2">Login Account</label>
                            <div class="col-md-3">
                                <input type="hidden" id="wholesaler_id" value="<?php echo $wholesaler['id'] ?>" class="form-control"/>
                                <input type="text" id="login_account" value="<?php echo $wholesaler['login_account'] ?>" class="form-control"/>
                            </div>
                            <label for="first_name" class="control-label col-md-2">First Name</label>
                            <div class="col-md-3">
                                <input type="text" id="first_name" value="<?php echo $wholesaler['first_name'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="control-label col-md-2">Login Password</label>
                            <div class="col-md-3">
                                <input type="text" id="login_password" value="<?php echo $wholesaler['login_password'] ?>" class="form-control"/>
                            </div>
                            <label for="last_name" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-3">
                                <input type="text" id="last_name" value="<?php echo $wholesaler['last_name'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-2">Email</label>
                            <div class="col-md-3">
                                <input type="text" id="email" value="<?php echo $wholesaler['email'] ?>" class="form-control"/>
                            </div>
                            <label for="company_name" class="control-label col-md-2">Company Name</label>
                            <div class="col-md-3">
                                <input type="text" id="company_name" value="<?php echo $wholesaler['company_name'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="landline_phone" class="control-label col-md-2">Landline Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="landline_phone" value="<?php echo $wholesaler['landline_phone'] ?>" class="form-control"/>
                            </div>
                            <label for="street" class="control-label col-md-2">Street</label>
                            <div class="col-md-3">
                                <input type="text" id="street" value="<?php echo $wholesaler['street'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone" class="control-label col-md-2">Mobile Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="mobile_phone" value="<?php echo $wholesaler['mobile_phone'] ?>" class="form-control"/>
                            </div>
                            <label for="area" class="control-label col-md-2">Area</label>
                            <div class="col-md-3">
                                <input type="text" id="area" value="<?php echo $wholesaler['area'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax_no" class="control-label col-md-2">Fax No</label>
                            <div class="col-md-3">
                                <input type="text" id="fax_no" value="<?php echo $wholesaler['fax_no'] ?>" class="form-control"/>
                            </div>
                            <label for="city" class="control-label col-md-2">City</label>
                            <div class="col-md-3">
                                <input type="text" id="city" value="<?php echo $wholesaler['city'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5"></div>
                            <label for="city" class="control-label col-md-2">Country</label>
                            <div class="col-md-3">
                                <input type="text" id="country" value="<?php echo $wholesaler['country'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="security_question" class="control-label col-md-2">Security Question</label>
                            <div class="col-md-8">
                                <input type="text" id="security_question" value="<?php echo $wholesaler['security_question'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="security_answer" class="control-label col-md-2">Security Answer</label>
                            <div class="col-md-8">
                                <input type="text" id="security_answer" value="<?php echo $wholesaler['security_answer'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label col-md-2">Receiver Information</label>
                            <div class="col-md-8">
                                <a href="/remarketing/wholesaler/receiver_address/add" target="_blank" class="btn btn-success btn-lg">Add Receiver Address</a>
                                &nbsp;
                                <a href="/remarketing/wholesaler/receiver_address/view" target="_blank" class="btn btn-success btn-lg">View Receiver Addresses</a>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_wholesaler" class="btn btn-success btn-lg btn-block">Edit</a>
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
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/remarketing/js/wholesaler/edit_wholesaler.js"></script>
<!-- END CUSTOMIZED LIB -->
