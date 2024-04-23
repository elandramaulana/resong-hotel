<script type="text/javascript">
    $(function () {
        $(document).on('click', '#btnAdd', function(e){
            callMenuAjax();
        });
        function callMenuAjax(){
            var day_name = $("#day_name").val();
            var cat_id = $("#category_id").val();
            console.log(cat_id);
            $('#list_menu option:not(:first-child)').remove();
            $('#list_menu').trigger('change');
            $.ajax({
                url: '{{ route('select2.menu_active') }}',
                type: "GET",
                data: {day_id:day_name, cat_id:cat_id},
                dataType: "json",
                }).done(function(data) {
                    $("#list_menu").select2({
                        data: data,
                    });
            });
        }
        $(document).on('change', '#list_menu', function (e) {
            var menu_id = $(this).val(); 
            $.ajax({
                url: '{{ route('detail.menu') }}',
                type: "GET",
                data: {menu_id:menu_id},
                dataType: "json",
                }).done(function(data) {
                    $("#menu_price").val(data.menu_price)
                    console.log(data.menu_price);
            });
         });
        $(document).on('change', "#category_id", function(e){
            callMenuAjax();
        });
    });
</script>