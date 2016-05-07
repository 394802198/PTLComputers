
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editCustomTopNavItemAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager/e_store/cms/custom_top_nav_item/view_by/pagination" class="text-warning">Custom Top Nav Item</a></li>
                        <li class="active">Edit Custom Top Nav Item</li>
                    </ol>
                </div>
                <div id="collapseEditCustomTopNavItem" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="hidden" id="custom_top_nav_item_id" value="<?php echo $customTopNavItem['id'] ?>" />
                                <input type="text" id="name" value="<?php echo $customTopNavItem['name'] ?>" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkage" class="control-label col-md-2">Linkage</label>
                            <div class="col-md-8">
                                <input type="text" id="linkage" value="<?php echo $customTopNavItem['linkage'] ?>" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_activate_linkage" class="control-label col-md-2">Is Activate Linkage</label>
                            <div class="col-md-3">
                                <select id="is_activate_linkage" class="form-control">
                                    <option value="Y" <?php echo strcasecmp( $customTopNavItem['is_activate_linkage'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $customTopNavItem['is_activate_linkage'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_visible" class="control-label col-md-2">Is Visible</label>
                            <div class="col-md-3">
                                <select id="is_visible" class="form-control">
                                    <option value="Y" <?php echo strcasecmp( $customTopNavItem['is_visible'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $customTopNavItem['is_visible'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_custom_top_nav_item" class="btn btn-warning btn-lg">Edit</a>
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
<script src="/resources/manager/js/e_store/cms/custom_top_nav_item/edit_custom_top_nav_item.js"></script>
<!-- END CUSTOMIZED LIB -->
