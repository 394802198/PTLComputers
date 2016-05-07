/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="delete_wholesaler"]').click(function()
    {
		$('#deleteWholesalerConfirm').attr('data-wholesaler-id',$(this).attr('data-wholesaler-id'));
		$('#deleteWholesalerModal').modal('show');
	});
	
	$('#deleteWholesalerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-wholesaler-id')
		};
		
		$.post('/manager/remarketing/wholesaler/action/session/delete', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/remarketing/wholesaler/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
	$('a[data-name="activate_wholesaler"]').click(function()
    {
		$('#activateWholesalerConfirm').attr('data-wholesaler-id',$(this).attr('data-wholesaler-id'));
		$('#activateWholesalerModal').modal('show');
		
	});
	
	$('#activateWholesalerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-wholesaler-id')
		};
		
		$.post('/manager/remarketing/wholesaler/action/session/activate', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/remarketing/wholesaler/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
	$('a[data-name="inactivate_wholesaler"]').click(function()
    {
		$('#inactivateWholesalerConfirm').attr('data-wholesaler-id',$(this).attr('data-wholesaler-id'));
		$('#inactivateWholesalerModal').modal('show');
		
	});
	
	$('#inactivateWholesalerConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-wholesaler-id')
		};
		
		$.post('/manager/remarketing/wholesaler/action/session/inactivate', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/remarketing/wholesaler/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);