/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 *	    Last Update: 01 Oct 2015
 */


(function($){

    $("#estoreSwitcher").bootstrapSwitch({
        'onColor':'warning',
        //'offColor':'danger',
        'onText':'&nbsp;&nbsp;<strong>Routine</strong>&nbsp;&nbsp;',
        'offText':'&nbsp;&nbsp;<strong>Maintain</strong>&nbsp;&nbsp;',
        'state':estoreState=='routine' ? true : false,
        'disabled':managerRole=='administrator' ? false : true,
        'size':'normal'
    });

    $("#remarketingSwitcher").bootstrapSwitch({
        'onColor':'info',
        //'offColor':'danger',
        'onText':'&nbsp;&nbsp;<strong>Routine</strong>&nbsp;&nbsp;',
        'offText':'&nbsp;&nbsp;<strong>Maintain</strong>&nbsp;&nbsp;',
        'state':remarketingState=='routine' ? true : false,
        'disabled':managerRole=='administrator' ? false : true,
        'size':'normal'
    });

    $('#estoreSwitcher').on('switchChange.bootstrapSwitch', function(event, state)
    {
        var data = {
            'estore_state': state==true ? 'routine' : 'maintain'
        };

        $.post('/manager/core/status/action/session/switch_e_store_state', data, function(resultObj)
        {
            var resultObj = JSON.parse(resultObj);

            showResultToastr({
                'resultObj': resultObj
            });

        });
    });

    $('#remarketingSwitcher').on('switchChange.bootstrapSwitch', function(event, state)
    {
        var data = {
            'remarketing_state': state==true ? 'routine' : 'maintain'
        };

        $.post('/manager/core/status/action/session/switch_remarketing_state', data, function(resultObj)
        {
            var resultObj = JSON.parse(resultObj);

            showResultToastr({
                'resultObj': resultObj
            });

        });
    });

})(jQuery);