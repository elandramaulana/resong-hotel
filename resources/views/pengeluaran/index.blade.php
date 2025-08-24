@extends('layouts.dashboard_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

@if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <h4>Error Message</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="font-weight-bold text-dark">Daftar Pengeluaran</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <button class="btn btn-extend">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#inputFormModal">Tambah</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cleaningHistoryTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Item</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                                <th>Total</th>
                                                <th style="width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($data as $item)
                                            @php
                                                $total = $item->harga * $item->qty;
                                            @endphp
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td title="{{ $item->keterangan }}">{{ $item->item }}</td>
                                                    <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->tgl }}</td>
                                                    <td>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                                                    <td>
                                                        <a data-id="{{$item->id}}" class="btn btn-warning edit">Edit</a>
                                                        <a data-id="{{$item->id}}" class="btn btn-danger delete">Hapus</a>
                                                    </td>
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
    <!-- Modal Tambah Pengeluaran -->
    <div class="modal fade" id="inputFormModal" tabindex="-1" aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputFormModalLabel">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengeluaran.store') }}" method="post">
                        @csrf
                        <input type="text" id="id" name="id" hidden >
                        <div class="mb-3">
                            <label for="item" class="col-form-label">Item:</label>
                            <input type="text" class="form-control" id="item" name="item" placeholder="Masukan Nama Item">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="col-form-label">Harga:</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" >
                        </div>
                        <div class="mb-3">
                            <label for="metode_bayar" class="col-form-label">Metode Bayar:</label>
                            <select name="metode_bayar" id="metode_bayar" class="form-select">
                                <option value="Cash" selected>Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Uang Kas">Uang Kas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsSection')
@include('pengeluaran.js')
@endsection
