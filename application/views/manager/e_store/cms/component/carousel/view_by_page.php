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
    background: #f0ad4e;
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
    background: #f0ad4e;
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
    background: #5bc0de;
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
        <div class="panel panel-warning">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-warning">Home</a></li>
                    <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                    <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                    <li><a href="/manager#e_store_panel" class="text-warning">Component</a></li>
                    <li class="active">Carousel</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/e_store/cms/component/carousel/add" class="btn btn-xs btn-warning">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Carousel
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="page_type" class="col-md-2 control-label">Page Type</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="page_type" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->page_type != null && $ciPagination->model->page_type != null && $ciPagination->model->page_type=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($page_types as $page_type) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->page_type != null && ( $ciPagination->model->page_type==$page_type['code'] && $ciPagination->model->page_type!='NULL' ) ) { ?>
                                            <option value="<?php echo $page_type['code'] ?>" selected><?php echo $page_type['name'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $page_type['code'] ?>"><?php echo $page_type['name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="page_type">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="position" class="col-md-2 control-label">Position</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select name="position" class="form-control" data-search>
                                    <option></option>
                                    <?php if( $ciPagination != null && $ciPagination->position != null && $ciPagination->model->position != null && $ciPagination->model->position=='NULL' ) { ?>
                                        <option value="NULL" selected>Search empty one</option>
                                    <?php } else { ?>
                                        <option value="NULL">Search empty one</option>
                                    <?php } ?>
                                    <option disabled>-----------------------</option>
                                    <?php foreach ($positions as $position) { ?>
                                        <?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->position != null && ( $ciPagination->model->position==$position['code'] && $ciPagination->model->position!='NULL' ) ) { ?>
                                            <option value="<?php echo $position['code'] ?>" selected><?php echo $position['name'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $position['code'] ?>"><?php echo $position['name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="position">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="brief_introduction" class="col-md-2 control-label">Brief Introduction</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->brief_introduction != null ) echo $ciPagination->model->brief_introduction ?>" name="brief_introduction" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="brief_introduction">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-sm btn-warning">
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
               <a href="javascript:void(0);" id="delete_carousel_btn" class="btn btn-sm btn-warning">
                   <span class="glyphicon glyphicon-trash"></span>
                   Delete selected carousel
               </a>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="6" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="carousel_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-center">Image</th>
                            <th class="text-center" width="30%">Brief Introduction</th>
                            <th class="text-center">Page Type</th>
                            <th class="text-center">Position</th>
                            <th class="text-center" width="13%">Sequence</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $carousel ): ?>
                        <tr class="<?php echo $index%2==0 ? 'warning' : '' ?> text-center" style="word-break:break-all;">
                            <td class="text-left">
                                <input type="checkbox" data-name="carousel_checkbox" data-carousel-id="<?php echo $carousel->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/e_store/cms/component/carousel/edit/id/<?php echo $carousel->id ?>" class="img-thumbnail">
                                    <img data-name="picture" src="<?php echo $carousel->img_path ? '/' .$carousel->img_path : '/resources/global/image/default_img.svg' ?>" width="400px" height="150px">
                                </a>
                            </td>
                            <td>
                                <?php echo $carousel->brief_introduction ?>
                            </td>
                            <td>
                                <?php

                                        $page_types = array(
                                            100 =>  'Home'
                                        );

                                        echo $page_types[ $carousel->page_type ];

                                ?>
                            </td>
                            <td>
                                <?php

                                        $positions = array(
                                            104 =>  'Header Bottom'
                                        );

                                        echo $positions[ $carousel->position ];

                                ?>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" data-sequence-input data-carousel-id="<?php echo $carousel->id ?>" value="<?php echo $carousel->sequence ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" data-name="update_sequence" data-carousel-id="<?php echo $carousel->id ?>" type="button">
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
                                    Carousel is empty, please click the button at the top right of this page to add carousels
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
<div class="modal fade" id="deleteCarouselModal" tabindex="-1" role="dialog" aria-labelledby="deleteCarouselModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteCarouselModalLabel">Delete carousel</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected carousel?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deleteCarouselConfirm">Delete</button>
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
<script src="/resources/manager/js/e_store/cms/component/carousel/view_carousel_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
