
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addEmailTemplateSystemAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li><a href="/manager/core/email_template_system/view" class="text-danger">Email Template ( System )</a></li>
                        <li class="active">Add Email Template ( System )</li>
                    </ol>
                </div>
                <div id="collapseAddEmailTemplateSystem" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="subject" class="control-label col-md-2">Subject</label>
                            <div class="col-md-5">
                                <input type="text" id="subject" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="purpose" class="control-label col-md-2">Purpose</label>
                            <div class="col-md-3">
                                <select class="form-control" id="purpose">
                                    <option value="100">EStore Register</option>
                                    <option value="101">EStore Forget Password</option>
                                    <option value="102">EStore Online Ordering</option>
                                    <option value="103">EStore Online Ordering With Payment</option>
                                    <option value="105">EStore Forget Account</option>
                                    <option value="200">Remarketing Register</option>
                                    <option value="201">Remarketing Forget Password</option>
                                    <option value="202">Remarketing Online Ordering</option>
                                    <option value="203">Remarketing Forget Account</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="control-label col-md-2">Body</label>
                            <div class="col-md-8">
                                <textarea id="body" class="form-control" rows="50"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_email_template_system" class="btn btn-danger btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/core/email_template_system/add_email_template_system.js"></script>
<!-- END CUSTOMIZED LIB -->
