<script type="text/javascript">
    $(function () {

        $(document).on('submit', '#frmAddons', function(e){
            e.preventDefault();
            var formData = $(this).serializeArray();
            let formAction = $(this).attr("action");

            $("#btn-submit").attr('disabled', true);
            $('#frmAddons').waitMe({
                effect : 'bounce',
                text : '',
                bg : "rgba(255,255,255,0.7)",
                color : "#000",
                maxSize : '',
                waitTime : -1,
                textPos : 'vertical',
                fontSize : '',
                source : '',
                onClose : function() {}
            });

            $.ajax({
               type: 'POST',
               url: formAction, 
               data: formData,
               success: function (data) { 
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
                console.log(data);
                   $("#frmAddons").waitMe("hide");
                   $("#btn-submit").attr('disabled', false);
               },
               error: function (xhr, status, error) {
                  var errors = xhr.responseJSON.errors;
                  var msg = xhr.responseJSON.message;
                  if(errors.messages=='Connection Fails'){
                     $('.showerror').text('');
                     $('select, textarea, input').removeClass('error-border');
                     $("#router-errors").text(errors.errors);
                     $("#btn-submit").attr('disabled', false);
                  }else{
                     $('.showerror').text('');
                     $('#showerror').text(msg);
                     $('select, textarea, input').removeClass('error-border');
                     $.each(errors, function (field, messages) {
                           var inputElement = $('[name="' + field + '"]');
                           var errorMessage = messages.join(', ');
                           inputElement.siblings('.showerror').text(errorMessage);
                           inputElement.addClass('error-border');
                          
                     });
                     $("#btn-submit").attr('disabled', false);
                  }
                  $("#frmAddons").waitMe("hide");
                 
               }
            });
        });
        $(document).on('click', '.del-addons', function(e){
            e.preventDefault();
            var detID = $(this).data('id');
            Swal.fire({
            icon: "question",
            title: "Hapus Addons ini ?",
            showDenyButton: true,
            confirmButtonText: "Iya ",
            denyButtonText: "Tidak",
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        url: "{{ route('inhouse.del_addons') }}",
                        dataType: "json",
                        data: {
                            detail_id : detID,
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
                            });
                                
                            }
                        }
                    });
            }
            });
        });
    });
</script>