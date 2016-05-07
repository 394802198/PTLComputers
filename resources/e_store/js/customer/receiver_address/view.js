/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function()
{
    $(document).on('click', '[data-name="set_as_default_receiver_address"]', function()
    {
        var data =
        {
            'id'  :   $(this).attr('data-id')
        };
        $.post('/e_store/customer/receiver_address/action/session/set_as_default', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });
        });
    });

    $(document).on('click', '[data-name="delete_receiver_address"]', function()
    {
        var data =
        {
            'id'  :   $(this).attr('data-id')
        };
        $.post('/e_store/customer/receiver_address/action/session/delete', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'error',
                'reloadOnSuccess': true
            });
        });
    });

})(jQuery);