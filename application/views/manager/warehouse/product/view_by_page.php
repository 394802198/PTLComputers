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
                    <li class="active">Product</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/warehouse/product/add" class="btn btn-xs btn-success">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Product
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="imported_date" class="col-md-2 control-label">Start Imported Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_import_date != null ) echo $ciPagination->model->start_import_date ?>" class="form-control" name="start_import_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_import_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="imported_date" class="col-md-2 control-label">End Imported Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_import_date != null ) echo $ciPagination->model->end_import_date ?>" class="form-control" name="end_import_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_import_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_last_update" class="col-md-2 control-label">Start Last Update</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_last_update != null ) echo $ciPagination->model->start_last_update ?>" class="form-control" name="start_last_update" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_last_update">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="start_last_update" class="col-md-2 control-label">End Last Update</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_last_update != null ) echo $ciPagination->model->end_last_update ?>" class="form-control" name="end_last_update" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_last_update">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_ordered_date" class="col-md-2 control-label">Start Ordered Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_ordered_date != null ) echo $ciPagination->model->start_ordered_date ?>" class="form-control" name="start_ordered_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_ordered_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_ordered_date" class="col-md-2 control-label">End Ordered Date</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_ordered_date != null ) echo $ciPagination->model->end_ordered_date ?>" class="form-control" name="end_ordered_date" data-date-format="yyyy-mm-dd" data-search>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_ordered_date">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="product_status" class="col-md-2 control-label">Product Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="product_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->product_status != null && $ciPagination->model->product_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($productStatus as $productState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->product_status != null && ( $ciPagination->model->product_status==$productState->product_status && $ciPagination->model->product_status!='NULL' ) ) { ?>
                                            <?php if( trim( $productState->product_status ) != '' ) { ?>
                                                <option value="<?php echo $productState->product_status ?>" selected><?php echo $productState->product_status ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $productState->product_status ) != '' ) { ?>
                                                <option value="<?php echo $productState->product_status ?>"><?php echo $productState->product_status ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="product_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job_number" class="col-md-2 control-label">Job Number</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="job_number" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->job_number != null && $ciPagination->model->job_number=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($jobNumbers as $jobNumber) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->job_number != null && ( $ciPagination->model->job_number==$jobNumber->job_number && $ciPagination->model->job_number!='NULL' ) ) { ?>
                                            <?php if( trim( $jobNumber->job_number ) != '' ) { ?>
                                                <option value="<?php echo $jobNumber->job_number ?>" selected><?php echo $jobNumber->job_number ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $jobNumber->job_number ) != '' ) { ?>
                                                <option value="<?php echo $jobNumber->job_number ?>"><?php echo $jobNumber->job_number ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="job_number">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_code" class="col-md-2 control-label">Item Code</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->item_code != null ) echo $ciPagination->model->item_code ?>" name="item_code" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="item_code">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="manufacturer_name" class="col-md-2 control-label">Manufacturer</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="manufacturer_name" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manufacturer_name != null && $ciPagination->model->manufacturer_name=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($manufacturers as $manufacturer) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->manufacturer_name != null && ( $ciPagination->model->manufacturer_name==$manufacturer->manufacturer_name && $ciPagination->model->manufacturer_name!='NULL' ) ) { ?>
                                            <?php if( trim( $manufacturer->manufacturer_name ) != '' ) { ?>
                                                <option value="<?php echo $manufacturer->manufacturer_name ?>" selected><?php echo $manufacturer->manufacturer_name ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $manufacturer->manufacturer_name ) != '' ) { ?>
                                                <option value="<?php echo $manufacturer->manufacturer_name ?>"><?php echo $manufacturer->manufacturer_name ?></option>
                                            <?php } ?>
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
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && $ciPagination->model->type=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($types as $type) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && ( $ciPagination->model->type==$type->type && $ciPagination->model->type!='NULL' ) ) { ?>
                                            <?php if( trim( $type->type ) != '' ) { ?>
                                                <option value="<?php echo $type->type ?>" selected><?php echo $type->type ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $type->type ) != '' ) { ?>
                                                <option value="<?php echo $type->type ?>"><?php echo $type->type ?></option>
                                            <?php } ?>
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
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->type != null && $ciPagination->model->type=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($locations as $location) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->location != null && ( $ciPagination->model->location==$location->location && $ciPagination->model->location!='NULL' ) ) { ?>
                                            <?php if( trim( $location->location ) != '' ) { ?>
                                                <option value="<?php echo $location->location ?>" selected><?php echo $location->location ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $location->location ) != '' ) { ?>
                                                <option value="<?php echo $location->location ?>"><?php echo $location->location ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="location">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="visual_status" class="col-md-2 control-label">Visual Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="visual_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->visual_status != null && $ciPagination->model->visual_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($visualStatus as $visualState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->visual_status != null && ( $ciPagination->model->visual_status==$visualState->visual_status && $ciPagination->model->visual_status!='NULL' ) ) { ?>
                                            <?php if( trim( $visualState->visual_status ) != '' ) { ?>
                                                <option value="<?php echo $visualState->visual_status ?>" selected><?php echo $visualState->visual_status ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $visualState->visual_status ) != '' ) { ?>
                                                <option value="<?php echo $visualState->visual_status ?>"><?php echo $visualState->visual_status ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="visual_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="performance_status" class="col-md-2 control-label">Performance Status</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="performance_status" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->performance_status != null && $ciPagination->model->performance_status=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($performanceStatus as $performanceState) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->performance_status != null && ( $ciPagination->model->performance_status==$performanceState->performance_status && $ciPagination->model->performance_status!='NULL' ) ) { ?>
                                            <?php if( trim( $performanceState->performance_status ) != '' ) { ?>
                                                <option value="<?php echo $performanceState->performance_status ?>" selected><?php echo $performanceState->performance_status ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $performanceState->performance_status ) != '' ) { ?>
                                                <option value="<?php echo $performanceState->performance_status ?>"><?php echo $performanceState->performance_status ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="performance_status">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="model" class="col-md-2 control-label">Model</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="model" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->model != null && $ciPagination->model->model=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($models as $model) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->model != null && ( $ciPagination->model->model==$model->model && $ciPagination->model->model!='NULL' ) ) { ?>
                                            <?php if( trim( $model->model ) != '' ) { ?>
                                                <option value="<?php echo $model->model ?>" selected><?php echo $model->model ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $model->model ) != '' ) { ?>
                                                <option value="<?php echo $model->model ?>"><?php echo $model->model ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="model">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="sn" class="col-md-2 control-label">SN</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->sn != null ) echo $ciPagination->model->sn ?>" name="sn" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="sn">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="processor" class="col-md-2 control-label">Processor</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->processor != null ) echo $ciPagination->model->processor ?>" name="processor" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="processor">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="processor_speed" class="col-md-2 control-label">Processor Speed</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->processor_speed != null ) echo $ciPagination->model->processor_speed ?>" name="processor_speed" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="processor_speed">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mem_size" class="col-md-2 control-label">Mem Size</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->mem_size != null ) echo $ciPagination->model->mem_size ?>" name="mem_size" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="mem_size">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="hdd_size" class="col-md-2 control-label">HDD Size</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->hdd_size != null ) echo $ciPagination->model->hdd_size ?>" name="hdd_size" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="hdd_size">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="screen_size" class="col-md-2 control-label">Screen Size</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="screen_size" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->screen_size != null && $ciPagination->model->screen_size=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($screenSizes as $screenSize) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->screen_size != null && ( $ciPagination->model->model==$screenSize->screen_size && $ciPagination->model->screen_size!='NULL' ) ) { ?>
                                            <?php if( trim( $screenSize->screen_size ) != '' ) { ?>
                                                <option value="<?php echo $screenSize->screen_size ?>" selected><?php echo $screenSize->screen_size ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if( trim( $screenSize->screen_size ) != '' ) { ?>
                                                <option value="<?php echo $screenSize->screen_size ?>"><?php echo $screenSize->screen_size ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="screen_size">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="optical_drive" class="col-md-2 control-label">Optical Drive</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->optical_drive != null ) echo $ciPagination->model->optical_drive ?>" name="optical_drive" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="optical_drive">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="system_license" class="col-md-2 control-label">System License</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->system_license != null ) echo $ciPagination->model->system_license ?>" name="system_license" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="system_license">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-md-2 control-label">Notes</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->notes != null ) echo $ciPagination->model->notes ?>" name="notes" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="notes">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="faults" class="col-md-2 control-label">Faulty</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->faults != null ) echo $ciPagination->model->faults ?>" name="faults" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="faults">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_power_supply" class="col-md-2 control-label">Is Power Supply</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="is_power_supply" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_power_supply != null && $ciPagination->model->is_power_supply=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php $isPowerSupplyArr = array('Y','N'); ?>
                                    <?php foreach ($isPowerSupplyArr as $isPowerSupply) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_power_supply != null && ( $ciPagination->model->is_power_supply==$isPowerSupply && $ciPagination->model->is_power_supply!='NULL' ) ) { ?>
                                            <option value="<?php echo $isPowerSupply ?>" selected><?php echo $isPowerSupply == 'Y' ? 'Yes' : 'No' ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $isPowerSupply ?>"><?php echo $isPowerSupply == 'Y' ? 'Yes' : 'No' ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="is_power_supply">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="is_web_cam" class="col-md-2 control-label">Is Web Cam</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="is_web_cam" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_web_cam != null && $ciPagination->model->is_web_cam=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php $isWebCamArr = array('Y','N'); ?>
                                    <?php foreach ($isWebCamArr as $isWebCam) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->is_web_cam != null && ( $ciPagination->model->is_web_cam==$isWebCam && $ciPagination->model->is_web_cam!='NULL' ) ) { ?>
                                            <option value="<?php echo $isWebCam ?>" selected><?php echo $isWebCam == 'Y' ? 'Yes' : 'No' ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $isWebCam ?>"><?php echo $isWebCam == 'Y' ? 'Yes' : 'No' ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="is_web_cam">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_price" class="col-md-2 control-label">Start Price</label>
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
                        <label for="end_price" class="col-md-2 control-label">End Price</label>
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
                    </div>
                    <div class="form-group">
                        <label for="start_weight" class="col-md-2 control-label">Start Weight</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="start_weight" name="start_weight" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_weight != null ) { echo $ciPagination->model->start_weight; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="start_weight_result" name="start_weight" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->start_weight != null ) echo $ciPagination->model->start_weight ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="start_weight">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="end_weight" class="col-md-2 control-label">End Weight</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="range" data-range="end_weight" name="end_weight" min="0" max="9999" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_weight != null ) { echo $ciPagination->model->end_weight; } else { echo 0; } ?>" style="float: left; height: 34px;">
                                </div>
                                <div class="col-md-6" style="padding: 0;">
                                    <input type="text" data-range-result data-range="end_weight_result" name="end_weight" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->end_weight != null ) echo $ciPagination->model->end_weight ?>" class="form-control" data-search style="font-size: 12px;">
                                </div>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="end_weight">
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
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" disabled>Selected Product(s)</button>
                    <a href="javascript:void(0);" id="hold_product_order_temp_list_btn" class="btn btn-sm btn-success" style="color:#FFF;">
                        <span class="glyphicon glyphicon-plus"></span>
                        Hold to order temp list
                    </a>
                    <a href="javascript:void(0);" data-name="order_4_wholesaler_btn" class="btn btn-sm btn-success" style="color:#FFF;">
                        <span class="glyphicon glyphicon-paste"></span>
                        Order for wholesaler
                    </a>
                    <?php if($_SESSION['manager']['role']=='administrator'){ ?>
                        <a href="javascript:void(0);" id="delete_product_btn" class="btn btn-sm btn-success" style="color:#FFF;">
                            <span class="glyphicon glyphicon-trash"></span>
                            Delete
                        </a>
                    <?php } ?>
                </div><!-- /input-group -->

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" disabled>Searched Product(s)</button>
                    <a href="javascript:void(0);" id="export_btn" class="btn btn-sm btn-success" style="color:#FFF;">
                        <span class="glyphicon glyphicon-save-file"></span>
                        Export to CSV
                    </a>
                </div><!-- /input-group -->

                <br/><br/>

                <div class="form-group">
                    <a id="order_temp_list_btn" class="btn btn-info btn-sm" data-is-expand="false">
                        <span data-name="order_temp_list_span" class="glyphicon glyphicon-menu-down"></span>
                        Order temp list
                        &nbsp;
                        <span class="badge"><?php echo $orderTempListCount ?></span>
                        <span data-name="order_temp_list_span" class="glyphicon glyphicon-menu-down"></span>
                    </a>
                </div>

                <div class="form-group" id="order_temp_list_div" style="display:none;"></div>

            </div>

            <div>
                <table class="table table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="12" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="product_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Filtered: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Item Code</th>
                            <th>Location</th>
                            <th>Model</th>
                            <th>SN</th>
                            <th>Price</th>
                            <th>Processor</th>
                            <th>Performance Status</th>
                            <th>Status</th>
                            <th>Locked</th>
                            <th>Ordered</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $product ):?>
                        <tr class="<?php echo $index%2==0 ? 'success' : '' ?>">
                            <td>
                                <input type="checkbox" data-name="product_checkbox" data-product-id="<?php echo $product->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/warehouse/product/edit/id/<?php echo $product->id ?>" class="btn btn-xs btn-success">
                                    <?php echo $product->item_code ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
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
                                <?php echo sprintf("%01.2f",$product->price); ?>
                            </td>
                            <td>
                                <?php echo $product->processor ?>
                            </td>
                            <td>
                                <?php echo $product->performance_status ?>
                            </td>
                            <td>
                                <?php echo $product->product_status ?>
                            </td>
                            <td>
                                <?php echo $product->is_locked == 'Y' ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <?php echo $product->is_ordered == 'Y' ? 'Yes' : 'No' ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                     Please add some products by:
                                     <a href="/manager/warehouse/product/add" style="font-weight:bold;">Add</a> product or
                                     <a href="/manager/warehouse/product/batch_file/view" style="font-weight:bold;">upload</a> product batch file
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
</div>

