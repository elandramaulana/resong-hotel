<script type="text/javascript">
    $(function () {
        $(document).on('click', '#btn-extrabed', function (e) { 
            Swal.fire({
            icon: "question",
            title: "Tambahkan Extrabed ?",
            showDenyButton: true,
            confirmButtonText: "Iya ",
            denyButtonText: "Tidak",
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        url: "{{ route('inhouse.add_extrabed') }}",
                        dataType: "json",
                        data: {
                            checkin_id : {{ $CheckinData->checkin_id }},
                        },
                        success: function(data) {
                            if(data.status==='success'){
                                Swal.fire({
                                    icon: "success",
                                    title: data.msg,
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                // Reload the page after a delay
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000); // Adjust the delay as needed
                            });;
                                
                            }
                        }
                    });


            }
            });
        });
    });
</script>