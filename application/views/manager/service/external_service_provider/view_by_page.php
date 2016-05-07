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
    background: #286090;
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
    background: #286090;
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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-primary">Home</a></li>
                    <li><a href="/manager#service_panel" class="text-primary">Service</a></li>
                    <li class="active">External Service Provider</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="/manager/service/external_service_provider/add" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-plus" ></span>
                            Add External Service Provider
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12" style="padding:50px;">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->name != null ) echo $ciPagination->model->name ?>" name="name" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="name">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="phone" class="col-md-2 control-label">Phone</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->phone != null ) echo $ciPagination->model->phone ?>" name="phone" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="phone">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">Email</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->email != null ) echo $ciPagination->model->email ?>" name="email" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="email">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                        <label for="address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input type="text" value="<?php if( $ciPagination != null && $ciPagination->model != null && $ciPagination->model->address != null ) echo $ciPagination->model->address ?>" name="address" data-search class="form-control" />
                                <a href="javascript:void(0);" class="input-group-addon" data-remove-search-by data-remove="address">
                                    <span class="glyphicon glyphicon-trash text-danger"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br/><br/>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="javascript:void(0);" id="search_btn" class="btn btn-sm btn-primary">
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
               <a href="javascript:void(0);" id="delete_external_service_provider_btn" class="btn btn-sm btn-primary">
                   <span class="glyphicon glyphicon-trash"></span>
                   Delete selected external service provider
               </a>
            </div>
            <div>
                <table class="table  table-condensed" style="font-size:12px;">
                    <?php if( isset( $ciPagination ) && $ciPagination->content != null ){ ?>
                    <thead >
                        <tr>
                            <th colspan="6" style="font-size:20px; line-height:30px;">
                                <input type="checkbox" data-name="external_service_provider_checkbox_all" />&nbsp;<strong>←</strong>&nbsp;Click the box to check all
                                <span class="pull-right">
                                Total Items: <?php echo $ciPagination->total_item_rows ?>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                Searched Items: <?php echo $ciPagination->total_searched_rows ?>&nbsp;&nbsp;</span>
                            </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-center" width="20%">Name</th>
                            <th class="text-center" width="20%">Phone</th>
                            <th class="text-center" width="20%">Email</th>
                            <th class="text-center" width="30%">Address</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ciPagination->content as $index => $externalServiceProvider ): ?>
                        <tr class="<?php echo $index%2==0 ? 'primary' : '' ?> text-center" style="word-break:break-all;">
                            <td class="text-left">
                                <input type="checkbox" data-name="external_service_provider_checkbox" data-external-service-provider-id="<?php echo $externalServiceProvider->id ?>" />
                            </td>
                            <td>
                                <a href="/manager/service/external_service_provider/edit/id/<?php echo $externalServiceProvider->id ?>" class="btn btn-primary btn-xs">
                                    <?php echo $externalServiceProvider->name ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $externalServiceProvider->phone ?>
                            </td>
                            <td>
                                <?php echo $externalServiceProvider->email ?>
                            </td>
                            <td style="word-break:break-all;">
                                <?php echo $externalServiceProvider->address ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    <?php } else { ?>
                        <tfoot>
                            <div style="text-align:center;">
                                <div class="alert alert-primary col-md-10 col-md-offset-1" style="margin-top:20px; margin-bottom:20px;">
                                    External Service Provider is empty, please click the button at the top right of this page to add one
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
<div class="modal fade" id="deleteExternalServiceProviderModal" tabindex="-1" role="dialog" aria-labelledby="deleteExternalServiceProviderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteExternalServiceProviderModalLabel">Delete External Service Provider</h4>
      </div>
      <div class="modal-body">
        Sure to delete selected external service provider?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteExternalServiceProviderConfirm">Delete</button>
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
<script src="/resources/manager/js/service/external_service_provider/view_by_page.js"></script>
<!-- END CUSTOMIZED LIB -->
