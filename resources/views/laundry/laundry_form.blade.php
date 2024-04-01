@extends('layouts.dashboard_layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<section class="mt-5">
    <div class="container-fluid">
        <form action="{{ route('laundry.post') }}" method="POST">
            <div class="row">
                <!-- Check-in Table -->
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="font-weight-bold text-warning left">{{ $Title }}</h6>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="laundry_type">Type Laundry</label>
                                        <select name="laundry_type" class="form-control" id="laundry_type">
                                            <option value="">Pilih Type Laundry</option>
                                            <option value="Guest">Guest</option>
                                            <option value="Linen">Linen</option>
                                            <option value="Uniforms">Uniforms</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="display: none" id="formSelectRoom">
                                    <div class="form-group">
                                        <label for="">Pilih No Kamar</label>
                                        <select name="checkin_id" id="checkin_id" class="form-control">
                                            <option value="">Pilih No Kamar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>Detail Laundry</h4>
                                        </div>
                                        <div class="col-lg-4 right">
                                            <a  class="btn btn-success right btn-sm" href="#" id="btnAddLaundry"><i class="fa fa-plus"></i> Tambah</a>
                                        </div>
                                    </div>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kategori</th>
                                                    <th>Deskripsi</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center" colspan="7">Belum ada data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
<!-- /.container-fluid -->
@endsection
@section('jsSection')
  @include('laundry.laundry_js')
@endsection