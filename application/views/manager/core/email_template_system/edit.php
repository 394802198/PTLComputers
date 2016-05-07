
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
    <div class="container">
        <div class="col-md-12">
            <div class="panel-group" id="editEmailTemplateSystemAccordion">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-danger">Home</a></li>
                            <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                            <li><a href="/manager/core/email_template_system/view" class="text-danger">Email Template ( System )</a></li>
                            <li class="active">Edit Email Template ( System )</li>
                        </ol>
                    </div>
                    <div id="collapseEditEmailTemplateSystem" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="subject" class="control-label col-md-2">Subject</label>
                                <div class="col-md-5">
                                    <input type="hidden" id="email_template_system_id" value="<?php echo $emailTemplate['id'] ?>" class="form-control" placeholder="*"/>
                                    <input type="text" id="subject" value="<?php echo $emailTemplate['subject'] ?>" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                            <div class="form-group">
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
                                                105     =>  'EStore Forget Account',
                                                /** Remarketing
                                                 */
                                                200     =>  'Remarketing Register',
                                                201     =>  'Remarketing Forget Password',
                                                202     =>  'Remarketing Online Ordering',
                                                203     =>  'Remarketing Forget Account'
                                            );
                                    ?>
                                    <select class="form-control" id="purpose">
                                        <?php foreach( $purposes as $key => $purpose ) { ?>
                                            <?php if( $key == $emailTemplate['purpose'] ) { ?>
                                                <option value="<?php echo $key ?>" selected><?php echo $purpose ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $key ?>"><?php echo $purpose ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="control-label col-md-2">Body</label>
                                <div class="col-md-8">
                                    <textarea id="body" class="form-control" rows="50"><?php echo $emailTemplate['body'] ?></textarea>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-2">
                                    <a id="edit_email_template_system" class="btn btn-danger btn-lg btn-block">Edit</a>
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
<script src="/resources/manager/js/core/email_template_system/edit_email_template_system.js"></script>
<!-- END CUSTOMIZED LIB -->
