@extends('layouts.dashboard_layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Available Rooms Content -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            @php
                                                // Assuming $prs->periode_payroll contains '12-2024'
                                                $periodePayroll = \Carbon\Carbon::createFromFormat('m-Y', $Payroll->periode_payroll);
                                                $numericFormat = $periodePayroll->format('m-Y'); // 12-2024
                                                $textFormat = $periodePayroll->translatedFormat('F Y'); // Desember 2024
                                            @endphp
                                            {{ $textFormat }}
                                        </div>
                                        <div class="h5 font-weight-bold text-white">Payroll Period</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Used Rooms Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            {{ number_format($Payroll->total_penggajian) }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-white">Total Pembayaran</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-money-bill-alt fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reserved Rooms Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">

                                            {{ number_format($Payroll->jumlah_karyawan) }} Orang
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-white">Total Karyawan</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <!-- Cleaning Rooms Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">

                                           <i class="fas fa-refresh" aria-hidden="true"></i>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-white">Re-Calculate</div>
                                    </div>
                                    <div class="col-auto">
                                        a<i class="fas fa-refresh fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="font-weight-bold text-dark"> <i class="fa fa-list" aria-hidden="true"></i> Detail Payrolls</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataProsesTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Nama</th>
                                                <th>Pendapatan</th>
                                                <th>Potongan</th>
                                                <th>THP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no=1;
                                            @endphp
                                          @foreach ($PayrollDetail as $Detail)
                                              <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $Detail->k_nama }}</td>
                                                <td align="right">{{ number_format($Detail->total_pendapatan) }}</td>
                                                <td align="right">{{ number_format($Detail->total_potongan) }}</td>
                                                <td align="right">{{ number_format($Detail->thp) }}</td>
                                                <td>
                                                    {{-- lets triger modal to see detail here --}}
                                                    <a href="#" class="btn btn-sm btn-info btn-detail-payroll" data-toggle="modal" data-id="{{ $Detail->id }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    @if($Payroll->payroll_status!='Accepted')
                                                    <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-id="{{ $Detail->id }}">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    @endif
                                                </td>
                                              </tr>
                                              @php
                                                    $no++;       
                                              @endphp
                                          @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="row">
                                    @if($Payroll->payroll_status!='Accepted')
                                    <div class="col-lg-3">
                                        <button data-id="{{ $Payroll->id }}" class="btn btn-success btn-sm " id="btn-accept"> <i class="fa fa-check"></i> Accept</button>
                                    </div>    
                                    @endif
                                    
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
      <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Detail Gaji</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form method="POST" action="{{ route('payroll.add_item_hot') }}"  enctype="multipart/form-data" id="addItemPayrollActive">
                    @csrf
                    <div class="row">
                        <input type="text" id="id_detail_payrol" name="id_detail_payrol" hidden>
                        <div class="form-group col-lg-3">
                            <label for="">Inputkan Nama Komponen</label>
                            <input type="text" name="nama_komponen_payroll" class="form-control" placeholder="Ex: Bonus Penjualan">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="">Pilih Jenis Komponen</label>
                            <select class="form-control" name="type_komponen_payroll" id="type_komponen_payroll">
                                <option value="pendapatan">Pendapatan</option>
                                <option value="potongan">Potongan</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="">Inputkan Besar Komponen</label>
                            <input type="text" name="besaran_komponen_payroll" class="form-control" placeholder="ex:1.000.000">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="">&nbsp; </label>
                            <button type="submit" class="btn btn-prmary form-control"><i class="fa fa-plus"></i> Tambah Komponen</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <title>Keterangan</title>
                            <textarea name="keterangan_komponen_payroll" id="keterangan_komponen_payroll" class="form-control" placeholder="Inputkan keterangan"></textarea>
                        </div>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </div>
      </div>
@endsection
@section('jsSection')
    @include('payroll.payroll_show.js')
@endsection
