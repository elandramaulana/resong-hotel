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
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">edit Karyawan</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('store.karyawan')}}" method="post" enctype="multipart/form-data">
                     @csrf
                    <div class="row">

                     <div class="mb-3">
                        <label for="id_karyawan" class="form-label">Id Karyawan</label>
                        <input value="" name="id_karyawan" type="text" class="form-control" id="id_karyawan" disabled>
                        <x-input-error :messages="$errors->get('id_karyawan')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_nama" class="form-label">Nama Lengkap</label>
                        <input value="" name="k_nama" type="text" class="form-control" id="k_nama">
                        <x-input-error :messages="$errors->get('k_nama')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_nik" class="form-label">Nama Lengkap</label>
                        <input value="" name="k_nik" type="text" class="form-control" id="k_nik">
                        <x-input-error :messages="$errors->get('k_nik')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_contact" class="form-label">No Telp</label>
                        <input value="" name="k_contact" type="text" class="form-control" id="k_contact">
                        <x-input-error :messages="$errors->get('k_contact')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_email" class="form-label">No Telp</label>
                        <input value="" name="k_email" type="text" class="form-control" id="k_email">
                        <x-input-error :messages="$errors->get('k_email')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="alamat_karyawan" class="form-label">Alamat</label>
                        <input value="" name="alamat_karyawan" type="text" class="form-control" id="alamat_karyawan">
                        <x-input-error :messages="$errors->get('alamat_karyawan')" class="mt-2" />
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