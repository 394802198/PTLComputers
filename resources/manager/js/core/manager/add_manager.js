/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#login_account').keyup(function()
    {
		var login_account = $('#login_account').val();
		var data = {
			'login_account':login_account
		};
		
		$.post('/manager/core/manager/action/session/check_loginaccount_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json');
		
	});
	
	$('#add_manager').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var login_account = $('#login_account').val();
		var login_password = $('#login_password').val();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var role = $('#role').val();
		
		var data = {
			'login_account':login_account,
			'login_password':login_password,
			'first_name':first_name,
			'last_name':last_name,
			'role':role
		};
		
		$.post('/manager/core/manager/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);