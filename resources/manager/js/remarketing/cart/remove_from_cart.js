/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="deleteCartDetail"]').click(function()
    {
		$('#removeCartDetailConfirm').attr('data-cart-detail-id',$(this).attr('data-cart-detail-id'));
		$('#deleteCartDetailModal').modal('show');
		
	});
	$('#removeCartDetailConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var cart_id = $(this).attr('data-cart-id');
		
		var data = {
            'id':$(this).attr('data-cart-detail-id'),
			'cart_id':cart_id
		};

		$.post('/manager/remarketing/cart/action/session/remove_detail_from_cart', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 	 			if(resultObj.model.is_cart_empty){
 	 				window.location.href = '/manager/remarketing/cart/view';
 	 			} else {
 	 				window.location.href = '/manager/remarketing/cart/edit/id/'+cart_id;
 	 			}
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
	$('a[data-name="emptyCart"]').click(function(){
		$('#emptyCartModal').modal('show');
	});
	$('#emptyCartConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-cart-id')
		}

		$.post('/manager/remarketing/cart/action/session/empty_cart', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/remarketing/cart/view';
                }, 1000);
            }
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);