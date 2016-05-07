/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#edit_email_template_system').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var email_template_system_id = $('#email_template_system_id').val();
        var subject = $('#subject').val();
        var body = $('#body').val();
        var purpose = $('#purpose').val();

        var data =
        {
            'id'            :   email_template_system_id,
            'subject'       :   subject,
            'body'          :   body,
            'purpose'       :   purpose
        };
		
        $.post('/manager/core/email_template_system/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);