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
        <h1 class="h3 mb-0 text-gray-800">Edit Karyawan</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{ route('karyawan.update', $karyawan->karyawan_id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                    <div class="row">

                     <div class="mb-3">
                        <label for="id_karyawan" class="form-label">Id Karyawan</label>
                        <input value="{{ $karyawan->karyawan_id }}" name="id_karyawan" type="text" class="form-control" id="id_karyawan" disabled>
                        <x-input-error :messages="$errors->get('id_karyawan')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_nama" class="form-label">Nama Lengkap</label>
                        <input value="{{$karyawan->nama_karyawan }}" name="k_nama" type="text" class="form-control" id="k_nama">
                        <x-input-error :messages="$errors->get('k_nama')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_nik" class="form-label">Nik</label>
                        <input value="{{$karyawan->nik_karyawan}}" name="k_nik" type="text" class="form-control" id="k_nik">
                        <x-input-error :messages="$errors->get('k_nik')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_contact" class="form-label">No Telp</label>
                        <input value="{{$karyawan->kontak_karyawan}}" name="k_contact" type="text" class="form-control" id="k_contact">
                        <x-input-error :messages="$errors->get('k_contact')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_email" class="form-label">Email</label>
                        <input value="{{$karyawan->email_karyawan}}" name="k_email" type="text" class="form-control" id="k_email">
                        <x-input-error :messages="$errors->get('k_email')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="k_alamat" class="form-label">Alamat</label>
                        <input value="{{$karyawan->alamat_karyawan}}" name="k_alamat" type="text" class="form-control" id="k_alamat">
                        <x-input-error :messages="$errors->get('k_alamat')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="k_gender" class="form-label">Jenis Kelamin</label>
                        <select name="k_gender" class="form-control" id="k_gender">
                            <option value="{{ $karyawan->gender_karyawan_text }}" selected>{{ $karyawan->gender_karyawan_text }}</option>
                            <option value="Laki-laki" {{ $karyawan->gender_karyawan_text == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $karyawan->gender_karyawan_text == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('k_gender')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="khr_tgljoin" class="form-label">Tanggal Join</label>
                        <input value="{{$karyawan->tanggal_bergabung}}" name="khr_tgljoin" type="text" class="form-control"
                            id="khr_tgljoin" onfocus="(this.type='date');this.focus()"
                            onblur="(this.type='text');this.value=formatDate(this.value)">
                        <x-input-error :messages="$errors->get('khr_tgljoin')" class="mt-2" />
                    </div>   

                    <div class="mb-3">
                        <label for="khr_tglOut" class="form-label">Tanggal Keluar</label>
                        <input value="{{ $karyawan->tanggal_keluar ? $karyawan->tanggal_keluar : 'Atur' }}" name="khr_tglOut" type="text" class="form-control"
                            id="khr_tglOut" onfocus="(this.type='date');this.focus()"
                            onblur="(this.type='text');this.value=formatDate(this.value)">
                           
                        <x-input-error :messages="$errors->get('khr_tglOut')" class="mt-2" />
                    </div>   

                    <div class="mb-3">
                        <label for="khr_isActive" class="form-label">Status Karyawan</label>
                        <select name="khr_isActive" class="form-control" id="khr_isActive">
                            <option value="{{ $karyawan->status_karyawan_text }}" selected>{{ $karyawan->status_karyawan_text }}</option>
                            <option value="1" {{ $karyawan->status_karyawan_text == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $karyawan->status_karyawan_text == 0 ? 'selected' : '' }}>Non-Active</option>
                        </select>
                        <x-input-error :messages="$errors->get('khr_isActive')" class="mt-2" />
                    </div>

                    <!-- Divisi Dropdown -->
                    <div class="mb-3">
                        <label for="divisi" class="form-label">Divisi</label>
                        <select name="d_nama" class="form-control" id="divisi">
                            <option value="" disabled>Pilih Divisi</option>
                            @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id }}" {{ $karyawan->nama_divisi == $divisi->id ? 'selected' : '' }}>
                                    {{ $divisi->d_nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('d_nama')" class="mt-2" />
                    </div>

                    <!-- Shift Dropdown -->
                    <div class="mb-3">
                        <label for="shift" class="form-label">Shift</label>
                        <select name="shift_id" class="form-control" id="shift">
                            <option value="" disabled></option>
                            <!-- Existing shift will be populated here -->
                        </select>
                        <x-input-error :messages="$errors->get('shift_id')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="k_pin" class="form-label">Pin Absensi</label>
                        <input value="{{$karyawan->pin_karyawan}}" name="k_pin" type="text" class="form-control"
                            id="k_pin" onfocus="(this.type='date');this.focus()"
                            onblur="(this.type='text');this.value=formatDate(this.value)">
                        <x-input-error :messages="$errors->get('k_pin')" class="mt-2" />
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var currentShiftId = '{{ $karyawan->shift_karyawan }}';

    function loadShifts(divisiId, callback) {
        $.ajax({
            url: '/get-shifts/' + divisiId,
            type: 'GET',
            success: function(data) {
                $('#shift').empty();
                $('#shift').append('<option value="" disabled>Pilih Shift</option>');
                if (data.length > 0) {
                    $.each(data, function(key, shift) {
                        var selected = (shift.id == currentShiftId) ? 'selected' : '';
                        $('#shift').append('<option value="' + shift.id + '" ' + selected + '>' + shift.s_nama + '</option>');
                    });
                } else {
                    $('#shift').append('<option value="" disabled>Shift tidak tersedia</option>');
                }
                if (callback) callback();
            },
            error: function() {
                alert('Gagal memuat shift. Silakan coba lagi.');
            }
        });
    }

    // Load initial shifts
    loadShifts($('#divisi').val(), function() {
        // Ensure the current shift is selected after loading
        $('#shift').val(currentShiftId);
    });

    // On divisi change
    $('#divisi').change(function() {
        var divisiId = $(this).val();
        if (divisiId) {
            loadShifts(divisiId);
        } else {
            $('#shift').empty();
            $('#shift').append('<option value="" disabled selected>Pilih Shift</option>');
        }
    });
});
</script>


@endsection