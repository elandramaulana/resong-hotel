@extends('layouts.dashboard_layout')

@section('content')

    <section id="normal-checkin">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start">
                <h1 class="h3 mb-0 text-gray-800">Normal Check-in</h1>
                <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
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
        <input type="text" name="room_id" value="{{ $Room->id }}" hidden>
        @csrf;
    <section  id="form-booking">
        <section  id="form-detail">
            <div class="container-fluid mt-4 mb-5 ">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5>Uppss Sepertinya ada kesalahan</h5>
                        <p>Periksa pesan error pada form</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Customer</h4>
                    </div>
                    <div class="card-body text-dark">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="room_no">Kartu Identitas</label>
                                            <select name="id_type" class="form-control" id="id_type">
                                                <option value="KTP" {{ "KTP" === old('id_type') ? 'selected' : '' }}>KTP</option>
                                                <option value="SIM" {{ "SIM" === old('id_type') ? 'selected' : '' }}>SIM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="room_no">Nomor Identitas</label>
                                            <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number') }}" placeholder="Nomor Identitas">
                                            <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-2">
                                        <label for="name_guest">Salutation</label>
                                        <select name="title" id="title" class="form-control">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-10">
                                        <label for="name_guest">Nama Tamu</label>
                                        <input type="text" class="form-control" id="name_guest" name="name_guest" value="{{ old('name_guest') }}" placeholder="Nama Tamu">
                                        <x-input-error :messages="$errors->get('name_guest')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-8">
                                        <label for="place_of_birth">Tempat</label>
                                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Tempat Lahir">
                                        <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="date_of_birth">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Tanggal Lahir">
                                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="place_of_birth">Email</label>
                                        <input type="text" class="form-control" id="frm_email" name="frm_email" value="{{ old('frm_email') }}" placeholder="Email">
                                        <x-input-error :messages="$errors->get('frm_email')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="date_of_birth">No Telp</label>
                                        <input type="text" class="form-control" id="telp_number" name="telp_number" value="{{ old('telp_number') }}" placeholder="No Telp">
                                        <x-input-error :messages="$errors->get('telp_number')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="agama">Religion</label>
                                        <select name="agama" id="agama" class="form-control">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ "Islam" === old('agama') ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ "Kristen" === old('agama') ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ "Katolik" === old('agama') ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ "Hindu" === old('agama') ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ "Buddha" === old('agama') ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ "Konghucu" === old('agama') ? 'selected' : '' }}>Konghucu</option>
                                            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="country">Negara</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" placeholder="Negara">
                                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="country">Provinsi</label>
                                        <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" placeholder="Provinsi">
                                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="country">Kode Pos</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" placeholder="Kode Pos">
                                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-9">
                                        <label for="city">Kota</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="Kota">
                                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="no_invoice">No Invoice</label>
                                        <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $no_invoice }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-7">
                                        <label for="room_name">Room Name</label>
                                        <input type="text" class="form-control" id="room_name" name="room_name" value="{{ $Room->room_name }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="room_no">Room Number</label>
                                        <input type="text" class="form-control" id="room_no" name="room_no" value="{{ $Room->room_no }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="room_price">Room Price / Night</label>
                                        <input type="text" readonly class="form-control" id="room_price" name="room_price" value="{{ $Room->room_price }}" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="checkin_time">Check-in Date</label>
                                        <input type="date" name="checkin_time" class="form-control" value="{{ date('Y-m-d') }}" id="checkin_time">
                                        <x-input-error :messages="$errors->get('checkin_time')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="checkinHour">Time</label>
                                        <input type="time" class="form-control" id="checkinHour" name="checkinHour" id="checkinHour" value="{{ old('checkinHour') }}" >
                                        <x-input-error :messages="$errors->get('checkinHour')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="checkout_time">Check-out Date</label>
                                        <input type="date" class="form-control" id="checkout_time" name="checkout_time" id="checkout_time" value="{{ old('checkout_time') }}">
                                        <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="number_of_adult">Jumlah Dewasa</label>
                                        <input type="number" class="form-control" id="number_of_adult" name="number_of_adult" max="{{ $Room->room_capacity }}" value="{{ old('number_of_adult', 1) }}" >
                                        <x-input-error :messages="$errors->get('number_of_adult')" class="mt-2" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="number_of_children">Jumlah Anak-anak</label>
                                        <input type="number" class="form-control" id="number_of_children" name="number_of_children" value="{{ old('number_of_children') }}" >
                                        <x-input-error :messages="$errors->get('number_of_children')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="channel">Channel</label>
                                        <select name="channel" id="channel" class="form-control">
                                            <option value="Walk-in" {{ "Walk-in" === old('channel') ? 'selected' : '' }}>Walk-in</option>
                                            <option value="Traveloka" {{ "Traveloka" === old('channel') ? 'selected' : '' }}>Traveloka</option>
                                            <option value="booking.com" {{ "booking.com" === old('channel') ? 'selected' : '' }}>booking.com</option>
                                            <option value="Travel Agent" {{ "Travel Agent" === old('channel') ? 'selected' : '' }}>Travel Agent</option>
                                            <option value="Corporate" {{ "Corporate" === old('channel') ? 'selected' : '' }}>Corporate</option>
                                            <option value="Phone-in" {{ "Phone-in" === old('channel') ? 'selected' : '' }}>Phone-in</option>
                                            <option value="tiket.com" {{ "tiket.com" === old('channel') ? 'selected' : '' }}>Tiket.com</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 form-check">
                                        &nbsp;<br>
                                        <input type="checkbox" class="form-check-input" id="extrabed" name="extrabed" value="1" {{ old('extrabed', 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="extrabed">Dengan Extrabed</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="jenis_deposit">Jenis Deposit</label>
                                        <div class="d-flex">
                                            <div class="form-check mr-3">
                                                <input class="form-check-input" checked type="radio" name="jenis_deposit" id="jenis_deposit_cash" value="Cash" {{ "Cash" === old('jenis_deposit') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="jenis_deposit_cash">Cash</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_deposit" id="jenis_deposit_lain" value="Lain-lain" {{ "Lain-lain" === old('jenis_deposit') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="jenis_deposit_lain">Lain-lain</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6" id="show_deposit_lain" >
                                        <label for="deposit">Deposit Lain-lain</label>
                                        <input type="text" class="form-control" id="deposit_lain" name="deposit_lain" value="{{ old('deposit_lain') }}" placeholder="Inputkan Deposit lain-lain Ex: KTP, SIM dan lain-lain ">
                                        <x-input-error :messages="$errors->get('deposit_lain')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="payment_method">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control">
                                            <option value="Cash" {{ "Cash" === old('payment_method') ? 'selected' : '' }}>Cash</option>
                                            <option value="Bank Transfer" {{ "Bank Transfer" === old('payment_method') ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="Qris" {{ "Qris" === old('payment_method') ? 'selected' : '' }}>Qris</option>
                                            <option value="Dana" {{ "Dana" === old('payment_method') ? 'selected' : '' }}>Dana</option>
                                            <option value="Go-Pay" {{ "Go-Pay" === old('payment_method') ? 'selected' : '' }}>Go-Pay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <!-- Button -->
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Checkin Summary</h4>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Check-in Date: <span id="summary_checkin_date">{{ old('checkin_time', date('Y-m-d')) }}</span></p>
                                        <p>Check-out Date: <span id="summary_checkout_date">{{ old('checkout_time') }}</span></p>
                                        <p>Duration: <span id="summary_duration">0</span> nights</p>
                                        <p>Extrabed: Rp <span id="extrabed_price">0</span></p>
                                        <input type="text" name="extrabed_price" id="extrabed_price_input" value="0" hidden>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Room Rate : Rp <input type="number" name="room_price_input" id="room_price_input" value="{{ $Room->room_price }}" > </p>
                                        <p>Total Room Price: Rp <span id="summary_room_price">0</span></p>
                                        <p>Tax ({{$Settings->pajak_checkin}} %): <span id="showPajak"></span></p>
                                        <input type="text" name="tax" id="tax" value="{{$Settings->pajak_checkin}}" hidden>
                                        <p>Total Price: Rp <span id="summary_total_price">0</span></p>
                                        <input type="text" name="total_price" id="total_price" value="0" hidden>
                                        <p>Deposit: <input type="text" id="deposit" class="form-control" name="deposit" value="{{ old('deposit') }}" placeholder="Masukan Besar Deposit" value="50000"></p>
                                        <p>Pembayaran + Deposit: Rp <span id="summary_total_payment">0</span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mt-5 mb-3 d-flex justify-content-start ">
                                        <div class="ml-auto">
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
                    </div>
                </div>
                </div>
            </div>
        </section>
</section>


                <!-- Form Detail Customer -->


                <!-- Scripnya ada di view dashboard_layout.blade.php -->

                <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
                    "Nama" at Room "Nomor room" Checked in Succesfully
                </div>

                <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                    Failed To Submit
                </div>
            </form>
        </div>
    </section>

@endsection
@section('jsSection')
    @include('frontoffice.checkin.normal_checkin_form_js')
@endsection
