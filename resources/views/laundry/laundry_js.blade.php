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
        loadLaudryData();
        function loadLaudryData(){
            var table = $("#dtShow").DataTable();
            var filters = [];
            $('.filterCheckbox:checked').each(function() {
                filters.push($(this).val());
            });
            $.ajax({
                url: '{{ route('datatable.laundry') }}',
                method: 'GET',
                dataType: 'json',
                data: { filters: filters },
                success: function (data) {
                    table.clear().draw();     
                    $.each(data, function (index, item) {
                        if(item.laundry_type!=='Guest'){
                            var guest_name = "Internal";
                            var room_no = "~"
                        }else{
                            var guest_name = item.name_guest;
                            var room_no = item.room_no
                        }
                        table.row.add([
                            index + 1,
                            guest_name,
                            room_no,
                            item.laundry_type,
                            '<span class="price">' + item.total_price + '</span>',                       
                            ""
                        ]).draw(false);

                        table.column(4).cells().render({
                            "display": function (data, type, row) {
                                // Check if it's display type
                                if (type === 'display') {
                                    return '<div style="text-align: right;">' + data + '</div>';
                                }
                                return data; // Otherwise, return the data as is
                            }
                        });
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Failed to load data:", error);
                }
            });
        
        }
        $('.filterCheckbox').change(function() {
            loadLaudryData(); // Fetch data when checkbox state changes
            console.log('ok');
        });

    });
</script>