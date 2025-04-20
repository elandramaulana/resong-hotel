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
            @if(session('success'))
            <div class="col-sm-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            @if ($errors->any())
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <h4>Error Message</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <!-- Check-in Table -->
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="font-weight-bold text-warning left">Daftar Laundry Linen</h6>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a  class="btn btn-extend right btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalAddLaundry" id="btnAddLaundry"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dtShow" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah(Lembar)</th>
                                        <th>Pengirim</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Penerima</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Harga</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Modal -->
<div class="modal fade" id="setMasuk" tabindex="-1" role="dialog" aria-labelledby="modalDetailLaundryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLaundryLabel">Detail Laundry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('laundry.store_linen')}}" method="post">
                @csrf
                <input type="text" id="laundry_id" name="laundry_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk Laundry</label>
                                <input type="date" required class="form-control" id="tgl_masuk" name="tgl_masuk" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="harga">Harga Laundry</label>
                                <input type="text" required placeholder="Harga Laundry" class="form-control" id="harga" name="harga">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="status_kembali">Status Kembali</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_kembali" id="inlineRadio2" checked value="sebagian">
                                    <label class="form-check-label" for="inlineRadio2">Sebagian</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_kembali" id="inlineRadio1" value="selesai">
                                    <label class="form-check-label" for="inlineRadio1">Selesai</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="keterangan_status">Keterangan Status</label>
                                <textarea type="text" placeholder="Keterangan Laundry" class="form-control" id="keterangan_status" name="keterangan_status"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAddLaundry" tabindex="-1" role="dialog" aria-labelledby="modalAddLaundryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLaundryLabel">Tambah Laundry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('laundry.store_new_linen')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Laundry</label>
                                <input type="date" required value="{{ date('Y-m-d') }}" class="form-control" id="tgl_keluar" name="tgl_keluar">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea required placeholder="Keterangan Laundry" class="form-control" id="nama_item" name="nama_item"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="jumlah_satuan">Jumlah Satuan (Lembar)</label>
                                <input type="text" required placeholder="Jumlah Satuan (Lembar)" class="form-control" id="jumlah_satuan" name="jumlah_satuan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
@section('jsSection')
  @include('laundry.laundry_js')
@endsection
