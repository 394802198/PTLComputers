/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){


    /** 更新类型顺序
     */
    $('[data-name="update_sequence"]').click(function()
    {
        var type_name = $(this).attr('data-type-name');
        var sequence = $('[data-sequence-input][data-type-name="' + type_name + '"]').val();

        var data =
        {
            name        :   type_name,
            sequence    :   sequence
        };

        $.post('/manager/warehouse/commodity/type/action/session/update_sequence', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });
        }, 'json');

    });

    $('[data-sequence-input]').change(function()
    {
        prevent_negative( $(this) );
    }).keyup(function()
    {
        prevent_negative( $(this) );
    });

    function prevent_negative( $this )
    {
        var val = $this.val();
        if( val < 0 )
        {
            $this.val( 0 );
        }
    }
	
})(jQuery);