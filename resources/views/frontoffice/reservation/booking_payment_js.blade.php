<script type="text/javascript">
    $(function () {
        $(document).on('change', "#reservation_payment_status", function (e) { 
            var reservation_payment_status = $(this).val();
            var total_bayar = {{ $total }};
            if(reservation_payment_status=='Lunas'){
                var pembayaran = total_bayar
            }else if(reservation_payment_status=='DP'){
                var pembayaran = total_bayar/2;
            }else{
                var pembayaran = "";
            }
            $("#reservation_payment").val(pembayaran);
         });
    });
</script>