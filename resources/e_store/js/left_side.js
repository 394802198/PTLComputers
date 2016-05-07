/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($)
{
    $('[data-search]').change(function()
    {
        if( $(this).val() !== '' )
        {
            $(this).css('color', '#000');
        }
        else
        {
            $(this).css('color', '#c8c8c8');
        }
    });

    function getManufacturersByType( ulManufacturer, type )
    {
        var commodityType =
        {
            name    :   type
        };

        return $.post('/e_store/side_dropdown_menu/action/session_less/getManufacturersByType', commodityType, function( resultObj )
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
            });

            if( resultObj.model )
            {
                var manufacturers = resultObj.model;

                ulManufacturer.unSelectFCSelectorUl({
                    'defaultSelectedText'  :   'All Manufacturers'
                })

                for( var manufacturerIndex in manufacturers )
                {
                    $('<li class="fc-select-list-item">' + manufacturers[ manufacturerIndex ].manufacturer + '</li>').appendTo( ulManufacturer );
                }
            }

            ulManufacturer.selectFCSelectorUl({
                'normalTexts'    :   ['All Manufacturers']
            })
        });
    }

    /** FC 伪下拉菜单回调函数
     */
    function FC_Select_Callback()
    {
        var type = '';
        var manufacturer = '';
        var priceRange = '';
        /** 如果是带参数的 URL
         */
        if( window.location.href.indexOf('?') !== -1 )
        {

            var paramsStr = window.location.href.substr( window.location.href.indexOf('?') + 1 );
            var params = paramsStr.split('&');
            for( var paramIndex in params )
            {
                /** 获取【厂家】
                 */
                if( params[ paramIndex ].indexOf('manufacturer=') !== -1 )
                {
                    manufacturer = decodeURI( params[ paramIndex ].split('=')[1] );
                }

                /** 获取【类型】
                 */
                if( params[ paramIndex ].indexOf('type=') !== -1 )
                {
                    type = decodeURI( params[ paramIndex ].split('=')[1] );

                    var ulManufacturer = $('.fc-select-list-item:contains("All Manufacturers")').parent();

                    /** 只留 All Manufacturers 选项，其余的剔除
                     */
                    ulManufacturer.find('li:not(:first-child)').remove();

                    /** 等待通过【类型】获取【厂家】调用完成，再刷新【厂家】列表
                     */
                    $.when( getManufacturersByType( ulManufacturer, type ) ).done(function()
                    {
                        refreshSearchFields( manufacturer, 'All Manufacturers' );
                    });
                }

                /** 获取【价格范围】
                 */
                if( params[ paramIndex ].indexOf('price_range=') !== -1 )
                {
                    priceRange = decodeURI( params[ paramIndex ].split('=')[1] );
                }
            }
        }
        refreshSearchFields( type, 'All Types' );
        refreshSearchFields( priceRange, 'All Prices' );
        refreshSearchFields( manufacturer, 'All Manufacturers' );

        $('.fc-select-list-item:contains("All Types")').closest('ul').find('.fc-select-list-item').on('click', function()
        {
            var typeText = $(this).text() === 'All Types' ? '' : $(this).text();
            var ulManufacturer = $('.fc-select-list-item:contains("All Manufacturers")').parent();
            /** 只留 All Manufacturers 选项，其余的剔除
             */
            ulManufacturer.find('li:not(:first-child)').remove();

            /** 选中【类型】，根据【类型】找【厂家】
             */
            if( typeText && typeText !== '' )
            {
                getManufacturersByType( ulManufacturer, typeText );
            }
            /** 未选中【类型】为空，列出所有【厂家】
             */
            else
            {
                $.post('/e_store/side_dropdown_menu/action/session_less/getManufacturers', function( resultObj )
                {
                    if( IsJsonString(resultObj) )
                    {
                        resultObj = JSON.parse( resultObj );
                    }

                    var manufacturers = resultObj;

                    ulManufacturer.unSelectFCSelectorUl({
                        'defaultSelectedText'  :   'All Manufacturers'
                    })

                    for( var manufacturerIndex in manufacturers )
                    {
                        ulManufacturer.append('<li class="fc-select-list-item">' + manufacturers[ manufacturerIndex ].manufacturer + '</li>');
                    }
                    ulManufacturer.selectFCSelectorUl({
                        'normalTexts'    :   ['All Manufacturers']
                    })
                });
            }

            /** 重新获取【厂家】后，默认将第一个【厂家】选项 All Manufacturers 高亮显示
             */
            ulManufacturer.find('li:first-child').addClass('opt-selected');
        });
    }


    /** 刷新搜索字段
     */
    function refreshSearchFields( field, defaultFieldContains )
    {
        var defaultField = $('.fc-select-list-item:contains("' + defaultFieldContains + '")');
        var parentField = defaultField.closest('ul');
        var childrenField = $('.fc-select-list ').find('.fc-select-list-item');

        var isDefault = true;
        childrenField.each(function( $index )
        {
            /** 每个单词首字母大写
             */
            var finalText = $(this).text();
            var finalField = field;

            if( $index > 0 && finalText === finalField )
            {
                parentField.siblings('h4').find('span.selected-text').text( finalField ).css('fontWeight', 'bold');
                parentField.find('.fc-select-list-item').removeClass('opt-selected').css('fontWeight', 'normal');
                parentField.find('.fc-select-list-item:contains("' + finalField + '")').addClass('opt-selected').css('fontWeight', 'bold');

                isDefault = false;
            }
        });

        /** 参数不匹配，则高亮显示默认选项
         */
        if( isDefault )
        {
            defaultField.addClass('opt-selected');
        }
    }

    $('select[data-search]').FCSelector({
        // open the list when click on
        click: true,
        // enable jQuery animation
        jQuery_animation: true,
        // function callback
        callBack: FC_Select_Callback
    });


    $('.fc-select-list-item:contains("All Types")').closest('ul').siblings('h4').find('span.selected-arrow')
        .append('<i class="fa fa-cubes"></i>');
    $('.fc-select-list-item:contains("All Manufacturers")').closest('ul').siblings('h4').find('span.selected-arrow')
        .append('<i class="fa fa-truck"></i>');
    $('.fc-select-list-item:contains("All Prices")').closest('ul').siblings('h4').find('span.selected-arrow')
        .append('<i class="fa fa-dollar"></i>');

    var uls = $('.fc-select-list-item:contains("All Types"),' +
    '.fc-select-list-item:contains("All Manufacturers"),' +
    '.fc-select-list-item:contains("All Prices")').parent();

    uls.selectFCSelectorUls([
        {
            'normalTexts'    :   ['All Types']
        },
        {
            'normalTexts'    :   ['All Manufacturers']
        },
        {
            'normalTexts'    :   ['All Prices']
        }
    ]).siblings('h4')
        .find('span.selected-arrow')
        .css({
        'paddingTop'    :   '12px',
        'color'         :   '#FFFFFF'
    }).siblings('span.selected-text').css({
        'textAlign' :   'left',
        'fontSize'  :   '14px'
    });

    $('#search_product_btn').off().on('click', function()
    {
        var base_url = '/e_store/commodity/search';
        var params = '';

        var selectedLis = $('.side_search_div').find('li.opt-selected');
        selectedLis.each(function()
        {
            if( $(this).text().indexOf('All Types') === -1 && $(this).text().indexOf('All Manufacturers') === -1 && $(this).text().indexOf('All Prices') === -1 )
            {
                if( params !== '' )
                {
                    params += '&';
                }
                if( $(this).siblings('li:contains("All Types")').length == 1 )
                {
                    params += 'type=' + $(this).text();
                }
                if( $(this).siblings('li:contains("All Manufacturers")').length == 1 )
                {
                    params += 'manufacturer=' + $(this).text();
                }
                if( $(this).siblings('li:contains("All Prices")').length == 1 )
                {
                    params += 'price_range=' + $(this).text();
                }
            }
        });

        var final_url = base_url + ( params !== '' ? '?' + params : '' );

        window.location.href = final_url;
    });




    /** 头部底部产品下拉菜单
     */
    $('ul[class="side_dropdown_menu"][data-is-dropped="false"]').css('display','none');
    $('.side_dropdown_a').click(function(e)
    {
        e.stopPropagation();

        var side_dropdown_a = $('.side_dropdown_a').not('[data-drop-product-type="' + $(this).attr('data-drop-product-type') + '"]');
        side_dropdown_a.parent().removeClass('active');
        $(this).parent().addClass('active');

        /** 其余的下拉内容
         */
        var other_side_dropdown_ul = $('.side_dropdown_menu').not('[data-drop-product-type="' + $(this).attr('data-drop-product-type') + '"]');
        other_side_dropdown_ul.hide('slow', function()
        {
            $(this).attr('data-is-dropped', 'false');
            $(this).children().removeClass('active');
        });

        /** 点击的下拉内容
         */
        var side_dropdown_ul = $('ul[class="side_dropdown_menu"][data-drop-product-type="' + $(this).attr('data-drop-product-type') + '"]');

        var is_dropped = side_dropdown_ul.attr('data-is-dropped');
        if( is_dropped === 'true' )
        {
            side_dropdown_ul.hide('fast', function()
            {
                $(this).attr('data-is-dropped', 'false');
            });
        }
        else
        {
            side_dropdown_ul.show('fast', function()
            {
                $(this).attr('data-is-dropped', 'true');
            });
        }
    });

})(jQuery);