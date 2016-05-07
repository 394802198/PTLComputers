/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('a[data-name="delete_email_template_system"]').click(function()
    {
		$('#deleteEmailTemplateSystemConfirm').attr('data-email-template-system-id',$(this).attr('data-email-template-system-id'));
		$('#deleteEmailTemplateSystemModal').modal('show');
		
	});
	
	$('#deleteEmailTemplateSystemConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-email-template-system-id')
		};
		
		$.post('/manager/core/email_template_system/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/core/email_template_system/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);