
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCustomPageAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager/e_store/cms/custom_page/view_by/pagination" class="text-warning">Custom Page</a></li>
                        <li class="active">Add Custom Page</li>
                    </ol>
                </div>
                <div id="collapseAddCustomPage" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="page_type" class="control-label col-md-2">Page Type</label>
                            <div class="col-md-3">
                                <select id="page_type" class="form-control">
                                    <option value="100">Custom</option>
                                    <option value="101">About Us</option>
                                    <option value="102">Where to buy</option>
                                    <option value="103">Terms & Conditions</option>
                                    <option value="104">Returns</option>
                                    <option value="105">Services</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_name" class="control-label col-md-2">Page Name</label>
                            <div class="col-md-3">
                                <input type="text" id="page_name" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title" class="control-label col-md-2">Page Title</label>
                            <div class="col-md-3">
                                <input type="text" id="page_title" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title_size" class="control-label col-md-2">Page Title Size</label>
                            <div class="col-md-3">
                                <select id="page_title_size" class="form-control">
                                    <option value="100">Extra Large</option>
                                    <option value="101">Large</option>
                                    <option value="102">Medium</option>
                                    <option value="103">Small</option>
                                    <option value="104">Extra Small</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title_alignment" class="control-label col-md-2">Page Title Alignment</label>
                            <div class="col-md-3">
                                <select id="page_title_alignment" class="form-control">
                                    <option value="100">Left</option>
                                    <option value="101">Center</option>
                                    <option value="102">Right</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_page_title_visible" class="control-label col-md-2">Is Page Title Visible</label>
                            <div class="col-md-3">
                                <select id="is_page_title_visible" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_content" class="control-label col-md-2">Page Content</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="seo_title" class="control-label col-md-2">SEO Title</label>
                            <div class="col-md-6">
                                <input type="text" id="seo_title" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_description" class="control-label col-md-2">SEO Description</label>
                            <div class="col-md-8">
                                <textarea id="seo_description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_keywords" class="control-label col-md-2">SEO Keywords</label>
                            <div class="col-md-8">
                                <input type="text" id="seo_keywords" class="form-control" />
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_custom_page" class="btn btn-warning btn-lg">Add</a>
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
<script src="/resources/manager/js/e_store/cms/custom_page/add_custom_page.js"></script>
<!-- END CUSTOMIZED LIB -->
