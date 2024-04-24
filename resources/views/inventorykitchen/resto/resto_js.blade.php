<script type="text/javascript">
    $(function () {
        $(document).on('change', '#customer_type', function (e) { 
            var customer_type = $(this).val();
            var hiddenParagraph = document.getElementById("formSelectRoom");
            var nama = document.getElementById("nama_customer");
            var kontak = document.getElementById("contact_customer");
            var email = document.getElementById("customer_email");
            if(customer_type==='Guest'){
                //show select room 
                hiddenParagraph.style.display = "block";
                $.ajax({
                url: '{{ route('select2.room_inhouse') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    $("#checkin_id").select2({
                        data: data,
                    });
                });
                nama.style.display = "none";
                kontak.style.display = "none";
                email.style.display = "none";
            }else{
                hiddenParagraph.style.display = "none";
                nama.style.display = "block";
                kontak.style.display = "block";
                email.style.display = "block";
            }
            enBtnSubmit();
        })
        $(document).on('change', '#checkin_id', function(e){
            
            enBtnSubmit();
        });
        $(document).on('click', '#btnAdd', function(e){
            callMenuAjax();
            select2Category();
        });
        function callMenuAjax(){
            var day_name = $("#day_name").val();
            var cat_id = $("#category_id").val();
            // console.log(cat_id);
            $('#list_menu option:not(:first-child)').remove();
            $('#list_menu').trigger('change');
            $.ajax({
                url: '{{ route('select2.menu_active') }}',
                type: "GET",
                data: {day_id:day_name, cat_id:cat_id},
                dataType: "json",
                }).done(function(data) {
                    $("#list_menu").select2({
                        data: data,
                    });
            });
        }
        $(document).on('change', '#list_menu', function (e) {
            var menu_id = $(this).val(); 
            $.ajax({
                url: '{{ route('detail.menu') }}',
                type: "GET",
                data: {menu_id:menu_id},
                dataType: "json",
                }).done(function(data) {
                    $("#menu_price").val(data.menu_price)
                    // console.log(data.menu_price);
            });
            document.getElementById("menu_qty").focus();
         });
        $(document).on('change', "#category_id", function(e){
            callMenuAjax();
        });
        function select2Category() { 
            $.ajax({
                url: '{{ route('select2.menu_category') }}',
                type: "GET",
                dataType: "json",
                }).done(function(data) {
                    const now = new Date();
                    const hours = now.getHours().toString().padStart(2, '0'); // padStart adds a leading zero if necessary
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    const seconds = now.getSeconds().toString().padStart(2, '0');
                    var current_time = `${hours}`;
                    var cat_menu = "";
                    if(current_time<12){
                        cat_menu = 1;
                    }else if(current_time<16){
                        cat_menu = 2;
                    }else{
                        cat_menu = 3;
                    }
                    $("#category_id").select2({
                        data: data,
                    });
                    $('#category_id').val(cat_menu).trigger('change');
            });

            
            //  console.log(cat_menu);
        
            }

        $(document).on('click', '.btn_del', function (param) { 
            $(this).closest('tr').remove();
           enBtnSubmit();
        });

        $(document).on('click', '#btn-submit', function(e){
            var elementToHide = document.getElementById("dataKosong");
            var list_menu = $("#list_menu").val();
            
            if(list_menu !=""){
                elementToHide.style.display = "none";
                
                const menu_element = document.getElementById("list_menu");
                const selectedOption = menu_element.options[menu_element.selectedIndex];
                var show_menu = selectedOption.text;

                const menucat_element = document.getElementById("category_id");
                const selectedOptioncat = menucat_element.options[menucat_element.selectedIndex];
                var show_cat = selectedOptioncat.text;

                var menu_cat = $("#category_id").val();
                var menu_price = $("#menu_price").val();
                var menu_qty = $("#menu_qty").val();
                var total = menu_qty * menu_price;
                var show_harga = formatNumber(menu_price);
                var show_jml = formatNumber(menu_qty)
                var show_total = formatCurrency(total);
                var newRowHTML = `
                    <tr class='tableRow'>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${list_menu}" name="inp_menu_id[]" >
                            <input hidden class='multipleInput' type="text" value="${show_menu}" name="inp_menu_name[]" >
                            ${show_menu}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="  ${menu_cat}" name="inp_kategori[]" >
                            ${show_cat}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${menu_price}" name="inp_price[]" >
                            ${menu_price}
                        </td>
                        <td>
                            <input hidden class='multipleInput' type="text" value="${menu_qty}" name="inp_qty[]" >
                            ${menu_qty}
                        </td>
                        <td>
                            ${total}
                        </td>
                        <td><a class='btn_del'><i class='fa fa-trash'></i></a></td>
                    </tr>
                `;
                document.querySelector("#detailLayananRestoTable tbody").insertAdjacentHTML('afterbegin', newRowHTML);
            }
            enBtnSubmit();
        });
    });

    function enBtnSubmit(){
         //get all parameter
         var customer_type = $("#customer_type").val();
        var checkin_id = $("#checkin_id").val();
        if(customer_type!==""){
            if(customer_type=="Guest"){
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
</script>