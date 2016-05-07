/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){

    $('#receiver_name, #receiver_phone, #receiver_email, #receiver_country, #receiver_province, #receiver_city, #receiver_post, #receiver_address').blur(function(){
        /* If is not use customer address */
        if( $('#is_use_customer_address').val() == 'N' )
        {
            $(this).attr( 'data-from-origin', $(this).val() );
        }
    });

    $('#is_use_customer_address').change(function()
    {
        var receiver_name = $('#receiver_name');
        var receiver_phone = $('#receiver_phone');
        var receiver_email = $('#receiver_email');
        var receiver_country = $('#receiver_country');
        var receiver_province = $('#receiver_province');
        var receiver_city = $('#receiver_city');
        var receiver_post = $('#receiver_post');
        var receiver_address = $('#receiver_address');


        if( $(this).val() == 'Y' )
        {
            receiver_name.val( receiver_name.attr('data-from-customer') ).prop('disabled', true);
            receiver_phone.val( receiver_phone.attr('data-from-customer') ).prop('disabled', true);
            receiver_email.val( receiver_email.attr('data-from-customer') ).prop('disabled', true);
            receiver_country.val( receiver_country.attr('data-from-customer') ).prop('disabled', true);
            receiver_province.val( receiver_province.attr('data-from-customer') ).prop('disabled', true);
            receiver_city.val( receiver_city.attr('data-from-customer') ).prop('disabled', true);
            receiver_post.val( receiver_post.attr('data-from-customer') ).prop('disabled', true);
            receiver_address.val( receiver_address.attr('data-from-customer') ).prop('disabled', true);
        }
        else
        {
            receiver_name.val( receiver_name.attr('data-from-origin') ).prop('disabled', false);
            receiver_phone.val( receiver_phone.attr('data-from-origin') ).prop('disabled', false);
            receiver_email.val( receiver_email.attr('data-from-origin') ).prop('disabled', false);
            receiver_country.val( receiver_country.attr('data-from-origin') ).prop('disabled', false);
            receiver_province.val( receiver_province.attr('data-from-origin') ).prop('disabled', false);
            receiver_city.val( receiver_city.attr('data-from-origin') ).prop('disabled', false);
            receiver_post.val( receiver_post.attr('data-from-origin') ).prop('disabled', true);
            receiver_address.val( receiver_address.attr('data-from-origin') ).prop('disabled', false);
        }
    });

    $('#edit_receiver_address').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var receiver_address_id = $('#receiver_address_id').val();
        var shipping_area_id = $('#shipping_area_id').val();
        var is_use_customer_address = $('#is_use_customer_address').val();
        var is_default = $('#is_default').val();
        var receiver_name = $('#receiver_name').val();
        var receiver_phone = $('#receiver_phone').val();
        var receiver_email = $('#receiver_email').val();
        var receiver_country = $('#receiver_country').val();
        var receiver_province = $('#receiver_province').val();
        var receiver_city = $('#receiver_city').val();
        var receiver_address = $('#receiver_address').val();
        var receiver_post = $('#receiver_post').val();

        var data =
        {
            'id':receiver_address_id,
            'shipping_area_id':shipping_area_id,
            'is_use_customer_address':is_use_customer_address,
            'is_default':is_default,
            'receiver_name':receiver_name,
            'receiver_phone':receiver_phone,
            'receiver_email':receiver_email,
            'receiver_country':receiver_country,
            'receiver_province':receiver_province,
            'receiver_city':receiver_city,
            'receiver_address':receiver_address,
            'receiver_post':receiver_post
        };

        $.post( ROOT_PATH + '/e_store/customer/receiver_address/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': ROOT_PATH + '/e_store/customer/receiver_address/view'
            });
        }, 'json').always(function () { $btn.button('reset'); });

    });

})(jQuery);