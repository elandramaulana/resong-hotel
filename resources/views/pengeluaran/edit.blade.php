@extends('layouts.dashboard_layout')

@section('content')
    <section id="">
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
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-start">
                    <h1 class="h3 mb-0 text-gray-800">Edit Supplier Assets</h1>
                </div>
            </div>

            <div class="form-speedy">
                <div class="container-fluid mt-4">
                    <div class="card">
                        <div class="card-body text-dark">

                            <form action="{{ route('inventory-assets.supplier.update', $supplier->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="mb-3">
                                        <label for="supplier_name" class="form-label">Nama</label>
                                        <input value="{{ $supplier->supplier_name }}" name="supplier_name" type="text"
                                            class="form-control" id="supplier_name">
                                        <x-input-error :messages="$errors->get('supplier_name')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="supplier_telp" class="form-label">No Telp</label>
                                        <input value="{{ $supplier->supplier_telp }}" name="supplier_telp" type="text"
                                            class="form-control" id="supplier_telp">
                                        <x-input-error :messages="$errors->get('supplier_telp')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="supplier_alamat" class="form-label">Alamat</label>
                                        <input value="{{ $supplier->supplier_alamat }}" name="supplier_alamat"
                                            type="text" class="form-control" id="supplier_alamat">
                                        <x-input-error :messages="$errors->get('supplier_alamat')" class="mt-2" />
                                    </div>

                                    <div class="mt-4 mb-3 d-flex justify-content-start ">
                                        <div class="">
                                            <button type="submit" class="btn submit-btn mr-5">
                                                Update
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
