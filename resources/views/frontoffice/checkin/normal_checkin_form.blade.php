@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Normal Check-in</h1> <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
    </div>
    
    <div style="background: rgba(219, 176, 79, 0.3); padding-top:12px" class="row rounded text-dark text-center">
        <div class="col-sm-3">
            <p>Jam Check-In : 14:00</p>
        </div>
        <div class="col-sm-3">
            <p>Jam Check-Out : 12:00</p>
        </div>
        <div class="col-sm-3">
            <p>Early Check-In : 06:00 - 14.00</p>
        </div>
        <div class="col-sm-3">
            <p>Early Check-Out : 12:00 - 14.00</p>
        </div>
    </div>

    <!-- form Room Number -->
    <form action="{{ route('checkin.normal.store') }}" method="POST">
        @csrf;
    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-3">
                    <h2>Room Number: {{ $Room['room_no'] }}</h2>
                </div>
                <div class="col-sm-3 text-warning text-center">
                    <h6 class="shape rounded p-2">{{ $Room['room_name'] }} (@RP{{ $Room['room_price'] }})</h6>
                </div>
            </div>
            <input type="text" name="room_id" value="{{ $Room['id'] }}" hidden>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="invoice" class="form-label">#Invoice</label>
                                <input value="{{ $no_invoice }}" name="invoice" type="text" class="form-control" id="invoice" readonly>
                                <x-input-error :messages="$errors->get('invoice')" class="mt-2" />
            
                            </div>

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input readonly value="{{ $checkin_time }}" name="checkin_time" type="text" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                <x-input-error :messages="$errors->get('checkin_time')" class="mt-2" />
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input name="number_of_adult" value="{{ $Room['room_capacity'] }}{{ old('number_of_adult') }}" type="number" class="form-control" id="adults">
                                <x-input-error :messages="$errors->get('number_of_adult')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="channel" class="form-control" id="channel">
                                    <option value="Walk-in" {{ "Walk-in" === old('channel') ? 'selected' : '' }} >Walk-in</option>
                                    <option value="Traveloka" {{ "Traveloka" === old('channel') ? 'selected' : '' }}>Traveloka</option>
                                    <option value="Phone-in" {{ "Phone-in" === old('channel') ? 'selected' : '' }}>Phone-in</option>
                                    <option value="tiket.com" {{ "tiket.com" === old('channel') ? 'selected' : '' }}>Tiket.com</option>
                                    <option value="syifa_travel" {{ "syifa_travel" === old('channel') ? 'selected' : '' }}>Syifa Travel</option>
                                </select>
                                <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input value="{{ old('checkout_time') }}" name="checkout_time" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input value="{{ old('number_of_children') }}" name="number_of_children" type="number" class="form-control" id="children" >
                                <x-input-error :messages="$errors->get('number_of_children')" class="mt-2" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>


