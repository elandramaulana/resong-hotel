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
                                <h3 class="font-weight-bold text-dark">Daftar Layanan Resto</h3>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <button class="btn btn-extend">
                                    <a style="text-decoration: none; color:white" href="{{ route('resto.form') }}">Tambah</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="layananRestoTable" width="100%" cellspacing="0">
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
                                    {{-- @foreach ($listlaundry as $laundry)
                                        
                                    @endforeach --}}
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