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
                                <h6 class="font-weight-bold text-warning left">Daftar Laundry Guest</h6>
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
                                        <th>Catatan</th>
                                        <th>Nama</th>
                                        <th>Room</th>
                                        <th>Jenis Laundry</th>
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
            <form action="{{route('laundry.store_guest')}}" method="post">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
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
            <form action="{{route('laundry.store_new_guest')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tgl_keluar">Pilih Tamu</label>
                                <select required name="checkin_id" class="form-control" id="checkin_id">
                                    <option value="">Pilih Tamu</option>
                                    @foreach ($checkin as $item){
                                        <option value="{{$item->checkin_id}}">{{$item->name_guest}} - {{$item->room_no}}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Laundry</label>
                                <input type="date" required value="{{ date('Y-m-d') }}" class="form-control" id="tgl_keluar" name="tgl_keluar">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="jenis_laundry">Jenis Laundry</label>
                                <select required name="jenis_laundry" id="jenis_laundry" class="form-control" >
                                    <option value="">Pilih Jenis Laundry</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Express">Express</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="keterangan">Catatan</label>
                                <textarea required placeholder="Keterangan Laundry" class="form-control" id="catatan" name="catatan"></textarea>
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
  @include('laundry.laundry_guest_js')
@endsection
