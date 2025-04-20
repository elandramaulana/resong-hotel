<script type="text/javascript">
    $(function () {

        loadLaudryData();
        $(document).on('click', '.btn-masuk', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#laundry_id').val(id);
            $.ajax({
                url: '{{ route('laundry.get_laundry') }}',
                method: 'GET',
                dataType: 'json',
                data: { id: id },
                success: function (data) {
                    console.log(data);
                    if(data.status_kembali == 'selesai'){
                        $('#inlineRadio1').prop('checked', true);
                    }else{
                        $('#inlineRadio2').prop('checked', true);
                    }
                    $('#keterangan_status').val(data.keterangan_status);
                    $('#harga').val(data.harga);
                }
            });
            console.log(id);
            $('#setMasuk').modal('show');
        })
        function loadLaudryData(){
            var table = $("#dtShow").DataTable();
            var filters = [];
            $('.filterCheckbox:checked').each(function() {
                filters.push($(this).val());
            });
            $.ajax({
                url: '{{ route('datatable.laundry') }}',
                method: 'GET',
                dataType: 'json',
                data: { filters: filters },
                success: function (data) {
                    console.log(data);

                    table.clear().draw();
                    $.each(data, function (index, item) {
                        table.row.add([
                            index + 1,
                            item.keterangan,
                            item.jumlah_satuan,
                            item.pengirim,
                            item.tgl_keluar,
                            item.penerima,
                            item.tgl_masuk,
                            '<span class="price">' + item.harga + '</span>',
                            item.action
                            // item.invoice_laundry,
                            // item.status,

                        ]).draw(false);
                        table.column(4).cells().render({
                            "display": function (data, type, row) {
                                // Check if it's display type
                                if (type === 'display') {
                                    return '<div style="text-align: right;">' + data + '</div>';
                                }
                                return data; // Otherwise, return the data as is
                            }
                        });
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Failed to load data:", error);
                }
            });
        }
    });
</script>