<!-- Form Detail Customer -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
                <!-- Id -->
                <div class="row mt-3 ">
                    <label for="" class="col-sm-2 col-form-label">ID Number*</label>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <select name="id_type" class="form-control" id="id_type">
                                    <option value="KTP" {{ "KTP" === old('id_type') ? 'selected' : '' }}>KTP</option>
                                    <option value="SIM" {{ "SIM" === old('id_type') ? 'selected' : '' }}>SIM</option>
                                </select>
                                <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <input name="id_number" value="{{ old('id_number') }}" type="text" class="form-control" id="id_number">
                            <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                        </div>
                </div>

                <!-- Nama -->
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label ">Name*</label>
                        <div class="col-sm-8">
                        <input value="{{ old('name_guest') }}" type="text" name="name_guest" class="form-control clearable" id="name_guest">
                        <x-input-error :messages="$errors->get('name_guest')" class="mt-2" />
                        </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#customerData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>

                <!-- TTL -->
                    <div class="row ">
                        <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input name="place_of_birth" value="{{ old('place_of_birth') }}" type="text" class="form-control clearable" id="place_of_birth">
                                <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                            </div>

                            <div class="col-sm-4">
                                <input value="{{ old('date_of_birth') }}" name="date_of_birth" type="text" class="form-control clearable" id="date_of_birth" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>
                    </div>

                <!-- Gender -->
                    <div class="mt-3 row">
                        <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin*</label>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="genderMale">
                                <label class="form-check-label" for="gender">
                                    Laki-laki
                                </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Perempuan" id="genderFemale">
                                <label class="form-check-label" for="gender">
                                    Perempuan
                                </label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>


                <!-- Agama -->
                    <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <select name="religion" class="form-control" id="agama">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ "Islam" === old('religion') ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen"  {{ "Kristen" === old('religion') ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik"  {{ "Katolik" === old('religion') ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu"  {{ "Hindu" === old('religion') ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha"  {{ "Buddha" === old('religion') ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu"  {{ "Konghucu" === old('religion') ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                    </div>

                <!-- Title -->
                <div class="row">
                        <label for="name" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Mr" id="titleMr">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mr
                                </label>
                                </div>
                            </div>

                            <div class="col-sm-3 ">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Mrs" id="titleMrs">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mrs
                                </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Ms" id="titleMs">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Ms
                                </label>
                                </div>
                            </div>
                          
                </div>

                <!-- Negara -->
                <div class="row">
                        <label for="country" class="col-sm-2 col-form-label">Negara</label>
                            <div class="col-sm-8">
                                <input name="country" type="text" value="{{ old('country') }}" class="form-control clearable" id="country">
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countyData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>

                <!-- Provinsi -->
                <div class="mt-3 row">
                        <label for="province" class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <input name="province" type="text" class="form-control clearable" value="{{ old('province') }}" id="provinsi">
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#provinceData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>


                <!-- Kota -->
                <div class="mt-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-8">
                                <input name="city" type="text" class="form-control clearable" id="city" value="{{ old('city') }}">
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cityData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>


                <!-- Kode Pos -->
                <div class="row mt-3">
                        <label for="" class="col-sm-2 col-form-label">Kode Pos</label>
                            <div class="col-sm-8">
                                <input name="postal_code" type="text" class="form-control clearable" id="frm_kodepos" value="{{ old('postal_code') }}">
                                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                            </div>
                    </div>


                <!-- Email -->
                <div class="mt-3 row">
                        <label for="" class="col-sm-2 col-form-label">Email</label>
                            
                            <div class="col-sm-8">
                                <input name="email_address"  type="text" class="form-control clearable" id="frm_email" value="{{ old('email_address') }}">
                                <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
                            </div>
                    </div>


                <!-- No Telp -->
                <div class=" mt-3 row">
                        <label for="" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-8">
                                <input value="{{ old('telp_number') }}" name="telp_number" type="text" class="form-control clearable" id="contact">
                                <x-input-error :messages="$errors->get('telp_number')" class="mt-2" />
                            </div>
                    </div>


                <!-- Upload Dokumen -->
                 {{-- <div class=" mt-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Upload Foto Dokumen</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <input name="document" type="file" class="form-control" id="inputGroupFile02">
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                            </div>
                        </div>
                    </div> --}}

                 <!-- Deposit -->
                 <div class="mt-3 row">
                    <label for="deposit" class="col-sm-2 col-form-label">Total Deposit (Rp)</label>
                        <div class="col-sm-6">
                        <input name="deposit" value="{{ old('deposit') }}" type="text" class="form-control" id="inputDeposit">

                        <x-input-error :messages="$errors->get('deposit')" class="mt-2" />
                    </div>
                    <div class="col-sm-2">
                        <select name="payment_method" class="form-control">
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Qris">Qris</option>
                            <option value="Dana">Dana</option>
                            <option value="Go-Pay">Go-Pay</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>
                </div>


                <!-- Button -->
                    <div class="mt-5 mb-3 d-flex justify-content-start ">
                    <div class="">
                        <button type="submit" class="btn submit-btn mr-5">
                            Check In
                        </button>
                    </div>
                    <div class="">
                        <button class="btn cancel-btn">
                            Cancel
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</section>

<!-- Scripnya ada di view dashboard_layout.blade.php -->

<div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
    "Nama" at Room "Nomor room" Checked in Succesfully
</div>

<div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
    Failed To Submit
</div>
</form>

<!-- Modal for name customer -->
<div class="modal fade" id="customerData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="checkInTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>No Telp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>098878672343</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>09093892423</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>



<!-- Modal Country customer -->
<div class="modal fade" id="countyData" tabindex="-1" aria-labelledby="countyData" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Select Country</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="countryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Country Name</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Indonesia</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Japan</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>


<!-- Modal Province customer -->
<div class="modal fade" id="provinceData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ProvinceTable" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>Provinsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sumatera Utara</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kalimantan Barat</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>


<!-- Modal city customer -->
<div class="modal fade" id="cityData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cityTable" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>Kota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Padang</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jakarta</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    
        </div>
    </div>
</div>



    </div>
</section>

@endsection
@section('jsSection')
  @include('frontoffice.checkin.normal_checkin_form_js')
@endsection