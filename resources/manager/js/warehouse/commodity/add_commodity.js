/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

    /** 点击【图片】则显示/隐藏对应的按钮
     */
    $('img[data-commodity-picture-img]').click(function()
    {
        var btn = $('a[data-commodity-picture-btn][data-commodity-picture-id="' + $(this).attr('data-commodity-picture-id') + '"]');
        var selectedPics = $('a[data-commodity-picture-btn][selected]');
        var mainImg = $('img[data-commodity-picture-main]');

        /** 点击选中
         */
        if( btn.css('display') == 'none' )
        {
            /** 6 张图片是上限，刚刚好则不能再选
             */
            if( ! selectedPics || selectedPics.length < 6 )
            {
                btn.attr('selected', '');
                btn.css('display', '');

                var mainIcon = $('span[data-commodity-picture-btn-icon][main]');
                if( ! mainIcon.attr('data-commodity-picture-id') )
                {
                    var icon = $('span[data-commodity-picture-btn-icon][data-commodity-picture-id="' + $(this).attr('data-commodity-picture-id') + '"]');
                    /** 标为选中
                     */
                    icon.attr('main','').removeClass('glyphicon-ok-circle').addClass('glyphicon-ok-sign');
                    /** 显示选中图片
                     */
                    mainImg.prop('src', $(this).prop('src'));
                }
            }
            else
            {
                toastr.error('Considered the surfing experience of EStore customers, our suggestion for the maximum of a commodity\'s picture is 6');
            }
        }
        else
        {
            /** 剔除对应的反选图片
             */
            selectedPics.each(function( index )
            {
                if( $(this).attr('data-commodity-picture-id') === btn.attr('data-commodity-picture-id') )
                {
                    selectedPics.splice( index, 1 );
                }
            });
            btn.removeAttr('selected');
            btn.css('display', 'none');

            /** 移除对应的【主图】标识，并替换选中为未选中，如果存在其他位选中标识，则继承选中标识
             */
            var mainIcon = $('span[data-commodity-picture-btn-icon][main]');
            if( mainIcon.attr('data-commodity-picture-id') == $(this).attr('data-commodity-picture-id') )
            {
                mainIcon.removeAttr('main').removeClass('glyphicon-ok-sign').addClass('glyphicon-ok-circle');
                var firstSlaveSign = $('a[data-commodity-picture-btn][selected]').find('span').first();
                if( firstSlaveSign )
                {
                    firstSlaveSign.attr('main','').removeClass('glyphicon-ok-circle').addClass('glyphicon-ok-sign');
                    mainImg.prop('src', $('img[data-commodity-picture-img][data-commodity-picture-id="' + firstSlaveSign.attr('data-commodity-picture-id') + '"]').prop('src') );
                }
                else
                {
                    mainImg.prop('src', '/resources/global/image/default_img.svg');
                }
            }

            /** 没有选中图片，则用回默认图片
             */
            if( ! selectedPics || selectedPics.length < 1 )
            {
                mainImg.prop('src', '/resources/global/image/default_img.svg');
            }
        }
    });
    /** 点击【按钮】则反选其余显示的
     */
    $('a[data-commodity-picture-btn]').click(function()
    {
        var mainIcon = $('span[data-commodity-picture-btn-icon][main]');
        var icon = $('span[data-commodity-picture-btn-icon][data-commodity-picture-id="' + $(this).attr('data-commodity-picture-id') + '"]');

        if ( $(this).attr('data-commodity-picture-id') !== mainIcon.attr('data-commodity-picture-id') )
        {
            mainIcon.removeAttr('main').removeClass('glyphicon-ok-sign').addClass('glyphicon-ok-circle');
            icon.attr('main','').removeClass('glyphicon-ok-circle').addClass('glyphicon-ok-sign');

            /** 将选中的图片显示在【主图】上
             */
            $('img[data-commodity-picture-main]').prop('src', $('img[data-commodity-picture-img][data-commodity-picture-id="' + icon.attr('data-commodity-picture-id') + '"]').prop('src') );
        }
        else
        {
            icon.removeAttr('main').removeClass('glyphicon-ok-sign').addClass('glyphicon-ok-circle');
            var mainImg = $('img[data-commodity-picture-main]');
            mainImg.prop('src', '/resources/global/image/default_img.svg');
        }
    });
	
	$('#add_commodity').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var name = $('#name').val();
		var location = $('#location').val();
		var type = $('#type').val();
		var price = $('#price').val();
		var manufacturer = $('#manufacturer').val();
        var short_description =$('#short_description').val();
		var description = encodeURI(editor.html());

        /** commodityPicture properties
         */
        var main_picture_id = $('span[data-commodity-picture-btn-icon][main]').attr('data-commodity-picture-id');
        var picture_ids = [];
        $('a[data-commodity-picture-btn][selected]').each(function()
        {
            picture_ids.push( $(this).attr('data-commodity-picture-id') );
        });
		
		var data = {
            'name':name,
			'location':location,
			'type':type,
			'price':price,
			'manufacturer':manufacturer,
            'short_description':short_description,
			'description':description,
            'main_picture_id':main_picture_id,
            'picture_ids':picture_ids
		};
		
		$.post('/manager/warehouse/commodity/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);