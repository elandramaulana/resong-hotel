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
                                        <h3 class="font-weight-bold text-dark"> <i class="fa fa-history" aria-hidden="true"></i> History Payrolls</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataProsesTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Periode</th>
                                                <th>Total Penggajian (Rp)</th>
                                                <th>Jumlah Pegawai</th>
                                                <th>Status Payroll</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                        @foreach($processData as $prs)
                                        @php
                                                 // Assuming $prs->periode_payroll contains '12-2024'
                                                $periodePayroll = \Carbon\Carbon::createFromFormat('m-Y', $prs->periode_payroll);
                                                $numericFormat = $periodePayroll->format('m-Y'); // 12-2024
                                                $textFormat = $periodePayroll->translatedFormat('F Y'); // Desember 2024
                                        @endphp
                                            <tr>
                                                <td>{{ $no }}</td>
                                                {{-- this period_payroll return 12-2024 help me to make it Desember 2024 --}}
                                                <td>{{ $textFormat }}</td>
                                                <td align="right">{{ number_format($prs->total_penggajian) }}</td>
                                                <td align="center">{{ $prs->jumlah_karyawan }}</td>
                                                <td>{{ $prs->payroll_status }}</td>
                                                <td>
                                                    <a href="{{ route('payroll.show', $prs->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
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
