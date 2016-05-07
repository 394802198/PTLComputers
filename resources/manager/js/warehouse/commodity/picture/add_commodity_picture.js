/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){

	$('#add_commodity_picture').click(function()
    {
        var $btn = $(this);
		$btn.button('loading');

        var manufacturer = $('#manufacturer').val();
		var type = $('#type').val();
		var keyword = $('#keyword').val();
		
		var data = {
			'type':type,
			'manufacturer':manufacturer,
			'keyword':keyword
		};

        $.ajaxFileUpload({
            url 			: '/manager/warehouse/commodity/picture/action/session/add',
            secureuri		: false,
            fileElementId	: ['picture'],
            dataType		: 'json',
            data			: data,
            success			: function ( resultObj )
            {
                showResultToastr({
                    'resultObj': resultObj
                });
                if( ! resultObj.hasErrors )
                {
                    setTimeout(function()
                    {
                        window.location.href = '/manager/warehouse/commodity/picture/view_by/pagination';
                    }, 500);
                }
                else
                {
                    $('img').prop('src', '/resources/global/image/default_img.svg');
                    $('img').prop('title', 'No Image');
                    $('input[type="file"]').on('change', handleFileSelect);
                }
                $btn.button('reset');
            },
            error			: function (resultJSON)
            {
                //setTimeout(function()
                //{
                //    window.location.href = '/manager/warehouse/commodity/picture/view_by/pagination';
                //}, 500);
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