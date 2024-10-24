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
                    <h1 class="h3 mb-0 text-gray-800">Tambah Karyawan</h1>
                </div>
            </div>

            <div class="form-speedy">
                <div class="container-fluid mt-4">
                    <div class="card">
                        <div class="card-body text-dark">

                            <form action="{{ route('store.karyawan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    {{-- <div class="mb-3">
                        <label for="id_karyawan" class="form-label">Id Karyawan</label>
                        <input value="random generate" name="id_karyawan" type="text" class="form-control" id="id_karyawan" disabled>
                        <x-input-error :messages="$errors->get('id_karyawan')" class="mt-2" />
                    </div> --}}

                                    <div class="mb-3">
                                        <label for="k_nama" class="form-label">Nama Lengkap</label>
                                        <input value="" name="k_nama" type="text" class="form-control"
                                            id="k_nama">
                                        <x-input-error :messages="$errors->get('k_nama')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_nik" class="form-label">NIK</label>
                                        <input value="" name="k_nik" type="text" class="form-control"
                                            id="k_nik">
                                        <x-input-error :messages="$errors->get('k_nik')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_norek" class="form-label">No Rekening</label>
                                        <input value="" name="k_norek" type="text" class="form-control"
                                            id="k_norek">
                                        <x-input-error :messages="$errors->get('k_norek')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_contact" class="form-label">No Telepon</label>
                                        <input value="" name="k_contact" type="text" class="form-control"
                                            id="k_contact">
                                        <x-input-error :messages="$errors->get('k_contact')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_gender" class="form-label">Jenis Kelamin</label>
                                        <select name="k_gender" class="form-control" id="k_gender">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('k_gender')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="divisi" class="form-label">Divisi</label>
                                        <select name="k_divisi" class="form-control" id="divisi">
                                            <option value="" disabled selected>Pilih Divisi</option>
                                            @foreach ($divisis as $divisi)
                                                <option value="{{ $divisi->id }}">{{ $divisi->d_nama }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('k_divisi')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="shift" class="form-label">Shift</label>
                                        <select name="shift_id" class="form-control" id="shift">
                                            <option value="" disabled selected>Pilih Shift</option>
                                            <!-- Option shift akan diisi dengan AJAX berdasarkan divisi yang dipilih -->
                                        </select>
                                        <x-input-error :messages="$errors->get('shift_id')" class="mt-2" />
                                    </div>


                                    <div class="mb-3">
                                        <label for="checkinTime" class="form-label">Tanggal Join</label>
                                        <input value="" name="khr_tgljoin" type="text" class="form-control"
                                            id="khr_tgljoin" onfocus="(this.type='date');this.focus()"
                                            onblur="(this.type='text');this.value=formatDate(this.value)">
                                        <x-input-error :messages="$errors->get('khr_tgljoin')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_email" class="form-label">Email</label>
                                        <input value="" name="k_email" type="text" class="form-control"
                                            id="k_email">
                                        <x-input-error :messages="$errors->get('k_email')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="k_alamat" class="form-label">Alamat</label>
                                        <input value="" name="K_alamat" type="text" class="form-control"
                                            id="alamat_karyawan">
                                        <x-input-error :messages="$errors->get('K_alamat')" class="mt-2" />
                                    </div>

                                    {{-- <div class="mb-3">
                        <label for="k_pin" class="form-label">PIN</label>
                        <input value="" name="k_pin" type="number" class="form-control" id="alamat_karyawan">
                        <x-input-error :messages="$errors->get('k_pin')" class="mt-2" />
                    </div> --}}

                                    {{-- <div class="mb-3">
                        <label for="k_pin" class="form-label">Status Biometric</label>
                        <input value="" name="k_biometric_status" type="bool" class="form-control" id="alamat_karyawan">
                        <x-input-error :messages="$errors->get('k_biometric_status')" class="mt-2" />
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#divisi').change(function() {
                var divisi_id = $(this).val();

                // Kosongkan dropdown shift sebelum mengisinya kembali
                $('#shift').empty();
                $('#shift').append('<option value="" disabled selected>Pilih Shift</option>');

                if (divisi_id) {
                    $.ajax({
                        url: '/get-shifts/' + divisi_id,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(key, shift) {
                                    $('#shift').append('<option value="' + shift.id +
                                        '">' + shift.s_nama + '</option>');
                                });
                            } else {
                                $('#shift').append(
                                    '<option value="" disabled>Shift tidak tersedia</option>'
                                    );
                            }
                        },
                        error: function() {
                            alert('Gagal memuat shift. Silakan coba lagi.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
