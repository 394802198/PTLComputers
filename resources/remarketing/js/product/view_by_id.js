/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#add_to_cart').click(function()
    {
		var product_id = $('#product_id').val();
		var product_status = $('#product_status').val();
		var item_code = $('#item_code').val();
		var location = $('#location').val();
		var type = $('#type').val();
		var price = $('#price').val();
		var manufacturer_name = $('#manufacturer_name').val();
		var model = $('#model').val();
		var sn = $('#sn').val();
		var processor = $('#processor').val();
		var processor_speed = $('#processor_speed').val();
		var mem_size = $('#mem_size').val();
		var hdd_size = $('#hdd_size').val();
		var visual_status = $('#visual_status').val();
		var performance_status = $('#performance_status').val();
		var optical_drive = $('#optical_drive').val();
		var system_license = $('#system_license').val();
		var notes = $('#notes').val();
		var faults = $('#faults').val();
		
		var data = {
			'id':product_id,
			'product_status':product_status,
			'item_code':item_code,
			'location':location,
			'type':type,
			'price':price,
			'manufacturer_name':manufacturer_name,
			'model':model,
			'sn':sn,
			'processor':processor,
			'processor_speed':processor_speed,
			'mem_size':mem_size,
			'hdd_size':hdd_size,
			'visual_status':visual_status,
			'performance_status':performance_status,
			'optical_drive':optical_drive,
			'system_license':system_license,
			'notes':notes,
			'faults':faults
		};
		
		$.post('/remarketing/product/action/session/add_to_cart', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
		});
		
	});
	
})(jQuery);