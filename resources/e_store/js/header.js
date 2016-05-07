/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($)
{
    $('*[data-toggle="tooltip"]').tooltip();

    /** 页头导航
     */
    $('.xerp_drop_down_ul').css('display','none');
    $('.xerp_drop_down_a').click(function(e)
    {
        e.stopPropagation();

        /** 其余的下拉内容
         */
        var other_xerp_drop_down_ul = $('.xerp_drop_down_ul').not('[data-drop-product-type="' + $(this).attr('data-drop-product-type') + '"]');
        other_xerp_drop_down_ul.hide('slow', function()
        {
            $(this).attr('data-is-dropped', 'false');
        });

        /** 点击的下拉内容
         */
        var xerp_drop_down_ul = $('ul[class="xerp_drop_down_ul"][data-drop-product-type="' + $(this).attr('data-drop-product-type') + '"]');

        var is_dropped = xerp_drop_down_ul.attr('data-is-dropped');
        if( is_dropped === 'true' )
        {
            xerp_drop_down_ul.hide('slow', function()
            {
                $(this).attr('data-is-dropped', 'false');
            });
        }
        else
        {
            xerp_drop_down_ul.show('slow', function()
            {
                $(this).attr('data-is-dropped', 'true');
            });
        }
    });

    $('#forgetPasswordModal').on('shown.bs.modal', function ()
    {
        $('#forget_password_email').focus();
    });

    $('#forgetAccountModal').on('shown.bs.modal', function ()
    {
        $('#forget_account_email').focus();
    });

    $('#customerLoginBtn').click(function()
    {
        $('#customerLoginModal').modal('show');
    });

    $('#customerLoginModal').on('shown.bs.modal', function ()
    {
        $('#sign_in_email_or_account').focus();
    });

    $('#customerRegisterBtn').click(function()
    {
        $('#customerRegisterModal').modal('show');
    });

    $('#customerRegisterModal').on('shown.bs.modal', function ()
    {
        $('#sign_up_account').focus();
    });

    $('#switchFromForgetPasswordToSignIn').click(function()
    {
        $('#forgetPasswordModal').modal('hide');

        setTimeout(function()
        {
            $('#customerLoginModal').modal('show');
        },500);
    });

    $('#switchFromSignInToForgetPassword').click(function()
    {
        $('#customerLoginModal').modal('hide');

        setTimeout(function()
        {
            $('#forgetPasswordModal').modal('show');
        },500);
    });

    $('#switchFromForgetAccountToSignIn').click(function()
    {
        $('#forgetAccountModal').modal('hide');

        setTimeout(function()
        {
            $('#customerLoginModal').modal('show');
        },500);
    });

    $('#switchFromSignInToForgetAccount').click(function()
    {
        $('#customerLoginModal').modal('hide');

        setTimeout(function()
        {
            $('#forgetAccountModal').modal('show');
        },500);
    });

    $('#switchFromSignInToSignUp').click(function()
    {
        $('#customerLoginModal').modal('hide');

        setTimeout(function()
        {
            $('#customerRegisterModal').modal('show');
        },500);
    });

    $('#switchFromSignUpToSignIn').click(function()
    {
        $('#customerRegisterModal').modal('hide');

        setTimeout(function()
        {
            $('#customerLoginModal').modal('show');
        },500);
    });

    $('#customerLogoutBtn').click(function()
    {
        $('#customerLogoutModal').modal('show');
    });

    /** 忘记账号
     */
    $('#forgetPasswordBtn').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var customer =
        {
            email     :   $('#forget_password_email').val()
        };
        $.post('/e_store/customer/action/session_less/forget_password', customer, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
            });
        }).always(function(){ $btn.button('reset') });
    });

    /** 忘记账号
     */
    $('#forgetAccountBtn').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var customer =
        {
            email     :   $('#forget_account_email').val()
        };
        $.post('/e_store/customer/action/session_less/forget_account', customer, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
            });
        }).always(function(){ $btn.button('reset') });
    });

    /** 检测帐号是否重复
     */
    $('#sign_up_account').keyup(function()
    {
        var customer =
        {
            account     :   $('#sign_up_account').val()
        };
        $.post('/e_store/customer/action/session_less/check_account_exist', customer, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
            });
        });
    });

    /** 注册
     */
    $('#signUpBtn').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var customer =
        {
            account     :   $('#sign_up_account').val(),
            email       :   $('#sign_up_email').val(),
            password    :   $('#sign_up_credential').val()
        };
        $.post('/e_store/customer/action/session_less/add', customer, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess':false
            });
        }).always(function(){ $btn.button('reset') });
    });
    $('#sign_up_account, #sign_up_email, #sign_up_credential').keyup(function(e)
    {
        if( e.keyCode == 13 )
        {
            $('#signUpBtn').click();
        }
    });

    /** 登录
     */
    $('#signInBtn').click(function()
    {
        var customer =
        {
            email_or_account    :   $('#sign_in_email_or_account').val(),
            password            :   $('#sign_in_credential').val()
        };
        $.post('/e_store/customer/action/session_less/login', customer, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess':true
            });
        });
    });
    $('#sign_in_credential, #sign_in_email_or_account').keyup(function(e)
    {
        if( e.keyCode == 13 )
        {
            $('#signInBtn').click();
        }
    });

    /** 登出
     */
    $('#signOutBtn').click(function()
    {
        $.post('/e_store/customer/action/session_less/logout', function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess':true
            });
        });
    });

    /** 订阅
     */
    $('#subscribeBtn').click(function()
    {
        var subscribeList =
        {
            email    :   $('#subscribe_email').val()
        };
        $.post('/e_store/subscribe_list/action/session_less/subscribe', subscribeList, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess':true
            });
        });
    });
    $('#subscribe_email').on('keypress', function(e)
    {
        if( e.keyCode === 13 )
        {
            $('#subscribeBtn').click();
        }
    });

    /** 关键词搜索商品
     */
    $('#searchByKeywordBtn').on('click', function()
    {
        var search_keyword = $('#search_keyword').val();

        window.location.href = '/e_store/commodity/search' + ( search_keyword ? '?keyword=' + search_keyword : '' );
    });
    $('#search_keyword').on('keypress', function(e)
    {
        if( e.keyCode === 13 )
        {
            $('#searchByKeywordBtn').trigger('click');
        }
    }).focus();

    $('[data-check-customer-authentication-and-redirect]').click(function()
    {
        if( isCustomerLoggedIn === 'YES' )
        {
            window.location.href = $(this).attr('data-url');
        }
        else
        {
            setTimeout(function()
            {
                $('#customerLoginBtn').click();
            },500);

            toastr.info('Please Sign In first.');
        }
    });

    $('#to_my_wish_list').on('click', function()
    {
        if( isCustomerLoggedIn === 'YES' )
        {
            window.location.href = ROOT_PATH + '/e_store/customer/my_wish_list';
        }
        else
        {
            setTimeout(function()
            {
                $('#customerLoginBtn').click();
            },500);

            toastr.info('Please Sign In first, then you can start using Wish List to collecting your favourite products');
        }
    });

    /** 页左右广告
     */
    var client_height = window.innerHeight;
    $('[data-advertisement-page-left-right-div]').css('top', client_height / 2 - 150);
    $('[data-advertisement-hide]').click(function()
    {
        auto_or_manual_hide_advertisement( $(this), 'manual' );
    });
    var auto_hide_advertisements = $('[data-is-auto-hide-activate="true"]');
    auto_hide_advertisements.each(function()
    {
        auto_or_manual_hide_advertisement( $(this), 'auto' );
    });

    function auto_or_manual_hide_advertisement( This, type )
    {
        var closest_count_down_span = This.find('[data-count-down-span]');
        var hide_count_down_hide = type == 'manual' ? This.attr('data-manual-hide-count-down-seconds') : This.attr('data-auto-hide-count-down-seconds');
        var timer = setInterval(function()
        {
            closest_count_down_span.html( hide_count_down_hide );
            hide_count_down_hide --;
            if( hide_count_down_hide < 0 )
            {
                clearInterval( timer );
                This.closest('[data-advertisement-div]').remove();
            }
        }, 1000);

    }

})(jQuery);


