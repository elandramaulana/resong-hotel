@extends('layouts.dashboard_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="font-weight-bold text-dark">Data Karyawan</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <button class="btn btn-extend">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('tambah.karyawan') }}">Tambah</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  class="table table-bordered" id="dataKaryawanTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Id</th>
                                                <th>Nama</th>
                                                <th>Kontak</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Bergabung</th>
                                                <th>Status Aktif</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Alamat</th>
                                                <th>Divisi</th>
                                                <th>Shift</th>
                                                <th>Pin Absensi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter_karyawan = 1;
                                            @endphp
                                            @foreach ($karyawanData as $kr)
                                                <tr>
                                                    <td>{{ $counter_karyawan }}</td>
                                                    <td>{{ $kr->karyawan_id  }}</td>
                                                    <td>{{ $kr->nama_karyawan }}</td>
                                                    <td>{{ $kr->kontak_karyawan  }}</td>
                                                    <td>{{ $kr->gender_karyawan}}</td>

                                                    <!-- Tanggal Bergabung -->
                                                    <td>
                                                        {{ $kr->tanggal_bergabung  ?? 'Belum Ada' }}
                                                    </td>

                                                    <!-- Status Aktif -->
                                                    <td>
                                                        {{ $kr->status_karyawan  ? 'Aktif' : 'Tidak Aktif' }}
                                                    </td>

                                                    <!-- Tanggal Keluar -->
                                                    <td>
                                                        {{ $kr->tanggal_keluar  ?? 'Masih Bekerja' }}
                                                    </td>

                                                    <td>{{ $kr->alamat_karyawan  }}</td>
                                                    
                                                    <td>{{ $kr->nama_divisi }}</td>

                                                    <td>
                                                       {{$kr->shift_karyawan }}
                                                    </td>

                                                    <td>{{ $kr->pin_karyawan }}</td>

                                                    <td>
                                                        <div>
                                                            <button style="margin-right: 10px" type="button"
                                                                class="btn btn-warning btn-sm mt-2">
                                                                <a style="color: black"
                                                                    href="{{ route('edit.karyawan', ['id' => $kr->karyawan_id ]) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </button>

                                                            {{-- <form action="" method="POST" style="display: inline;" id="deleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#deleteConfirmationModal">
                                                            <i style="color: black" class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form> --}}

                                                            <!-- Modal -->
                                                            {{-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-body d-flex justify-content-center">
                                                                    <img class="" src="{{asset('assets/img/alert.png')}}" alt="">
                                                                </div>
                                                                <div class="col-sm-12 d-flex justify-content-center">
                                                                    <p>Yakin hapus data?</p>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                        </div>
                                                    </td>
                                                </tr>

                                                @php
                                                    $counter_karyawan++;
                                                @endphp
                                            @endforeach
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
    <!-- /.container-fluid -->
@endsection
