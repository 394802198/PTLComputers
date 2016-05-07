/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){

    $('[name="start_create_date"], [name="end_create_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2
    });

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});
	
	$('input[data-name="shipment_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="shipment_checkbox"]').iCheck('check');
	});
	$('input[data-name="shipment_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="shipment_checkbox"]').iCheck('uncheck');
	});

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/remarketing/shipment/view_by/pagination'
    } );
	
	$('#delete_shipment_btn').click(function()
    {
		$('#deleteShipmentWithDetailModal').modal('show');
	});
	
	$('#deleteShipmentWithDetailConfirm').click(function()
    {
		var shipment_ids = new Array();
		
		$('input[data-name="shipment_checkbox"]:checked').each(function()
        {
			shipment_ids.push($(this).attr('data-shipment-id'));
		});
		
		var data = {
			'shipment_ids':shipment_ids
		};

		$.post('/manager/remarketing/shipment/action/session/delete_batch', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/remarketing/shipment/view_by/pagination';
                }, 1000);
            }
		}, 'json');
		
	});


    $('button[data-name="switchShipmentStatusBtn"]').click(function()
    {
        $('#switchShipmentStatusModal').modal('show');
        $('#shipNumber').html( $(this).attr('data-shipment-ship-number') );
        $('#fromStatusSpan').html( $(this).attr('data-shipment-from-status') );
        $('#toStatusSpan').html( $(this).attr('data-shipment-to-status') );

        $('#switchShipmentStatusConfirm')
            .attr( 'data-shipment-id', $(this).attr('data-shipment-id'))
            .attr( 'data-shipment-status', $(this).attr('data-shipment-status') );

    });

    $('#switchShipmentStatusConfirm').click(function()
    {
        var data =
        {
            'id'            :   $(this).attr('data-shipment-id'),
            'ship_status'   :   $(this).attr('data-shipment-status')
        };

        $.post('/manager/remarketing/shipment/action/session/switch_status', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/remarketing/shipment/view_by/pagination';
                }, 1000);
            }
        }, 'json');
    });

    $('#switchShipmentStatusBatchBtn').click(function()
    {
        $('#switchShipmentStatusBatchModal').modal('show');
    });

    $('#switchShipmentStatusBatchConfirm').click(function()
    {
        var shipment_ids = new Array();

        $('input[data-name="shipment_checkbox"]:checked').each(function()
        {
            shipment_ids.push($(this).attr('data-shipment-id'));
        });

        var data = {
            'shipment_ids'  :   shipment_ids,
            'ship_status'   :   $('#shipStatusSelector').val()
        };

        $.post('/manager/remarketing/shipment/action/session/switch_status_batch', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/remarketing/shipment/view_by/pagination';
                }, 1000);
            }
        }, 'json');

    });
	
	
})(jQuery);