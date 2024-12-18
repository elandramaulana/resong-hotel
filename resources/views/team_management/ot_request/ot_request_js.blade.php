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
        var divisi_id = {{ $Divisions['id'] }};
        var selectedShift = "{{ request('shift') }}"; 
        $.ajax({
                url: '{{ route('select2.shift', [$Divisions['id']]) }}',
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
        $(document).on('click', '.btn-ot-actions', function(e){
            var ot_id = $(this).data('id');
            var status = $(this).data('set');
            if(status==='Approved'){
                swal.fire({
                    title: 'Approve OT?',
                    text: "Are you sure you want to approve this OT?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ot_action(ot_id, 'approved')
                        .then(response => {
                            swal.fire(
                                'Approved',
                                'OT has been approved.',
                                'success'
                            )
                        })
                        .catch(error => {
                            swal.fire(
                                'Error',
                                'Approval OT Error : '+error,
                                'error'
                            )
                        });
                    }
                    window.location.reload();
                });
            }else{
                swal.fire({
                    title: 'Reject OT?',
                    text: "Are you sure you want to reject this OT?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!',
                    input: 'textarea',
                    inputPlaceholder: 'Is there something wrong with this request ?',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Please enter a reason';
                        }
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        //how can i use value reason here ?
                        ot_action(ot_id, 'Rejected', result.value)
                        .then(response => {
                            swal.fire(
                                'Rejected',
                                'OT has been rejected.',
                                'success'
                            )                            
                        })
                        .catch(error => {
                            swal.fire(
                                'Error',
                                'Error when perform action :'+error,
                                'error'
                            )
                        });
                        window.location.reload();
                    }
                });
            }
            
        });
       function ot_action(ot_id, status, reason = null) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '{{ route('team.ot_action') }}',
                    type: "POST",
                    data: {
                        ot_id: ot_id,
                        status: status,
                        reason: reason
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log("Success:", data);
                        resolve(data); 
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        reject(xhr.responseJSON || error); 
                    }
                });
            });
        }
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
    });
</script>