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
                    <li class="active">Advertisement</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/e_store/cms/advertisement/add" class="btn btn-xs btn-warning">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add Advertisement
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
               <a href="javascript:void(0);" id="delete_advertisement_btn" class="btn btn-sm btn-warning">
                   <span class="glyphicon glyphicon-trash"></span>
                   Delete selected advertisement
               </a>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="6" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="advertisement_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
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
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $advertisement ): ?>
                            <?php

                                $width = '';
                                if( in_array( $advertisement->position, array( 100, 103 ) ) ) $width = '400px';
                                if( in_array( $advertisement->position, array( 101, 102 ) ) ) $width = '200px';
                                if( in_array( $advertisement->position, array( 104, 105 ) ) ) $width = '300px';

                                $height = strcasecmp( $width, '200px' )==0 ? '300px' : 'auto';

                            ?>
                        <tr class="<?php echo $index%2==0 ? 'warning' : '' ?> text-center" style="word-break:break-all;">
                            <td class="text-left">
                                <input type="checkbox" data-name="advertisement_checkbox" data-advertisement-id="<?php echo $advertisement->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/e_store/cms/advertisement/edit/id/<?php echo $advertisement->id ?>" class="img-thumbnail">
                                    <img data-name="picture" src="<?php echo $advertisement->img_path ? '/' .$advertisement->img_path : '/resources/global/image/default_img.svg' ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">
                                </a>
                            </td>
                            <td>
                                <?php echo $advertisement->brief_introduction ?>
                            </td>
                            <td>
                                <?php

                                        $page_types = array
                                        (
                                            100 =>  'Home', 101 => 'Product Search', 102 => 'Product Detail',
                                            103 => 'My Cart', 108 => 'Dashboard', 109 => 'My Profile',
                                            110 => 'Change Credential', 111 => 'My Order', 112 => 'Receiver Address',
                                            113 => 'My Cart', 114 => 'Shipment Tracking', 115 => 'My Wish List',
                                            200 => 'Custom Page'
                                        );

                                        echo $page_types[ $advertisement->page_type ];
                                ?>
                            </td>
                            <td>
                                <?php

                                        $positions = array(
                                            100 => 'Page Top', 101 => 'Page Left', 102 => 'Page Right',
                                            103 => 'Page Bottom', 104 =>  'Header Bottom', 105 => 'Footer Top'
                                        );

                                        echo $positions[ $advertisement->position ];
                                ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-warning col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                    Advertisement is empty, please click the button at the top right of this page to add advertisements
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
<div class="modal fade" id="deleteAdvertisementModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdvertisementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteAdvertisementModalLabel">Delete advertisement</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected advertisement?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deleteAdvertisementConfirm">Delete</button>
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
<script src="/resources/manager/js/e_store/cms/advertisement/view_advertisement_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
