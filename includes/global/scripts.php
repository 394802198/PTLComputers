<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/spin.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/icheck.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/bootstrap-switch.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/js/toastr.min.js"></script>
<script src="<?php echo ROOT_PATH ?>/resources/global/js/toastr.init.js"></script>

<script src="<?php echo ROOT_PATH ?>/resources/global/FC_select_list/fc-select-list.js" type="text/javascript"></script>

<script>

    /** 句子每个单词首字母大写
     */
    String.prototype.toTitleCase = function()
    {
        return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }
    /** 句子首个单词首字母大写
     */
    String.prototype.capitalize = function()
    {
        return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
    }

    function IsJsonString(str)
    {
        try
        {
            JSON.parse(str);
        }
        catch (e)
        {
            return false;
        }
        return true;
    }

    (function($){
        $.extend({
            /* CIPagination Search Helper */
            initCIPaginationSearchHelper : function( jsonConfig )
            {
                function initParams()
                {
                    var non_fixed_predicates = '';
                    var index = 0;

                    $('*[data-search]').each(function()
                    {
                        if($(this).val()!='')
                        {
                            if( index==0 )
                            {
                                non_fixed_predicates += '?';
                            }
                            else
                            {
                                non_fixed_predicates += '&';
                            }
                            non_fixed_predicates += $(this).attr('name') + '=';
                            non_fixed_predicates += $(this).val();
                            index++;
                        }
                    });

                    var fixed_predicates = '';

                    /* If no non-fixed predicates then pass pageNo as first param */
                    if( index == 0 )
                    {
                        fixed_predicates +=  '?' + 'per_page=1'
                    }
                    /* If got non-fixed predicates then append pageNo as last param */
                    else
                    {
                        fixed_predicates +=  '&' + 'per_page=1'
                    }

                    return ( non_fixed_predicates + fixed_predicates );
                }

                $( jsonConfig.search_btn_selector ).click(function()
                {
                    window.location.href = ( jsonConfig.base_url + initParams() );
                });

                $( jsonConfig.export_btn_selector ).click(function()
                {
                    window.location.href = ( jsonConfig.export_link + initParams() );
                });

                $( jsonConfig.reset_btn_selector).click(function(){
                    $('input[data-search]').val('');
                    $('select[data-search]').find("option:selected").prop("selected", false);
                    $('[type="range"]').val( 0 );
                });

                $('[data-remove-search-by]').click(function(){
                    $('input[name="' + $(this).attr('data-remove') + '"]').val('');
                    $('select[name="' + $(this).attr('data-remove') + '"]').find("option:selected").prop("selected", false);
                    $('[data-range="' + $(this).attr('data-remove') + '"]').val( 0 );
                });



                /**
                 * Pagination search helper
                 */

                /*  */
                $('*[data-search]').keydown(function(e)
                {
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $( jsonConfig.search_btn_selector ).click();
                    }
                });

                /* Change input range result when dragging input range */
                var isDrag = false;
                $('[type="range"]').on('mousedown', function(){
                    isDrag = true;
                });
                $('[type="range"]').on('mousemove', function(){
                    if( isDrag )
                    {
                        $('[data-range="' + $(this).attr('data-range') + '_result"]').val( $(this).val() );
                    }
                });
                $('[type="range"]').on('mouseup', function(){
                    isDrag = false;
                });

                /* Change input range when keyup range result */
                $('[data-range-result]').keyup(function(){

                    if( $(this).val() != '' && $.isNumeric( $(this).val() ) )
                    {
                        $('[data-range="' + $(this).attr('name') + '"]').val( $(this).val() );
                    }
                    else
                    {
                        $(this).val( 0 );
                        $('[data-range="' + $(this).attr('name') + '"]').val( 0 );
                    }
                });
            }
        });
    })(jQuery);


</script>