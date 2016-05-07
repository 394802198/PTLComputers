/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 *	    Update: Feb 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="carousel_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="carousel_checkbox"]').iCheck('check');
	});
	$('input[data-name="carousel_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="carousel_checkbox"]').iCheck('uncheck');
	});


    /** 更新轮播图顺序
     */
    $('[data-name="update_sequence"]').click(function()
    {
        var carousel_id = $(this).attr('data-carousel-id');
        var sequence = $('[data-sequence-input][data-carousel-id="' + carousel_id + '"]').val();

        var data =
        {
            id          :   carousel_id,
            sequence    :   sequence
        };

        console.log( data );

        $.post('/manager/e_store/cms/component/carousel/action/session/update_sequence', data, function( resultObj )
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


    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/e_store/cms/component/carousel/view_by/pagination'
    } );
	
	$('#delete_carousel_btn').click(function(){
		$('#deleteCarouselModal').modal('show');
	});
	
	$('#deleteCarouselConfirm').click(function()
    {
		var carousel_ids = new Array();
		
		$('input[data-name="carousel_checkbox"]:checked').each(function()
        {
            carousel_ids.push($(this).attr('data-carousel-id'));
		});
		
		var data = {
			'carousel_ids':carousel_ids
		};

		$.post('/manager/e_store/cms/component/carousel/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});
	
	
})(jQuery);