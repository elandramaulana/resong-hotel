<script type="text/javascript">
    $(function () {
        var callDatatable =  $("#tableID").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{route('inhouse.table')}}",
                // data: function(data){
                //     data.filterLevel = $('#filterLevel').val();
                // }
            },
            columns: [
                { data: 'no', orderable: false },
                { data: 'name_guest' },
                { data: 'room_no' },
                { data: 'date_checkin' },
                { data: 'date_checkout' },
                { data: 'chanel_checkin' },
                { data: 'payment' },
                { data: 'btn-action', orderable: false, searchable:false },
            ],
            order: [
                    [3, 'desc'],
                    ],
        });
    });
</script>