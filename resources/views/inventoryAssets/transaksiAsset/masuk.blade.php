@extends('layouts.dashboard_layout')

@section('content')
    <section id="">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start">
                <h1 class="h3 mb-0 text-gray-800">Transaksi Asset Masuk</h1>
            </div>
        </div>

        <div class="form-speedy">
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-body text-dark">

                        <form action="{{ route('store.trans.barang') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="mb-3">
                                    <label for="trans_jenis" class="form-label">Jenis Transaksi</label>
                                    <input readonly value="MASUK" name="trans_jenis" type="text" class="form-control"
                                        id="trans_jenis">
                                    <x-input-error :messages="$errors->get('trans_jenis')" class="mt-2" />
                                </div>


                                <div class="mb-3">
                                    <label for="Channel" class="form-label">Asset</label>
                                    <select name="asset_id" class="form-control" id="asset_id">
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">
                                                {{ $asset->nama }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="trans_jml" class="form-label">Jumlah Barang Dalam Satuan</label>
                                    <input value="" name="trans_jml" type="number" class="form-control"
                                        id="trans_jml">
                                    <x-input-error :messages="$errors->get('trans_jml')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="Channel" class="form-label">Supplier</label>
                                    <select name="trans_suplier" class="form-control" id="supplier">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">
                                                {{ $supplier->supplier_name }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('trans_suplier')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="trans_harga" class="form-label">Total Biaya (Rp)</label>
                                    <input value="" name="trans_harga" type="number" class="form-control"
                                        id="trans_harga">
                                    <x-input-error :messages="$errors->get('trans_harga')" class="mt-2" />
                                </div>

                                <div class="mt-4 mb-3 d-flex justify-content-start ">
                                    <div class="">
                                        <button type="submit" class="btn submit-btn mr-5">
                                            Tambah
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
