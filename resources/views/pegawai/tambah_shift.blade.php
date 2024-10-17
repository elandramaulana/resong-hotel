@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if (\Session::has('message'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Tambah Shift</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="{{route('store.shift')}}" method="post" enctype="multipart/form-data">
                     @csrf
                    <div class="row">

                        <div class="mb-3">
                            <label for="Channel" class="form-label">Divisi</label>
                            <select name="id_divisi" class="form-control" id="channel">
                                @foreach($divisis as $divisi)
                                    <option value="{{ $divisi->id }}" {{ $divisi->id === old('channel') ? 'selected' : '' }} >{{ $divisi->d_nama }}</option>
                                @endforeach
                            
                            </select>
                            <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                        </div>

                     <div class="mb-3">
                        <label for="k_nama" class="form-label">Nama Shift</label>
                        <input value="" name="s_nama" type="text" class="form-control" id="k_nama">
                        <x-input-error :messages="$errors->get('s_nama')" class="mt-2" />
                    </div>

                      <!-- Left Column -->
                      <div class="col-md-6">
                        @php
                            $showJamIn = date("H:i");
                        @endphp
                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Clock In</label>
                            <input name="s_clock_in" value="{{ $showJamIn }}" type="time" class="form-control" id="jam">
                        </div>
                    </div>

                       <!-- Right Column -->
                       <div class="col-md-6">
                            @php
                                $showJamOut = date("H:i");
                            @endphp
                            <!-- Jam -->
                            <div class="mb-3">
                                <label for="jam" class="form-label">Clock Out</label>
                                <input name="s_clock_out" value="{{ $showJamOut }}" type="time" class="form-control" id="jam">
                            </div>
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