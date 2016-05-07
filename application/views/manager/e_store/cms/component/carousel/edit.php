
<?php include 'includes/manager/header.php'; ?>

<style>
    @media screen and ( min-width: 501px )
    {
        .carousel_div> img
        {
            width:900px; height:300px;
        }
    }
    @media screen and ( max-width: 500px )
    {
        .carousel_div > img
        {
            width:100%;
        }
    }
</style>
<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editCarouselAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">Component</a></li>
                        <li><a href="/manager/e_store/cms/component/carousel/view_by/pagination" class="text-warning">Carousel</a></li>
                        <li class="active">Edit Carousel</li>
                    </ol>
                </div>
                <div id="collapseEditCarousel" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2">Picture</label>
                            <div class="col-md-10 carousel_div">
                                <img data-name="picture" class="img-thumbnail" src="<?php echo '/' . $carousel['img_path'] ?>">
                                <br/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2"></label>
                            <div class="col-md-2">
                                <input type="hidden" id="carousel_id" value="<?php echo $carousel['id'] ?>" />
                                <input type="file" id="picture" name="picture" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_type" class="control-label col-md-2">Page Type</label>
                            <div class="col-md-3">
                                <select id="page_type" class="form-control">
                                    <option value="100">Home</option>
                                </select>
                            </div>
                            <label for="position" class="control-label col-md-2">Position</label>
                            <div class="col-md-3">
                                <select id="position" class="form-control">
                                    <option value="104">Header Bottom</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_activate_linkage" class="control-label col-md-2">Is Activate Linkage</label>
                            <div class="col-md-3">
                                <select id="is_activate_linkage" class="form-control">
                                    <option value="Y" <?php echo strcasecmp( $carousel['is_activate_linkage'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $carousel['is_activate_linkage'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkage" class="control-label col-md-2">Linkage</label>
                            <div class="col-md-8">
                                <input type="text" id="linkage" class="form-control" value="<?php echo $carousel['linkage'] ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="brief_introduction" class="control-label col-md-2">Brief Introduction</label>
                            <div class="col-md-8">
                                <textarea id="brief_introduction" class="form-control" rows="4"><?php echo $carousel['brief_introduction'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_visible" class="control-label col-md-2">Is Visible</label>
                            <div class="col-md-3">
                                <select id="is_visible" class="form-control">
                                    <option value="Y" <?php echo strcasecmp( $carousel['is_visible'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo strcasecmp( $carousel['is_visible'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_carousel" class="btn btn-warning btn-lg">Edit</a>
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

<script src="/resources/global/js/ajaxfileupload.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/e_store/cms/component/carousel/edit_carousel.js"></script>
<!-- END CUSTOMIZED LIB -->
