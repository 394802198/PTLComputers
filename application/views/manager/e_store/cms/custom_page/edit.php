
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editCustomPageAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager/e_store/cms/custom_page/view_by/pagination" class="text-warning">Custom Page</a></li>
                        <li class="active">Edit Custom Page</li>
                    </ol>
                </div>
                <div id="collapseEditCustomPage" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">Preview</label>
                            <div class="col-md-10">
                                <p class="form-control-static">
                                    <a href="<?php echo ROOT_PATH ?>/e_store/page/hash/<?php echo $customPage['hash_token'] ?>" target="_blank">
                                        <?php echo ROOT_PATH ?>/e_store/page/hash/<?php echo $customPage['hash_token'] ?>
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_type" class="control-label col-md-2">Page Type</label>
                            <div class="col-md-3">
                                <?php

                                    $page_types = array(
                                        100 =>  'Custom',
                                        101 =>  'About Us',
                                        102 =>  'Where to buy',
                                        103 =>  'Terms & Conditions',
                                        104 =>  'Returns',
                                        105 =>  'Services'
                                    );

                                ?>
                                <input type="hidden" id="custom_page_id" value="<?php echo $customPage['id'] ?>" />
                                <select id="page_type" class="form-control">
                                    <?php foreach( $page_types as $code => $page_type ) { ?>
                                        <option value="<?php echo $code ?>" <?php echo $customPage['page_type'] == $code ? 'selected' : '' ?>>
                                            <?php echo $page_type ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_name" class="control-label col-md-2">Page Name</label>
                            <div class="col-md-3">
                                <input type="text" id="page_name" value="<?php echo $customPage['page_name'] ?>" class="form-control" placeholder="*" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title" class="control-label col-md-2">Page Title</label>
                            <div class="col-md-3">
                                <input type="text" id="page_title" value="<?php echo $customPage['page_title'] ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title_size" class="control-label col-md-2">Page Title Size</label>
                            <div class="col-md-3">
                                <?php

                                    $page_title_sizes = array(
                                        100 =>  'Extra Large',
                                        101 =>  'Large',
                                        102 =>  'Medium',
                                        103 =>  'Small',
                                        104 =>  'Extra Small'
                                    );

                                ?>
                                <select id="page_title_size" class="form-control">
                                    <?php foreach( $page_title_sizes as $code => $page_title_size ) { ?>
                                        <option value="<?php echo $code ?>" <?php echo $customPage['page_title_size'] == $code ? 'selected' : '' ?>>
                                            <?php echo $page_title_size ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_title_alignment" class="control-label col-md-2">Page Title Alignment</label>
                            <div class="col-md-3">
                                <?php

                                    $page_title_alignments = array(
                                        100 =>  'Left',
                                        101 =>  'Center',
                                        102 =>  'Right'
                                    );

                                ?>
                                <select id="page_title_alignment" class="form-control">
                                    <?php foreach( $page_title_alignments as $code => $page_title_alignment ) { ?>
                                        <option value="<?php echo $code ?>" <?php echo $customPage['page_title_alignment'] == $code ? 'selected' : '' ?>>
                                            <?php echo $page_title_alignment ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_page_title_visible" class="control-label col-md-2">Is Page Title Visible</label>
                            <div class="col-md-3">
                                <select id="is_page_title_visible" class="form-control">
                                    <option value="Y" <?php echo strcasecmp( $customPage['is_page_title_visible'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $customPage['is_page_title_visible'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_content" class="control-label col-md-2">Page Content</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control" rows="4"><?php echo rawurldecode( $customPage['page_content'] ) ?></textarea>
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="seo_title" class="control-label col-md-2">SEO Title</label>
                            <div class="col-md-6">
                                <input type="text" id="seo_title" value="<?php echo $customPage['seo_title'] ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_description" class="control-label col-md-2">SEO Description</label>
                            <div class="col-md-8">
                                <textarea id="seo_description" class="form-control" rows="4"><?php echo $customPage['seo_description'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_keywords" class="control-label col-md-2">SEO Keywords</label>
                            <div class="col-md-8">
                                <input type="text" id="seo_keywords" value="<?php echo $customPage['seo_keywords'] ?>" class="form-control" placeholder="Keyword 1, Keyword 2, Keyword n, etc..." />
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_custom_page" class="btn btn-warning btn-lg">Edit</a>
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
<script src="/resources/manager/js/e_store/cms/custom_page/edit_custom_page.js"></script>
<!-- END CUSTOMIZED LIB -->
