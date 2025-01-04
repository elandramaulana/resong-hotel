<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function () {        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         // Function to reload the page with query parameters
         function updateTable() {
            const daterangeInput = document.querySelector("#daterange");
            const shiftSelect = document.querySelector("#shift_select2");
                const daterange = daterangeInput.value;
                const shift = shiftSelect.value;

                // Construct the URL with query parameters
                const url = new URL(window.location.href);
                url.searchParams.set("date", daterange);
                url.searchParams.set("shift", shift);

                // Redirect to the updated URL
                window.location.href = url.toString();
                console.log('sampaikamari');
            }
           
        //load pilihan shift
        var divisi_id = {{ $divisionID }};
        var selectedShift = "{{ request('shift') }}"; 
        $.ajax({
                url: '{{ route('select2.shift', [$divisionID]) }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#shift_select2").select2({
                        data: data,
                        allowClear: true,
                    });
                    if (selectedShift) {
                        isProgrammaticChange = true; 
                        $("#shift_select2").val(selectedShift).trigger("change");
                    } else {
                        isProgrammaticChange = false;
                    }
                });
        $(document).on('change', '#shift_select2', function (e) { 
            if (isProgrammaticChange) {
                isProgrammaticChange = false; // Reset the flag after programmatic change
            } else {
                updateTable(); // Call the update function for user-initiated changes
            }
        });
        //call daterange picker
        $('#daterange').daterangepicker({
            opens: 'right', // Options: 'left', 'right', 'center'
            singleDatePicker: true,
            autoApply: true,
            autoUpdateInput: false,
            showDropdowns: true,
            maxDate: moment(),
            locale: {
                format: 'YYYY-MM-DD', // Date format
                applyLabel: "Apply",
                cancelLabel: "Cancel",
            }
        }, function(start, end, label) {
            console.log("Selected range: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log("Date range selected: " + picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
            updateTable();
            // You can perform any action here, for example, updating some content or making an API call
        });
        $(document).on('change', '.shift_id', function (e) { 
            var shift_id = $(this).val();
            var karyawan_id = $(this).data('id');
            var date = $(this).data('date');
            // Create sweet alert
            Swal.fire({
                    title: 'Are you sure?',
                    text: "Tindakan ini hanya akan merubah Shift saat ini. Point Keterlambatan akan di kalkulasi ulang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{route('team.edit.shift')}}",
                            type: "POST",
                            dataType: "json",
                            data: {
                                shift_id: shift_id,
                                date: date,
                                karyawan_id : karyawan_id
                            }
                        }).done(function(data) {
                            if(data.status=='success'){
                                var icon = 'success';
                                var title = 'Updated';
                            }else{
                                var title = 'Error'
                                var icon = 'error'
                            }
                            Swal.fire({
                                title: title,
                                text: data.message,
                                icon: icon,
                            }).then(function() {
                                location.reload();
                            });
                        }); 
                    }
                })
            
            
        })
    });
</script>