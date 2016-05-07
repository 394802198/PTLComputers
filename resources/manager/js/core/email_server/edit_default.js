/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#edit_default').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var host = $('#host').val();
		var host_name = $('#host_name').val();
		var is_ssl = $('#is_ssl').val();
		var port = $('#port').val();
		var username = $('#username').val();
		var password = $('#password').val();
        var reply = $('#reply').val();
        var reply_name = $('#reply_name').val();
        var from_name = $('#from_name').val();
		
		var data =
        {
			'host'          :   host,
			'host_name'     :   host_name,
			'is_ssl'        :   is_ssl,
			'port'          :   port,
			'username'      :   username,
			'password'      :   password,
            'reply'         :   reply,
            'reply_name'    :   reply_name,
            'from_name'     :   from_name
		};
		
		$.post('/manager/core/email_server/action/session/edit_default', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);