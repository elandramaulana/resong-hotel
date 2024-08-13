@extends('layouts.dashboard_layout')
@section('content')
<style>
    .price {
        text-align: right;
        display: inline-block;
        width: 100%; /* Ensure the width takes the whole column */
    }
</style>
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
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-warning left">Daftar Layanan Laundry</h6>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a  class="btn btn-extend right btn-sm" href="{{ route('laundry.form') }}" id="btnAddLaundry"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card text-left">
                          <div class="card-body">
                            <h4 class="card-title">Filter Data</h4>
                            <div class="form-check form-switch form-check-inline">
                                <input type="checkbox" value="Guest" class="form-check-input filterCheckbox" id="check-guest" autocomplete="off" checked >
                                <label class="form-check-label " for="check-guest">Guest</label>
                            </div>
                        
                            <div class="form-check form-switch form-check-inline">
                                <input type="checkbox" value="Linen" class="form-check-input filterCheckbox" id="check-linen" autocomplete="off" checked >
                                <label class="form-check-label " for="check-linen">Linen</label>
                            </div>
                            
                            <div class="form-check form-switch form-check-inline">
                                <input type="checkbox" value="Uniform" class="form-check-input filterCheckbox" id="check-uniform" autocomplete="off" checked >
                                <label class="form-check-label " for="check-uniform">Uniform</label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dtShow" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="40%">Guest Name</th>
                                        <th width="20">Room</th>
                                        <th width="20">Kategory</th>
                                        <th width="20">Harga</th>
                                        {{-- <th>Status</th> --}}
                                        <th width="40">Aksi</th>
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
  @include('laundry.laundry_js')
@endsection