
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCustomerAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                        <li><a href="/manager/e_store/customer/view" class="text-warning">Customer</a></li>
                        <li class="active">Add Customer</li>
                    </ol>
                </div>
                <div id="collapseAddCustomer" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="account" class="control-label col-md-2">Account</label>
                            <div class="col-md-3">
                                <input type="text" id="account" class="form-control" placeholder="*"/>
                            </div>
                            <label for="first_name" class="control-label col-md-2">First Name</label>
                            <div class="col-md-3">
                                <input type="text" id="first_name" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-3">
                                <input type="password" id="password" class="form-control" placeholder="*"/>
                            </div>
                            <label for="last_name" class="control-label col-md-2">Last Name</label>
                            <div class="col-md-3">
                                <input type="text" id="last_name" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone" class="control-label col-md-2">Mobile Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="mobile_phone" class="form-control" placeholder="*"/>
                            </div>
                            <label for="email" class="control-label col-md-2">Email</label>
                            <div class="col-md-3">
                                <input type="text" id="email" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fixed_phone" class="control-label col-md-2">Fixed Phone</label>
                            <div class="col-md-3">
                                <input type="text" id="fixed_phone" class="form-control"/>
                            </div>
                            <label for="country" class="control-label col-md-2">Country</label>
                            <div class="col-md-3">
                                <input type="text" id="country" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax_no" class="control-label col-md-2">Fax No</label>
                            <div class="col-md-3">
                                <input type="text" id="fax_no" class="form-control"/>
                            </div>
                            <label for="province" class="control-label col-md-2">Province</label>
                            <div class="col-md-3">
                                <input type="text" id="province" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="control-label col-md-2">Company Name</label>
                            <div class="col-md-3">
                                <input type="text" id="company_name" class="form-control"/>
                            </div>
                            <label for="city" class="control-label col-md-2">City</label>
                            <div class="col-md-3">
                                <input type="text" id="city" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post" class="control-label col-md-2">Post/ZipCode</label>
                            <div class="col-md-3">
                                <input type="text" id="post" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-md-2">Address</label>
                            <div class="col-md-8">
                                <input type="text" id="address" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_customer" class="btn btn-warning btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/e_store/customer/add_customer.js"></script>
<!-- END CUSTOMIZED LIB -->
