<script type="text/javascript">
    $(function () {
        
        $(document).on('change', '#laundry_type', function (e) { 
            var laundry_type = $(this).val();
            var hiddenParagraph = document.getElementById("formSelectRoom");
            if(laundry_type==='Guest'){
                //show select room 
                hiddenParagraph.style.display = "block";
                $.ajax({
                url: '{{ route('select2.room_inhouse') }}',
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
        })
    });
</script>