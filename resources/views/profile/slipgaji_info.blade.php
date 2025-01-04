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
                                        <td>{{$dataKaryawan->k_nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td class="px-2">:</td>
                                        <td>{{ Auth::user()->karyawan->k_norek }}</td> <!-- Menampilkan nomor rekening karyawan -->
                                        <td>{{$dataKaryawan->k_norek}}</td>
                                    </tr>
                                </table>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cleaningHistoryTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Periode Gaji</th>
                                                <th>Total Pendapatan</th>
                                                <th>Total Potongan</th>
                                                <th>Take Home Pay</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataSlipGaji as $slipGaji)

                                            @php
                                                $periodePayroll = \Carbon\Carbon::createFromFormat('m-Y', $slipGaji->periode_payroll);
                                                $numericFormat = $periodePayroll->format('m-Y'); // 12-2024
                                                $textFormat = $periodePayroll->translatedFormat('F Y'); // Desember 2024
                                            @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $textFormat }}</td>
                                                    <td>Rp. {{ number_format($slipGaji->total_pendapatan, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($slipGaji->total_potongan, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($slipGaji->thp, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($slipGaji->payroll_status == 'Evaluating')
                                                            <span class="badge badge-danger">{{ $slipGaji->payroll_status }}</span>
                                                        @else
                                                            <span class="badge badge-success">{{ $slipGaji->payroll_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($slipGaji->payroll_status =='Evaluating')
                                                        @else
                                                            <a href="#" data-id="{{ $slipGaji->detail_payroll_id }}" data-toggle="modal"
                                                                class="btn btn-success btn-sm btn-download-slip"> <i class="fa fa-download" aria-hidden="true"></i> </a>
                                                        @endif
                                                        <a href="#" data-id="{{ $slipGaji->detail_payroll_id }}" data-toggle="modal"
                                                            class="btn btn-primary btn-sm btn-slip-detail"><i class="fa fa-list" aria-hidden="true"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    <div class="modal fade" id="modalSlip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Detail Gaji</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6">
                    <table>
                        {{-- <tr>
                            <th colspan="3">Detail Karyawan</th>
                        </tr> --}}
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><b id="showNameSlip"></b></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table>
                        <tr>
                            <th colspan="3">Periode</th>
                            <th>:</th>
                            <th>Desember 2024</th>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12" id="showTable">

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
@endsection
@section('jsSection')
@include('profile.slipgaji_js');
@endsection
