<script type="text/javascript">
    $(function () {

        loadLaudryData();
        $(document).on('click', '.btn-masuk', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#laundry_id').val(id);
            $('#setMasuk').modal('show');
        })
        function loadLaudryData(){
            var table = $("#dtShow").DataTable();
            var filters = [];
            $('.filterCheckbox:checked').each(function() {
                filters.push($(this).val());
            });
            $.ajax({
                url: '{{ route('datatable.laundry_guest') }}',
                method: 'GET',
                dataType: 'json',
                data: { filters: filters },
                success: function (data) {
                    console.log(data);

                    table.clear().draw();
                    $.each(data, function (index, item) {
                        table.row.add([
                            index + 1,
                            item.catatan,
                            item.name_guest,
                            item.room,
                            item.jenis_laundry,
                            item.pengirim,
                            item.tgl_laundry_keluar,
                            item.penerima,
                            item.tgl_laundry_masuk,
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
