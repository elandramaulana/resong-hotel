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
                                        <h3 class="font-weight-bold text-dark">Profile User</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">
                                    @csrf

                                   
{{--                                         
                                        
                                        
                                       
                                        
                                        
                                       
                                        
                                       
                                        <hr>
                                    --}}
                                    @foreach ($karyawanData as $karyawan)
                                    <div class="row mb-3">
                                        <div class="col-6 col-md-6">
                                            <div class="mb-3">
                                                <p><strong>Nama:</strong> {{ $karyawan->k_nama }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>Email:</strong> {{ $karyawan->k_email }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>NIK:</strong> {{ $karyawan->k_nik }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>Jenis Kelamin:</strong> {{ $karyawan->k_gender }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>Divisi:</strong> {{ $karyawan->divisi_nama }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="mb-3">
                                                <p><strong>Kontak:</strong> {{ $karyawan->k_contact }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>Alamat:</strong> {{ $karyawan->K_alamat }}</p>
                                            </div>


                                            <div class="mb-3">
                                                <p><strong>Tanggal Bergabung:</strong> {{ $karyawan->khr_tgljoin }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <p><strong>Tanggal Keluar:</strong> {{ $karyawan->khr_tglOut ?? 'Masih Aktif' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
