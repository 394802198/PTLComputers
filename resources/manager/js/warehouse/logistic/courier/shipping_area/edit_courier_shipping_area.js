/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){

    $('#name').keyup(function()
    {
        var shipping_area_id = $('#shipping_area_id').val();
        var name = $('#name').val();
        var data = {
            'id':shipping_area_id,
            'name':name
        };

        $.post('/manager/warehouse/logistic/courier/shipping_area/action/session/check_edit_name_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json');

    });
	
	$('#edit_courier_shipping_area').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var shipping_area_id = $('#shipping_area_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':shipping_area_id,
			'name':name
		};
		
		$.post('/manager/warehouse/logistic/courier/shipping_area/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);