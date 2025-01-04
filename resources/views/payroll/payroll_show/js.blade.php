<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).on('click', ".btn-add", function (e) {
            var id_detail_payroll = $(this).data('id');
            $("#id_detail_payrol").val(id_detail_payroll);
            // Show the modal
           $("#modalAddItem").modal('toggle');
        });    
            $(document).on('click', ".btn-detail-payroll", function (e) {
                var id_detail_payrolls = $(this).data('id');
                $.ajax({
                    url: '{{ route('payroll.det_detail_payroll') }}',
                    type: "POST",
                    data: {
                        id_detail_payrolls: id_detail_payrolls
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#showNameSlip").text(data[0].k_nama);
                        // Construct the table HTML
                        let pemasukanRows = '';
                        let potonganRows = '';
                        let totalPemasukan = 0;
                        let totalPotongan = 0;

                        data.forEach((item, index) => {
                            if (item.type_komponen_payroll === 'pendapatan') {
                                totalPemasukan += item.besaran_komponen_payroll;
                                pemasukanRows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nama_komponen_payroll}</td>
                                        <td class="text-right">${item.besaran_komponen_payroll.toLocaleString()}</td>
                                        <td>-</td>
                                        
                                    </tr>
                                `;
                            } else if (item.type_komponen_payroll === 'potongan') {
                                totalPotongan += item.besaran_komponen_payroll;
                                potonganRows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nama_komponen_payroll}</td>
                                        <td>-</td>
                                        <td class="text-right">${item.besaran_komponen_payroll.toLocaleString()}</td>
                                        
                                    </tr>
                                `;
                            }
                        });

                        let thp = totalPemasukan - totalPotongan;

                        let tableHTML = `
                            <table class="table table-bordered table-stripted">
                                <thead>
                                    <tr>
                                        <th width="1" rowspan="2" class="text-center">No</th>
                                        <th rowspan="2" class="text-center">Nama Komponen</th>
                                        <th colspan="2" class="text-center">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pemasukan</th>
                                        <th class="text-center">Potongan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th colspan="5">A. Pemasukan</th></tr>
                                    ${pemasukanRows}
                                    <tr><th colspan="5">B. Potongan</th></tr>
                                    ${potonganRows}
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Jumlah</b></td>
                                        <td class="text-right">${totalPemasukan.toLocaleString()}</td>
                                        <td class="text-right">${totalPotongan.toLocaleString()}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Take Home Pay</b></td>
                                        <td class="text-right" colspan="2"><b>${thp.toLocaleString()}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        `;
                        // Inject the constructed table into the modal
                        $("#showTable").html(tableHTML);

                        // Show the modal
                        $("#modalSlip").modal('toggle');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        $(document).on('click', '#btn-accept', function (e) { 
            var payroll_id = $(this).data('id');
            //show confirm sweet alert here
            swal.fire({
                    title: 'Accept Payrolls ?',
                    text: "Are you sure you want to accept this Payroll ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //send ajax to accept the payroll
                        $.ajax({
                            url: '{{ route('payroll.acc_payroll') }}',
                                type: "POST",
                                data: {
                                    payroll_id:payroll_id
                                },
                                dataType: "json",
                                success: function(data) {
                                    if(data.status==='success'){
                                        swal.fire(
                                            'Accepted',
                                            data.message,
                                            'success'
                                        )
                                    }else{
                                        swal.fire(
                                            'Error',
                                            data.message,
                                            'error'
                                        )
                                    }
                                    console.log("Success:", data);

                                },
                                error: function(xhr, status, error) {
                                    console.error("Error:", error);
                                    reject(xhr.responseJSON || error); 
                                }
                        });
                    }
                    // window.location.reload();
                });
            
            
        });
       function ot_action(ot_id, status, reason = null) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '{{ route('team.ot_action') }}',
                    type: "POST",
                    data: {
                        ot_id: ot_id,
                        status: status,
                        reason: reason
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log("Success:", data);
                        resolve(data); 

                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        reject(xhr.responseJSON || error); 
                    }
                });
            });
        }
  //call daterange picker
  $('#daterange').daterangepicker({
            opens: 'right', // Options: 'left', 'right', 'center'
            singleDatePicker: true,
            autoApply: true,
            autoUpdateInput: false,
            showDropdowns: true,
            maxDate: moment(),
            locale: {
                format: 'YYYY-MM-DD', // Date format
                applyLabel: "Apply",
                cancelLabel: "Cancel",
            }
        }, function(start, end, label) {
            console.log("Selected range: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log("Date range selected: " + picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
            updateTable();
            // You can perform any action here, for example, updating some content or making an API call
        });
    });
</script>