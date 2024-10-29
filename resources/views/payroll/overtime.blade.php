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
                                        <h3 class="font-weight-bold text-dark">Overtime</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <button class="btn btn-extend">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('add.overtime') }}">Tambah</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="overtimeTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Id</th>
                                                <th>Nama</th>
                                                <th>Divisi</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Status</th>
                                                <th>Approver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                             @endphp
                                             @foreach($overtimeData as $ovt)
                                             <tr>
                                                 <td>{{ $no }}</td>
                                                 <td>{{ $ovt->overtime_id }}</td>
                                                 <td>{{ $ovt->nama_karyawan }}</td>
                                                 <td>{{ $ovt->nama_divisi }}</td>
                                                 <td>{{ $ovt->ot_date }}</td>
                                                 <td>{{ $ovt->ot_start }}</td>
                                                 <td>{{ $ovt->ot_end }}</td>
                                                 <td>{{ $ovt->ot_approval }}</td>
                                                 <td>{{ $ovt->ot_approvedBy }}</td>
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
