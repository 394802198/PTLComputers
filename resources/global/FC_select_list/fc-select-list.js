/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($) {

    /** 刷新搜索字段
     */
    function unSelectFCSelectorUl( json )
    {
        json.ul.siblings('.fc-select-list-selected').find('.selected-text').css('fontWeight', 'normal').text( json.defaultSelectedText );
    }
    function selectFCSelectorUl( ul, json )
    {
        var li = ul.find('li');
        li.on('click', function()
        {
            var parent = $(this).closest('.fc-select-list ');
            parent.children().removeClass('opt-selected').css('fontWeight', 'normal');

            $(this).addClass('opt-selected');

            if( json.normalTexts.indexOf( $(this).text() ) === -1 )
            {
                parent.siblings('h4.fc-select-list-selected')
                    .find('.selected-text').css('fontWeight', 'bold').text( $(this).text() );

                $(this).css('fontWeight', 'bold');
            }
            else
            {
                unSelectFCSelectorUl({
                    'ul'                    :   ul,
                    'defaultSelectedText'   :   $(this).text()
                });
            }

            var real_select = parent.prev();
            real_select.find('option').prop('selected', false);
            real_select.find('option:eq(' + $(this).index() + ')').prop('selected', true);

            fcClose( parent.siblings('h4.fc-select-list-selected').find('.selected-arrow') );
        });
    }

    function fcOpen( $this )
    {
        $this.parent().removeClass('fc-close').addClass('fc-open');
        $this.removeClass('fc-close').addClass('fc-open')
            .parents('.fc-select-list-wrapper').css('zIndex', 50 + index)
            .find('ul').show('fast');

        click_slideDown();
    }

    function fcClose( $this )
    {
        $this.parent().removeClass('fc-open').addClass('fc-close');
        $this.removeClass('fc-open').addClass('fc-close')
            .parents('.fc-select-list-wrapper').css('z-index', 40)
            .find('ul').hide('fast');

        click_slideDown();
    }

    var index = 0;
    function click_slideDown()
    {
        /** 防止同层重叠，每一次展开都是在之前的上面一层 index
         */

        $('.fc-select-list-selected.fc-close').off().on('click', function()
        {
            fcOpen( $(this).find('span.fc-close') );
            index++;
        });
        //$('.fc-select-list-selected > span.fc-close').off().on('click', function()
        //{
        //    fcOpen( $(this) );
        //    index++;
        //});

        $('.fc-select-list-selected.fc-open').off().on('click', function()
        {
            fcClose( $(this).find('span.fc-open') );
        });
        //$('.fc-select-list-selected > span.fc-open').off().on('click', function()
        //{
        //    fcClose( $(this) );
        //});
    }

    $.fn.extend({
        selectFCSelectorUl: function( json )
        {
            var This = $(this);

            selectFCSelectorUl( $(this), json );

            return This;
        },
        selectFCSelectorUls: function( json )
        {
            var This = $(this);

            This.each(function( $index )
            {
                selectFCSelectorUl( $(this), json[ $index ] );
            });

            return This;
        },
        unSelectFCSelectorUl: function( json )
        {
            var This = $(this);

            unSelectFCSelectorUl({
                'ul'                    :   $(this),
                'defaultSelectedText'   :   json.defaultSelectedText
            });

            return This;
        },
        FCSelector:    function( options )
        {
            // SET VARIABLES
            var settings = $.extend({
                jQuery_animation: false,
                firstOptionLabel: false,
                firstOptionText: '',
                hover: true,
                click: false,
                callBack: function(){}
            }, options);

            this.each(function()
            {
                // classes
                var css3_support    = settings.jQuery_animation ?  'jQuery-transition' : 'css3-transition';
                var click_support   = settings.click ? 'click-true' : '';
                var hover_support   = settings.hover ? 'hover-true' : 'hover-false';

                var current = $(this);
                var wrapper_classes = 'fc-select-list-wrapper ' + css3_support + ' ' + hover_support + ' ' + click_support;
                var ul_classes = 'fc-select-list ';

                var opt = $(this).find('option');
                var opt_first = opt.eq(0).text();
                var select_id = 'select-' + opt_first;

                // text replacement
                var label_text;
                if (settings.firstOptionText == '' ? label_text = current.prev().text() : opt_first = settings.firstOptionText );
                $('<div class="' + wrapper_classes + '"><h4 class="fc-select-list-selected fc-close" style="cursor:pointer;"><span class="selected-text">' + opt_first + '</span><span class="selected-arrow fc-close"></span></h4><ul id="' + select_id + '" class="' + ul_classes + '"></ul></div>').insertAfter(this);
                for (var i = 0; i < opt.length; i++)
                {
                    if ((i == 0) && (settings.firstOptionText != ''))
                    {
                        $('<li class="fc-select-list-item">' + settings.firstOptionText + '</li>').appendTo($(this).next().find('.fc-select-list'));
                    }
                    else
                    {
                        $('<li class="fc-select-list-item">' + opt.eq(i).text() + '</li>').appendTo($(this).next().find('.fc-select-list'));
                    }
                }
                current.hide();
            });
            settings.callBack();

            if ( settings.click )
            {
                click_slideDown();
            }
        }
    });

})(jQuery);
