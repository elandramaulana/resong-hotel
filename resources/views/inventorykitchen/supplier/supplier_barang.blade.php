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
                                <h3 class="font-weight-bold text-dark">Supplier</h3>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <button class="btn btn-extend">
                                    <a style="text-decoration: none; color:white" href="{{route('tambah.supplier')}}">Tambah</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cleaningHistoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">NO</th>
                                        <th>Id Supplier</th>
                                        <th>Nama</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $counter_sup = 1;
                                @endphp
                                 @foreach($supplier as $sup)
                                    <tr>
                                        <td>{{ $counter_sup }}</td>
                                        <td>{{$sup->id_supplier}}</td>
                                        <td>{{$sup->supplier_name}}</td>
                                        <td>{{$sup->supplier_telp}}</td>
                                        <td>{{$sup->supplier_alamat}}</td>
                                        <td>
                                            <div>
                                                <button style="margin-right: 10px" type="submit" class="btn btn-warning btn-sm mt-2">
                                                   <a style="color: black" href="{{route('edit.supplier',['id' => $sup->id])}}">  <i class="fas fa-edit"></i></a>
                                                </button>
                                                <form action="{{ route('destroy.supplier', $sup->id) }}" method="POST" style="display: inline;" id="deleteForm{{$sup->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#deleteConfirmationModal{{$sup->id}}">
                                                       <i style="color: black" class="fas fa-trash-alt"></i>
                                                     </button>
                                                </form>

                                                            <!-- Delete Confirmation Modal for each post -->
                                                    <div class="modal fade" id="deleteConfirmationModal{{$sup->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{$sup->id}}" aria-hidden="true">
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
                                                                    <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteForm{{$sup->id}}').submit()">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                @php
                                    $counter_sup++;
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
