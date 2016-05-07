
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editDefaultEmailServerAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li class="active">Edit Default Email Server</li>
                    </ol>
                </div>
                <div id="collapseEditDefaultEmailServer" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="host" class="control-label col-md-2">Host</label>
                            <div class="col-md-3">
                                <input type="text" id="host" value="<?php echo isset( $emailServer['host'] ) ? $emailServer['host'] : '' ?>" class="form-control"/>
                            </div>
                            <label for="host_name" class="control-label col-md-2">Host Name</label>
                            <div class="col-md-3">
                                <input type="text" id="host_name" value="<?php echo isset( $emailServer['host_name'] ) ? $emailServer['host_name'] : '' ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_ssl" class="control-label col-md-2">Is SSL</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_ssl">
                                    <option value="Y" <?php echo isset( $emailServer['is_ssl'] ) && strcasecmp( $emailServer['is_ssl'], 'Y' ) == 0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo isset( $emailServer['is_ssl'] ) && strcasecmp( $emailServer['is_ssl'], 'N' ) == 0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                            <label for="port" class="control-label col-md-2">Port</label>
                            <div class="col-md-3">
                                <input type="text" id="port" value="<?php echo isset( $emailServer['port'] ) ? $emailServer['port'] : '' ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label col-md-2">Username</label>
                            <div class="col-md-3">
                                <input type="text" id="username" value="<?php echo isset( $emailServer['username'] ) ? $emailServer['username'] : '' ?>" class="form-control"/>
                            </div>
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-3">
                                <input type="text" id="password" value="<?php echo isset( $emailServer['password'] ) ? $emailServer['password'] : '' ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply" class="control-label col-md-2">Reply</label>
                            <div class="col-md-3">
                                <input type="text" id="reply" value="<?php echo isset( $emailServer['reply'] ) ? $emailServer['reply'] : '' ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply_name" class="control-label col-md-2">Reply Name</label>
                            <div class="col-md-3">
                                <input type="text" id="reply_name" value="<?php echo isset( $emailServer['reply_name'] ) ? $emailServer['reply_name'] : '' ?>" class="form-control"/>
                            </div>
                            <label for="from_name" class="control-label col-md-2">From Name</label>
                            <div class="col-md-3">
                                <input type="text" id="from_name" value="<?php echo isset( $emailServer['from_name'] ) ? $emailServer['from_name'] : '' ?>" class="form-control"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_default" class="btn btn-danger btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/core/email_server/edit_default.js"></script>
<!-- END CUSTOMIZED LIB -->
