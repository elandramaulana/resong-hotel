@extends('layouts.dashboard_layout')

@section('content')

<!-- Invoice Detail  -->

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
                                <tr style="background-color: lightblue;">
                                    <td colspan="2" class="text-center"><b>THP</b></td>
                                    <td class="text-right" colspan="2" ><b>{{ number_format($thp, 0, ',', '.') }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    <option value="penambahan">Pemasukan</option>
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


@endsection