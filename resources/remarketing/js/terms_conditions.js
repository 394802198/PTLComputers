/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$('#i_accept_btn').on("click", function()
    {
		var data = {
			'is_accepted':$('#is_accepted').is(':checked')
		};
		$.post('/remarketing/wholesaler/action/session_less/accept_terms_conditions', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/remarketing';
                }, 2000);
            }
		});
	});
	
})(jQuery);