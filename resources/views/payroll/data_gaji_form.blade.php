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
                                        <h3 class="font-weight-bold text-dark">Form Proses Penggajian</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('proses_gaji.store') }}" method="post" id="frmUpdate">
                                    <div class="row">
                                        <div class="form-group col-lg-6 mb-3">
                                            <label for="">Periode Penggajian</label>
                                            <input type="text" value="" name="periode_payroll" id="periode_payroll" class="form-control" placeholder="Periode Penggajian dalam bulan" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                        <div class="form-group col-lg-6 mb-3">
                                            <label for="">Hari Kerja</label>
                                            <input type="number" value="" name="hari_kerja" id="hari_kerja" class="form-control" placeholder="Jumlah hari kerja dari periode sebelumnya" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 mb-3">
                                            <label for="">Jumlah Karyawan</label>
                                            <input type="number" value="" name="jml_karyawan" id="jml_karyawan" class="form-control" placeholder="Jumlah Karyawan" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                        <div class="form-group col-lg-6 mb-3">
                                            <label for="">Total Pembayaran Gaji</label>
                                            <input type="number" value="" name="hari_kerja" id="hari_kerja" class="form-control" placeholder="Jumlah hari kerja dari periode sebelumnya" aria-describedby="helpId">
                                            <i class="showerror"></i>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="font-weight-bold text-dark">Daftar Karyawan yang akan di proses</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                               <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Karyawan</th>
                                                <th>Jabatan</th>
                                                <th>Total Gaji</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
@section('jsSection')
  @include('payroll.data_gaji_js')
@endsection
