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
                                <h3 class="font-weight-bold text-dark">Daftar Menu Daily</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                <form action="{{ route('store.daily.menu') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="row">
                            <div class="col-sm-12">
                                {{-- <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                    <label for="Channel" class="form-label">Hari</label>
                                                    <select name="day_name" class="form-control" id="channel">
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jum'at</option>
                                                        <option value="Sabtu">Sabtu</option>
                                                        <option value="Minggu">Minggu</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                    
                                    <!-- Right Column -->
                                    <div class="col-md-6">
                    
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                    <label for="Channel" class="form-label">Set Status</label>
                                                    <select name="status" class="form-control" id="channel">
                                                        <option value="Active">Active</option>
                                                        <option value="Non-Active">Non-Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div> --}}
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="manageMenuTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Breakfast</th>
                                            <th>Lunch</th>
                                            <th>Dinner</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($menus as $menu)
                                            <tr>
                                                <td>{{$menu['day_name']}}</td>
                                                <td>
                                                    <ul class="list-group list-group-flush">
                                                    @foreach($menu['Breakfast'] as $key)
                                                        <li class="list-group-item">{{ $key['menu_name'] }}</li>
                                                    @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-group list-group-flush">
                                                    @foreach($menu['Lunch'] as $key)
                                                        <li class="list-group-item">{{ $key['menu_name'] }}</li>
                                                    @endforeach
                                                    </ul></td>
                                                <td>
                                                    
                                                    @foreach($menu['Dinner'] as $key)
                                                        {{ $key['menu_name'] }}
                                                    @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button style="margin-right: 10px" type="submit" class="btn btn-warning btn-sm mt-2">
                                                           <a style="color: black" href="">  <i class="fas fa-edit"></i></a>
                                                        </button>
                                                        <form action="" method="POST" style="display: inline;" id="deleteForm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#deleteConfirmationModal">
                                                               <i style="color: black" class="fas fa-trash-alt"></i>
                                                             </button>
                                                        </form>
        
                                                                    <!-- Delete Confirmation Modal for each post -->
                                                            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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
                                                                            <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                       
                                            @endforeach
                                      
                                        </tbody>
                                </table>
                            
                            </div>
                        </div>
                      </div>
                      <br>
                      <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn submit-btn mr-5">
                                <i class="fas fa-save"></i> Save
                            </button>
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
