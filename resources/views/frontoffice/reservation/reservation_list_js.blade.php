<script type="text/javascript">
    $(function () {
       $("#reservationListTable").dataTable();
       $(document).on('click','.btn-cancel' , function (e) { 
        var reservation_id = $(this).data('id');
        Swal.fire({
            icon: "question",
            title: "Cancel Reservasi Ini ?",
            showDenyButton: true,
            confirmButtonText: "Iya ",
            denyButtonText: "Tidak",
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                        },
                        url: "{{ route('booking.cancel') }}",
                        dataType: "json",
                        type:"post",
                        data: {
                            reservation_id : reservation_id,
                        },
                        success: function(data) {
                            if(data.status==='success'){
                                Swal.fire({
                                    icon: "success",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                // Reload the page after a delay
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000); // Adjust the delay as needed
                            });
                                
                            }
                        }
                    });
            }
            });
       });
    });
</script>