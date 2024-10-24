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
              
                    
                        <div class="col-sm-12">
                            <div class="container">
                                <h1>Manage Menu for {{ $day->day_name }}</h1>
                                <form action="{{ route('update.daily', ['id' => $day->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Category</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allMenus as $menu)
                                                <tr>
                                                    <td>{{ $menu->menu_name }}</td>
                                                    <td>{{ $menu->nama_kategori }}</td>
                                                    <td>
                                                        <input type="checkbox" name="menu_ids[]" value="{{ $menu->menu_id }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                
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




<!-- /.container-fluid -->

@endsection
