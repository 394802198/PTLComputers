/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function()
{
    $('[data-on-click="favourite"]').on('click', function()
    {
        var data =
        {
            'commodity_id'  :   $(this).attr('data-commodity-id'),
            'e_store_sku'   :   $(this).attr('data-e-store-sku')
        };
        $.post('/e_store/wish_list/action/session_less/favourite', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });

            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            if( resultObj.errorMap.signInMsg )
            {
                setTimeout(function()
                {
                    $('#customerLoginModal').modal('show');
                },500);
            }
        });
    });

    $('[data-on-click="remove_favourite"]').on('click', function()
    {
        var data =
        {
            'commodity_id'  :   $(this).attr('data-commodity-id')
        };
        $.post('/e_store/wish_list/action/session_less/remove', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });

            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            if( resultObj.errorMap.signInMsg )
            {
                setTimeout(function()
                {
                    $('#customerLoginModal').modal('show');
                },500);
            }
        });
    });

})(jQuery);