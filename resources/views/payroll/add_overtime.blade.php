@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Overtime</h1>
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
                <form action="{{ route('store.overtime') }}" method="POST" id="formDetailCheckin">
                    @csrf

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="k_nama" class="form-label">Nama Karyawan</label>
                                <input 
                                    value="{{ $karyawanData->first()->k_nama ?? 'Tidak ditemukan' }}" 
                                    name="k_nama" 
                                    type="text" 
                                    class="form-control" 
                                    id="k_nama" 
                                    readonly>
                            </div>
                
                            <!-- Divisi -->
                            <div class="mb-3">
                                <label for="divisi_nama" class="form-label">Divisi</label>
                                <input 
                                    value="{{ $karyawanData->first()->divisi_nama ?? 'Tidak ditemukan' }}" 
                                    name="divisi_nama" 
                                    type="text" 
                                    class="form-control" 
                                    id="divisi_nama" 
                                    readonly>
                            </div>

                             <!-- Shift -->
                            <div class="mb-3">
                                <label for="shift_nama" class="form-label">Shift</label>
                                <input 
                                    value="{{ $karyawanData->first()->shift_nama ?? 'Tidak ditemukan' }}" 
                                    name="shift_nama" 
                                    type="text" 
                                    class="form-control" 
                                    id="shift_nama" 
                                    readonly>
                            </div>

                            <!-- Hidden Inputs -->
                        <input hidden name="karyawan_id" value="{{ $karyawanData->first()->id ?? '' }}">
                        <input hidden name="khd_id" value="{{ $karyawanData->first()->khd_id ?? '' }}">


                           
                        </div>
                    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="ot_date" class="form-label">Pilih Tanggal</label>
                                    <input value="" name="ot_date" type="text" class="form-control"
                                        id="ot_date" onfocus="(this.type='date');this.focus()"
                                        onblur="(this.type='text');this.value=formatDate(this.value)">
                                    <x-input-error :messages="$errors->get('ot_date')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mb-3">
                                @php
                                    $showJamIn = date("H:i");
                                @endphp
                                <!-- Jam -->
                                <div class="mb-3">
                                    <label for="ot_start" class="form-label">Start</label>
                                    <input name="ot_start" value="{{ $showJamIn }}" type="time" class="form-control" id="ot_start">
                                </div>
                            </div>

                            <div class="mb-3">
                                @php
                                    $showJamOut = date("H:i");
                                @endphp
                                <!-- Jam -->
                                <div class="mb-3">
                                    <label for="ot_end" class="form-label">End</label>
                                    <input name="ot_end" value="{{ $showJamOut }}" type="time" class="form-control" id="ot_end">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mt-4 mb-3 d-flex justify-content-start ">
                        <div class="">
                            <button type="submit" class="btn submit-btn mr-5">
                               Ajukan
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('#karyawan').change(function() {
        var karyawanId = $(this).val();

        if (karyawanId) {
            $.ajax({
                url: "{{ route('get.karyawan.data') }}",
                type: "GET",
                data: { karyawan_id: karyawanId },
                success: function(response) {
                    if (response) {
                        $('#khd_id').val(response.khd_id || '');
                        $('#divisi').val(response.divisi || '');
                        $('#shift_karyawan').val(response.shift || '');
                    }
                },
                error: function() {
                    alert("Data tidak ditemukan");
                }
            });
        }
    });
});

</script> --}}


@endsection