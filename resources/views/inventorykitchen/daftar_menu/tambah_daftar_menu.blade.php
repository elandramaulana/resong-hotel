@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 style="font-weight: bold" class="h3 mb-0 text-gray-800">Tambah Daftar Menu</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
    <form action="{{route('store.daily.menu')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body text-dark">
                    <div class="row">
                    @php
                        $tanggal_menu = date('Y-m-d');
                    @endphp

                        <div class="mb-3">
                            <label for="tanggal_menu" class="form-label">Tanggal</label>
                            <input value="{{ $tanggal_menu }}" name="tanggal_menu" type="text" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                            <x-input-error :messages="$errors->get('tanggal_menu')" class="mt-2" />
                        </div>
                    </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body text-dark">
              <div class="row">
                <div class="col-sm-6">
                    <h2 style="font-weight: bold">Breakfast</h2>
                </div>
                <div class="col-sm-6">
                    <div class="mt-4 mb-3 d-flex justify-content-end ">
                        <div class="">
                            <button type="button" class="btn submit-btn m-0" onclick="tambahKolomBreakfast()">
                               Tambah Kolom
                            </button>
                        </div>
                    </div>
                </div>
              </div>
                <div id="kolom-breakfast">
                    <div class="row kolom-breakfast">
                        <div class="mb-3">
                            <label for="breakfast" class="form-label">Menu</label>
                            <select name="menu_breakfast[]" class="form-control" id="breakfast">
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->menu_name }}" {{ $menu->menu_name === old('breakfast') ? 'selected' : '' }} >{{ $menu->menu_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_breakfast.*')" class="mt-2" />
                        </div>
                    </div>
                </div>

 
                    @php
                        $showJam = date("H:i");
                    @endphp

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Masak</label>
                            <input name="jam_masak_breakfast" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Hidang</label>
                            <input name="jam_hidang_breakfast" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>
                  
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body text-dark">
              <div class="row">
                <div class="col-sm-6">
                    <h2 style="font-weight: bold">Lunch</h2>
                </div>
                <div class="col-sm-6">
                    <div class="mt-4 mb-3 d-flex justify-content-end ">
                        <div class="">
                            <button type="button" class="btn submit-btn m-0" onclick="tambahKolomLunch()">
                               Tambah Kolom
                            </button>
                        </div>
                    </div>
                </div>
              </div>
                <div id="kolom-lunch">
                    <div class="row kolom-lunch">
                        <div class="mb-3">
                            <label for="lunch" class="form-label">Menu</label>
                            <select name="menu_lunch[]" class="form-control" id="lunch">
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->menu_name }}" {{ $menu->menu_name === old('lunch') ? 'selected' : '' }} >{{ $menu->menu_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_lunch.*')" class="mt-2" />
                        </div>
                    </div>
                </div>

 
                    @php
                        $showJam = date("H:i");
                    @endphp

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Masak</label>
                            <input name="jam_masak_lunch" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Hidang</label>
                            <input name="jam_hidang_lunch" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>
                  
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body text-dark">
              <div class="row">
                <div class="col-sm-6">
                    <h2 style="font-weight: bold">Dinner</h2>
                </div>
                <div class="col-sm-6">
                    <div class="mt-4 mb-3 d-flex justify-content-end ">
                        <div class="">
                            <button type="button" class="btn submit-btn m-0" onclick="tambahKolomDinner()">
                               Tambah Kolom
                            </button>
                        </div>
                    </div>
                </div>
              </div>
                <div id="kolom-dinner">
                    <div class="row kolom-dinner">
                        <div class="mb-3">
                            <label for="dinner" class="form-label">Menu</label>
                            <select name="menu_dinner[]" class="form-control" id="dinner">
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->menu_name }}" {{ $menu->menu_name === old('dinner') ? 'selected' : '' }} >{{ $menu->menu_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_dinner.*')" class="mt-2" />
                        </div>
                    </div>
                </div>

 
                    @php
                        $showJam = date("H:i");
                    @endphp

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Masak</label>
                            <input name="jam_masak_dinner" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>

                        <!-- Jam -->
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Hidang</label>
                            <input name="jam_hidang_dinner" value="{{ $showJam }}" type="text" class="form-control" id="jam">
                        </div>
                  
            </div>
        </div>

        
        <div class="mt-4 mb-3 d-flex justify-content-start ">
            <div class="">
                <button type="submit" class="btn submit-btn mr-5">
                   Tambah
                </button>
            </div>
        </div>
    </form>
    </div>
</div>

</section>


@endsection