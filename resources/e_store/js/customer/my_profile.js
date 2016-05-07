/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function()
{
    $('#company_name, #first_name, #last_name, #email, #mobile_phone, #fixed_phone, #fax_no, #country, #province, #city, #address').on('keyup', function(e)
    {
        if( e.keyCode == 13 )
        {
            $("#updateMyProfileBtn").click();
        }
    });

    $('#updateMyProfileBtn').on('click', function()
    {
        var data =
        {
            'company_name'          :   $('#company_name').val(),
            'first_name'            :   $('#first_name').val(),
            'last_name'             :   $('#last_name').val(),
            'email'                 :   $('#email').val(),
            'mobile_phone'          :   $('#mobile_phone').val(),
            'fixed_phone'           :   $('#fixed_phone').val(),
            'fax_no'                :   $('#fax_no').val(),
            'country'               :   $('#country').val(),
            'province'              :   $('#province').val(),
            'city'                  :   $('#city').val(),
            'address'               :   $('#address').val()
        };
        $.post('/e_store/customer/action/session/update_my_profile', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });
        });
    });

})(jQuery);