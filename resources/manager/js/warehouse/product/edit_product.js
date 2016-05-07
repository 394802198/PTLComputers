/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#item_code').keyup(function()
    {
		var product_id = $('#product_id').val();
		var item_code = $('#item_code').val();
		var data = {
			'id':product_id,
			'item_code':item_code
		};

		$.post('/manager/warehouse/product/action/session/check_edit_product_item_code_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json');
		
	});
	
	$('#edit_product').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var product_id = $('#product_id').val();
		var product_status = $('#product_status').val();
		var item_code = $('#item_code').val();
        var job_number = $('#job_number').val();
		var type = $('#type').val();
		var price = $('#price').val();
        var weight = $('#weight').val();
		var manufacturer_name = $('#manufacturer_name').val();
		var location = $('#location').val();
		var model = $('#model').val();
		var sn = $('#sn').val();
		var processor = $('#processor').val();
		var processor_speed = $('#processor_speed').val();
		var mem_size = $('#mem_size').val();
		var hdd_size = $('#hdd_size').val();
		var is_power_supply = $('#is_power_supply').val();
		var visual_status = $('#visual_status').val();
		var performance_status = $('#performance_status').val();
        var screen_size = $('#screen_size').val();
		var optical_drive = $('#optical_drive').val();
		var system_license = $('#system_license').val();
        var is_web_cam = $('#is_web_cam').val();
		var notes = $('#notes').val();
		var faults = $('#faults').val();
		
		var data = {
			'id':product_id,
			'product_status':product_status,
			'type':type,
			'manufacturer_name':manufacturer_name,
			'location':location,
			'item_code':item_code,
            'job_number':job_number,
			'visual_status':visual_status,
			'price':price,
            'weight':weight,
			'performance_status':performance_status,
            'screen_size':screen_size,
			'model':model,
			'sn':sn,
			'processor':processor,
			'processor_speed':processor_speed,
			'mem_size':mem_size,
			'hdd_size':hdd_size,
            'is_power_supply':is_power_supply,
			'optical_drive':optical_drive,
			'system_license':system_license,
            'is_web_cam':is_web_cam,
			'notes':notes,
			'faults':faults
		};
		
		$.post('/manager/warehouse/product/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);