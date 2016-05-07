/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('a[data-name="uploadProductBatchFile"]').click(function()
    {
		$('#uploadProductBatchFileModal').modal('show');
	});
	
	$('a[data-name="importProductBatchFile"]').click(function()
    {
		$('#importProductBatchFileModal').modal('show');
		$('#importProductBatchFileConfirm').attr('data-product-batch-file-id',$(this).attr('data-product-batch-file-id'));
	});
	$('a[data-name="deleteProductBatchFile"]').click(function()
    {
		$('#deleteProductBatchFileModal').modal('show');
		$('#deleteProductBatchFileConfirm').attr('data-product-batch-file-id',$(this).attr('data-product-batch-file-id'));
	});

	$('#product_batch_file_form').submit(function(e)
    {
		e.preventDefault();
		var fileName = $('#productBatchFileInput').val();
		// If no selected file
		if(fileName=='')
        {
			alert('Must select a file to continue!');
		}
        else
        {
			// Eliminate path
			fileName = fileName.substr(fileName.lastIndexOf('\\')+1);
			// Eliminate suffix
//			fileName = fileName.substr(0, fileName.lastIndexOf('.'));
			
			$.ajaxFileUpload({
				url 			:'/manager/warehouse/product/batch_file/action/session/upload',
				secureuri		:false,
				fileElementId	:'productBatchFileInput',
				dataType		: 'json',
				data			: {
					'title':fileName
				},
				success	: function (resultObj){
                    showResultToastr({
                        'resultObj': resultObj
                    });
		 			$('#uploadProductBatchFileModal').modal('hide');
                    if( ! resultObj.hasErrors)
                    {
                        setTimeout(function() {
                            window.location.href = '/manager/warehouse/product/batch_file/view';
                        }, 1000);
                    }
				},
				error	: function (resultObj){
                    showResultToastr({
                        'resultObj': resultObj
                    });
		 			$('#uploadProductBatchFileModal').modal('hide');
	 	 			setTimeout(function() {
                        window.location.href = '/manager/warehouse/product/batch_file/view';
	 	 			}, 1000);
				}
			});
			return false;
		}
	});
	
	$('#uploadProductBatchFileConfirm').click(function()
    {
		$('#product_batch_file_form').submit();
	});
	
	$('#importProductBatchFileConfirm').click(function()
    {
		var $btn = $(this);
		
		var data = {
			'id':$(this).attr('data-product-batch-file-id')
		};
		$btn.button('loading');
		$btn.attr('disabled',true);
		
		$.post('/manager/warehouse/product/batch_file/action/session/import', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
 			if( ! resultObj.hasErrors){
 	 			setTimeout(function() {
                    window.location.href = '/manager/warehouse/product/batch_file/view';
 	 			}, 1000);
 			}
 			$('#importProductBatchFileModal').modal('hide');
		}, 'json').always(function () { $btn.button('reset');  $btn.attr('disabled',false); });
	});
	
	$('#deleteProductBatchFileConfirm').click(function()
    {
		var $btn = $(this);
		
		var data = {
			'id':$(this).attr('data-product-batch-file-id')
		};
		$btn.button('loading');
		$btn.attr('disabled',true);
		
		$.post('/manager/warehouse/product/batch_file/action/session/delete_product_by_batch_file_id', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/warehouse/product/batch_file/view';
                }, 1000);
            }
 			$('#deleteProductBatchFileModal').modal('hide');
		}, 'json').always(function () { $btn.button('reset'); $btn.attr('disabled',false); });
	});

    $('[data-name="downloadProductBatchFile"]').click(function()
    {
        var data = {
            id  :   $(this).attr('data-product-batch-file-id')
        };
        $.post('/manager/warehouse/product/batch_file/action/session/download_single_file_verify', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/warehouse/product/batch_file/action/session/download_single_file?id=' + data.id;
                }, 1000);
            }

        }, 'json');
    });

})(jQuery);