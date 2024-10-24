<script type="text/javascript">
    $(function () {
        $(document).on('click', '.btnTrigger', function (e) { 
            e.preventDefault();
            $('#modalKomponenGaji').modal('show');
            const karyawan_id = $(this).data('id');
            console.log(karyawan_id);
        });
    });
</script>