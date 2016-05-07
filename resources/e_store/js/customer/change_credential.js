/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function()
{
    $('#current_credential, #new_credential, #confirm_new_credential').on('keyup', function(e)
    {
        if( e.keyCode == 13 )
        {
            $("#changeCredentialBtn").click();
        }
    });

    $('#changeCredentialBtn').on('click', function()
    {
        var data =
        {
            'current_credential'        :   $('#current_credential').val(),
            'new_credential'            :   $('#new_credential').val(),
            'confirm_new_credential'    :   $('#confirm_new_credential').val()
        };
        $.post('/e_store/customer/action/session/change_credential', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });
        });
    });

})(jQuery);