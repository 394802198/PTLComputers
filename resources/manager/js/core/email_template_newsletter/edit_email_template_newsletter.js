/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#edit_email_template_newsletter').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var email_template_newsletter_id = $('#email_template_newsletter_id').val();
        var subject = $('#subject').val();
        var body = encodeURI(editor.html());

        var data =
        {
            'id'            :   email_template_newsletter_id,
            'subject'       :   subject,
            'body'          :   body
        };
		
        $.post('/manager/core/email_template_newsletter/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);