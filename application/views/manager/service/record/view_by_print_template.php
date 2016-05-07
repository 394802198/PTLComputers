
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
    <div class="container">
        <div class="col-md-12">
            <div class="panel-group" id="recordPrintTemplateAccordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-primary">Home</a></li>
                            <li><a href="/manager#service_panel" class="text-primary">Service</a></li>
                            <li class="active">Record Print Template</li>
                        </ol>
                    </div>
                    <div id="collapseRecordPrintTemplate" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="picture" class="control-label col-md-2">Logo</label>
                                <div class="col-md-10">
                                    <img data-name="picture" class="img-thumbnail" src="<?php echo isset( $recordTemplate['logo_img'] ) ? '/' . $recordTemplate['logo_img'] : '/resources/global/image/default_img.svg' ?>" style="width:350px; height:70px;">
                                    <br/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="picture" class="control-label col-md-2"></label>
                                <div class="col-md-2">
                                    <input type="file" id="picture" name="picture" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company_name" class="control-label col-md-2">Company Name</label>
                                <div class="col-md-2">
                                    <input type="text" id="company_name" value="<?php echo $recordTemplate['company_name'] ?>" class="form-control" placeholder="*" />
                                </div>
                                <label for="company_street" class="control-label col-md-2">Company Street</label>
                                <div class="col-md-2">
                                    <input type="text" id="company_street" value="<?php echo $recordTemplate['company_street'] ?>" class="form-control" placeholder="*" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company_city" class="control-label col-md-2">Company City</label>
                                <div class="col-md-2">
                                    <input type="text" id="company_city" value="<?php echo $recordTemplate['company_city'] ?>" class="form-control" placeholder="*" />
                                </div>
                                <label for="phone" class="control-label col-md-2">Phone</label>
                                <div class="col-md-3">
                                    <input type="text" id="phone" value="<?php echo $recordTemplate['phone'] ?>" class="form-control" placeholder="*" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="control-label col-md-2">Title</label>
                                <div class="col-md-8">
                                    <input type="text" id="title" value="<?php echo $recordTemplate['title'] ?>" class="form-control" placeholder="*" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label col-md-2">Term Condition</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="description" rows="5" style="resize:none;" placeholder="*"><?php echo urldecode($recordTemplate['term_condition']) ?></textarea>
                                </div>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <a id="edit_record_template" class="btn btn-primary btn-lg">Edit</a>
                                    <a class="btn btn-default btn-lg" href="javascript:history.go( -1 );">Return</a>
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

<script src="/resources/global/js/ajaxfileupload.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/service/record/print_template.js"></script>
<!-- END CUSTOMIZED LIB -->
