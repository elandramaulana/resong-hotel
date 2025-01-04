<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.btn-download-slip', function(e){
            e.preventDefault();
            var id_detail_payrolls = $(this).data('id');
            window.location.href = '{{ route('payroll.download_slip', ':id') }}'.replace(':id', id_detail_payrolls);
        });
        $(document).on('click', ".btn-slip-detail", function (e) {
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
                    }
                    // ,
                    // error: function(xhr, status, error) {
                    //     console.error("Error:", error);
                    // }
                });

            });

    });
</script>
