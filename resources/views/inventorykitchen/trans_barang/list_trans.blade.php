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
                                        <h3 class="font-weight-bold text-dark">Belanja Barang Masuk</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end gap-2">
                                        <a style="text-decoration: none; color:white"
                                            href="{{ route('kurang.trans.barang') }}" class="btn btn-extend">Barang
                                            Keluar</a>
                                        <a style="text-decoration: none; color:white"
                                            href="{{ route('tambah.trans.barang') }}" class="btn btn-extend">Barang
                                            Masuk</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangMasukTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Barang</th>
                                                <th>Supplier</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Jumlah</th>
                                                <th>Total Biaya (Rp)</th>
                                                <th style="width: 60px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transMasuk as $index => $trans)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>  {{ \Carbon\Carbon::parse($trans->tgl_masuk ?? '')->locale('id')->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $trans->barang_nama }}</td>
                                                    <td>{{ $trans->trans_suplier }}</td>
                                                    <td>{{ $trans->trans_jenis }}</td>
                                                    <td>{{ $trans->trans_jml }}</td>
                                                    <td>Rp. {{ number_format($trans->trans_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        <div>
                                                            <button style="margin-right: 10px" type="submit"
                                                                class="btn btn-warning btn-sm mt-2">
                                                                <a style="color: black" href=""> <i
                                                                        class="fas fa-edit"></i></a>
                                                            </button>
                                                            <form action="{{ route('destroy.supplier', $trans->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $trans->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-warning btn-sm mt-2"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteConfirmationModal{{ $trans->id }}">
                                                                    <i style="color: black" class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            <!-- Delete Confirmation Modal for each post -->
                                                            <div class="modal fade"
                                                                id="deleteConfirmationModal{{ $trans->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="deleteConfirmationModalLabel{{ $trans->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div
                                                                            class="modal-body d-flex justify-content-center">
                                                                            <img class=""
                                                                                src="{{ asset('assets/img/alert.png') }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div
                                                                            class="col-sm-12 d-flex justify-content-center">
                                                                            <p>Yakin hapus data?</p>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer d-flex justify-content-center">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger"
                                                                                onclick="document.getElementById('deleteForm{{ $trans->id }}').submit()">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
@endsection
