/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#login_account').keyup(function()
    {
		var manager_id = $('#manager_id').val();
		var login_account = $('#login_account').val();
		var data = {
			'id':manager_id,
			'login_account':login_account
		};
		
		$.post('/manager/core/manager/action/session/check_edit_loginaccount_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

		}, 'json');
		
	});
	
	$('#edit_manager').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var manager_id = $('#manager_id').val();
		var login_account = $('#login_account').val();
		var login_password = $('#login_password').val();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var role = $('#role').val();
		
		var data = {
			'id':manager_id,
			'login_account':login_account,
			'login_password':login_password,
			'first_name':first_name,
			'last_name':last_name,
			'role':role
		};
		
		$.post('/manager/core/manager/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);