@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Tambah Room Kategori</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('update.roomcat', $roomcat->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                    <div class="row">

                     <div class="mb-3">
                        <label for="name_category" class="form-label">Nama</label>
                        <input value="{{$roomcat->name_category}}" name="name_category" type="text" class="form-control" id="name_category">
                        <x-input-error :messages="$errors->get('name_category')" class="mt-2" />
                    </div>

                        <div class="mt-4 mb-3 d-flex justify-content-start ">
                            <div class="">
                                <button type="submit" class="btn submit-btn mr-5">
                                   Tambah
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</section>


@endsection