<!-- BEGIN HEADER -->
<?php include 'includes/remarketing/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading text-center"><strong>Remarketing Resource Planning</strong></div>
            <div class="panel-body">
                <form id="loginForm">
                    <div class="form-group">
                        Forget account? Click <a href="javascript:void(0);" id="forget_account_btn">Here</a>
                        <div class="input-group">
                            <span class="input-group-addon" style="background:#5bc0de; border-color:#46b8da;">
                                <span class="glyphicon glyphicon-user" style="font-size:18px; color:#edfc87;"></span>
                            </span>
                            <input type="text" id="login_account" class="form-control" placeholder="Login Account" style="border-color:#46b8da;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" style="background:#5bc0de; border-color:#46b8da;">
                                <span class="glyphicon glyphicon-lock" style="font-size:18px; color:#edfc87;"></span>
                            </span>
                            <input type="password" id="login_password" class="form-control" placeholder="Login Password" style="border-color:#46b8da;">
                        </div>
                        Forget password? Click <a href="javascript:void(0);" id="forget_password_btn">Here</a>
                    </div>
                    <a id="signin-btn" data-loading-text="loading..." class="btn btn-info btn-lg btn-block">Sign In</a><br/>
                    Don't have an account? Don't hesitate to <a href="/remarketing/register_wholesaler"><strong>Sign Up</strong></a>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Customer Forget Password -->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgetPasswordModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="forgetPasswordModalLabel">Forget Password</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="forget_password_email" class="control-label col-md-5 text-primary">Email:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#5bc0de; border-color:#46b8da;">
                                        <i class="glyphicon glyphicon-envelope" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="forget_password_email" class="form-control" placeholder="* Email" style="border-color:#46b8da;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-info" id="forgetPasswordBtn">Get my password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Customer Forget Account -->
<div class="modal fade" id="forgetAccountModal" tabindex="-1" role="dialog" aria-labelledby="forgetAccountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-info text-center" id="forgetAccountModalLabel">Forget Account</h4>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="forget_account_email" class="control-label col-md-5 text-primary">Email:</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background:#5bc0de; border-color:#46b8da;">
                                        <i class="glyphicon glyphicon-envelope" style="font-size:18px; color:#edfc87;"></i>
                                    </span>
                                    <input type="text" id="forget_account_email" class="form-control" placeholder="* Email" style="border-color:#46b8da;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 text-right">
                                <button type="button" class="btn btn-default text-info" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-info" id="forgetAccountBtn">Get my account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- BEGIN FOOTER -->
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/remarketing/js/login.js"></script>
<!-- END CUSTOMIZED LIB -->