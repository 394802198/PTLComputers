/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('a[data-name="delete_email_server"]').click(function()
    {
		$('#deleteEmailServerConfirm').attr('data-email-server-id',$(this).attr('data-email-server-id'));
		$('#deleteEmailServerModal').modal('show');
		
	});
	
	$('#deleteEmailServerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-email-server-id')
		};
		
		$.post('/manager/core/email_server/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/core/email_server/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);