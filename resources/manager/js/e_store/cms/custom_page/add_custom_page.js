/*
 *		Author: Steven Chen
 *		Date: Mar 2016
 */

(function($){

	$('#add_custom_page').click(function()
    {
        var $btn = $(this);
		$btn.button('loading');

        var page_type = $('#page_type').val();
		var page_name = $('#page_name').val();
		var page_title = $('#page_title').val();
        var page_title_size = $('#page_title_size').val();
        var page_title_alignment = $('#page_title_alignment').val();
        var is_page_title_visible = $('#is_page_title_visible').val();
        var page_content = encodeURI(editor.html());
        var seo_title = $('#seo_title').val();
        var seo_description = $('#seo_description').val();
        var seo_keywords = $('#seo_keywords').val();
		
		var data = {
			'page_type'             :   page_type,
			'page_name'             :   page_name,
			'page_title'            :   page_title,
            'page_title_size'       :   page_title_size,
            'page_title_alignment'  :   page_title_alignment,
            'is_page_title_visible' :   is_page_title_visible,
            'page_content'          :   page_content,
            'seo_title'             :   seo_title,
            'seo_description'       :   seo_description,
            'seo_keywords'          :   seo_keywords
		};

        $.post('/manager/e_store/cms/custom_page/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/cms/custom_page/view_by/pagination'
            });
        }, 'json').always(function(){ $btn.button('reset'); });

	});
	
})(jQuery);