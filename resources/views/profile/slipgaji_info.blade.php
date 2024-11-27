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
                                        <h3 class="font-weight-bold text-dark">History Slip Gaji</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="mb-5">
                                    <tr>
                                        <td>Nama</td>
                                        <td class="px-2">:</td>
                                        <td>{{ Auth::user()->karyawan->k_nama }}</td> <!-- Menampilkan nama karyawan -->
                                    </tr>
                                    
                                    <tr>
                                        <td>Divisi</td>
                                        <td class="px-2">:</td>
                                        <td>{{ Auth::user()->karyawan->divisi->d_nama }}</td> <!-- Menampilkan divisi karyawan -->
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td class="px-2">:</td>
                                        <td>{{ Auth::user()->karyawan->k_norek }}</td> <!-- Menampilkan nomor rekening karyawan -->
                                    </tr>
                                </table>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cleaningHistoryTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Periode Gaji</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Lembur</th>
                                                <th>Bonus</th>
                                                <th>Potongan</th>
                                                <th>Total Gaji</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Status Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payrolls as $index => $payroll)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $payroll->periode_payroll }}</td>
                                                    <td>Rp. {{ number_format($payroll->gaji_pokok, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($payroll->tunjangan ?? 0, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($payroll->lembur ?? 0, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($payroll->bonus ?? 0, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($payroll->potongan, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($payroll->total_gaji, 0, ',', '.') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($payroll->tanggal_pembayaran)->format('d F Y') }}</td>
                                                    <td>{{ $payroll->payroll_status }}</td>
                                                </tr>
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
