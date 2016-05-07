/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 *		Update: Feb 2016
 */

(function($){

    $('#forget_password_email').keypress(function(e)
    {
        if(e.which == 13)
        {
            e.preventDefault();
            $('#forgetPasswordBtn').click();
        }
    });

    $('#forgetPasswordBtn').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data =
        {
            email   :   $('#forget_password_email').val()
        };

        $.post('/remarketing/wholesaler/action/session_less/forget_password', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    $('#forgetPasswordModal').on('shown.bs.modal', function()
    {
        $('#forget_password_email').focus();
    }).on('hidden.bs.modal', function()
    {
        $('#login_account').focus();
    });

    $('#forget_password_btn').click(function()
    {
        $('#forgetPasswordModal').modal('show');
    });

    $('#forget_account_email').keypress(function(e)
    {
        if(e.which == 13)
        {
            e.preventDefault();
            $('#forgetAccountBtn').click();
        }
    });

    $('#forgetAccountBtn').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var data =
        {
            email   :   $('#forget_account_email').val()
        };

        $.post('/remarketing/wholesaler/action/session_less/forget_account', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
        }, 'json').always(function () { $btn.button('reset'); });
    });

    $('#forgetAccountModal').on('shown.bs.modal', function()
    {
        $('#forget_account_email').focus();
    }).on('hidden.bs.modal', function()
    {
        $('#login_account').focus();
    });

    $('#forget_account_btn').click(function()
    {
        $('#forgetAccountModal').modal('show');
    });

    $('#login_account').focus();

	$('#login_account, #login_password').keypress(function(e)
    {
	    if(e.which == 13)
        {
	    	$('#signin-btn').click();
	    }
	});

	$('#signin-btn').on("click", function(e)
    {
		var $btn = $(this);
		$btn.button('loading');

		var data =
        {
			login_account   :   $('#login_account').val(),
            login_password  :   $('#login_password').val()
		};

		$.post('/remarketing/wholesaler/action/session_less/login', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
            if( resultObj.model.is_not_first_time == 1 )
            {
                window.location.href = '/remarketing';
            }
            else if( resultObj.model.is_not_first_time == 0 )
            {
                window.location.href = '/remarketing/terms_conditions';
            }
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);