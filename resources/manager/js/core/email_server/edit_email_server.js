/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){
	
	$('#edit_email_server').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var email_server_id = $('#email_server_id').val();
        var host = $('#host').val();
        var host_name = $('#host_name').val();
        var is_ssl = $('#is_ssl').val();
        var port = $('#port').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var reply = $('#reply').val();
        var reply_name = $('#reply_name').val();
        var from_name = $('#from_name').val();
        var is_use_default = $('#is_use_default').val();
        var purpose = $('#purpose').val();

        var data =
        {
            'id'            :   email_server_id,
            'host'          :   host,
            'host_name'     :   host_name,
            'is_ssl'        :   is_ssl,
            'port'          :   port,
            'username'      :   username,
            'password'      :   password,
            'reply'         :   reply,
            'reply_name'    :   reply_name,
            'from_name'     :   from_name,
            'is_use_default':   is_use_default,
            'purpose'       :   purpose
        };
		
        $.post('/manager/core/email_server/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);