<!-- Modal -->
<form class="form-horizontal">
<div class="modal fade" id="order4WholesalerModal" tabindex="-1" role="dialog" aria-labelledby="order4WholesalerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="order4WholesalerModalLabel">Order for specified wholesaler</h4>
            </div>
            <div class="modal-body" style="height:420px; overflow-x:hidden; overflow-y:scroll;">
                <div class="form-group">
                    <label for="selected_wholesaler" class="col-md-4 control-label">Wholesaler</label>
                    <div class="col-md-8">
                        <input type="hidden" id="recent_wholesaler" />
                        <select id="selected_wholesaler" class="form-control">
                            <option></option>
                            <?php foreach ($wholesalers as $wholesaler) { ?>
                                <option value="<?php echo $wholesaler->id ?>"><?php echo $wholesaler->company_name ?>&nbsp;-&nbsp;<?php echo $wholesaler->first_name ?>&nbsp;<?php echo $wholesaler->last_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" id="order_product_from" value="standard" />
                    <label class="col-md-4 control-label">Order Product From</label>
                    <div class="col-md-8">
                        <label style="cursor:pointer;"><input type="radio" name="order_product_from_radio" value="standard" checked />&nbsp;<span style="font-weight:normal;">Standard</span></label>&nbsp;
                        <label style="cursor:pointer;"><input type="radio" name="order_product_from_radio" value="order_temp_list" />&nbsp;<span style="font-weight:normal;">Order Temp List</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Order Temp List</label>
                    <div class="col-md-8">
                        <div class="col-md-12" id="order_temp_list_choose_div" style="height:60px; overflow-y:scroll; border:1px solid #ccc; border-radius: 4px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="shipping_method" value="Shipping" />
                    <label class="col-md-4 control-label">Shipping Method</label>
                    <div class="col-md-8">
                        <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Pick Up" checked />&nbsp;<span style="font-weight:normal;">Pick Up</span></label>&nbsp;
                        <label style="cursor:pointer;"><input type="radio" name="shipping_method_radio" value="Shipping" />&nbsp;<span style="font-weight:normal;">Shipping</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="shipping_area" />
                    <input type="hidden" name="receiver_address" />
                    <label class="col-md-4 control-label">Shipping Area</label>
                    <div class="col-md-8">
                        <div class="col-md-12" id="shipping_area_div" style="height:60px; overflow-y:scroll; border:1px solid #ccc; border-radius: 4px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="courier_and_pricing" />
                    <label class="col-md-4 control-label">Courier And Pricing</label>
                    <div class="col-md-8">
                        <div class="col-md-12" id="courier_and_pricing_div" style="height:60px; overflow-y:scroll; border:1px solid #ccc; border-radius: 4px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Ordering Total</label>
                    <div class="col-md-8" style="font-size: 12px;">
                        <div class="col-md-12" style="margin-bottom:0px;">
                            <label class="control-label col-md-8">Net charges</label>
                            <div class="col-md-4" style="padding-right:0;">
                                <p class="form-control-static pull-right" id="total_amount_p"></p>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom:0px;">
                            <label class="control-label col-md-8">GST</label>
                            <div class="col-md-4" style="padding-right:0;">
                                <p class="form-control-static pull-right" id="gst_p"></p>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom:0px;">
                            <label class="control-label col-md-8">Shipping Fee</label>
                            <div class="col-md-4" style="padding-right:0;">
                                <p class="form-control-static pull-right" id="shipping_fee_p"></p>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom:0px;">
                            <label class="control-label col-md-8">Product Include GST</label>
                            <div class="col-md-4" style="padding-right:0;">
                                <p class="form-control-static pull-right" id="total_amount_gst_p"></p>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom:0px;">
                            <label class="control-label col-md-8">Total Amount</label>
                            <div class="col-md-4" style="padding-right:0;">
                                <p class="form-control-static pull-right" id="total_amount_gst_shipping_fee_p"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="order4WholesalerConfirm">Order</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteProductModalLabel">Delete product(s)</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected product(s)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" id="deleteProductConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="holdToOrderTempListModal" tabindex="-1" role="dialog" aria-labelledby="holdToOrderTempListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="holdToOrderTempListModalLabel">Hold product(s)</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label style="cursor:pointer;">
                        <input type="radio" name="temp_list_type" value="new" checked/> New temp list
                    </label>
                    &nbsp;&nbsp;
                    <label style="cursor:pointer;">
                        <input type="radio" name="temp_list_type" value="existed" /> Existed temp list
                    </label>
                </div>

                <div id="order_temp_list_name_div" class="form-group" style="height:100px; overflow-y:scroll; overflow-x:hidden;">
                    <input type="text" id="order_temp_list_name" class="form-control" placeholder="Order temp list name, e.g. wholesaler detail: name, phone, etc..." />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-success" id="holdToOrderTempListConfirm">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderTempListProductsModal" tabindex="-1" role="dialog" aria-labelledby="orderTempListProductsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="orderTempListProductsModalLabel"></h4>
            </div>
            <div class="modal-body" id="order_temp_list_products_div" style="height:400px; overflow-y:scroll; overflow-x:hidden;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteOrderTempListModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderTempListLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteOrderTempListModalLabel">Delete Order Temp List</h4>
            </div>
            <div class="modal-body">
                Sure to delete selected order temp list?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="deleteOrderTempListConfirm">Sure</button>
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
<script src="/resources/manager/js/warehouse/product/view_product_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
