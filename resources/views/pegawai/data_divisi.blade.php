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
                                        <h3 class="font-weight-bold text-dark">Data Divisi</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <button class="btn btn-extend">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('tambah.divisi') }}">Tambah</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataDivisiTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Id Divisi</th>
                                                <th>Nama Divisi</th>
                                                <th>Deskripsi</th>
                                                <th>Jobdesc</th>
                                                <th>OT Approver</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($divisi as $d)
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$d->id}}</td>
                                                    <td>{{$d->d_nama}}</td>
                                                    <td>{{$d->d_deskripsi}}</td>
                                                    <td>{{$d->d_jobdesc}}</td>
                                                      <td>{{ $d->d_OT_approver == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        <div>
                                                            <button style="margin-right: 10px" type="submit"
                                                                class="btn btn-warning btn-sm mt-2">
                                                                <a style="color: black" href="{{ route('edit.divisi', ['id' => $d->id ]) }}"> <i
                                                                        class="fas fa-edit"></i></a>
                                                            </button>
                                                            <form action="{{ route('destroy.divisi', ['id' => $d->id]) }}" method="POST" style="display: inline;" id="deleteForm-{{ $d->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#deleteConfirmationModal-{{ $d->id }}">
                                                                    <i style="color: black" class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="deleteConfirmationModal-{{ $d->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda yakin ingin menghapus data ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" form="deleteForm-{{ $d->id }}" class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>

                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>



    </div>
    <!-- /.container-fluid -->
@endsection
