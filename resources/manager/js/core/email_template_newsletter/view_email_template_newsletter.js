/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){



    $('#sendEmailTemplateNewsletterToConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var email_template_id = $(this).attr('data-email-template-id');
        var to = $(this).attr('data-type');

        var data =
        {
            id      :   email_template_id,
            to      :   to
        };

        $.post('/manager/core/email_template_newsletter/action/session/send_to', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/core/email_template_newsletter/view'
            });

        }, 'json').always(function () { $btn.button('reset'); });
    });

    $('[data-name="send_to"]').click(function()
    {
        var to = $(this).attr('data-type');
        var send_to_span_preview = '';

        switch( to )
        {
            case 'e_store_customer' :
                send_to_span_preview = 'EStore Customers';
                break;
            case 'e_store_subscriber' :
                send_to_span_preview = 'EStore Subscribers';
                break;
            case 'remarketing_wholesaler' :
                send_to_span_preview = 'Remarketing Wholesalers';
                break;
        }

        $('#send_to_span_preview').html( send_to_span_preview );

        $('#sendEmailTemplateNewsletterToConfirm').attr('data-email-template-id', $(this).attr('data-email-template-id')).attr('data-type', to);
        $('#sendEmailTemplateNewsletterToModal').modal('show');
    });


	
	$('a[data-name="delete_email_template_newsletter"]').click(function()
    {
		$('#deleteEmailTemplateNewsletterConfirm').attr('data-email-template-newsletter-id',$(this).attr('data-email-template-newsletter-id'));
		$('#deleteEmailTemplateNewsletterModal').modal('show');
		
	});
	
	$('#deleteEmailTemplateNewsletterConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-email-template-newsletter-id')
		};
		
		$.post('/manager/core/email_template_newsletter/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/core/email_template_newsletter/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);