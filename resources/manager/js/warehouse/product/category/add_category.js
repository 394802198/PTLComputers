/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#category_name').keyup(function(e){
		
	    if(e.which != 13) {
		
			var category_name = $('#category_name').val();
			var data = {
				'category_name':category_name
			};
			
			$.post('/manager_product/category_rest/check_category_name_duplicate', data, function(resultJSON){
	 			$.jsonValidation(resultJSON, 'right');
			}, 'json');
		
	    }
		
	});
	$('#category_name').keypress(function(e) {
	    if(e.which == 13) {
			e.preventDefault();
	    	$('#add_category').click();
	    }
	});
	
	$('#add_category').click(function(){
		
		var $btn = $(this);
		$btn.button('loading');
		
		var category_name = $('#category_name').val();
		
		var data = {
			'category_name':category_name
		};
		
		$.post('/manager_product/category_rest/add', data, function(resultJSON){
 			$.jsonValidation(resultJSON, 'right');
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);