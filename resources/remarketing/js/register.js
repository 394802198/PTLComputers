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
		
		$.post('/remarketing/wholesaler/action/session_less/check_loginaccount_duplicate', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
		});
	});
	
	$('#add_wholesaler').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var login_account = $('#login_account').val();
		var login_password = $('#login_password').val();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var company_name = $('#company_name').val();
		var email = $('#email').val();
		var landline_phone = $('#landline_phone').val();
		var mobile_phone = $('#mobile_phone').val();
		var fax_no = $('#fax_no').val();
		var street = $('#street').val();
		var area = $('#area').val();
		var city = $('#city').val();
		var country = $('#country').val();
		var security_question = $('#security_question').val();
		var security_answer = $('#security_answer').val();
		
		var data = {
			'login_account':login_account,
			'login_password':login_password,
			'first_name':first_name,
			'last_name':last_name,
			'company_name':company_name,
			'email':email,
			'landline_phone':landline_phone,
			'mobile_phone':mobile_phone,
			'fax_no':fax_no,
			'street':street,
			'area':area,
			'city':city,
			'country':country,
			'security_question':security_question,
			'security_answer':security_answer
		};
		
		$.post('/remarketing/wholesaler/action/session_less/add', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors )
            {
                setTimeout(function() {
                    window.location.href = '/remarketing/login';
                }, 1000);
            }
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);