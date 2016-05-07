
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addEmailTemplateNewsletterAccordion">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li><a href="/manager/core/email_template_newsletter/view" class="text-danger">Email Template ( Newsletter )</a></li>
                        <li class="active">Add Email Template ( Newsletter )</li>
                    </ol>
                </div>
                <div id="collapseAddEmailTemplateNewsletter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="subject" class="control-label col-md-2">Subject</label>
                            <div class="col-md-5">
                                <input type="text" id="subject" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="control-label col-md-2">Body</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control" rows="50"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="add_email_template_newsletter" class="btn btn-danger btn-lg btn-block">Save</a>
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


<script src="/resources/global/kindeditor-4.1.10/kindeditor.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/kindeditor_init.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/core/email_template_newsletter/add_email_template_newsletter.js"></script>
<!-- END CUSTOMIZED LIB -->
