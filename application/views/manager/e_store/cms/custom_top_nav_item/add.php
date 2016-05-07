
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCustomTopNavItemAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager/e_store/cms/custom_top_nav_item/view_by/pagination" class="text-warning">Custom Top Nav Item</a></li>
                        <li class="active">Add Custom Top Nav Item</li>
                    </ol>
                </div>
                <div id="collapseAddCustomTopNavItem" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="text" id="name" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkage" class="control-label col-md-2">Linkage</label>
                            <div class="col-md-8">
                                <input type="text" id="linkage" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_activate_linkage" class="control-label col-md-2">Is Activate Linkage</label>
                            <div class="col-md-3">
                                <select id="is_activate_linkage" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_visible" class="control-label col-md-2">Is Visible</label>
                            <div class="col-md-3">
                                <select id="is_visible" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_custom_top_nav_item" class="btn btn-warning btn-lg">Add</a>
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

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/e_store/cms/custom_top_nav_item/add_custom_top_nav_item.js"></script>
<!-- END CUSTOMIZED LIB -->
