/*
 *		Author: Steven Chen
 *		Date: Jan 2016
 */

(function()
{
    $('#submit_enquiry').on('click', function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var message = $('#message').val();
        var captcha_code = $('#captcha_code').val();

        var data =
        {
            'first_name'    :   first_name,
            'last_name'     :   last_name,
            'phone'         :   phone,
            'email'         :   email,
            'message'       :   message,
            'captcha_code'  :   captcha_code
        };

        $.post('/e_store/contact_us/action/session_less/submit_enquiry', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });
        }).always(function(){ $btn.button('reset') });
    });

})(jQuery);