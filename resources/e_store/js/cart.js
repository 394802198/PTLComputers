/*
 *		Author: Steven Chen
 *		Date: Jan 2016
 */

(function()
{
    $('[data-on-click="add_to_cart"]').on('click', function()
    {
        var qtyPurchased = $('#qty_purchased').val();
        var data =
        {
            'commodity_id'  :   $(this).attr('data-commodity-id'),
            'e_store_sku'   :   $(this).attr('data-e-store-sku'),
            'qty_ordered'   :   qtyPurchased ? qtyPurchased : 1
        };

        $.post('/e_store/cart/action/session_less/add_to_cart', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'reloadOnSuccess': true
            });

            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            if( resultObj.model )
            {
                $('#cartTotalQtyOrderedBadge').html( resultObj.model );
                toastr["success"]( resultObj.model + ' item(s) in your cart' );
            }
        });
    });

    $('[data-on-click="remove_from_cart"]').on('click', function()
    {
        var data =
        {
            'commodity_id'  :   $(this).attr('data-commodity-id')
        };
        $.post('/e_store/cart/action/session_less/remove_from_cart', data, function( resultObj )
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
            if( resultObj.errorMap.notFoundInCart )
            {
                setTimeout(function()
                {
                    $('#customerLoginModal').modal('show');
                },500);
            }
        });
    });

})(jQuery);