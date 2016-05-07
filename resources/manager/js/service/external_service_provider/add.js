/*
 *		Author: Steven Chen
 *		Date: Apr 2016
 */

(function($){

	$('#add_external_service_provider').click(function()
    {
        var $btn = $(this);
		$btn.button('loading');

        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val();

		
		var data = {
			'name'      :   name,
            'phone'     :   phone,
            'email'     :   email,
            'address'   :   address
		};

        $.post('/manager/service/external_service_provider/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/service/external_service_provider/view_by/pagination'
            });
        }, 'json').always(function(){ $btn.button('reset'); });

	});
	
})(jQuery);