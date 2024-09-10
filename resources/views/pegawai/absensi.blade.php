@extends('layouts.dashboard_layout')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="font-weight-bold text-dark">Daftar Absensi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Filter Divisi -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="divisi" class="form-label">Divisi</label>
                                    <select name="id_divisi" class="form-control" id="divisi">
                                        <option value="">Pilih Divisi</option>
                                        @foreach($divisis as $divisi)
                                            <option value="{{ $divisi->id }}">{{ $divisi->d_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <!-- Filter Shift -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="shift" class="form-label">Shift</label>
                                    <select name="id_shift" class="form-control" id="shift">
                                        <option value="">Pilih Shift</option>
                                    </select>
                                </div>
                            </div>
                    
                            <!-- Filter Tanggal -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Date</label>
                                    <input name="tanggal_cleaning" type="date" class="form-control" id="tanggal">
                                </div>
                            </div>
                        </div>
                    
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataAbsensiTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">NO</th>
                                        <th>Nama</th>
                                        <th>Shift</th>
                                        <th>Schedule-In</th>
                                        <th>Punch-In</th>
                                        <th>Schedule-Out</th>
                                        <th>Punch-Out</th>
                                        <th>Working Hour</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat melalui AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



</div>
<script>
    $(document).ready(function() {
        // Fetch Shift options based on Divisi selection
        $('#divisi').change(function() {
            var divisiId = $(this).val();
            $.ajax({
                url: '/get-shift-by-divisi/' + divisiId,
                method: 'GET',
                success: function(data) {
                    $('#shift').empty().append('<option value="">Pilih Shift</option>');
                    $.each(data.shifts, function(key, value) {
                        $('#shift').append('<option value="' + value.id + '">' + value.s_nama + '</option>');
                    });
                }
            });

            // Fetch filtered data
            filterAbsensi();
        });

        // Trigger filter when shift or date is changed
        $('#shift, #tanggal').change(function() {
            filterAbsensi();
        });

        function filterAbsensi() {
            var divisiId = $('#divisi').val();
            var shiftId = $('#shift').val();
            var tanggal = $('#tanggal').val();

            $.ajax({
                url: '{{ route("filter.absensi") }}',
                method: 'GET',
                data: {
                    id_divisi: divisiId,
                    id_shift: shiftId,
                    tanggal_cleaning: tanggal
                },
                success: function(data) {
                    $('#dataAbsensiTable tbody').empty();
                    $.each(data.absensi, function(index, absensi) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + absensi.nama + '</td>' +
                            '<td>' + absensi.shift_nama + '</td>' +
                            '<td>' + absensi.schedule_in + '</td>' +
                            '<td>' + absensi.punch_in + '</td>' +
                            '<td>' + absensi.schedule_out + '</td>' +
                            '<td>' + absensi.punch_out + '</td>' +
                            '<td>' + absensi.working_hour + '</td>' +
                            '<td>' + absensi.status + '</td>' +
                            '</tr>';
                        $('#dataAbsensiTable tbody').append(row);
                    });
                }
            });
        }
    });
</script>


@endsection
