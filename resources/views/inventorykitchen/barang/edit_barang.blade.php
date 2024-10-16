@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('update.barang', $barang->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                    <div class="row">

                     <div class="mb-3">
                        <label for="barang_name" class="form-label">Nama</label>
                        <input value="{{$barang->barang_nama}}" name="barang_nama" type="text" class="form-control" id="barang_nama">
                        <x-input-error :messages="$errors->get('barang_nama')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="Channel" class="form-label">Kategori</label>
                        <select name="barang_kategori" class="form-control" id="channel">
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ $kat->nama_kategori === old('channel') ? 'selected' : '' }} >{{ $kat->nama_kategori }}</option>
                            @endforeach
                        
                        </select>
                        <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                    </div>

                     {{-- <div class="mb-3">
                        <label for="barang_stok" class="form-label">Stok</label>
                        <input value="" name="barang_stok" type="text" class="form-control" id="barang_stok">
                        <x-input-error :messages="$errors->get('barang_stok')" class="mt-2" />
                    </div> --}}

                    
                     <div class="mb-3">
                        <label for="barang_satuan" class="form-label">Satuan</label>
                        <input value="{{$barang->barang_satuan}}" name="barang_satuan" type="text" class="form-control" id="barang_satuan">
                        <x-input-error :messages="$errors->get('barang_satuan')" class="mt-2" />
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