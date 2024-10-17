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
                                        <h3 class="font-weight-bold text-dark">Proses Gaji Karyawan</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataProsesTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th style="width: 10px">Id</th>
                                                <th>Nama</th>
                                                <th>Divisi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                        @foreach($processData as $prs)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$prs->id_karyawan}}</td>
                                                <td>{{$prs->karyawan_nama}}</td>
                                                <td>{{$prs->divisi_karyawan}}</td>
                                                <td> {{ $prs->status_karyawan  ? 'Aktif' : 'Tidak Aktif' }}</td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-warning rounded " type="button">
                                                            <a style="text-decoration: none;color:black;"
                                                                href="{{ route('detail.proses', ['id' => $prs->id_karyawan]) }}">Proses</a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $no++
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
