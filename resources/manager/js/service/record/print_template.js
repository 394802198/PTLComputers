/*
 *		Author: Steven Chen
 *		Date: Apr 2016
 */

(function($){

    $('#edit_record_template').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var company_name = $('#company_name').val();
        var company_street = $('#company_street').val();
        var company_city = $('#company_city').val();
        var phone = $('#phone').val();
        var title = $('#title').val();
        var term_condition = encodeURI(editor.html());

        var data = {
            'company_name'      :   company_name,
            'company_street'    :   company_street,
            'company_city'      :   company_city,
            'phone'             :   phone,
            'title'             :   title,
            'term_condition'    :   term_condition
        };

        console.log( data );

        $.ajaxFileUpload({
            url 			: '/manager/service/record/action/session/edit_print_template',
            secureuri		: false,
            fileElementId	: ['picture'],
            dataType		: 'json',
            data			: data,
            success			: function ( resultObj )
            {
                showResultToastr({
                    'resultObj': resultObj,
                    'reloadOnSuccess': true
                });
                if( resultObj.hasErrors )
                {
                    $('input[type="file"]').on('change', handleFileSelect);
                }
                $btn.button('reset');
            },
            error			: function (resultJSON)
            {
                setTimeout(function()
                {
                    //window.location.href = '/manager';
                }, 500);
                $btn.button('reset');
            }
        });

    });

    function handleFileSelect(evt)
    {
        var This = this;
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
            if (!f.type.match('image.*')) continue;
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    console.log($('img[data-name="'+This.id+'"]').prop('src'));
                    $('img[data-name="'+This.id+'"]').prop('src', e.target.result);
                    $('img[data-name="'+This.id+'"]').prop('title', escape(theFile.name));
                    console.log($('img[data-name="'+This.id+'"]').prop('src'));
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    $('input[type="file"]').on('change', handleFileSelect);

})(jQuery);