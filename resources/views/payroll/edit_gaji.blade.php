@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Gaji</h1>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <h4>Error Message</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Checkout Detail -->
    
    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
                <form action="{{ route('update.gaji', $detailGaji->id_karyawan) }}" method="POST" id="formDetailCheckin">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                           
                            <div class="mb-3">
                                <input hidden value="{{ $detailGaji->id_karyawan }}" name="karyawan_id" type="text" class="form-control" id="karyawan_id" readonly>
                                <label for="nama" class="form-label">Nama</label>
                                <input value="{{ $detailGaji->karyawan_nama }}" name="nama" type="text" class="form-control" id="nama" readonly>
                            </div>
 
                           
                            <div class="mb-3">
                                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                <input value="{{ $detailGaji->gaji_pokok }}" name="gaji_pokok" type="number" class="form-control" id="gaji_pokok">
                                <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2"/>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="divisi" class="form-label">Divisi</label>
                                <input readonly name="divisi" type="text" class="form-control" value="{{ $detailGaji->divisi_karyawan }}">
                                <x-input-error :messages="$errors->get('divisi')" class="mt-2"/>
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="no_rek" class="form-label">Nomor Rekening</label>
                                <input value="{{ $detailGaji->rek_karyawan }}"  type="text" class="form-control" name="no_rek" id="no_rek">
                                <x-input-error :messages="$errors->get('no_rek')" class="mt-2"/>
                            </div>

                        </div>
                    </div>
                    <div class="mt-4 mb-3 d-flex justify-content-start ">
                        <div class="">
                            <button type="submit" class="btn submit-btn mr-5">
                               Simpan
                            </button>
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</section>
</div>
</section>


@endsection