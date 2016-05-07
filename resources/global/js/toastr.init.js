
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

function showResultToastr(params)
{
    var resultObj = params.resultObj;
    if( IsJsonString( resultObj ) )
    {
        resultObj = JSON.parse( resultObj );
    }
    if(resultObj.hasErrors)
    {
        for( var error in resultObj.errorMap )
        {
            if( params.errorType )
            {
                toastr[ params.errorType ]( resultObj.errorMap[error] );
            }
            else
            {
                toastr["error"]( resultObj.errorMap[error] );
            }
        }
    }
    else
    {
        for(var success in resultObj.successMap)
        {
            toastr["success"](resultObj.successMap[success]);
        }

        if( params.successURL )
        {
            setTimeout(function(){
                window.location.href = params.successURL;
            }, 1500);
        }

        if( params.reloadOnSuccess )
        {
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        }

    }
}