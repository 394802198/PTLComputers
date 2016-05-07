/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){

    /** 防止负数
     */
    $('[data-name="address_sequence"], [data-name="number_sequence"]').change(function()
    {
        var sequence = $(this);

        if( sequence.val() < 0 )
        {
            sequence.val(0);
        }
    });



    /**
     *
     * 工作时间 开始
     *
     */

    /** 删除
     */
    $('#deleteWorkingHourConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var data =
        {
            id          :   data_id
        };

        $.post('/manager/e_store/cms/configuration/contact_us/working_hour/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });
    $('[data-name="delete_working_hour_btn"]').click(function()
    {
        $('#deleteWorkingHourConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteWorkingHourModal').modal('show');
    });

    /** 编辑
     */
    $('[data-name="edit_working_hour_btn"]').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var name = $('[data-name="working_hour_name"][data-id="' + data_id + '"]').val();
        var time_range = $('[data-name="working_hour_time_range"][data-id="' + data_id + '"]').val();
        var sequence = $('[data-name="working_hour_sequence"][data-id="' + data_id + '"]').val();

        var data =
        {
            id          :   data_id,
            name        :   name,
            time_range  :   time_range,
            sequence    :   sequence
        };
        $.post('/manager/e_store/cms/configuration/contact_us/working_hour/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    /** 添加
     */
    $('#addWorkingHourConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var name = $('#add_working_hour_name').val();
        var time_range = $('#add_working_hour_time_range').val();

        var data = {
            'name'          :   name,
            'time_range'    :   time_range
        };
        $.post('/manager/e_store/cms/configuration/contact_us/working_hour/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); $('#addWorkingHourModal').modal('hide'); });
    });
    $('#add_working_hour_btn').click(function()
    {
        $('#addWorkingHourModal').modal('show');
    });

    /**
     *
     * 工作时间 结束
     *
     */



    /**
     *
     * 电邮 开始
     *
     */

    /** 删除
     */
    $('#deleteEmailConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var data =
        {
            id          :   data_id
        };

        $.post('/manager/e_store/cms/configuration/contact_us/email/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });
    $('[data-name="delete_email_btn"]').click(function()
    {
        $('#deleteEmailConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteEmailModal').modal('show');
    });

    /** 编辑
     */
    $('[data-name="edit_email_btn"]').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var name = $('[data-name="email_name"][data-id="' + data_id + '"]').val();
        var email = $('[data-name="email_email"][data-id="' + data_id + '"]').val();
        var sequence = $('[data-name="email_sequence"][data-id="' + data_id + '"]').val();

        var data =
        {
            id          :   data_id,
            name        :   name,
            email       :   email,
            sequence    :   sequence
        };
        $.post('/manager/e_store/cms/configuration/contact_us/email/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    /** 添加
     */
    $('#addEmailConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var name = $('#add_email_name').val();
        var email = $('#add_email_email').val();

        var data = {
            'name'      :   name,
            'email'     :   email
        };
        $.post('/manager/e_store/cms/configuration/contact_us/email/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); $('#addEmailModal').modal('hide'); });
    });
    $('#add_email_btn').click(function()
    {
        $('#addEmailModal').modal('show');
    });

    /**
     *
     * 电邮 结束
     *
     */




    /**
     *
     * 号码 开始
     *
     */

    /** 删除
     */
    $('#deleteNumberConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var data =
        {
            id          :   data_id
        };

        $.post('/manager/e_store/cms/configuration/contact_us/number/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });
    $('[data-name="delete_number_btn"]').click(function()
    {
        $('#deleteNumberConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteNumberModal').modal('show');
    });

    /** 编辑
     */
    $('[data-name="edit_number_btn"]').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var name = $('[data-name="number_name"][data-id="' + data_id + '"]').val();
        var number = $('[data-name="number_number"][data-id="' + data_id + '"]').val();
        var sequence = $('[data-name="number_sequence"][data-id="' + data_id + '"]').val();

        var data =
        {
            id          :   data_id,
            name        :   name,
            number      :   number,
            sequence    :   sequence
        };
        $.post('/manager/e_store/cms/configuration/contact_us/number/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    /** 添加
     */
    $('#addNumberConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var name = $('#add_number_name').val();
        var number = $('#add_number_number').val();

        var data = {
            'name'      :   name,
            'number'    :   number
        };
        $.post('/manager/e_store/cms/configuration/contact_us/number/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); $('#addNumberModal').modal('hide'); });
    });
    $('#add_number_btn').click(function()
    {
        $('#addNumberModal').modal('show');
    });

    /**
     *
     * 号码 结束
     *
     */



    /**
     *
     * 地址 开始
     *
     */

    /** 删除
     */
    $('#deleteAddressConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var data =
        {
            id          :   data_id
        };

        $.post('/manager/e_store/cms/configuration/contact_us/address/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });
    $('[data-name="delete_address_btn"]').click(function()
    {
        $('#deleteAddressConfirm').attr('data-id', $(this).attr('data-id'));
        $('#deleteAddressModal').modal('show');
    });

    /** 编辑
     */
    $('[data-name="edit_address_btn"]').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data_id = $(this).attr('data-id');
        var name = $('[data-name="address_name"][data-id="' + data_id + '"]').val();
        var address = $('[data-name="address_address"][data-id="' + data_id + '"]').val();
        var sequence = $('[data-name="address_sequence"][data-id="' + data_id + '"]').val();

        var data =
        {
            id          :   data_id,
            name        :   name,
            address     :   address,
            sequence    :   sequence
        };
        $.post('/manager/e_store/cms/configuration/contact_us/address/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    /** 添加
     */
    $('#addAddressConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var name = $('#add_address_name').val();
        var address = $('#add_address_address').val();

        var data = {
            'name'      :   name,
            'address'   :   address
        };
        $.post('/manager/e_store/cms/configuration/contact_us/address/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json').always(function () { $btn.button('reset'); $('#addAddressModal').modal('hide'); });
    });
    $('#add_address_btn').click(function()
    {
        $('#addAddressModal').modal('show');
    });

    /**
     *
     * 地址 结束
     *
     */


	
	$('#edit_contact_us').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var subject = $('#subject').val();
        var is_receiver_email_activate = $('#is_receiver_email_activate').val();
        var receiver_email = $('#receiver_email').val();
        var is_map_visible = $('#is_map_visible').val();
        var map_iframe = $('#map_iframe').val();
        var map_position = $('#map_position').val();
        var info_position = $('#info_position').val();
        var form_position = $('#form_position').val();

		var data = {
			'subject'                       :   subject,
            'is_receiver_email_activate'    :   is_receiver_email_activate,
            'receiver_email'                :   receiver_email,
            'is_map_visible'                :   is_map_visible,
            'map_iframe'                    :   map_iframe,
            'map_position'                  :   map_position,
            'info_position'                 :   info_position,
            'form_position'                 :   form_position
		};
		
		$.post('/manager/e_store/cms/configuration/contact_us/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);