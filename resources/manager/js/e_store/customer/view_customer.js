/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($){

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="delete_customer"]').click(function()
    {
		$('#deleteCustomerConfirm').attr('data-customer-id',$(this).attr('data-customer-id'));
		$('#deleteCustomerModal').modal('show');
	});
	
	$('#deleteCustomerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-customer-id')
		};
		
		$.post('/manager/e_store/customer/action/session/delete', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/e_store/customer/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
	$('a[data-name="activate_customer"]').click(function()
    {
		$('#activateCustomerConfirm').attr('data-customer-id',$(this).attr('data-customer-id'));
		$('#activateCustomerModal').modal('show');
		
	});
	
	$('#activateCustomerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-customer-id')
		};
		
		$.post('/manager/e_store/customer/action/session/activate', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/e_store/customer/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
	$('a[data-name="inactivate_customer"]').click(function()
    {
		$('#inactivateCustomerConfirm').attr('data-customer-id',$(this).attr('data-customer-id'));
		$('#inactivateCustomerModal').modal('show');
		
	});
	
	$('#inactivateCustomerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-customer-id')
		};
		
		$.post('/manager/e_store/customer/action/session/inactivate', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/e_store/customer/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);