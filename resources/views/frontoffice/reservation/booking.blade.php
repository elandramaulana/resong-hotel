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

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
                <form action="{{ route('booking.pick_room') }}" method="post">
                    @csrf
                    <div class="row">
                        <h4>Data Tamu</h4>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reservation_name" class="form-label">Nama</label>
                                <input  placeholder="Masukan Nama" value="{{ old('reservation_name') }}" name="reservation_name" type="text" class="form-control" id="reservation_name">
                                <x-input-error :messages="$errors->get('reservation_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reservation_contact" class="form-label">Kontak</label>
                                <input  placeholder="Masukan Kontak" value="{{ old('reservation_contact') }}" name="reservation_contact" type="text" class="form-control" id="reservation_contact">
                                <x-input-error :messages="$errors->get('reservation_contact')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reservation_email" class="form-label">Email</label>
                                <input placeholder="Masukan email" value="{{ old('reservation_email') }}" name="reservation_email" type="text" class="form-control" id="reservation_email">
                                <x-input-error :messages="$errors->get('reservation_email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="qty_guest" class="form-label">Jumlah Tamu</label>
                                <input  placeholder="Masukan Jumlah Tamu (Dapat dikosongkan)" value="{{ old('qty_guest') }}" name="qty_guest" type="number" class="form-control" id="qty_guest">
                                <x-input-error :messages="$errors->get('qty_guest')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <h4>Data Reservasi</h4>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="reservation_chanel" class="form-label">Check-in Channel</label>
                                        <select name="reservation_chanel" id="reservation_chanel" class="form-control">
                                            <option value=""            >Pilih Chanel</option>
                                            <option value="Walk-in"   {{ old('reservation_chanel') == 'Walk-in' ? 'selected' : '' }}  >Walk-in</option>
                                            <option value="Traveloka" {{ old('reservation_chanel') == 'Traveloka' ? 'selected' : '' }}  >Traveloka</option>
                                            <option value="Phone"     {{ old('reservation_chanel') == 'Phone' ? 'selected' : '' }}  >Phone</option>
                                        </select>
                                    <x-input-error :messages="$errors->get('reservation_chanel')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reservation_checkin" class="form-label">Check-in Time</label>
                                    <input value="" name="reservation_checkin" value="{{ old('reservation_checkin') }}" type="text" class="form-control" id="reservation_checkin" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                    <x-input-error :messages="$errors->get('reservation_checkin')" class="mt-2" />
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="reservation_checkout" class="form-label">Check-out Time</label>
                                    <input name="reservation_checkout" type="date" value="{{ old('reservation_checkout') }}" class="form-control" id="reservation_checkout" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                    <x-input-error :messages="$errors->get('reservation_checkout')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reservation_desc">Keterangan</label>
                                    <textarea name="reservation_desc" id="reservation_desc" class="form-control" placeholder="Masukan Keterangan / Catatan"></textarea>
                                    <x-input-error :messages="$errors->get('reservation_desc')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-3 d-flex justify-content-start ">
                            <div class="">
                                <button type="submit" class="btn submit-btn mr-5">
                                   Next
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