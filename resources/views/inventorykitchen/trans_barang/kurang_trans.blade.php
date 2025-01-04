@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Barang Keluar</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('store.trans.barang')}}" method="post" enctype="multipart/form-data">
                     @csrf
                    <div class="row">

                        
                    <div class="mb-3">
                        <label for="Channel" class="form-label">Jenis Transaksi</label>
                        <select name="trans_jenis" class="form-control" id="channel">
                            <option value="TERPAKAI" {{ "TERPAKAI" === old('channel') ? 'selected' : '' }}>TERPAKAI</option>
                            <option value="RUSAK" {{ "RUSAK" === old('channel') ? 'selected' : '' }}>RUSAK</option>
                            <option value="EXPIRED" {{ "EXPIRED" === old('channel') ? 'selected' : '' }}>EXPIRED</option>
                        </select>
                        <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="Channel" class="form-label">Barang</label>
                        <select name="barang_id" class="form-control" id="barang">
                            @foreach($barang as $bar)
                                <option value="{{ $bar->id }}" {{ $bar->barang_nama === old('barang') ? 'selected' : '' }} >{{ $bar->barang_nama }}</option>
                            @endforeach
                        
                        </select>
                        <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="trans_jml" class="form-label">Jumlah Barang Dalam Satuan</label>
                        <input value="" name="trans_jml" type="number" class="form-control" id="trans_jml">
                        <x-input-error :messages="$errors->get('trans_jml')" class="mt-2" />
                    </div>

                    {{-- <div class="mb-3">
                        <label for="trans_suplier" class="form-label">Supplier</label>
                        <input readonly value="" name="trans_suplier" type="text" class="form-control" id="trans_suplier">
                        <x-input-error :messages="$errors->get('trans_suplier')" class="mt-2" />
                    </div> --}}

                    {{-- <div class="mb-3">
                        <label for="trans_harga" class="form-label">Total Biaya (Rp) *Kosongkan jika status selain 'MASUK'</label>
                        <input value="" name="trans_harga" type="number" class="form-control" id="trans_harga">
                        <x-input-error :messages="$errors->get('trans_harga')" class="mt-2" />
                    </div> --}}

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