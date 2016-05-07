/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($){
	
	$('#account').keyup(function()
    {
		var account = $('#account').val();
		var data = {
			'account':account
		};
		
		$.post('/manager/e_store/customer/action/session/check_account_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json');
		
	});
	
	$('#add_customer').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var account = $('#account').val();
		var password = $('#password').val();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var company_name = $('#company_name').val();
		var email = $('#email').val();
		var fixed_phone = $('#fixed_phone').val();
		var mobile_phone = $('#mobile_phone').val();
		var fax_no = $('#fax_no').val();
        var country = $('#country').val();
        var province = $('#province').val();
		var city = $('#city').val();
        var address = $('#address').val();
        var post = $('#post').val();

		var data = {
			'account':account,
			'password':password,
			'first_name':first_name,
			'last_name':last_name,
			'company_name':company_name,
			'email':email,
			'fixed_phone':fixed_phone,
			'mobile_phone':mobile_phone,
			'fax_no':fax_no,
            'country':country,
            'province':province,
			'city':city,
            'address':address,
            'post':post
		};
		
		$.post('/manager/e_store/customer/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);