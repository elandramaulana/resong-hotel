@extends('layouts.dashboard_layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Gaji</h1>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <h4>Error Message</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Checkout Detail -->
    
    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input hidden value="{{ $detailGaji->id_karyawan }}" name="karyawan_id" type="text" class="form-control" id="karyawan_id" readonly>
                            <label for="nama" class="form-label">Nama</label>
                            <input value="{{ $detailGaji->karyawan_nama }}" name="nama" type="text" class="form-control" id="nama" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="divisi" class="form-label">Divisi</label>
                            <input readonly name="divisi" type="text" class="form-control" value="{{ $detailGaji->divisi_karyawan }}">
                            <x-input-error :messages="$errors->get('divisi')" class="mt-2"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4 class="col-lg-6">Komponen Gaji</h4>
                    <p class="col-lg-6 text-right"><a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalAddKomponen">Tambah <i class="fa fa-plus" aria-hidden="true"></i></a></p>
                </div>
            </div>
            <div class="card-body text-dark">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead >
                                <tr>
                                    <th width="1" rowspan="2" class="text-center">No</th>
                                    <th rowspan="2" class="text-center">Nama Komponen</th>
                                    <th colspan="2" class="text-center">Jumlah</th>
                                    <th  rowspan="2" class="text-center ">Hapus</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Pemasukan</th>
                                    <th class="text-center">Potongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="5">A. Pemasukan</th>
                                </tr>
                                @php
                                    $totalPemasukan = 0;
                                @endphp
                                @foreach ($komponenGaji['pemasukan'] as $pemasukan)
                                @php
                                    $totalPemasukan += $pemasukan->besaran;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pemasukan->nama_komponen }}</td>
                                    <td class="text-right">{{ number_format($pemasukan->besaran, 0, ',', '.')  }}</td>
                                    <td>-</td>
                                    <td class="text-center">
                                        <a href="#" class="btn-delete" data-id="{{ $pemasukan->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5">B. Potongan</th>
                                </tr>
                                @php
                                    $totalPotongan = 0;
                                @endphp
                                @foreach ($komponenGaji['potongan'] as $potongan)
                                @php
                                    $totalPotongan += $potongan->besaran;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $potongan->nama_komponen }}</td>
                                    <td>-</td>
                                    <td class="text-right">{{ number_format($potongan->besaran, 0, ',', '.')  }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn-delete" data-id="{{ $potongan->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center"><b>Jumlah</b></td>
                                    <td class="text-right">{{  number_format($totalPemasukan, 0, ',', '.')  }}</td>
                                    <td class="text-right">{{ number_format($totalPotongan, 0, ',', '.') }}</td>
                                </tr>
                                @php
                                    $thp = $totalPemasukan - $totalPotongan;
                                @endphp
                                <tr>
                                    <td colspan="2" class="text-center"><b>Take Home Pay</b></td>
                                    <td class="text-right" colspan="2" ><b>{{ number_format($thp, 0, ',', '.') }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <small><i>Note: Form ini adalah komponen gaji rutin karyawan, jika ada bonus atau potongan tidak rutin dapat di tambahkan saat Proses Gaji Karyawan</i></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</section>
<!-- Modal -->
<div class="modal fade" id="modalAddKomponen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Komponen Gaji Untuk : <b>{{ $detailGaji->karyawan_nama }}</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('gaji.addkomponen') }}" method="post" id="frmAddKomponen">
        @csrf
        <input type="hidden" name="karyawan_id" value="{{ $detailGaji->id_karyawan }}">
        <div class="modal-body">
         <div class="row">
            <div class="form-group col-lg-6">
                <label for="">Nama Komponen</label>
                <input type="text" name="nama_komponen" id="nama_komponen" class="form-control" placeholder="Inputkan Nama Komponen Gaji">
                <i class="showerror"></i>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Besaran</label>
                <input type="text" name="besaran" id="besaran" class="form-control" placeholder="Inputkan Besaran Komponen Gaji">
                <i class="showerror"></i>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Jenis</label>
                <select name="tipe_komponen" id="tipe_komponen" class="form-control">
                    <option value="pendapatan">Pendapatan</option>
                    <option value="potongan">Potongan</option>
                </select>
                <i class="showerror"></i>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Deskripsi Komponen Gaji</label>
                <textarea name="deskripsi_komponen" id="deskripsi_komponen" class="form-control" placeholder="Inputkan keterangan dari komponen gaji"></textarea>
                <i class="showerror"></i>
            </div>
            
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-submit">Tambah <i class="fa fa-plus"></i></button>
        </div>
        @csrf
    </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.btn-delete', function(e){
                const komponen_id = $(this).data('id');
                //swall confirm
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteKomponen(komponen_id);
                    }
                })
            });
            function deleteKomponen(komponen_id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('gaji.deletekomponen') }}",
                    data: {
                        komponen_id: komponen_id
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            };
            $("#frmAddKomponen").on('submit', function (e) {
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
        });
    </script>
@endsection
