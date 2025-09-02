{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                console.log('table updated');
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
        var datevalue = $('#daterange').val();
        console.log(datevalue);
        $(document).on('change', '#daterange', function (e) {
            console.log($(this).val());

            updateTable();
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
