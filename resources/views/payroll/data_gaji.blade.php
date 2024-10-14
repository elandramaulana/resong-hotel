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
                                        <h3 class="font-weight-bold text-dark">Data Gaji Karywan</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataGajiTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Id Karyawan</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Divisi</th>
                                                <th>Status Karyawan</th>
                                                <th>Besar Gaji (Rp)</th>
                                                <th>Nomor Rekening</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach($payrollData as $pyr)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$pyr->id_karyawan}}</td>
                                                <td>{{$pyr->nama_karyawan}}</td>
                                                <td>{{$pyr->gender_karyawan}}</td>
                                                <td>{{$pyr->divisi_karyawan}}</td>
                                                <td>{{$pyr->status_karyawan}}</td>
                                                <td>{{ number_format($pyr->gaji_karyawan, 0, ',', '.') }}</td>
                                                <td>{{$pyr->rek_karyawan}}</td>
                                                <td>
                                                    <div>
                                                        <button style="margin-right: 10px" type="submit"
                                                            class="btn btn-warning btn-sm mt-2">
                                                            <a style="color: black" href="{{route('edit.gaji', ['id' => $pyr->id_karyawan])}}"> <i class="fas fa-edit"></i></a>
                                                        </button>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
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
