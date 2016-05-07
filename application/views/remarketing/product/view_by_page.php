<!-- BEGIN HEADER -->
<?php include 'includes/remarketing/header.php'; ?>
<link rel="stylesheet" href="/resources/remarketing/css/product/view_product.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<style>

@media (max-width: 1199px) {
	.product-panel {
	   width:96%;
	}
}
@media (min-width: 1200px) {
	.product-panel {
	   width:1100px;
	}
}
@media (min-width: 1300px) {
	.product-panel {
	   width:1200px;
	}
}
@media (min-width: 1480px) {
	.product-panel {
	   width:1450px;
	}
}
.info-tr {
	background-color: #e8e8e8;
}

</style>

<div class="product-panel" style="margin:0 auto;">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/remarketing" class="text-info">Home</a></li>
                    <li class="active">View Product</li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="manufacturer" class="col-md-2 control-label">Manufacturer</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="manufacturer_name" class="form-control" data-search>
                                    <option></option>
                                    <?php foreach ($manufacturers as $manufacturer) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manufacturer_name != null && ( $ciPagination->model->manufacturer_name==$manufacturer->manufacturer_name && $ciPagination->model->manufacturer_name!='NULL' ) ) { ?>
                                            <option value="<?php echo $manufacturer->manufacturer_name ?>" selected><?php echo $manufacturer->manufacturer_name ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $manufacturer->manufacturer_name ?>"><?php echo $manufacturer->manufacturer_name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="manufacturer_name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="type" class="col-md-2 control-label">Product Type</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="type" class="form-control" data-search>
                                    <option></option>
                                    <?php foreach ($types as $type) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && ( $ciPagination->model->type==$type->type && $ciPagination->model->type!='NULL' ) ) { ?>
                                            <option value="<?php echo $type->type ?>" selected><?php echo $type->type ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $type->type ?>"><?php echo $type->type ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="type">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-md-2 control-label">Location</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="location" class="form-control" data-search>
                                    <option></option>
                                    <?php foreach ($locations as $location) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->location != null && ( $ciPagination->model->location==$location->location && $ciPagination->model->location!='NULL' ) ) { ?>
                                            <option value="<?php echo $location->location ?>" selected><?php echo $location->location ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $location->location ?>"><?php echo $location->location ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="location">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="model" class="col-md-2 control-label">Model</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="model" class="form-control" data-search>
                                    <option></option>
                                    <?php foreach ($models as $model) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->model != null && ( $ciPagination->model->model==$model->model && $ciPagination->model->model!='NULL' ) ) { ?>
                                            <option value="<?php echo $model->model ?>" selected><?php echo $model->model ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $model->model ?>"><?php echo $model->model ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="model">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-primary">Search</a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" id="reset_btn" class="btn btn-default">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align:center; padding:20px 0;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <div class="col-md-12">
               <a href="javascript:void(0);" data-name="add_selected_2_cart" class="btn btn-primary" style="color:#FFF;">
                   Add selected to cart
               </a>
               <a href="javascript:void(0);" id="export_btn" class="btn btn-primary" style="color:#FFF;">
                   Export search result to CSV
               </a>
            </div>
            <table class="table table-condensed" style="font-size:12px;">
                <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                <thead >
                    <tr>
                        <th colspan="11" style="font-size:20px; line-height:30px;">
                            <input type="checkbox" data-name="product_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                        </th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Item Code</th>
                        <th>Location</th>
                        <th>Model</th>
                        <th>SN</th>
                        <th>Processor</th>
                        <th>Speed</th>
                        <th>Mem</th>
                        <th>HDD</th>
                        <th>Performance</th>
                        <th style="text-align:right">Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ( $ciPagination->content as $index => $product ):?>
                    <tr class="<?php echo $index%2==0 ? 'success' : '' ?>">
                        <td>
                            <input type="checkbox" data-name="product_checkbox" data-product-id="<?php echo $product->id ?>" />
                        </td>
                        <td>
                            <a href="/remarketing/product/view_by/id/<?php echo $product->id ?>" class="btn btn-xs btn-info">
                            <?php echo $product->item_code ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $product->location ?>
                        </td>
                        <td>
                            <?php echo $product->model ?>
                        </td>
                        <td>
                            <?php echo $product->sn ?>
                        </td>
                        <td>
                            <?php echo $product->processor ?>
                        </td>
                        <td>
                            <?php echo $product->processor_speed ?>
                        </td>
                        <td>
                            <?php echo $product->mem_size ?>
                        </td>
                        <td>
                            <?php echo $product->hdd_size ?>
                        </td>
                        <td>
                            <?php echo $product->performance_status ?>
                        </td>
                        <td style="text-align:right">
                            $&nbsp;<?php echo sprintf("%01.2f",$product->price); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <?php } else { ?>
                    <tfoot>
                        <div style="text-align:center;">
                            <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                 Product list is empty, please contact system administrator ask for more informations!
                            </div>
                        </div>
                    </tfoot>
                <?php } ?>
            </table>
            <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                <div class="col-md-12" style="text-align:center; padding:20px 0;">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/remarketing/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script>
var $php_self = '<?php echo $_SERVER["REQUEST_URI"] ?>';
</script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/remarketing/js/product/view_product.js"></script>
<!-- END CUSTOMIZED LIB -->