@extends('layouts.dashboard_layout')

@section('content')
    <section id="normal-checkin">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ route('update_reservation', $edit->id) }}" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-body text-dark">
                        <div class="row">
                            <h4>Data Tamu</h4>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reservation_name" class="form-label">Nama</label>
                                    <input placeholder="Masukan Nama" name="reservation_name" type="text"
                                        class="form-control" id="reservation_name"
                                        value="{{ $edit->reservation_name ?? '' }}">
                                    <x-input-error :messages="$errors->get('reservation_name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reservation_contact" class="form-label">Kontak</label>
                                    <input placeholder="Masukan Kontak" value="{{ $edit->reservation_contact ?? '' }}"
                                        name="reservation_contact" type="text" class="form-control"
                                        id="reservation_contact">
                                    <x-input-error :messages="$errors->get('reservation_contact')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reservation_email" class="form-label">Email</label>
                                    <input placeholder="Masukan email" value="{{ $edit->reservation_email ?? '' }}"
                                        name="reservation_email" type="text" class="form-control" id="reservation_email">
                                    <x-input-error :messages="$errors->get('reservation_email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="qty_guest" class="form-label">Jumlah Tamu</label>
                                    <input placeholder="Masukan Jumlah Tamu (Dapat dikosongkan)"
                                        value="{{ $edit->qty_guest ?? '' }}" name="qty_guest" type="number"
                                        class="form-control" id="qty_guest">
                                    <x-input-error :messages="$errors->get('qty_guest')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h4>Data Reservasi</h4>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="reservation_chanel" class="form-label">Check-in Channel</label>
                                        <select name="reservation_chanel" id="reservation_chanel" class="form-control">
                                            <option value="" hidden selected>Pilih Chanel</option>
                                            <option value="Walk-in"
                                                {{ $edit->reservation_chanel == 'Walk-in' ? 'selected' : '' }}>Walk-in
                                            </option>
                                            <option value="Traveloka"
                                                {{ $edit->reservation_chanel == 'Traveloka' ? 'selected' : '' }}>Traveloka
                                            </option>
                                            <option value="Phone"
                                                {{ $edit->reservation_chanel == 'Phone' ? 'selected' : '' }}>Phone</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('reservation_chanel')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="reservation_checkin" class="form-label">Check-in Time</label>
                                        <input name="reservation_checkin" value="{{ $edit->reservation_checkin ?? '' }}"
                                            type="text" class="form-control" id="reservation_checkin"
                                            onfocus="(this.type='date');this.focus()"
                                            onblur="(this.type='text');this.value=formatDate(this.value)">
                                        <x-input-error :messages="$errors->get('reservation_checkin')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Check-out Time -->
                                    <div class="mb-3">
                                        <label for="reservation_checkout" class="form-label">Check-out Time</label>
                                        <input name="reservation_checkout" type="date"
                                            value="{{ $edit->reservation_checkout ?? '' }}" class="form-control"
                                            id="reservation_checkout" onfocus="(this.type='date');this.focus()"
                                            onblur="(this.type='text');this.value=formatDate(this.value)">
                                        <x-input-error :messages="$errors->get('reservation_checkout')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="reservation_desc">Keterangan</label>
                                        <textarea name="reservation_desc" id="reservation_desc" class="form-control" placeholder="Masukan Keterangan / Catatan">{{ $edit->reservation_desc ?? '' }}</textarea>
                                        <x-input-error :messages="$errors->get('reservation_desc')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kamar --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h4>Pilih Kamar</h4>
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Room No</th>
                                        <th>Room Name</th>
                                        <th>Room Type</th>
                                        <th>Room Price</th>
                                        <th>Capacity</th>
                                        <th>Have Extrabed</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr @if ($room->id == $selectedRoomId) class = "table-success" @endif>
                                            {{-- Warna hijau --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $room->room_no }}</td>
                                            <td>{{ $room->room_name }}</td>
                                            <td>{{ $room->room_type }}</td>
                                            <td>Rp. {{ number_format($room->room_price, 0, ',', '.') }}</td>
                                            <td>{{ $room->room_capacity }}</td>
                                            <td>
                                                @if ($room->room_extrabed == 1)
                                                    <span class='badge badge-success'> <i class='fa fa-check'></i></span>
                                                @else
                                                    <span class='badge badge-danger'> <i class='fa fa-ban'></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <label class="custom-radio">
                                                    {{-- Radio Button dengan data-room-price --}}
                                                    <input type="radio" name="room_id" value="{{ $room->id }}"
                                                        data-room-price="{{ $room->room_price }}"
                                                        @if ($room->id == $selectedRoomId) checked @endif>
                                                    <i
                                                        class="fa fa-check-circle @if ($room->id == $selectedRoomId) text-success @else text-muted @endif"></i>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                {{-- Pembayaran --}}
                <div class="card card-body">
                    <div class="row">
                        <h4>Data Pembayaran</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reservation_payment_status">Status Pembayaran</label>
                                <select name="reservation_payment_status" id="reservation_payment_status"
                                    class="form-control">
                                    <option value="" selected hidden>Pilih Status Pembayaran</option>
                                    <option value="Lunas"
                                        {{ 'Lunas' === $edit->reservation_payment_status ? 'selected' : '' }}>Lunas
                                    </option>
                                    <option value="DP"
                                        {{ 'DP' === $edit->reservation_payment_status ? 'selected' : '' }}>DP</option>
                                </select>
                                <x-input-error :messages="$errors->get('reservation_payment_status')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reservation_payment_method">Metode Pembayaran</label>
                                <select name="reservation_payment_method" id="reservation_payment_method"
                                    class="form-control">
                                    <option value="" selected hidden>Pilih Metode Pembayaran</option>
                                    <option value="Cash"
                                        {{ 'Cash' === $edit->reservation_payment_method ? 'selected' : '' }}>Cash</option>
                                    <option value="Bank Transfer"
                                        {{ 'Bank Transfer' === $edit->reservation_payment_method ? 'selected' : '' }}>Bank
                                        Transfer</option>
                                    <option value="Qris"
                                        {{ 'Qris' === $edit->reservation_payment_method ? 'selected' : '' }}>Qris</option>
                                    <option value="eWallet"
                                        {{ 'eWallet' === $edit->reservation_payment_method ? 'selected' : '' }}>eWallet
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('reservation_payment_method')" class="mt-2" />
                            </div>
                        </div>
                        @php
                            // $total = $room_detail->room_price * $tamu_detail['qty_hari'];
                            // $showTotal = formatCurrency($total);
                        @endphp
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_bayar">Pembayaran</label>
                                <input type="text" readonly class="form-control" name="total_bayar" id="total_bayar"
                                    value="{{ number_format($edit->room->room_price, 0, ',', '.') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reservation_payment">Pembayaran</label>
                                <input type="text" readonly
                                    value="{{ number_format($edit->reservation_payment, 0, ',', '.') }}"
                                    class="form-control" name="reservation_payment" id="reservation_payment">
                                <x-input-error :messages="$errors->get('reservation_payment')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-3 d-flex justify-content-start ">
                    <div class="">
                        <button type="submit" class="btn submit-btn mr-5">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan semua radio buttons dengan name 'room_id'
            const roomRadios = document.querySelectorAll('input[name="room_id"]');
            const totalBayarInput = document.getElementById('total_bayar');
            const reservationPaymentInput = document.getElementById('reservation_payment');
            const paymentStatusSelect = document.getElementById('reservation_payment_status');

            let selectedRoomPrice = 0;

            // Fungsi untuk mengupdate pembayaran berdasarkan status pembayaran
            function updatePayment() {
                let total = selectedRoomPrice;
                let paymentStatus = paymentStatusSelect.value;

                if (paymentStatus === 'DP') {
                    total *= 0.5; // Jika DP, totalnya 50%
                }

                // Update field pembayaran dengan format ribuan
                reservationPaymentInput.value = new Intl.NumberFormat('id-ID').format(total);
            }

            // Event listener untuk setiap radio button
            roomRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        // Ambil harga dari data attribute 'data-room-price'
                        selectedRoomPrice = parseFloat(this.getAttribute('data-room-price'));

                        // Update total bayar dengan format ribuan
                        totalBayarInput.value = new Intl.NumberFormat('id-ID').format(
                            selectedRoomPrice);

                        // Panggil fungsi untuk update pembayaran berdasarkan status pembayaran
                        updatePayment();
                    }
                });
            });

            // Event listener untuk perubahan pada status pembayaran
            paymentStatusSelect.addEventListener('change', function() {
                updatePayment();
            });
        });
    </script>
@endsection
