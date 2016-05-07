<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <ol class="breadcrumb" style="margin: 0;">
                    <li><a href="/manager" class="text-success">Home</a></li>
                    <li><a href="/manager#warehouse_panel" class="text-success">Warehouse</a></li>
                    <li class="active">Product Batch File</li>
                    <li class="pull-right" id="breadcrumb-li">
                        <a href="javascript:void(0);" data-name="uploadProductBatchFile" class="btn btn-xs btn-success" style="color:#FFF;">Upload Product Batch File</a>
                    </li>
                </ol>
            </div>
            <?php if( $productBatchFiles && count( $productBatchFiles ) > 0 ) { ?>
                <table class="table">
                    <thead >
                    <tr>
                        <th>&nbsp;</th>
                        <th>File Name</th>
                        <th>Import Date</th>
                        <th>Is Imported</th>
                        <th>File Existed</th>
                        <th>Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($productBatchFiles as $productBatchFile):?>
                        <tr class="">
                            <td>&nbsp;</td>
                            <td>
                                <?php echo $productBatchFile->file_name_ori ?>
                            </td>
                            <td>
                                <?php echo $productBatchFile->upload_date ?>
                            </td>
                            <td>
                                <?php echo strcasecmp($productBatchFile->is_imported, 'Y') == 0 ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <?php echo strcasecmp($productBatchFile->is_file_existed, 'Y') == 0 ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <?php if( ! strcasecmp($productBatchFile->is_imported, 'Y') == 0 ){?>
                                    <a href="javascript:void(0);" data-name="importProductBatchFile" data-product-batch-file-id="<?php echo $productBatchFile->id ?>" class="btn btn-xs btn-success">Import</a>
                                <?php } else { ?>
                                    <a href="javascript:void(0);" data-name="deleteProductBatchFile" data-product-batch-file-id="<?php echo $productBatchFile->id ?>" class="btn btn-xs btn-success">Delete imported product</a>
                                <?php }?>
                                <a href="javascript:void(0);" data-name="downloadProductBatchFile" data-product-batch-file-id="<?php echo $productBatchFile->id ?>" class="btn btn-xs btn-success">Download File</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadProductBatchFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadProductBatchFileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="uploadProductBatchFileModalLabel">Upload product batch file</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="product_batch_file_form">
            <input type="file" name="productBatchFileInput" id="productBatchFileInput" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-success" id="uploadProductBatchFileConfirm">Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importProductBatchFileModal" tabindex="-1" role="dialog" aria-labelledby="importProductBatchFileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="importProductBatchFileModalLabel">Import product from batch file</h4>
      </div>
      <div class="modal-body">
          Sure to import product from this batch file?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-success" id="importProductBatchFileConfirm">Import</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteProductBatchFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductBatchFileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteProductBatchFileModalLabel">Delete related product(s) from database</h4>
      </div>
      <div class="modal-body">
          Sure to delete related product(s) from the database?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-success" id="deleteProductBatchFileConfirm">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<script src="/resources/global/js/ajaxfileupload.js"></script>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->


<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/warehouse/product/view_product_batch_file.js"></script>
<!-- END CUSTOMIZED LIB -->
