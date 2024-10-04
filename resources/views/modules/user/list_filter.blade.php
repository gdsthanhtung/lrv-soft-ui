<script language="javascript">
    $(document).ready(function(){
        $(".per-page").on("change", function(){
            $("#filterForm").submit();
        });

        $('#select-all').on("click", function(){
            var checkboxes = $(this).closest('form').find(':checkbox');
            if($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });

        $(".sort").on("click", function(){
            var asc_desc = $("#asc_desc").val();
            var order_by = $(this).attr('alt');

            $("#order_by").val(order_by);

            if(asc_desc == 'asc'){
                $("#asc_desc").val("desc");
            }else{
                $("#asc_desc").val("asc");
            }

            $("#form").submit();
        });

        $("#clear_button").on("click", function(){
            $(".records_per_page").val('10');
            $(".search").val('');
            $("#order_by").val('id');
            $("#asc_desc").val("asc");
            $("#user_group_id").val("0");
            $("#form").submit();
        });

        $("#submit_button").on("click", function(){
            $("#form").submit();
        });
    })
</script>
