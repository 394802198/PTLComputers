/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#category_name').keyup(function(e){
		
	    if(e.which != 13) {
		
			var category_id = $('#category_id').val();
			var category_name = $('#category_name').val();
			var data = {
				'category_id':category_id,
				'category_name':category_name
			};
	
			$.post('/manager_product/category_rest/check_edit_category_name_duplicate', data, function(resultJSON){
	 			$.jsonValidation(resultJSON, 'right');
			}, 'json');
			
	    }
			
	});
	$('#category_name').keypress(function(e) {
	    if(e.which == 13) {
			e.preventDefault();
	    	$('#edit_category').click();
	    }
	});
	
	$('#edit_category').click(function(){
		
		var $btn = $(this);
		$btn.button('loading');

		var category_id = $('#category_id').val();
		var category_name = $('#category_name').val();
		
		var data = {
			'category_id':category_id,
			'category_name':category_name
		};
		
		$.post('/manager_product/category_rest/edit', data, function(resultJSON){
 			$.jsonValidation(resultJSON, 'right');
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);