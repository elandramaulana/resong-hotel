@extends('layouts.dashboard_layout')

@section('content')
    <section id="">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start">
                <h1 class="h3 mb-0 text-gray-800">Edit Asset</h1>
            </div>
        </div>

        <div class="form-speedy">
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-body text-dark">

                        <form action="{{ route('inventory-assets.asset.update', $asset->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input value="{{ $asset->nama }}" name="nama" type="text" class="form-control"
                                        id="nama">
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="category_asset_id" class="form-label">Kategori</label>
                                    <select name="category_asset_id" class="form-control" id="category_asset_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $asset->category_asset_id === $category->id ? 'selected' : '' }}>
                                                {{ $category->nama_kategori }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('category_asset_id')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input value="{{ $asset->satuan }}" name="satuan" type="text" class="form-control"
                                        id="satuan">
                                    <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
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
