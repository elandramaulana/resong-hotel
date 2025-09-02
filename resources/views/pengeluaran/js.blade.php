<script type="text/javascript">
    $(function () {
        let url = "{{ route('pengeluaran.edit', ['id' => ':id']) }}";
        function getEditUrl(id) {
            return url.replace(':id', id);
        }

        $(document).on('click', '.edit', function () {
            let id = $(this).data('id');
            setEditForm(id);
        })
        function setEditForm(id) {
            let url = getEditUrl(id);

            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    console.log(response);
                    $('#item').val(response.item);
                    $('#harga').val(response.harga);
                    $('#jumlah').val(response.qty);
                    $('#tanggal').val(response.tgl);
                    $('#keterangan').val(response.keterangan);
                    $('#id').val(response.id);
                    $('#inputFormModal').modal('show');
                    $('#inputFormModal').find('form').attr('action', "{{ route('pengeluaran.update') }}");
                }
            });
        }
        let urlHapus = "{{ route('pengeluaran.destroy', ['id' => ':id']) }}";
        function getDeleteUrl(id) {
            return urlHapus.replace(':id', id);
        }
        $(document).on('click', '.delete', function () {
            let id = $(this).data('id');
            let url = getDeleteUrl(id);
            if (confirm('Are you sure to delete this data?')) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        })
    });
</script>
