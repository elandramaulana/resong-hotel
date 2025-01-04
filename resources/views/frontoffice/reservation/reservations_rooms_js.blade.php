<script type="text/javascript">
       $(function () {
        var callDatatable =  $("#tableID").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{route('booking.table')}}",
                data: function(data){
                    data.reservation_checkin = $('#reservation_checkin').val();
                    data.reservation_checkout = $('#reservation_checkout').val();
                    data.qty_guest = $('#qty_guest').val();
                }
            },
            columns: [
                { data: 'no', orderable: false, searchable:false },
                { data: 'room_no' },
                { data: 'room_name' },
                { data: 'room_type' },
                { data: 'room_price' },
                { data: 'room_capacity' },
                { data: 'room_extrabed' },
                { data: 'btn-action', orderable: false, searchable:false },
            ],
            order: [
                    [1, 'desc'],
                    ],
        });
       });
</script>