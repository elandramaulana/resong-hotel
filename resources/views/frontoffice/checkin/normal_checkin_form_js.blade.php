<script type="text/javascript">
       $(function () {
        const checkinDateInput = document.getElementById('checkin_time');
        const checkoutDateInput = document.getElementById('checkout_time');
        const extrabed = document.getElementById('extrabed');
        const roomPrice = {{ $Room->room_price }};
        const extrabedPrice = {{ $Settings->extrabed_price }};

        function calculateSummary() {
            const checkinDate = new Date(checkinDateInput.value);
            const checkoutDate = new Date(checkoutDateInput.value);
            const duration = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
            let totalPrice = duration * roomPrice;

            if (extrabed.checked) {
            totalPrice += extrabedPrice;
            document.getElementById('extrabed_price').textContent = extrabedPrice.toLocaleString('id-ID');
            } else {
            document.getElementById('extrabed_price').textContent = '0';
            }
            const taxRate = {{$Settings->pajak_checkin}};
            let taxAmount = totalPrice * (taxRate / 100);
            totalPrice = totalPrice + taxAmount;
            document.getElementById('summary_checkin_date').textContent = checkinDateInput.value;
            document.getElementById('summary_checkout_date').textContent = checkoutDateInput.value;
            document.getElementById('summary_duration').textContent = duration;
            document.getElementById('summary_total_price').textContent = totalPrice.toLocaleString('id-ID');
            document.getElementById('showPajak').textContent = taxAmount.toLocaleString('id-ID');
        }

        checkinDateInput.addEventListener('change', calculateSummary);
        checkoutDateInput.addEventListener('change', calculateSummary);
        extrabed.addEventListener('change', calculateSummary);

        calculateSummary();
        function calculateDuration() {
            var checkinTime = $('#checkin_time').val();
            var checkoutTime = $('#checkout_time').val();

            if (checkinTime && checkoutTime) {
            var checkin = new Date(checkinTime);
            var checkout = new Date(checkoutTime);

            var duration = (checkout - checkin) / (1000 * 60 * 60 * 24); // duration in days
            if (duration == 0) {
                duration = 1;
            }
            if (duration < 0) {
                alert('Tanggal Check Out tidak boleh kurang dari tanggal Check In');
                $('#checkout_time').val('');
                return false;
            }
            var price = {{$Room->room_price}};
            console.log(price);


            var total = price * duration;
            $("#total_bayar").val(total.toLocaleString());
            return duration;
            // You can use the duration variable here if needed
            }
        }

        $(document).on('change', '#checkout_time, #checkin_time', function (e) {
           var days = calculateDuration();
           console.log(days);
        });

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
                            var selectElement = document.getElementById("agama");
                            var valueToSelect = data.guest_religion; // Value of the option to be selected
                            $("#frm_email").val(data.guest_email);
                            $("#telp_number").val(data.guest_contact);
                            $("#country").val(data.guest_country);
                            $("#province").val(data.guest_province);
                            $("#city").val(data.guest_city);
                            $("#postal_code").val(data.guest_postalcode);
                            $("#inputDeposit").focus();
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
