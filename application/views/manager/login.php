<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-danger">
            <div class="panel-heading text-center"><strong>Electronics Resource Planing</strong></div>
            <div class="panel-body">
                <form id="loginForm">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="background:#d9534f; border-color:#d43f3a;">
                                <span class="glyphicon glyphicon-user" style="font-size:18px; color:#edfc87;"></span>
                            </span>
                            <input type="text" id="login_account" class="form-control" placeholder="Login Account" style="border-color:#d43f3a;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="background:#d9534f; border-color:#d43f3a;">
                                <span class="glyphicon glyphicon-lock" style="font-size:18px; color:#edfc87;"></span>
                            </span>
                            <input type="password" id="login_password" class="form-control" placeholder="Login Password" style="border-color:#4cae4c;">
                        </div>
                    </div>
                    <a id="signin-btn" data-loading-text="loading..." class="btn btn-danger btn-lg btn-block">Login</a>
                </form>
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

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/login.js"></script>
<!-- END CUSTOMIZED LIB -->