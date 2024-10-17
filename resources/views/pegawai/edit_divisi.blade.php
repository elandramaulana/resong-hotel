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
        <h1 class="h3 mb-0 text-gray-800">Edit Divisi</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('update.divisi', $divisi->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                    <div class="row">

                     <div class="mb-3">
                        <label for="d_nama" class="form-label">Nama Divisi</label>
                        <input value="{{ $divisi->d_nama }}" name="d_nama" type="text" class="form-control" id="d_nama">
                        <x-input-error :messages="$errors->get('d_nama')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="d_deskripsi" class="form-label">Deskripsi</label>
                        <input value="{{ $divisi->d_deskripsi }}" name="d_deskripsi" type="text" class="form-control" id="d_deskripsi">
                        <x-input-error :messages="$errors->get('d_deskripsi')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="d_jobdesc" class="form-label">Jobdesk</label>
                        <textarea rows="3" value="{{ $divisi->d_jobdesc }}" name="d_jobdesc" type="text" class="form-control" id="d_jobdesc"></textarea>
                        <x-input-error :messages="$errors->get('d_jobdesc')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="d_OT_approver" class="form-label">Over Time</label>
                        <select name="d_OT_approver" class="form-control" id="d_OT_approver">
                            <option value="{{ $divisi->d_OT_approver }}" disabled selected>{{ $divisi->d_OT_approver }}</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <x-input-error :messages="$errors->get('d_OT_approver')" class="mt-2" />
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