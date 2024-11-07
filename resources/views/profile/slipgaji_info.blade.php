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
                                        <td>Budiono Siregar</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td class="px-2">:</td>
                                        <td>Resepsionis</td>
                                    </tr>
                                    <tr>
                                        <td>Divisi</td>
                                        <td class="px-2">:</td>
                                        <td>Front Desk</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td class="px-2">:</td>
                                        <td>0102 019 8927 89</td>
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
                                            <tr>
                                                <td>1</td>
                                                <td>Januari 2024</td>
                                                <td>Rp. 3.000.000</td>
                                                <td>Rp. 500.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 0</td>
                                                <td>Rp. 100.000</td>
                                                <td>Rp. 3.600.000</td>
                                                <td>31 Januari 2024</td>
                                                <td>Sudah Dibayar</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Februari 2024</td>
                                                <td>Rp. 3.000.000</td>
                                                <td>Rp. 500.000</td>
                                                <td>Rp. 150.000</td>
                                                <td>Rp. 100.000</td>
                                                <td>Rp. 50.000</td>
                                                <td>Rp. 3.700.000</td>
                                                <td>-</td>
                                                <td>Belum Dibayar</td>
                                            </tr>
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
