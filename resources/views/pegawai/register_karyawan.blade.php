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
                                        <h3 class="font-weight-bold text-dark">Register Akun Karyawan</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('store.user')}}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="r_nama" class="form-label">Nama Lengkap</label>
                                                <input value="" name="r_nama" type="text" class="form-control"
                                                    id="r_nama">
                                                <x-input-error :messages="$errors->get('r_nama')" class="mt-2" />
                                            </div>

                                            <div class="mb-3">
                                                <label for="checkinTime" class="form-label">Tanggal Lahir</label>
                                                <input value="" name="r_ttl" type="text" class="form-control"
                                                    id="r_ttl" onfocus="(this.type='date');this.focus()"
                                                    onblur="(this.type='text');this.value=formatDate(this.value)">
                                                <x-input-error :messages="$errors->get('r_ttl')" class="mt-2" />
                                            </div>

                                            <div class="mb-3">
                                                <label for="r_email" class="form-label">Email</label>
                                                <input value="" name="r_email" type="text" class="form-control"
                                                    id="r_email">
                                                <x-input-error :messages="$errors->get('r_email')" class="mt-2" />
                                            </div>

                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="r_username" class="form-label">Username</label>
                                                <input value="" name="r_username" type="text" class="form-control"
                                                    id="r_username">
                                                <x-input-error :messages="$errors->get('r_username')" class="mt-2" />
                                            </div>

                                        </div>

                                        <div class="mt-4 mb-3 d-flex justify-content-end ">
                                            <div class="">
                                                <button type="submit" class="btn submit-btn mr-5">
                                                    Daftar
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
