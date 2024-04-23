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
                                <h3 class="font-weight-bold text-dark">Manage Menu</h3>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <button class="btn btn-extend">
                                    <a style="text-decoration: none; color:white" href="{{route('tambah.menu')}}">Tambah</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="manageMenuTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">NO</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $counter_menu = 1;
                                @endphp
                                 @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $counter_menu }}</td>
                                        <td>{{$menu->menu_name}}</td>
                                        <td>{{$menu->nama_kategori}}</td>
                                        <td>{{$menu->menu_price}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <img width="200" src="{{ asset('storage/' . $menu->menu_photo) }}" alt="">
                                            </div>
                                         
                                        </td>
                                        <td>
                                            <div>
                                                <button style="margin-right: 10px" type="submit" class="btn btn-warning btn-sm mt-2">
                                                   <a style="color: black" href="">  <i class="fas fa-edit"></i></a>
                                                </button>
                                                <form action="{{ route('destroy.kategori', $menu->menu_id) }}" method="POST" style="display: inline;" id="deleteForm{{$menu->menu_id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#deleteConfirmationModal{{$menu->menu_id}}">
                                                       <i style="color: black" class="fas fa-trash-alt"></i>
                                                     </button>
                                                </form>

                                                            <!-- Delete Confirmation Modal for each post -->
                                                    <div class="modal fade" id="deleteConfirmationModal{{$menu->menu_id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{$menu->menu_id}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-body d-flex justify-content-center">
                                                                    <img class="" src="{{asset('assets/img/alert.png')}}" alt="">
                                                                </div>
                                                                <div class="col-sm-12 d-flex justify-content-center">
                                                                    <p>Yakin hapus data?</p>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteForm{{$menu->menu_id}}').submit()">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                @php
                                    $counter_menu++;
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
