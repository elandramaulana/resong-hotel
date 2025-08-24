@extends('layouts.dashboard_layout')
@section('content')
    <section id="speedy-checkin">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-start">
                <h1 class="h3 mb-0 text-gray-800">Speedy Check-in</h1>
            </div>
        </div>

        <div class="form-speedy">
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-body text-dark">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('checkin.speedy_post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <label for="bookingNumber" class="form-label">Nama Reservasi</label>
                                            <input value="" name="reservation_name" type="text"
                                                class="form-control" id="reservation_name">
                                        </div>
                                    </div>

                            <!-- Check-in Time -->
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="checkinTime" class="form-label">Check-in Date</label>
                                    <input name="speedy_checkin_time" value="" type="text"  class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="checkinHour" class="form-label">Check-in Time</label>
                                    <input name="speedy_checkin_hour" type="time" required class="form-control" id="checkinHour" >
                                </div>
                            </div>

                                    <div class="mb-3">
                                        <label for="adults" class="form-label">Jumlah Dewasa</label>
                                        <input name="number_of_adult" value="1" type="number" class="form-control"
                                            id="adults">
                                        <x-input-error :messages="$errors->get('number_of_adult')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Contact</label>
                                        <input name="reservation_contact" value="" type="text" class="form-control"
                                            readonly id="reservation_contact">
                                    </div>

                            <!-- Check-out Time -->
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="checkoutTime" class="form-label">Check-out Date</label>
                                    <input  name="speedy_checkout_time" value="" type="text" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                </div>
                                {{-- <div class="mb-3 col-6">
                                    <label for="checkoutHour" class="form-label">Check-out Time</label>
                                    <input name="speedycheckout_hour" type="time" class="form-control" id="checkoutHour" readonly>
                                </div> --}}
                                    </div>

                                    <div class="mb-3">
                                        <label for="children" class="form-label">Jumlah Anak-anak</label>
                                        <input name="number_of_children" type="number" class="form-control" id="children"
                                            min="0" value="{{ old('number_of_children', 0) }}">
                                        <x-input-error :messages="$errors->get('number_of_children')" class="mt-2" />
                                    </div>

                                </div>
                                <h4>Lengkapi Data Tamu</h4>


                                <section id="form-detail">
                                    <div class="container-fluid mt-4 mb-5 ">
                                        <div class="card">
                                            <div class="card-body text-dark">
                                                <!-- Id -->
                                                <div class="row mt-3 ">
                                                    <label for="" class="col-sm-2 col-form-label">ID Number*</label>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <select name="id_type" class="form-control" id="id_type">
                                                                <option value="KTP"
                                                                    {{ 'KTP' === old('id_type') ? 'selected' : '' }}>KTP
                                                                </option>
                                                                <option value="SIM"
                                                                    {{ 'SIM' === old('id_type') ? 'selected' : '' }}>SIM
                                                                </option>
                                                            </select>
                                                            <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <input name="id_number" value="{{ old('id_number') }}"
                                                            type="text" class="form-control" id="id_number">
                                                        <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                                                    </div>
                                                </div>

                                                <!-- Nama -->
                                                <div class="mb-3 row">
                                                    <label for="name" class="col-sm-2 col-form-label ">Name*</label>
                                                    <div class="col-sm-8">
                                                        <input value="{{ old('name_guest') }}" type="text"
                                                            name="name_guest" class="form-control " id="name_guest">
                                                        <x-input-error :messages="$errors->get('name_guest')" class="mt-2" />
                                                    </div>

                                                </div>

                                                <!-- TTL -->
                                                <div class="row ">
                                                    <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal
                                                        Lahir</label>
                                                    <div class="col-sm-4">
                                                        <input name="place_of_birth" value="{{ old('place_of_birth') }}"
                                                            type="text" class="form-control clearable"
                                                            id="place_of_birth">
                                                        <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <input value="{{ old('date_of_birth') }}" name="date_of_birth"
                                                            type="text" class="form-control clearable"
                                                            id="date_of_birth" onfocus="(this.type='date');this.focus()"
                                                            onblur="(this.type='text');this.value=formatDate(this.value)">
                                                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="mt-3 row">
                                                    <label for="gender" class="col-sm-2 col-form-label">Jenis
                                                        Kelamin*</label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                value="Laki-laki" id="genderMale">
                                                            <label class="form-check-label" for="gender">
                                                                Laki-laki
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                value="Perempuan" id="genderFemale">
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
                                                                <option value="Islam"
                                                                    {{ 'Islam' === old('religion') ? 'selected' : '' }}>
                                                                    Islam</option>
                                                                <option value="Kristen"
                                                                    {{ 'Kristen' === old('religion') ? 'selected' : '' }}>
                                                                    Kristen</option>
                                                                <option value="Katolik"
                                                                    {{ 'Katolik' === old('religion') ? 'selected' : '' }}>
                                                                    Katolik</option>
                                                                <option value="Hindu"
                                                                    {{ 'Hindu' === old('religion') ? 'selected' : '' }}>
                                                                    Hindu</option>
                                                                <option value="Buddha"
                                                                    {{ 'Buddha' === old('religion') ? 'selected' : '' }}>
                                                                    Buddha</option>
                                                                <option value="Konghucu"
                                                                    {{ 'Konghucu' === old('religion') ? 'selected' : '' }}>
                                                                    Konghucu</option>
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
                                                            <input class="form-check-input" type="radio" name="title"
                                                                value="Mr" id="titleMr">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Mr
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 ">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                value="Mrs" id="titleMrs">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Mrs
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                value="Ms" id="titleMs">
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
                                                        <input name="country" type="text"
                                                            value="{{ old('country') }}" class="form-control clearable"
                                                            id="country">
                                                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                                    </div>

                                                </div>

                                                <!-- Provinsi -->
                                                <div class="mt-3 row">
                                                    <label for="province" class="col-sm-2 col-form-label">Provinsi</label>
                                                    <div class="col-sm-8">
                                                        <input name="province" type="text"
                                                            class="form-control clearable" value="{{ old('province') }}"
                                                            id="provinsi">
                                                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <!-- Kota -->
                                                <div class="mt-3 row">
                                                    <label for="name" class="col-sm-2 col-form-label">Kota</label>
                                                    <div class="col-sm-8">
                                                        <input name="city" type="text"
                                                            class="form-control clearable" id="city"
                                                            value="{{ old('city') }}">
                                                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <!-- Kode Pos -->
                                                <div class="row mt-3">
                                                    <label for="" class="col-sm-2 col-form-label">Kode Pos</label>
                                                    <div class="col-sm-8">
                                                        <input name="postal_code" type="text"
                                                            class="form-control clearable" id="frm_kodepos"
                                                            value="{{ old('postal_code') }}">
                                                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <!-- Email -->
                                                <div class="mt-3 row">
                                                    <label for="" class="col-sm-2 col-form-label">Email</label>

                                                    <div class="col-sm-8">
                                                        <input name="email_address" type="text"
                                                            class="form-control clearable" id="frm_email"
                                                            value="{{ old('email_address') }}">
                                                        <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <!-- No Telp -->
                                                <div class=" mt-3 row">
                                                    <label for="" class="col-sm-2 col-form-label">No Telp</label>
                                                    <div class="col-sm-8">
                                                        <input value="{{ old('telp_number') }}" name="telp_number"
                                                            type="text" class="form-control clearable" id="contact">
                                                        <x-input-error :messages="$errors->get('telp_number')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class=" mt-3 row">
                                                    <div class="d-flex align-items-center">
                                                        <label for="" class="col-form-label mr-3">Jenis
                                                            Deposit</label>
                                                        <div class="form-check mr-3">
                                                            <input checked class="form-check-input" type="radio"
                                                                name="jenis_deposit" id="jenis_deposit_cash"
                                                                value="Cash"
                                                                {{ 'Cash' === old('jenis_deposit') ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="jenis_deposit_cash">Cash</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_deposit" id="jenis_deposit_lain"
                                                                value="Lain-lain"
                                                                {{ 'Lain-lain' === old('jenis_deposit') ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="jenis_deposit_lain">Lain-lain</label>
                                                        </div>
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



                                            </div>
                                        </div>

                                    </div>
                                </section>
                                <h4>Lengkapi Pembayaran</h4>


                                <section id="form-detail">
                                    <div class="container-fluid mt-4 mb-5 ">
                                        <div class="card">
                                            <div class="card-body text-dark">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header bg-primary text-white">
                                                                Rekap Transaksi
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="29">Night(s)</td>
                                                                            <td width="2">:</td>
                                                                            <td width="49" align="right"><div id="night-count"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Room Rate</td>
                                                                            <td>:</td>
                                                                            <td align="right"><div id="room-rate-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Room</td>
                                                                            <td>:</td>
                                                                            <td align="right"><div id="total-payment-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Extrabed</td>
                                                                            <td>:</td>
                                                                            <td align="right"><div id="extrabed-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tax</td>
                                                                            <td>:</td>
                                                                            <td align="right"><div id="tax-payment-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Payment</td>
                                                                            <td>:</td>
                                                                            <td align="right" style="border-top:1px solid black ">
                                                                                <div id="paymment_value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Down Payment </td>
                                                                            <td>:</td>
                                                                            <td align="right"><div id="down-payment-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Deposit</td>
                                                                            <td>:</td>
                                                                            <td id="show_deposit_cash">
                                                                                <input type="text" name="deposit" id="deposit" id="deposit" class="form-control" placeholder="Input Deposit Min 50.000" style="text-align: right">
                                                                            </td>
                                                                            <td id="show_deposit_lain">
                                                                                <input type="text" name="deposit_lain" id="deposit_lain" id="deposit_lain" class="form-control" placeholder="Inputkan Deposit lain-lain Ex: KTP, SIM dan lain-lain" style="text-align: right">
                                                                            </td>
                                                                        </tr>
                                                                        <input type="text" name="remaining_payment" id="remaining_payment" >
                                                                        <tr>
                                                                            <td>Remaining Payment</td>
                                                                            <td>:</td>
                                                                            {{-- <input type="text" name="remaining_payment" id="remaining_payment" hidden style="text-align: right"> --}}
                                                                            <td align="right"><div id="remaining-payment-value"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Payment Method</td>
                                                                            <td>:</td>
                                                                            <td>
                                                                                <select name="payment_method" id="payment_method" class="form-control" required>
                                                                                    <option value="cash">Cash</option>
                                                                                    <option value="transfer">Transfer</option>
                                                                                    <option value="credit card">Credit Card</option>
                                                                                    <option value="EDC">EDC</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                            </div>
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
                                <div class="mt-4 mb-3 d-flex justify-content-start ">
                                    <div class="">
                                        <button type="submit" class="btn submit-btn mr-5">
                                            Check In
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Scripnya ada di view dashboard_layout.blade.php -->
                            <div class="alert alert-success mt-3" role="alert" id="successAlert"
                                style="display:none;">
                                "Nama" at Room "Nomor room" Checked in Succesfully
                            </div>

                            <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                                Failed To Sumbit
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection
@section('jsSection')
    @include('frontoffice.checkin.speedy_checkin_js')
@endsection
