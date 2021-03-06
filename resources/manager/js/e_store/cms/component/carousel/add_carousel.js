/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){

	$('#add_carousel').click(function()
    {
        var $btn = $(this);
		$btn.button('loading');

        var page_type = $('#page_type').val();
		var position = $('#position').val();
		var is_activate_linkage = $('#is_activate_linkage').val();
        var linkage = $('#linkage').val();
        var brief_introduction = $('#brief_introduction').val();
        var is_visible = $('#is_visible').val();
		
		var data = {
			'page_type':page_type,
			'position':position,
			'is_activate_linkage':is_activate_linkage,
            'linkage':linkage,
            'brief_introduction':brief_introduction,
            'is_visible':is_visible
		};

        $.ajaxFileUpload({
            url 			: '/manager/e_store/cms/component/carousel/action/session/add',
            secureuri		: false,
            fileElementId	: ['picture'],
            dataType		: 'json',
            data			: data,
            success			: function ( resultObj )
            {
                showResultToastr({
                    'resultObj': resultObj,
                    'successURL': '/manager/e_store/cms/component/carousel/view_by/pagination'
                });
                if( resultObj.hasErrors )
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