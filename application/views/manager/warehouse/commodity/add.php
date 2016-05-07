
<?php include 'includes/manager/header.php'; ?>

<style>
    @media screen and ( min-width: 501px )
    {
        .commodity_pic_div> img
        {
            width: 350px; height: 300px;
        }
    }
    @media screen and ( max-width: 500px )
    {
        .commodity_pic_div > img
        {
            width: 100%;
        }
    }
</style>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="addCommodityAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/commodity/view_by/pagination" class="text-success">Commodity</a></li>
                        <li class="active">Add Commodity</li>
                    </ol>
                </div>
                <div id="collapseAddCommodity" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Pictures</label>
                            <div class="col-md-5 commodity_pic_div">
                                <img class="img-thumbnail" src="/resources/global/image/default_img.svg" data-commodity-picture-main />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Candidates</label>
                            <div class="col-md-10">
                                <ul class="img-thumbnail" style="overflow-y:scroll; padding:10px; height:300px;">
                                    <?php if( count( $commodityPictures ) > 0 ) { ?>
                                        <?php foreach( $commodityPictures as $commodityPicture ){ ?>
                                            <li style="float:left; position:relative; margin-top:30px;">
                                                <a class="btn btn-sm btn-success" style="position:absolute; top:-24px; left:2px; display:none;" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-btn>
                                                    <span class="glyphicon glyphicon-ok-circle" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-btn-icon></span>
                                                </a>
                                                <!--                                            <a class="btn btn-xs btn-success" style="position:absolute; top:-15px; left:2px;">-->
                                                <!--                                                <span class="glyphicon glyphicon-ok-circle"></span>-->
                                                <!--                                            </a>-->
                                                <img class="img-thumbnail" src="<?php echo '/'. $commodityPicture->pic_path ?>" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-img width="150px" style="margin:2px; cursor:pointer;" />
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="item_code" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-screenshot"></span></span>
                                    <input type="text" id="name" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" id="price" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="model" class="control-label col-md-2">Weight</label>
                            <div class="col-md-3">
                                <input type="text" id="weight" class="form-control" placeholder="*"/>
                            </div>
                            <label for="type" class="control-label col-md-2">Commodity Type</label>
                            <div class="col-md-3">
                                <select id="type" class="form-control">
                                    <?php foreach ($types as $type): ?>
                                        <option value="<?php echo $type->name ?>">
                                            <?php echo $type->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manufacturer" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <select id="manufacturer" class="form-control">
                                    <?php foreach ($manufacturers as $manufacturer): ?>
                                        <option value="<?php echo $manufacturer->name ?>">
                                            <?php echo $manufacturer->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <select id="location" class="form-control">
                                    <?php foreach ($locations as $location): ?>
                                        <option value="<?php echo $location->name ?>">
                                            <?php echo $location->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_on_shelf" class="control-label col-md-2">Is On Shelf</label>
                            <div class="col-md-3">
                                is_on_shelf
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="control-label col-md-2">Short Description</label>
                            <div class="col-md-8">
                                <textarea id="short_description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label col-md-2">Description</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_commodity" class="btn btn-success btn-lg">Add</a>
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
<script src="/resources/manager/js/warehouse/commodity/add_commodity.js"></script>
<!-- END CUSTOMIZED LIB -->
