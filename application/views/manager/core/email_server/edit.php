
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editEmailServerAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li><a href="/manager/core/email_server/view" class="text-danger">Email Server</a></li>
                        <li class="active">Edit Email Server</li>
                    </ol>
                </div>
                <div id="collapseEditEmailServer" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="host" class="control-label col-md-2">Host</label>
                            <div class="col-md-3">
                                <input type="hidden" id="email_server_id" value="<?php echo $emailServer['id'] ?>" class="form-control"/>
                                <input type="text" id="host" value="<?php echo $emailServer['host'] ?>" class="form-control"/>
                            </div>
                            <label for="host_name" class="control-label col-md-2">Host Name</label>
                            <div class="col-md-3">
                                <input type="text" id="host_name" value="<?php echo $emailServer['host_name'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_ssl" class="control-label col-md-2">SSL</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_ssl">
                                    <option value="Y" <?php echo strcasecmp( $emailServer['is_ssl'], 'Y' ) == 0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $emailServer['is_ssl'], 'N' ) == 0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                            <label for="port" class="control-label col-md-2">Port</label>
                            <div class="col-md-3">
                                <input type="text" id="port" value="<?php echo $emailServer['port'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label col-md-2">Username</label>
                            <div class="col-md-3">
                                <input type="text" id="username" value="<?php echo $emailServer['username'] ?>" class="form-control"/>
                            </div>
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-3">
                                <input type="text" id="password" value="<?php echo $emailServer['password'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply" class="control-label col-md-2">Reply</label>
                            <div class="col-md-3">
                                <input type="text" id="reply" value="<?php echo $emailServer['reply'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reply_name" class="control-label col-md-2">Reply Name</label>
                            <div class="col-md-3">
                                <input type="text" id="reply_name" value="<?php echo $emailServer['reply_name'] ?>" class="form-control"/>
                            </div>
                            <label for="from_name" class="control-label col-md-2">From Name</label>
                            <div class="col-md-3">
                                <input type="text" id="from_name" value="<?php echo $emailServer['from_name'] ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_use_default" class="control-label col-md-2">Use Default</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_use_default">
                                    <option value="N" <?php echo strcasecmp( $emailServer['is_use_default'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                    <option value="Y" <?php echo strcasecmp( $emailServer['is_use_default'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                </select>
                            </div>
                            <label for="purpose" class="control-label col-md-2">Purpose</label>
                            <div class="col-md-3">
                                <?php
                                        $purposes = array(
                                            /** EStore
                                             */
                                            100     =>  'EStore Register',
                                            101     =>  'EStore Forget Password',
                                            102     =>  'EStore Online Ordering',
                                            103     =>  'EStore Online Ordering With Payment',
                                            104     =>  'EStore Newsletter',
                                            105     =>  'EStore Forget Account',
                                            106     =>  'EStore Contact Us',
                                            /** Remarketing
                                             */
                                            200     =>  'Remarketing Register',
                                            201     =>  'Remarketing Forget Password',
                                            202     =>  'Remarketing Online Ordering',
                                            203     =>  'Remarketing Forget Login Account'
                                        );
                                ?>
                                <select class="form-control" id="purpose">
                                    <?php foreach( $purposes as $key => $purpose ) { ?>
                                        <?php if( $emailServer['purpose'] == $key ) { ?>
                                            <option value="<?php echo $key ?>" selected ><?php echo $purpose ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $purpose ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_email_server" class="btn btn-danger btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/core/email_server/edit_email_server.js"></script>
<!-- END CUSTOMIZED LIB -->
