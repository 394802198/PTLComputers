/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#add_email_template_system').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var subject = $('#subject').val();
        var body = $('#body').val();
        var purpose = $('#purpose').val();

        var data =
        {
            'subject'       :   subject,
            'body'          :   body,
            'purpose'       :   purpose
        };
		
		$.post('/manager/core/email_template_system/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);