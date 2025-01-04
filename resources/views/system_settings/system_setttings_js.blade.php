<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#frmUpdate").on('submit', function (e) {
                e.preventDefault();
                const buttonSubmit = document.querySelector('.btn-submit');
                var form = $(this)[0];
                let frmData = new FormData(form);
                buttonSubmit.setAttribute('disabled', true);
                let formAction = $(this).attr("action");
                $('.showerror').text('');
                $('input, select, textarea').removeClass('error-border'); // Remove error styling

                $.ajax({
                        type: 'POST',
                        url: formAction,
                        data: frmData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                           if(data.status=='success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.reload();
                                });
                           }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                           }
                        },
                        error: function (xhr, status, error) {
                        if (xhr.status === 413) {
                                var inputElement = $('[name="evidence_transfer"]');
                                var errorMessage = "The file you are trying to upload is too large";
                                inputElement.siblings('.showerror').text(errorMessage);
                                inputElement.addClass('error-border');
                        } else {
                            var errors = xhr.responseJSON.errors;
                            $('.showerror').text('');
                            $('select, textarea, input').removeClass('error-border');
                            $.each(errors, function (field, messages) {
                                    var inputElement = $('[name="' + field + '"]');
                                    var errorMessage = messages.join(', ');
                                    inputElement.siblings('.showerror').text(errorMessage);
                                    inputElement.addClass('error-border');
                            });

                        }
                        },
                        complete: function() {
                            // Re-enable the submit button regardless of success or error
                            buttonSubmit.removeAttribute('disabled');
                        }
                });

            });
    });
</script>
