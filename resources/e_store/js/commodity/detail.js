/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function()
{
    function isInt( n )
    {
        return n % 1 === 0;
    }

    $('#qty_purchased').change(function()
    {
        prevent_negative( $(this) );
    }).keyup(function(e)
    {
        prevent_negative( $(this) );

        if( e.keyCode === 13 )
        {
            e.preventDefault();
            $('[data-on-click="add_to_cart"]').click();
        }

        var qtyPurchased = $(this).val();

        if( qtyPurchased > 0 )
        {
            if( ! isInt( qtyPurchased ) )
            {
                $(this).val( qtyPurchased.substr( 0, qtyPurchased.indexOf('.') ) );
            }
        }
        else
        {
            $(this).val( 1 );
        }
    });

    function prevent_negative( $this )
    {
        var val = $this.val();
        if( val < 1 )
        {
            $this.val( 1 );
        }
    }


    var origin_main_img_pic_path;
    var main_img = $('.main_img');
    var list_img = $('.list_img');
    list_img
        .on('mouseover', function()
        {
            origin_main_img_pic_path = main_img.attr( 'src');
            main_img.attr( 'src', $(this).attr('src'));

        }).on('mouseout', function()
        {
            main_img.attr( 'src', origin_main_img_pic_path);

        }).on('click', function()
        {
            origin_main_img_pic_path = $(this).attr('src');
            list_img.removeClass('selected_img');
            $(this).addClass('selected_img');
        });


})(jQuery);