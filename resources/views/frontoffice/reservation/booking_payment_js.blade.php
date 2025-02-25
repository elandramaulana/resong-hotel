<script type="text/javascript">
    $(function () {
        function CalculateTotal() {
            let total = 0;
            let room_price = {{$room_detail->room_price}};
            let qty_hari = {{$tamu_detail['qty_hari']}};
            let pajak_checkin = {{$Settings->pajak_checkin}};
            let extrabed_price = {{$Settings->extrabed_price}};
            let extrabed = $("#extrabed").is(":checked") ? extrabed_price : 0;
            total = ((room_price * qty_hari) + extrabed) + ((room_price * qty_hari) * (pajak_checkin / 100)) ;
            // $("#total_price").val(total);
            // $("#total_price_input").val(total);
            $("#total_bayar").val(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total));
            var payment_status = $("#reservation_payment_status").val();
            if (payment_status === 'DP') {
                total *= 0.5;
            }
            $("#reservation_payment").val(total);
        }


        CalculateTotal();
        $("#extrabed, #reservation_payment_status").change(function() {
            CalculateTotal();
        });
        // $("").change(function() {
        //     CalculateTotal();
        // });
    });
</script>
