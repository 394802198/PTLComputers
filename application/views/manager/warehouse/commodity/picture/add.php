
<?php include 'includes/manager/header.php'; ?>

<style>
    @media screen and ( min-width: 501px )
    {
        .commodity_pic_div> img
        {
            width:300px; height:300px;
        }
    }
    @media screen and ( max-width: 500px )
    {
        .commodity_pic_div > img
        {
            width:100%;
        }
    }
</style>
<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCommodityPictureAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/commodity/picture/view_by/pagination" class="text-success">Commodity Picture</a></li>
                        <li class="active">Add Commodity Picture</li>
                    </ol>
                </div>
                <div id="collapseAddCommodityPicture" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2">Picture</label>
                            <div class="col-md-5 commodity_pic_div">
                                <img data-name="picture" class="img-thumbnail" src="/resources/global/image/default_img.svg">
                                <br/>
                                <strong>Recommended Width:300px, Height:300px</strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2"></label>
                            <div class="col-md-2">
                                <input type="file" id="picture" name="picture" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manufacturer" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select id="manufacturer" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($manufacturers as $manufacturer): ?>
                                        <option value="<?php echo $manufacturer->name ?>">
                                            <?php echo $manufacturer->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if( count( $manufacturers ) < 1 ){ ?>
                                    <h5>Click <a class="btn btn-xs btn-success" target="_blank" href="/manager/warehouse/commodity/manufacturer/add">Here</a> to add Manufacturers</h5>
                                <?php } ?>
                            </div>
                            <label for="type" class="control-label col-md-2">Type</label>
                            <div class="col-md-3">
                                <select id="type" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?php echo $type->name ?>">
                                            <?php echo $type->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if( count( $types ) < 1 ){ ?>
                                    <h5>Click <a class="btn btn-xs btn-success" target="_blank" href="/manager/warehouse/commodity/type/add">Here</a> to add Types</h5>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keyword" class="control-label col-md-2">Keyword</label>
                            <div class="col-md-8">
                                <input type="text" id="keyword" class="form-control" />
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_commodity_picture" class="btn btn-success btn-lg">Add</a>
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
<script src="/resources/manager/js/warehouse/commodity/picture/add_commodity_picture.js"></script>
<!-- END CUSTOMIZED LIB -->
