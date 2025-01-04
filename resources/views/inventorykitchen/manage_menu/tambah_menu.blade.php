@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Tambah Menu</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
    <form action="{{route('store.menu')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body text-dark">
                    <div class="row">

                     <div class="mb-3">
                        <label for="menu_name" class="form-label">Nama Menu</label>
                        <input value="" name="menu_name" type="text" class="form-control" id="menu_name">
                        <x-input-error :messages="$errors->get('menu_name')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="Channel" class="form-label">Kategori</label>
                        <select name="menu_category" class="form-control" id="channel">
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ $kat->nama_kategori === old('channel') ? 'selected' : '' }} >{{ $kat->nama_kategori }}</option>
                            @endforeach
                        
                        </select>
                        <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                    </div>

                     <div class="mb-3">
                        <label for="menu_price" class="form-label">Harga Menu</label>
                        <input value="" name="menu_price" type="number" class="form-control" id="menu_price">
                        <x-input-error :messages="$errors->get('menu_price')" class="mt-2" />
                    </div>


                    <div class="mb-3">
                        <label for="menu_photo" class="form-label">Pilih Foto Menu</label>
                        <div class="mb-4 d-flex justify-content-center">
                            <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                            alt="example placeholder" style="width: 50%;" />
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-warning btn-rounded">
                                <label class="form-label text-dark m-1" for="customFile1">Choose file</label>
                                <input type="file" name="menu_photo" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <br>
      
        <div class="m-5 d-flex justify-content-start ">
            <div class="">
                <button type="submit" class="btn submit-btn mr-5">
                   Simpan
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
<br>

</section>


@endsection