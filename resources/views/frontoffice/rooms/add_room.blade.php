@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Tambah Room</h1>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <h4>Error Message</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Checkout Detail -->
    
    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
                <form action="{{ route('store.room')}}" method="POST" id="formDetailCheckin">
                    @csrf
                    

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                           
                            <div class="mb-3">
                                <label for="room_name" class="form-label">Name</label>
                                <input value="" name="room_name" type="text" class="form-control" id="room_name" >
                                <x-input-error :messages="$errors->get('room_name')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <label for="room_no" class="form-label">No</label>
                                <input value="" name="room_no" type="text" class="form-control" id="room_no" >
                                <x-input-error :messages="$errors->get('room_no')" class="mt-2"/>
                            </div>
 
                           
                            <div class="mb-3">
                                <label for="room_capacity" class="form-label">Capacity</label>
                                <input value="" name="room_capacity" type="number" class="form-control" id="room_capacity">
                                <x-input-error :messages="$errors->get('room_capacity')" class="mt-2"/>
                            </div>
                        </div>
                    
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="room_extrabed" class="form-label">Extrabed</label>
                                <select name="room_extrabed" class="form-control" id="room_extrabed">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <x-input-error :messages="$errors->get('room_extrabed')" class="mt-2" />
                            </div>

                            

                            <div class="mb-3">
                                <label for="room_type" class="form-label">Type (PREMIUM, VIP, STANDARD, etc)</label>
                                <input name="room_type" type="text" class="form-control" value="">
                                <x-input-error :messages="$errors->get('room_type')" class="mt-2"/>
                            </div>

                          
                            <div class="mb-3">
                                <label for="bed_type" class="form-label">Bed Type(SINGLE, TWIN, etc) </label>
                                <input value=""  type="text" class="form-control" name="bed_type" id="no_rek">
                                <x-input-error :messages="$errors->get('bed_type')" class="mt-2"/>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="room_price" class="form-label">Price</label>
                            <input value="" name="room_price" type="number" class="form-control" id="room_price">
                            <x-input-error :messages="$errors->get('room_price')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 d-flex justify-content-start ">
                        <div class="">
                            <button type="submit" class="btn submit-btn mr-5">
                               Simpan
                            </button>
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</section>
</div>
</section>


@endsection