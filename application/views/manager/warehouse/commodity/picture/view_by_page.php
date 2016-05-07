<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<link rel="stylesheet" href="/resources/global/css/view_by_page.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->

<style>
.info-tr {
	background-color: #e8e8e8;
}

input[type=range] {
    /*removes default webkit styles*/
    -webkit-appearance: none;

    /*fix for FF unable to apply focus style bug */
    border: 1px solid white;

    /*required for proper track sizing in FF*/x
}
input[type=range]::-webkit-slider-runnable-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #5cb85c;
    margin-top: -4px;
}
input[type=range]:focus {
    outline: none;
}
input[type=range]:focus::-webkit-slider-runnable-track {
    background: #ccc;
}

input[type=range]::-moz-range-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-moz-range-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #5cb85c;
}

/*hide the outline behind the border*/
input[type=range]:-moz-focusring{
    outline: 1px solid white;
    outline-offset: -1px;
}

input[type=range]::-ms-track {
    width: 300px;
    height: 5px;

    /*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
    background: transparent;

    /*leave room for the larger thumb to overflow with a transparent border */
    border-color: transparent;
    border-width: 6px 0;

    /*remove default tick marks*/
    color: transparent;
}
input[type=range]::-ms-fill-lower {
    background: #777;
    border-radius: 10px;
}
input[type=range]::-ms-fill-upper {
    background: #ddd;
    border-radius: 10px;
}
input[type=range]::-ms-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: #5cb85c;
}
input[type=range]:focus::-ms-fill-lower {
    background: #888;
}
input[type=range]:focus::-ms-fill-upper {
    background: #ccc;
}
</style>
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-success">Home</a></li>
                    <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                    <li class="active">Commodity Picture</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <?php if($_SESSION['manager']['role']=='administrator'){ ?>
<!--                            <a href="javascript:void(0);" id="auto_synchronizing_pictures_to_related_commodities" class="btn btn-xs btn-info">-->
<!--                                <span class="glyphicon glyphicon-refresh" ></span>-->
<!--                                Auto Synchronizing Pictures to Related Commodities-->
<!--                            </a>-->
                        <?php } ?>
                        <a href="/manager/warehouse/commodity/picture/add" class="btn btn-xs btn-success">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Commodity Picture
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="manufacturer" class="col-md-2 control-label">Manufacturer</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="manufacturer" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manufacturer != null && $ciPagination->model->manufacturer=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($manufacturers as $manufacturer) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manufacturer != null && ( $ciPagination->model->manufacturer==$manufacturer->manufacturer && $ciPagination->model->manufacturer!='NULL' ) ) { ?>
                                            <option value="<?php echo $manufacturer->manufacturer ?>" selected><?php echo $manufacturer->manufacturer ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $manufacturer->manufacturer ?>"><?php echo $manufacturer->manufacturer ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="manufacturer">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="type" class="col-md-2 control-label">Type</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="type" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && $ciPagination->model->type=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
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
                        <label for="faults" class="col-md-2 control-label">Keyword</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->keyword != null ) echo $ciPagination->model->keyword ?>" name="keyword" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="keyword">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-search"></span>
                                Search
                            </a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" id="reset_btn" class="btn btn-sm btn-default">
                                <span class="glyphicon glyphicon-refresh"></span>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align:center; padding:20px 0;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <div class="col-md-12">
<!--               <a href="javascript:void(0);" data-name="order_4_wholesaler_btn" class="btn btn-xs btn-success" style="color:#FFF;">-->
<!--                   Order for customer-->
<!--               </a>-->
<!--               <a href="javascript:void(0);" id="export_product_2_excel_btn" class="btn btn-xs btn-success" style="color:#FFF;">-->
<!--                   Export commodity to excel-->
<!--               </a>-->
               <?php if( $_SESSION['manager']['role']=='administrator' ){ ?>
                   <a href="javascript:void(0);" id="delete_commodity_picture_btn" class="btn btn-sm btn-success">
                       <span class="glyphicon glyphicon-trash"></span>
                       Delete selected commodity picture
                   </a>
               <?php } ?>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="6" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="commodity_picture_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Manufacturer</th>
                            <th class="text-center">Type</th>
                            <th class="text-center" width="55%">Keyword</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $commodityPicture ): ?>
                        <tr class="<?php echo $index%2==0 ? 'success' : '' ?> text-center">
                            <td class="text-left">
                                <input type="checkbox" data-name="commodity_picture_checkbox" data-commodity-picture-id="<?php echo $commodityPicture->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/warehouse/commodity/picture/edit/id/<?php echo $commodityPicture->id ?>" class="img-thumbnail">
                                    <img data-name="picture" src="<?php echo $commodityPicture->pic_path ? '/' .$commodityPicture->pic_path : '/resources/global/image/default_img.svg' ?>" width="150px" height="150px">
                                </a>
                            </td>
                            <td>
                                <?php echo $commodityPicture->manufacturer ?>
                            </td>
                            <td>
                                <?php echo $commodityPicture->type ?>
                            </td>
                            <td>
                                <?php echo $commodityPicture->keyword ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                    Commodity Picture is empty, please click the button at the top right of this page to add pictures
                                </div>
                            </div>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
            <div style="text-align:center; padding:20px 0;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCommodityPictureModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommodityPictureModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCommodityPictureModalLabel">Delete commodity</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected commodity picture?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deleteCommodityPictureConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="autoSynchronizingPicturesToRelatedCommoditiesModal" tabindex="-1" role="dialog" aria-labelledby="autoSynchronizingPicturesToRelatedCommoditiesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="autoSynchronizingPicturesToRelatedCommoditiesModalLabel">Auto Synchronizing Pictures To Related Commodities</h4>
            </div>
            <div class="modal-body">
                Sure to synchronizing pictures to related commodities?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="autoSynchronizingPicturesToRelatedCommoditiesConfirm">Synchronize Start</button>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script>
var $php_self = '<?php echo $_SERVER["REQUEST_URI"] ?>';
</script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/warehouse/commodity/picture/view_commodity_picture_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
