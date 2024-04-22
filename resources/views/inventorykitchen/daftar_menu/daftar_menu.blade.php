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
                                <div class="row">
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
                                </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="manageMenuTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                         @foreach($menus as $menu)
                                            <tr>
                                                <td>{{$menu->menu_name}}</td>
                                                <td>{{$menu->menu_category}}</td>
                                                <td>{{$menu->menu_price}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <img width="200" src="{{ asset('storage/' . $menu->menu_photo) }}" alt="">
                                                    </div>
                                                 
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input  name="menu_ids[]" style="width: 20px; height:20px" class="form-check-input" type="checkbox" value="{{ $menu->menu_id }}" id="flexCheckDefault">
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
