@extends('layouts.dashboard_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="font-weight-bold text-dark">Profile {{ Auth::user()->name }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-6 col-md-6">
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
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="k_divisi" class="form-label">Divisi</label>
                                                {{-- <select name="k_divisi" class="form-control" id="divisi">
                                                    <option value="" disabled selected>Pilih Divisi</option>
                                                    @foreach ($divisis as $divisi)
                                                        <option value="{{ $divisi->id }}">{{ $divisi->d_nama }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('k_divisi')" class="mt-2" /> --}}
                                                <input value="" name="k_divisi" type="text" class="form-control"
                                                    id="k_divisi" disabled>
                                                <x-input-error :messages="$errors->get('k_divisi')" class="mt-2" />
                                            </div>

                                            <div class="mb-3">
                                                <label for="k_shift" class="form-label">Shift</label>
                                                {{-- <select name="shift_id" class="form-control" id="shift">
                                                    <option value="" disabled selected>Pilih Shift</option>
                                                    <!-- Option shift akan diisi dengan AJAX berdasarkan divisi yang dipilih -->
                                                </select>
                                                <x-input-error :messages="$errors->get('shift_id')" class="mt-2" /> --}}
                                                <input value="" name="k_shift" type="text" class="form-control"
                                                    id="k_shift" disabled>
                                                <x-input-error :messages="$errors->get('k_shift')" class="mt-2" />
                                            </div>


                                            <div class="mb-3">
                                                <label for="checkinTime" class="form-label">Tanggal Join</label>
                                                <input value="" name="khr_tgljoin" type="text" class="form-control"
                                                    id="khr_tgljoin" onfocus="(this.type='date');this.focus()"
                                                    onblur="(this.type='text');this.value=formatDate(this.value)" disabled>
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
                                                <input value="" name="K_alamat" type="text"
                                                    class="form-control" id="alamat_karyawan">
                                                <x-input-error :messages="$errors->get('K_alamat')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="mt-4 mb-3 d-flex justify-content-end ">
                                            <div class="">
                                                <button type="submit" class="btn submit-btn mr-5">
                                                    Perbarui
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- /.container-fluid -->
@endsection
