<script type="text/javascript">
    $(function () {
    
        $(document).on('change', '#customer_type', function (e) { 
            var customer_type = $(this).val();
            var hiddenParagraph = document.getElementById("formSelectRoom");
            if(customer_type==='Guest'){
                //show select room 
                hiddenParagraph.style.display = "block";
                $.ajax({
                url: '{{ route('inhouse.resto') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#checkin_id").select2({
                        data: data,
                    });
                });
            }else{
                hiddenParagraph.style.display = "none";
            }
        });

        function showSelect2CheckinID(){
            $.ajax({
                url: '{{ route('inhouse.resto') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#checkin_id").select2({
                        data: data,
                    });
            });
        }
    });
</script>