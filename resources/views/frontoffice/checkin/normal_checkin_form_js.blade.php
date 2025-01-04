<script type="text/javascript">
       $(function () {
            $( "#id_number" ).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.guests') }}",
                        dataType: "json",
                        data: {
                            term : request.term,
                            type_identity : $("#id_type").val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2, // Minimum characters before triggering autocomplete
                select: function(event, ui) {
                var selectedTag = ui.item.value;
                $.ajax({
                        url: "{{ route('autocomplete.selectedguest') }}",
                        dataType: "json",
                        data: {
                            id_number : selectedTag,
                            id_type : $("#id_type").val()
                        },
                        success: function(data) {
                            $("#name_guest").val(data.name_guest);
                            $("#place_of_birth").val(data.place_of_birth);
                            $("#date_of_birth").val(data.date_of_birth);
                            if(data.guest_gender=='Laki-laki'){
                                document.getElementById("genderMale").checked = true;
                            }else{
                                document.getElementById("genderFemale").checked = true;
                            }
                            var selectElement = document.getElementById("agama");
                            var valueToSelect = data.guest_religion; // Value of the option to be selected

                            // Iterate over options to find the one with the matching value
                            for (var i = 0; i < selectElement.options.length; i++) {
                                if (selectElement.options[i].value === valueToSelect) {
                                    // Set the selected attribute of the matching option to true
                                    selectElement.options[i].selected = true;
                                    break; // Exit loop once the matching option is found
                                }
                            }
                            console.log(valueToSelect);
                            if(data.guest_title=='Mr'){
                                document.getElementById("titleMr").checked = true;
                            }else if(data.guest_title=='Mrs'){
                                document.getElementById("titleMrs").checked = true;
                            }else if(data.guest_title=='Ms'){
                                document.getElementById("titleMs").checked = true;
                            }
                            $("#country").val(data.guest_country);
                            $("#provinsi").val(data.guest_province);
                            $("#city").val(data.guest_city);
                            $("#frm_kodepos").val(data.guest_postalcode);
                            $("#frm_email").val(data.guest_email);
                            $("#contact").val(data.guest_contact);
                            $("#inputDeposit").focus();
                        }
                    });
            }
            });
            $(document).on('keyup', '#id_number', function (param) { 
                var elements = document.getElementsByClassName("clearable");
    
                // Iterate over the selected elements and clear their values
                for (var i = 0; i < elements.length; i++) {
                    elements[i].value = "";
                }

                document.getElementById("agama").selectedIndex = 0;
                document.getElementById("genderMale").checked = false;
                document.getElementById("genderFemale").checked = false;
                document.getElementById("titleMr").checked = false;
                document.getElementById("titleMrs").checked = false;
                document.getElementById("titleMs").checked = false;
            });
       });
</script>