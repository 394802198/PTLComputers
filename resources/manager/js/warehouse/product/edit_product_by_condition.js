/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#edit_product_by_condition').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

		var data = {};
		
		$('*[data-contidion-field]').each(function()
        {
			if($(this).val()!=''){
				data[$(this).attr('name')] = $(this).val();
			}
		});
		
		$('*[data-final-field]').each(function()
        {
			if($(this).val()!=''){
				data[$(this).attr('name')] = $(this).val();
			}
		});
		
		$.post('/manager/warehouse/product/action/session/edit_product_by_condition', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json').always(function(){ $btn.button('reset'); });
	});
	
})(jQuery);