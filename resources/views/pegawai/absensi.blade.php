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
                            <div class="col-lg-6">
                                <a href="" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modalSettings">Pengaturan Kehadiran</a>
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
                                    <select name="id_shift" class="form-control" id="shift" disabled>
                                        <option value="">Pilih Shift</option>
                                    </select>
                                </div>
                            </div>
                    
                            <!-- Filter Tanggal -->
                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Date</label>
                                    <input name="tanggal_absen" type="date" class="form-control" id="tanggal">
                                </div>
                            </div> --}}

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Pilih Tanggal</label>
                                    <input value="" name="tanggal_absen" type="text" class="form-control"
                                        id="tanggal" onfocus="(this.type='date');this.focus()"
                                        onblur="(this.type='text');this.value=formatDate(this.value)">
                                    <x-input-error :messages="$errors->get('tanggal_absen')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    
                        <div class="table-responsive">
                            <table id="dataAbsensiTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Shift</th>
                                        <th>Schedule In</th>
                                        <th>Punch In</th>
                                        <th>Schedule Out</th>
                                        <th>Punch Out</th>
                                        <th>Working Hour</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
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
<!-- Modal -->
<div class="modal fade" id="modalSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Pengaturan Point Keterlambatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('latepoint.update') }}" method="post" id="frmUpdate">
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint I</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" value="{{ $latePointSetting['first_late'] }}" name="first_late" id="first_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" value="{{ $latePointSetting['first_latepoint'] }}" name="first_latepoint" id="first_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint II</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" name="second_late" value="{{ $latePointSetting['second_late'] }}" id="second_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>                    
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" name="second_latepoint" value="{{ $latePointSetting['second_latepoint'] }}" id="second_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Checkpoint III</h6>
                <div class="form-group col-lg-6">
                    <label for="">Keterlambatan (Menit)</label>
                    <input type="number" name="third_late" value="{{ $latePointSetting['third_late'] }}" id="third_late" class="form-control" placeholder="Masukan lama keterlambatan dalam menit" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Point Keterlambatan</label>
                    <input type="number" name="third_latepoint" value="{{ $latePointSetting['third_latepoint'] }}" id="third_latepoint" class="form-control" placeholder="Masukan jumlah keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
            <div class="row">
                <h6 class="font-weight-bold text-dark">Potongan Gaji Keterlambatan</h6>
                <div class="form-group col-lg-6">
                    <label for="">Besar Potongan (Rp)</label>
                    <input value="{{ $latePointSetting['besar_potongan'] }}" type="number" name="besar_potongan" id="besar_potongan" class="form-control" placeholder="Masukan besar potongan keterlambatan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Per Point Keterlambatan</label>
                    <input value="{{ $latePointSetting['besar_point'] }}" type="number" name="besar_point" id="besar_point" class="form-control" placeholder="Masukan jumlah point perpotongan" aria-describedby="helpId">
                    <i class="showerror"></i>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
        </div>
        @csrf
    </form>
      </div>
    </div>
  </div>
<!-- Tambahkan ini di bagian <head> atau tepat sebelum </body> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
           
            $("#frmUpdate").on('submit', function (e) { 
                e.preventDefault();
                const buttonSubmit = document.querySelector('.btn-submit');
                var form = $(this)[0];
                let frmData = new FormData(form);
                buttonSubmit.setAttribute('disabled', true);
                let formAction = $(this).attr("action");
                $('.showerror').text(''); 
                 $('input, select, textarea').removeClass('error-border'); // Remove error styling

                $.ajax({
                        type: 'POST',
                        url: formAction, 
                        data: frmData,
                        processData: false,
                        contentType: false,
                        success: function (data) { 
                           if(data.status=='success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.reload();
                                });
                           }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                           }
                        },
                        error: function (xhr, status, error) {               
                        if (xhr.status === 413) {
                                var inputElement = $('[name="evidence_transfer"]');
                                var errorMessage = "The file you are trying to upload is too large";
                                inputElement.siblings('.showerror').text(errorMessage);
                                inputElement.addClass('error-border');
                        } else {
                            var errors = xhr.responseJSON.errors;
                            $('.showerror').text('');
                            $('select, textarea, input').removeClass('error-border');
                            $.each(errors, function (field, messages) {
                                    var inputElement = $('[name="' + field + '"]');
                                    var errorMessage = messages.join(', ');
                                    inputElement.siblings('.showerror').text(errorMessage);
                                    inputElement.addClass('error-border');
                            });
                           
                        }
                        },
                        complete: function() {
                            // Re-enable the submit button regardless of success or error
                            buttonSubmit.removeAttribute('disabled');
                        }
                });
             
            });

            // Fetch Karyawan and Shift options based on Divisi selection
            $('#divisi').change(function() {
                var divisiId = $(this).val();
                if(divisiId) {
                    // Enable shift dropdown
                    $('#shift').prop('disabled', false);
                    
                    // Fetch shifts
                    $.ajax({
                        url: '{{ route("get.shifts.by.divisi", ":id") }}'.replace(':id', divisiId),
                        type: 'GET',
                        success: function(data) {
                            $('#shift').empty();
                            $('#shift').append('<option value="">Pilih Shift</option>');
                            $.each(data, function(key, value) {
                                $('#shift').append('<option value="' + value.id + '">' + value.s_nama + '</option>');
                            });
                        }
                    });
        
                    // Fetch and display karyawan
                    filterAbsensi();
                } else {
                    $('#shift').prop('disabled', true);
                    $('#shift').empty();
                    $('#shift').append('<option value="">Pilih Shift</option>');
                    $('#dataAbsensiTable tbody').empty();
                }
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
                        tanggal_absen: tanggal
                    },
                    success: function(data) {
                    console.log(data);
                    
                        $('#dataAbsensiTable tbody').empty();
                        if (data.absensi.length === 0) {
                            $('#dataAbsensiTable tbody').append('<tr><td colspan="9" class="text-center">Tidak ada data</td></tr>');
                        } else {
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
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        $('#dataAbsensiTable tbody').empty();
                        $('#dataAbsensiTable tbody').append('<tr><td colspan="9" class="text-center">Error loading data</td></tr>');
                    }
                });
            }
        });
        </script>

@endsection
