/*
 *		Author: Steven Chen
 *	    Date: Apr 2016
 */

(function($){

    $(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
        checkboxClass : 'icheckbox_square-blue',
        radioClass : 'iradio_square-blue'
    });

    $('[name="start_created_at"], [name="end_created_at"],' +
    '[name="start_check_in_date"], [name="end_check_in_date"],' +
    '[name="start_check_out_date"], [name="end_check_out_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2
    });

	$('input[data-name="record_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="record_checkbox"]').iCheck('check');
	});
	$('input[data-name="record_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="record_checkbox"]').iCheck('uncheck');
	});

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/service/record/view_by/pagination'
    } );
	
	$('#delete_record_btn').click(function(){
		$('#deleteRecordModal').modal('show');
	});
	
	$('#deleteRecordConfirm').click(function()
    {
		var record_ids = new Array();
		
		$('input[data-name="record_checkbox"]:checked').each(function()
        {
            record_ids.push($(this).attr('data-record-id'));
		});
		
		var data = {
			'record_ids':record_ids
		};

		$.post('/manager/service/record/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});

    $('a[data-name="add_comment"]').click(function(){
        $('#addCommentConfirm').attr('data-record-id', $(this).attr('data-record-id'));
        $('#addCommentModal').modal('show');
    });


    $('#addCommentConfirm').click(function() {
        var $btn = $(this);
        $btn.button('loading');

        var record_id = $(this).attr('data-record-id');
        var comment_content = $('#comment_content').val();

        var data = {
            'record_id': record_id,
            'content': comment_content
        };

        $.post('/manager/service/record/action/session/add_comment', data, function (resultObj) {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
        }, 'json').always(function () {
            $btn.button('reset');
        });
    });


    })(jQuery);