
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
        <div class="panel-group" id="addCommodityAccordion">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-success">Home</a></li>
                        <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                        <li><a href="/manager/warehouse/commodity/view_by/pagination" class="text-success">Commodity</a></li>
                        <li class="active">Edit Commodity</li>
                    </ol>
                </div>
                <div id="collapseAddCommodity" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Picture</label>
                            <div class="col-md-5 commodity_pic_div">
                                <img class="img-thumbnail" src="<?php echo $commodityRelatedMainPicture ? '/' . $commodityRelatedMainPicture['pic_path'] : '/resources/global/image/default_img.svg' ?>" data-commodity-picture-main />
                                <br/>
                                <strong>Recommended Width:300px, Height:300px</strong>
                                <br/>
                                <strong>Picture limitation of a commodity is 6</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Matched Pictures</label>
                            <div class="col-md-10">
                                <ul class="img-thumbnail" style="overflow-y:scroll; padding:10px; height:300px; width:100%;">
                                    <?php if( count( $commodityPictures ) > 0 ) { ?>
                                        <?php foreach( $commodityPictures as $index => $commodityPicture ){ ?>
                                            <?php if( $index % 5 == 0 ) { ?>
                                                <li style="float:left; width:100%;"></li>
                                            <?php } ?>
                                            <li style="float:left; position:relative; margin-top:30px; ">
                                                <?php $isSelected = false;  ?>
                                                <?php if( count( $commodityRelatedPictures ) > 0 ) { ?>
                                                    <?php foreach( $commodityRelatedPictures as $commodityRelatedPicture ) { ?>
                                                        <?php if( $commodityRelatedPicture->id === $commodityPicture->id ) { ?>
                                                            <?php $isSelected = true; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                <a class="btn btn-sm btn-success" style="position:absolute; top:-24px; left:2px; <?php echo $isSelected ? '' : 'display:none;' ?>" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-btn <?php echo $isSelected ? 'selected' : '' ?> >
                                                    <?php if( count( $commodityRelatedPictures ) > 0 ) { ?>
                                                        <?php foreach( $commodityRelatedPictures as $commodityRelatedPicture ) { ?>
                                                            <?php if( $commodityRelatedPicture->id === $commodityPicture ) { ?>
                                                                <?php echo 'selected' ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <span class="glyphicon glyphicon-<?php echo $commodityRelatedMainPicture ? $commodityRelatedMainPicture['id'] === $commodityPicture->id ? 'ok-sign' : 'ok-circle' : 'ok-circle' ?>" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-btn-icon <?php echo $commodityRelatedMainPicture['id'] === $commodityPicture->id ? 'main' : '' ?> ></span>
                                                </a>
                                                <img class="img-thumbnail" src="<?php echo '/'. $commodityPicture->pic_path ?>" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" data-commodity-picture-img width="150px" style="margin:2px; cursor:pointer;" />
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        No Images found? Click <a class="btn btn-xs btn-success" target="_blank" href="/manager/warehouse/commodity/picture/add">Here</a> to upload pictures for this <strong>Manufacturer & Type</strong> of commodity then refresh this page.
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label col-md-2">Name</label>
                            <div class="col-md-3">
                                <input type="hidden" id="commodity_id" value="<?php echo $commodity['id'] ?>" />
                                <input id="name" value="<?php echo $commodity['name'] ?>" class="form-control" placeholder="*" />
                            </div>
                            <label for="price" class="control-label col-md-2">Price</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" id="price" value="<?php echo $commodity['price'] ?>" class="form-control" placeholder="*"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="control-label col-md-2">Location</label>
                            <div class="col-md-3">
                                <?php if( strcasecmp( $commodity['is_e_store_created'], 'N' ) == 0 ){ ?>
                                    <input type="text" id="location" value="<?php echo $commodity['location'] ?>" class="form-control" disabled/>
                                <?php } else { ?>
                                    <select id="location" class="form-control">
                                        <?php foreach ($locations as $location): ?>
                                            <?php if( strcasecmp( $commodity['location'], $location->name)==0 ){ ?>
                                                <option value="<?php echo $location->name ?>" selected="selected">
                                                    <?php echo $location->name ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="<?php echo $location->name ?>">
                                                    <?php echo $location->name ?>
                                                </option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <label for="model" class="control-label col-md-2">Weight</label>
                            <div class="col-md-3">
                                <?php if( strcasecmp( $commodity['is_e_store_created'], 'N' ) == 0 ){ ?>
                                    <input type="text" id="weight" value="<?php echo $commodity['weight'] ?>" class="form-control" placeholder="*"/>
                                <?php } else { ?>
                                    <input type="text" id="weight" value="<?php echo $commodity['weight'] ?>" class="form-control" placeholder="*"/>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manufacturer" class="control-label col-md-2">Manufacturer</label>
                            <div class="col-md-3">
                                <?php if( strcasecmp( $commodity['is_e_store_created'], 'N' ) == 0 ){ ?>
                                    <input type="text" id="manufacturer" value="<?php echo $commodity['manufacturer'] ?>" class="form-control" disabled/>
                                <?php } else { ?>
                                    <select id="manufacturer" class="form-control">
                                        <?php foreach ($manufacturers as $manufacturer): ?>
                                            <?php if( strcasecmp($commodity['manufacturer'], $manufacturer->name) == 0 ){ ?>
                                                <option value="<?php echo $manufacturer->name ?>" selected="selected">
                                                    <?php echo $manufacturer->name ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="<?php echo $manufacturer->name ?>">
                                                    <?php echo $manufacturer->name ?>
                                                </option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <label for="model" class="control-label col-md-2">Stock</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $commodity['inventory']['stock'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="control-label col-md-2">Type</label>
                            <div class="col-md-3">
                                <?php if( strcasecmp( $commodity['is_e_store_created'], 'N' ) == 0 ){ ?>
                                    <input type="text" id="type" value="<?php echo $commodity['type'] ?>" class="form-control" disabled/>
                                <?php } else { ?>
                                    <select id="type" class="form-control">
                                        <?php foreach ($types as $type): ?>
                                            <?php if( strcasecmp($commodity['type'], $type->name) == 0 ){ ?>
                                                <option value="<?php echo $type->name ?>" selected="selected">
                                                    <?php echo $type->name ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="<?php echo $type->name ?>">
                                                    <?php echo $type->name ?>
                                                </option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                <?php } ?>
                            </div>
                            <label for="is_on_shelf" class="control-label col-md-2">Is On Shelf</label>
                            <div class="col-md-3">
                                <select id="is_on_shelf" class="form-control">
                                    <option value="N" <?php echo strcasecmp( $commodity['is_on_shelf'], 'N' ) == 0 ? 'selected' : '' ?> >No</option>
                                    <option value="Y" <?php echo strcasecmp( $commodity['is_on_shelf'], 'Y' ) == 0 ? 'selected' : '' ?> >Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_on_sale" class="control-label col-md-2">Is On Sale</label>
                            <div class="col-md-3">
                                <select id="is_on_sale" class="form-control">
                                    <option value="N" <?php echo strcasecmp( $commodity['is_on_sale'], 'N' ) == 0 ? 'selected' : '' ?> >No</option>
                                    <option value="Y" <?php echo strcasecmp( $commodity['is_on_sale'], 'Y' ) == 0 ? 'selected' : '' ?> >Yes</option>
                                </select>
                            </div>
                        </div>

<!--                        <div class="form-group">-->
<!--                            <label for="is_on_shelf" class="control-label col-md-2">Is E Store Created</label>-->
<!--                            <div class="col-md-1">-->
<!--                                <p class="form-control-static">--><?php //echo strcasecmp( $commodity['is_e_store_created'], 'Y' ) == 0 ? 'Yes' : 'No' ?><!--</p>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="form-group">
                            <label for="short_description" class="control-label col-md-2">Short Description</label>
                            <div class="col-md-8">
                                <textarea id="short_description" class="form-control" rows="4"><?php echo $commodity['short_description'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label col-md-2">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="description">
                                    <?php if(isset($commodity['description'])) echo rawurldecode($commodity['description']) ?>
                                </textarea>
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="edit_commodity" class="btn btn-success btn-lg">Edit</a>
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
<script src="/resources/manager/js/warehouse/commodity/edit_commodity.js"></script>
<!-- END CUSTOMIZED LIB -->
