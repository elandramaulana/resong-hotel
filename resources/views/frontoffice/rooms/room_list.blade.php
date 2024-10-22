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
                                        <h3 class="font-weight-bold text-dark">Daftar Room</h3>
                                    </div>
                                    <div class="col-sm-6 d-flex justify-content-end">
                                        <button class="btn btn-extend">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('tambah.room') }}">Tambah</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataRoomTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">NO</th>
                                                <th>Room No</th>
                                                <th>Room Name</th>
                                                <th>Room Type</th>
                                                <th>Room Price</th>
                                                <th>Capacity</th>
                                                <th>Extrabed</th>
                                                <th>Status</th>
                                                <th>Bed Type</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($rooms as $r)
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$r->room_no}}</td>
                                                    <td>{{$r->room_name}}</td>
                                                    <td>{{$r->room_type}}</td>
                                                    <td>Rp. {{ number_format($r->room_price, 0, ',', '.') }}</td>
                                                    <td>{{$r->room_capacity}}</td>
                                                    <td>
                                                        @if($r->room_extrabed == 1)
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        @else
                                                            <i class="fas fa-times-circle" style="color: red;"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{$r->room_status}}</td>
                                                    <td>{{$r->bed_type}}</td>
                                                    <td>
                                                        <div>
                                                            <button style="margin-right: 10px" type="submit"
                                                                class="btn btn-warning btn-sm mt-2">
                                                                <a style="color: black" href="{{ route('edit.room', ['id' => $r->id ]) }}"> <i
                                                                        class="fas fa-edit"></i></a>
                                                            </button>
                                                            <form action="{{route('destroy.room',['id' => $r->id ])}}" method="POST" style="display: inline;"
                                                                id="deleteForm">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-warning btn-sm mt-2"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteConfirmationModal">
                                                                    <i style="color: black" class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            <!-- Delete Confirmation Modal for each post -->
                                                            <div class="modal fade" id="deleteConfirmationModal"
                                                                tabindex="-1"
                                                                aria-labelledby="deleteConfirmationModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div
                                                                            class="modal-body d-flex justify-content-center">
                                                                            <img class=""
                                                                                src="{{ asset('assets/img/alert.png') }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div
                                                                            class="col-sm-12 d-flex justify-content-center">
                                                                            <p>Yakin hapus data?</p>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer d-flex justify-content-center">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger"
                                                                                onclick="document.getElementById('deleteForm').submit()">Hapus</button>
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