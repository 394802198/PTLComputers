
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addEmailServerAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li><a href="/manager/core/email_server/view" class="text-danger">Email Server</a></li>
                        <li class="active">Add Email Server</li>
                    </ol>
                </div>
                <div id="collapseAddEmailServer" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="host" class="control-label col-md-2">Host</label>
                            <div class="col-md-3">
                                <input type="text" id="host" class="form-control" placeholder="*"/>
                            </div>
                            <label for="host_name" class="control-label col-md-2">Host Name</label>
                            <div class="col-md-3">
                                <input type="text" id="host_name" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_ssl" class="control-label col-md-2">SSL</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_ssl">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                            <label for="port" class="control-label col-md-2">Port</label>
                            <div class="col-md-3">
                                <input type="text" id="port" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label col-md-2">Username</label>
                            <div class="col-md-3">
                                <input type="text" id="username" class="form-control" placeholder="*"/>
                            </div>
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-3">
                                <input type="text" id="password" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply" class="control-label col-md-2">Reply</label>
                            <div class="col-md-3">
                                <input type="text" id="reply" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply_name" class="control-label col-md-2">Reply Name</label>
                            <div class="col-md-3">
                                <input type="text" id="reply_name" class="form-control" placeholder="*"/>
                            </div>
                            <label for="from_name" class="control-label col-md-2">From Name</label>
                            <div class="col-md-3">
                                <input type="text" id="from_name" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_use_default" class="control-label col-md-2">Use Default</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_use_default">
                                    <option value="N">NO</option>
                                    <option value="Y">YES</option>
                                </select>
                            </div>
                            <label for="purpose" class="control-label col-md-2">Purpose</label>
                            <div class="col-md-3">
                                <select class="form-control" id="purpose">
                                    <option value="100">EStore Register</option>
                                    <option value="101">EStore Forget Password</option>
                                    <option value="102">EStore Online Ordering</option>
                                    <option value="103">EStore Online Ordering With Payment</option>
                                    <option value="104">EStore Newsletter</option>
                                    <option value="105">EStore Forget Account</option>
                                    <option value="106">EStore Contact Us</option>
                                    <option value="200">Remarketing Register</option>
                                    <option value="201">Remarketing Forget Password</option>
                                    <option value="202">Remarketing Online Ordering</option>
                                    <option value="203">Remarketing Forget Login Account</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_email_server" class="btn btn-danger btn-lg btn-block">Save</a>
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
<script src="/resources/manager/js/core/email_server/add_email_server.js"></script>
<!-- END CUSTOMIZED LIB -->
