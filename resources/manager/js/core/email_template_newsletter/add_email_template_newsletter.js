/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#add_email_template_newsletter').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var subject = $('#subject').val();
        var body = encodeURI(editor.html());

        var data =
        {
            'subject'       :   subject,
            'body'          :   body
        };
		
		$.post('/manager/core/email_template_newsletter/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);