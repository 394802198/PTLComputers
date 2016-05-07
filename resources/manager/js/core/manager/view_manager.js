/*
 *		Author: Steven Chen
 *		Date: Apr 2015
 */

(function($){
	
	$('a[data-name="delete_manager"]').click(function()
    {
		$('#deleteManagerConfirm').attr('data-manager-id',$(this).attr('data-manager-id'));
		$('#deleteManagerModal').modal('show');
		
	});
	
	$('#deleteManagerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-manager-id')
		};
		
		$.post('/manager/core/manager/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/core/manager/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);