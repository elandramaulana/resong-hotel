@extends('layouts.dashboard_layout')

@section('content')

<section id="">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Reservation</h1>
    </div>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('booking.store') }}" method="post">
    @csrf
<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
              
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Data Tamu</h4>
                            <div class="col-lg-12">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <td style="width: 30%">Nama</td>
                                            <td style="width: 2%">:</td>
                                            <td style="width: 70%">{{ $tamu_detail['reservation_name'] }} <input hidden type="text" name="reservation_name" value="{{ $tamu_detail['reservation_name'] }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Kontak</td>
                                            <td>:</td>
                                            <td>{{ $tamu_detail['reservation_contact'] }} <input hidden type="text" name="reservation_contact" value="{{ $tamu_detail['reservation_contact'] }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{ $tamu_detail['reservation_email'] }} <input type="text" hidden name="reservation_email" value="{{ $tamu_detail['reservation_email'] }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Tamu</td>
                                            <td>:</td>
                                            <td>{{ $tamu_detail['qty_guest'] }}<input type="text" hidden name="qty_guest" value="{{ $tamu_detail['qty_guest'] }}"></td>
                                            <input type="text" name="reservation_desc" value="{{ $tamu_detail['reservation_desc'] }}" hidden>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4>Data Kamar & Reservasi</h4>
                            <div class="col-lg-12">
                                <table class="table">
                                    @php
                                        $showHarga = formatCurrency($room_detail->room_price);
                                        $showTglCheckin = tgl_indo($tamu_detail['reservation_checkin']);
                                        $showTglCheckout = tgl_indo($tamu_detail['reservation_checkout']);
                                    @endphp
                                    <input type="text" name="reservation_chanel" id="reservation_chanel" hidden value="{{ $tamu_detail['reservation_chanel'] }}">
                                    <thead>
                                        <tr>
                                            <td style="width: 30%">Nama Kamar</td>
                                            <td style="width: 2%">:</td>
                                            <td style="width: 70%">{{ $room_detail->room_name }} <input hidden type="text" name="room_id" value="{{ $room_detail->id }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Type Kamar</td>
                                            <td>:</td>
                                            <td>{{ $room_detail->room_type }}<input type="text" hidden name="room_name" value="{{ $room_detail->room_type }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Kamar</td>
                                            <td>:</td>
                                            <td>{{ $showHarga }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Checkin / Checkout</td>
                                            <td>:</td>
                                            <td>{{ $showTglCheckin }} / {{ $showTglCheckout }} <input hidden type="text" name="reservation_checkin" value="{{ $tamu_detail['reservation_checkin'] }}"> <input hidden type="text" name="reservation_checkout" value="{{ $tamu_detail['reservation_checkout'] }}"> <a class="badge badge-success">({{ $tamu_detail['qty_hari'] }} Hari)</a></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
              
            </div>
        </div>
</div>
</div>
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body text-dark">
            <div class="row">
                <div class="row">
                    <h4>Data Pembayaran</h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reservation_payment_status">Status Pembayaran</label>
                            <select name="reservation_payment_status"  id="reservation_payment_status" class="form-control">
                                <option value="">Pilih Status Pembayaran</option>
                                <option value="Lunas" {{ "Lunas" === old('reservation_payment_status') ? 'selected' : '' }}>Lunas</option>
                                <option value="DP" {{ "DP" === old('reservation_payment_status') ? 'selected' : '' }}>DP</option>
                            </select>
                            <x-input-error :messages="$errors->get('reservation_payment_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reservation_payment_method">Metode Pembayaran</label>
                            <select name="reservation_payment_method"  id="reservation_payment_method" class="form-control">
                                <option value="" >Pilih Metode Pembayaran</option>
                                <option value="Cash" {{ "Cash" === old('reservation_payment_method') ? 'selected' : '' }}>Cash</option>
                                <option value="Bank Transfer"  {{ "Bank Transfer" === old('reservation_payment_method') ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="Qris" {{ "Qris" === old('reservation_payment_method') ? 'selected' : '' }}>Qris</option>
                                <option value="eWallet" {{ "eWallet" === old('reservation_payment_method') ? 'selected' : '' }}>eWallet</option>
                            </select>
                            <x-input-error :messages="$errors->get('reservation_payment_method')" class="mt-2" />
                        </div>
                    </div>
                    @php
                        $total = $room_detail->room_price * $tamu_detail['qty_hari'];
                        $showTotal = formatCurrency($total);
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_bayar">Pembayaran</label>
                            <input type="text" readonly class="form-control" name="total_bayar" id="total_bayar" value="{{ $showTotal }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reservation_payment">Pembayaran</label>
                            <input type="text" readonly value="{{ old('reservation_payment') }}" class="form-control" name="reservation_payment" id="reservation_payment" >
                            <x-input-error :messages="$errors->get('reservation_payment')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
                
<small>Dp Minimal 50%</small>
            </div>
        </div>
    </div>
</div>
</form>
</section>


@endsection
@section('jsSection')
  @include('frontoffice.reservation.booking_payment_js')
@endsection