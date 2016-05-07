/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */
/**
 * Upgraded Date: Sep 2015
 * By: Steven
 */

(function($){

	$('#login_account, #login_password').keypress(function(e)
    {
	    if(e.which == 13) {
	    	$('#signin-btn').click();
	    }
	});

	$('#signin-btn').on("click", function()
    {
		var $btn = $(this);
		$btn.button('loading');
		var data = {
			login_account: $('#login_account').val()
			, login_password: $('#login_password').val()
		};
		$.post('/manager/core/manager/action/session_less/login', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager'
            });

		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);