<script type="text/javascript">
       $(function () {
        check_rooms();
            function check_rooms(){
                $('#showWaitme').waitMe({
                    effect : 'ios',
                    text : 'Getting Room Informations',
                    color : "#000",
                    maxSize : '',
                    waitTime : 30000,
                    textPos : 'vertical',
                    fontSize : '',
                    source : '',
                    onClose : function() {}
                });

                let fromDate = $("#fromDate").val();
                let toDate = $("#toDate").val();
                let token = $('meta[name=csrf-token]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('ajax.selectrooms.checkout') }}",
                    success: function(response){
                        $("#ajax_select_rooms").html(response.html);
                       $("#showWaitme").waitMe("hide");
                    },
                    error: function(xhr){
                        alert(xhr.responseText);
                       $("#showWaitme").waitMe("hide");
                    }
                });
            }
       });
</script>