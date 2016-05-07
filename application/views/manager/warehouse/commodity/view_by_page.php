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
                    <li class="active">Commodity</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <?php if($_SESSION['manager']['role']=='administrator'){ ?>
                            <a class="btn btn-xs btn-success" id="commodityConfiguration">
                                Visible Per Page
                            </a>
                            <a class="btn btn-xs btn-success" data-loading-text="Processing... please be patient~" id="generate_commodity_from_remarketing_product">Import Commodity from Remarketing Product</a>
                        <?php } ?>
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
                        <label for="type" class="col-md-2 control-label">Product Type</label>
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
                        <label for="location" class="col-md-2 control-label">Location</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="location" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->location != null && $ciPagination->model->location=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
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
                    </div>

                    <div class="form-group">
                        <label for="system_license" class="col-md-2 control-label">Start Price</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="start_price" name="start_price" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_price != null ) { echo $ciPagination->model->start_price; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="start_price_result" name="start_price" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_price != null ) echo $ciPagination->model->start_price ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_price">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="system_license" class="col-md-2 control-label">End Price</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="end_price" name="end_price" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_price != null ) { echo $ciPagination->model->end_price; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="end_price_result" name="end_price" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_price != null ) echo $ciPagination->model->end_price ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_price">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="is_on_shelf" class="col-md-2 control-label">Is On Shelf</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="is_on_shelf" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_on_shelf != null && $ciPagination->model->is_on_shelf=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php
                                            $is_on_shelf_arr = array(
                                                'Y' =>  'Yes',
                                                'N' =>  'No'
                                            );
                                    ?>
                                    <?php foreach ( $is_on_shelf_arr as $key => $is_on_shelf ) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_on_shelf != null && ( $ciPagination->model->is_on_shelf==$key && $ciPagination->model->is_on_shelf!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $is_on_shelf ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $is_on_shelf ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="is_on_shelf">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="faults" class="col-md-2 control-label">Is Self Created</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->faults != null ) echo $ciPagination->model->faults ?>" name="faults" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="faults">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="faults" class="col-md-2 control-label">Description</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->faults != null ) echo $ciPagination->model->faults ?>" name="faults" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="faults">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="is_weight_shown" class="col-md-2 control-label">Is Weight Shown</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="is_weight_shown" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_weight_shown != null && $ciPagination->model->is_weight_shown=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php
                                    $is_weight_shown_arr = array(
                                        'Y' =>  'Yes',
                                        'N' =>  'No'
                                    );
                                    ?>
                                    <?php foreach ( $is_weight_shown_arr as $key => $is_weight_shown ) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_weight_shown != null && ( $ciPagination->model->is_weight_shown==$key && $ciPagination->model->is_weight_shown!='NULL' ) ) { ?>
                                            <option value="<?php echo $key ?>" selected><?php echo $is_weight_shown ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $key ?>"><?php echo $is_weight_shown ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="is_weight_shown">
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
            <?php if( count( $ciPagination->content ) > 0 ){ ?>
                <div class="col-md-12" style="text-align:center; padding:20px 0;">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" disabled>Selected Commodities</button>
                    <button type="button" data-name="selected_commodities_on_off_shelf" data-type="on" class="btn btn-success btn-sm">&nbsp;On&nbsp;</button>
                    <button type="button" data-name="selected_commodities_on_off_shelf" data-type="off" class="btn btn-success btn-sm">&nbsp;Off&nbsp;</button>
                    <button type="button" class="btn btn-default btn-sm" disabled>Shelf</button>
                    <button type="button" data-name="selected_commodities_show_hide_weight" data-type="show" class="btn btn-success btn-sm">&nbsp;Show&nbsp;</button>
                    <button type="button" data-name="selected_commodities_show_hide_weight" data-type="hide" class="btn btn-success btn-sm">&nbsp;Hide&nbsp;</button>
                    <button type="button" class="btn btn-default btn-sm" disabled>Weight</button>
                </div><!-- /input-group -->
<!--               <a href="javascript:void(0);" data-name="order_4_wholesaler_btn" class="btn btn-xs btn-success" style="color:#FFF;">-->
<!--                   Order for customer-->
<!--               </a>-->
<!--               <a href="javascript:void(0);" id="export_product_2_excel_btn" class="btn btn-xs btn-success" style="color:#FFF;">-->
<!--                   Export commodity to excel-->
<!--               </a>-->
<!--               --><?php //if($_SESSION['manager']['role']=='administrator'){ ?>
<!--                   <a href="javascript:void(0);" id="delete_commodity_btn" class="btn btn-sm btn-success">-->
<!--                       <span class="glyphicon glyphicon-trash"></span>-->
<!--                       Delete selected commodity-->
<!--                   </a>-->
<!--               --><?php //} ?>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="100" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="commodity_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th width="20%">Main Picture</th>
                            <th width="15%">Name</th>
                            <th width="6%">Price</th>
                            <th width="6%">Weight</th>
                            <th width="6%">Stock</th>
                            <th width="10%">Location</th>
                            <th width="10%">Manufacturer</th>
                            <th width="10%">Type</th>
                            <th width="3%">Is On Shelf</th>
                            <th width="3%">Is Weight Shown</th>
                            <th width="17%">Sequence</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $commodity ):?>
                        <tr class="<?php echo $index%2==0 ? 'success' : '' ?>">
                            <td>
                                <input type="checkbox" data-name="commodity_checkbox" data-commodity-e-store-sku="<?php echo $commodity->e_store_sku ?>" data-commodity-id="<?php echo $commodity->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/warehouse/commodity/edit/id/<?php echo $commodity->id ?>" class="img-thumbnail" target="_blank">
                                    <img data-name="picture" src="<?php echo $commodity->main_picture['pic_path'] ? '/' . $commodity->main_picture['pic_path'] : '/resources/global/image/default_img.svg' ?>" width="150px" height="150px">
                                </a>
                            </td>
                            <td>
                                <?php echo $commodity->name ?>
                            </td>
                            <td>
                                <?php echo sprintf("%01.2f",$commodity->price); ?>
                            </td>
                            <td>
                                <?php echo $commodity->weight ?>
                            </td>
                            <td>
                                <?php echo $commodity->inventory['stock'] ?>
                            </td>
                            <td>
                                <?php echo $commodity->location ?>
                            </td>
                            <td>
                                <?php echo $commodity->manufacturer ?>
                            </td>
                            <td>
                                <?php echo $commodity->type ?>
                            </td>
                            <td>
                                <?php echo strcasecmp( $commodity->is_on_shelf, 'Y' ) == 0 ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <?php echo strcasecmp( $commodity->is_weight_shown, 'Y' ) == 0 ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" data-sequence-input data-commodity-id="<?php echo $commodity->id ?>" value="<?php echo $commodity->sequence ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" data-name="update_sequence" data-commodity-id="<?php echo $commodity->id ?>" type="button">
                                            &nbsp;<span class="glyphicon glyphicon-ok"></span>&nbsp;
                                        </button>
                                    </span>
                                </div>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                    Commodity is empty, you can click <strong>[Generate Commodity from Remarketing Product]</strong> button at the <strong>[top right]</strong> area in current page to generate commodities from Remarketing Product
                                </div>
                            </div>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
            <?php if( count( $ciPagination->content ) > 0 ){ ?>
                <div class="col-md-12" style="text-align:center; padding:20px 0;">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<form class="form-horizontal">
    <!-- Modal -->
    <div class="modal fade" id="commodityConfigurationModal" tabindex="-1" role="dialog" aria-labelledby="commodityConfigurationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="commodityConfigurationModalLabel"></h4>
                </div>
                <div class="modal-body" id="commodityConfigurationModalContent">
                    <div class="form-group">
                        <label class="control-label col-md-3">Home Listing</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="home_visible_per_page" placeholder="10 by default" />
                        </div>
                        <label class="control-label col-md-3">Search Result</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="search_visible_per_page" placeholder="20 by default" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="commodityConfigurationConfirm">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form class="form-horizontal">
<div class="modal fade" id="order4CustomerModal" tabindex="-1" role="dialog" aria-labelledby="order4CustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="order4CustomerModalLabel">Order for specified customer</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="notes" class="col-md-4 control-label">Customer</label>
            <div class="col-md-8">
                <select data-name="specified_wholesaler" class="form-control">
                    <option></option>
                    <?php foreach ($customers as $customer) { ?>
                    <option value="<?php echo $customer->id ?>"><?php echo $customer->company_name ? $customer->company_name.'&nbsp;-&nbsp;' : '' ?><?php echo $customer->first_name ?>&nbsp;<?php echo $customer->last_name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
		    <input type="hidden" name="shipping_method" value="Shipping" />
            <label for="notes" class="col-md-4 control-label">Shipping Method</label>
            <div class="col-md-8">
			    <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Pick Up" />&nbsp;<span style="font-weight:normal;">Pick Up</span></label>&nbsp;
			    <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Shipping" />&nbsp;<span style="font-weight:normal;">Shipping</span></label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="order4CustomerConfirm">Order</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="deleteCommodityModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommodityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCommodityModalLabel">Delete commodity</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected commodity?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deleteCommodityConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="generateCommodityFromRemarketingProductModal" tabindex="-1" role="dialog" aria-labelledby="generateCommodityFromRemarketingProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="generateCommodityFromRemarketingProductModalLabel">Generate commodity</h4>
            </div>
            <div class="modal-body">
                Sure to generate commodity from Remarketing product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="generateCommodityFromRemarketingProductConfirm">Generate</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="onOffShelfSelectedCommoditiesModal" tabindex="-1" role="dialog" aria-labelledby="onOffShelfSelectedCommoditiesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="onOffShelfSelectedCommoditiesModalLabel"></h4>
            </div>
            <div class="modal-body" id="onOffShelfSelectedCommoditiesModalContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="onOffShelfSelectedCommoditiesConfirm">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="showHideSelectedCommoditiesWeightModal" tabindex="-1" role="dialog" aria-labelledby="showHideSelectedCommoditiesWeightModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showHideSelectedCommoditiesWeightModalLabel"></h4>
            </div>
            <div class="modal-body" id="showHideSelectedCommoditiesWeightModalContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="showHideSelectedCommoditiesWeightConfirm">Yes</button>
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
<script src="/resources/manager/js/warehouse/commodity/view_commodity_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
