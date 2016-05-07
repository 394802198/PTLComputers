/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('input[name="shipping_method_radio"][value="'+shipping_method+'"]').iCheck('check');
	
})(jQuery);