/*
 *		Author: Steven Chen
 *		Date: Apr 2016
 */

(function($){

    $('#type').change(function(){
        var display = $(this).val() == 100 ? 'none' : '';
        $('#external_service_provider_id').css('display', display);
    });

    $('#appraisal, #payable, #cost, #paid').change(function(){
        if ($(this).val() < 0) {
            $(this).val(0);
        }
    });

    $('[id="check_in_date"], [id="check_out_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2,
        'format': 'yyyy-mm-dd'
    });

    $('#edit_record').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        var record_id = $('#record_id').val();
        var type = $('#type').val();
        var status = $('#status').val();
        var created_at = $('#created_at').val();
        var check_in_date = $('#check_in_date').val();
        var check_out_date = $('#check_out_date').val();
        var customer_name = $('#customer_name').val();
        var customer_phone = $('#customer_phone').val();
        var customer_email = $('#customer_email').val();
        var customer_address = $('#customer_address').val();
        var item_name = $('#item_name').val();
        var item_model = $('#item_model').val();
        var item_sn = $('#item_sn').val();
        var problem_description = $('#problem_description').val();
        var appraisal = $('#appraisal').val();
        var payable = $('#payable').val();
        var paid = $('#paid').val();
        var external_service_provider_id = $('#external_service_provider_id').val();

        var data = {
            'id'                            :   record_id,
            'type'                          :   type,
            'status'                        :   status,
            'created_at'                    :   created_at,
            'check_in_date'                 :   check_in_date,
            'check_out_date'                :   check_out_date,
            'customer_name'                 :   customer_name,
            'customer_phone'                :   customer_phone,
            'customer_email'                :   customer_email,
            'customer_address'              :   customer_address,
            'item_name'                     :   item_name,
            'item_model'                    :   item_model,
            'item_sn'                       :   item_sn,
            'problem_description'           :   problem_description,
            'appraisal'                     :   appraisal,
            'payable'                       :   payable,
            'paid'                          :   paid,
            'external_service_provider_id'  :   external_service_provider_id
        };

        $.post('/manager/service/record/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/service/record/view_by/pagination'
            });
        }, 'json').always(function(){ $btn.button('reset'); });

    });

})(jQuery);