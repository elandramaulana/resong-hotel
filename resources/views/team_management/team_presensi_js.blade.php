<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function () {        
        //load pilihan shift
        var divisi_id = {{ $divisionID }};
        $.ajax({
                url: '{{ route('select2.shift', [$divisionID]) }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#shift_select2").select2({
                        data: data,
                    });
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
            // You can perform any action here, for example, updating some content or making an API call
        });
    });
</script>