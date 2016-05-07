/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('a[data-name="delete_courier"]').click(function()
    {
		$('#deleteCourierConfirm').attr('data-courier-id',$(this).attr('data-courier-id'));
		$('#deleteCourierModal').modal('show');
		
	});
	
	$('#deleteCourierConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-courier-id')
		};
		
		$.post('/manager/warehouse/logistic/courier/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/warehouse/logistic/courier/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);