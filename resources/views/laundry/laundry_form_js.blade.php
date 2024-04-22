<script type="text/javascript">
    $(function () {
        $(document).on('click', '.btn_del', function (param) { 
            $(this).closest('tr').remove();
            enBtnSubmit();
        });
            $.ajax({
                url: '{{ route('select2.categoryLaundry') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#category_id").select2({
                        data: data,
                    });
            });
        $(document).on('change', '#laundry_type', function (e) { 
            var lan_type = $(this).val();
            var element = document.getElementById('formSelectRoom');
            if(lan_type==='Guest'){
                element.style.display = 'block';
                $.ajax({
                url: '{{ route('select2.room_inhouse') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#checkin_id").select2({
                        data: data,
                    });
            });

            }else{
                element.style.display = 'none';
            }

            enBtnSubmit();
         });
        $(document).on('change', '#formSelectRoom', function(e){
            enBtnSubmit();
        });
        $(document).on('change', '#category_id', function(e){
            var cat_id = $(this).val();
            var formData = {
                    cat_id: cat_id
                };
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.detCatLaundryByID') }}", 
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        var cat_id = data.data['id'];
                        var cat_harga = data.data['cat_price'];
                        var cat_satuan = data.data['cat_unit'];
                        var cat_name = data.data['catergory_name'];
                        $("#frm_cat_id").val(cat_id);
                        $("#frm_cat_price").val(cat_harga);
                        $("#frm_cat_unit").val(cat_satuan);
                        $("#frm_cat_name").val(cat_name);
                        $("#cat_price").val(formatCurrency(cat_harga))
                        $("#cat_unit").val(cat_satuan);
                        $("#det_laundry_qty").focus();
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
                
        })
        $(document).on('click', '#btn-submit', function(e){
            var elementToHide = document.getElementById("dataKosong");
            var cat_qty = $("#det_laundry_qty").val();
            var cat_id = $("#frm_cat_id").val();
            if(cat_qty!=="" && cat_id!==""){
                elementToHide.style.display = "none";
                var cat_name = $("#frm_cat_name").val();
                var cat_price = $("#frm_cat_price").val();
                var cat_unit = $("#frm_cat_unit").val();
                var item_desc = $("#item_description").val();
                var total = cat_qty * cat_price;
                var show_harga = formatNumber(cat_price);
                var show_jml = formatNumber(cat_qty)
                var show_total = formatCurrency(total);
                var newRowHTML = `
               
                    <tr class='tableRow'>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${cat_id}" name="send_cat_id[]" >
                            ${cat_name}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${item_desc}" name="send_cat_desc[]" >
                            <input hidden class='multipleInput' type="text" value="  ${cat_name}" name="send_cat_name[]" >
                            ${item_desc}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${cat_qty}" name="send_cat_qty[]" >
                            ${show_harga}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${cat_price}" name="send_cat_price[]" >
                            ${show_jml} ${cat_unit}
                        </td>
                        <td>
                            ${show_total}
                        </td>
                        <td><a class='btn_del'><i class='fa fa-trash'></i></a></td>
                    </tr>
                `;
                document.querySelector("#listLaundry tbody").insertAdjacentHTML('afterbegin', newRowHTML);
            }
            enBtnSubmit();
        });
    });
    function enBtnSubmit(){
         //get all parameter
         var laundry_type = $("#laundry_type").val();
        var checkin_id = $("#checkin_id").val();
        if(laundry_type!==""){
            if(laundry_type=="Guest"){
                if(checkin_id!==""){
                    var enable = 1;
                }else{
                    var enable = 0;
                }
            }else{
                var enable = 1;
            }
        }
      
        var item = document.getElementsByClassName('multipleInput').length;
        if(item>0){
            var item  = 1;
        }else{
            item = 0;
        }
        enable = enable +item;
        var btn = document.getElementById('btnSubmit');
        if(enable>1){
            btn.disabled = false;
        }else{
            btn.disabled = true;
        }
    }
    $(document).on('submit', '#formInput', function (e) { 
        e.preventDefault();
        //collect all paramater can be post
        var formData = {};
        
        var singleInput = document.querySelector('.singleInput');
        formData[singleInput.name] = singleInput.value;
        formData['checkin_id'] = $("#checkin_id").val();
        
        var multipleInputs = document.querySelectorAll('.multipleInput');
        multipleInputs.forEach(function(input, index) {
            if (!formData[input.name]) {
                formData[input.name] = [];
            }
            formData[input.name].push(input.value);
        });
       
            $.ajax({
                type: "POST",
                url: "{{ route('laundry.post') }}", 
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.status=='success'){
                        Swal.fire({
                                    icon: "success",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                // Reload the page after a delay
                                setTimeout(function() {
                                    window.location.href = "{{ route('laundry') }}";
                                }, 1000); // Adjust the delay as needed
                            });
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
     });
   
</script>