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
              
                      <div class="row">
                            <div class="col-sm-12">
                               
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="manageMenuTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                    
                                           
                                            @foreach($categories as $category)
                                                <th>{{ $category->nama_kategori }}</th>
                                            @endforeach
                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp <!-- Inisialisasi counter -->
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>
                                                    <span class="hidden-number">{{ $counter }}</span> <!-- Menyimpan nomor di sini -->
                                                    {{ $menu['day_name'] }} <!-- Tampilkan nama hari -->
                                                </td>
                                    
                                                @foreach($menu['categories'] as $category_name => $category_menus)
                                                    <td>
                                                        <ul class="list-group list-group-flush">
                                                            @foreach($category_menus as $key)
                                                                <li class="list-group-item">{{ $key['menu_name'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                @endforeach
                                    
                                                <td>
                                                    <div>
                                                        <button style="margin-right: 10px" type="button" class="btn btn-warning btn-sm mt-2">
                                                            <a style="color: black" href="{{ route('manage.daily', ['id' => $menu['id']]) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp <!-- Increment counter -->
                                        @endforeach
                                    </tbody>
                                    
                                    
                                </table>
                            
                            </div>
                        </div>
                      </div>
                      <br>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</section>



</div>
<!-- /.container-fluid -->

@endsection
