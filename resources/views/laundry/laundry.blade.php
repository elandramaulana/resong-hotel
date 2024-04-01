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
                            <div class="col-lg-8">
                                <h6 class="font-weight-bold text-warning left">Daftar Layanan Laundry</h6>
                            </div>
                            <div class="col-lg-4 right">
                                <a  class="btn btn-success right btn-sm" href="{{ route('laundry.form') }}" id="btnAddLaundry"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="noShowReservations" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Guest Name</th>
                                        <th>Room</th>
                                        <th>Kategory</th>
                                        <th>Quantity</th>
                                        <th>Harga</th>
                                        <th>Status</th>
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
  @include('laundry.laundry_js')
@endsection