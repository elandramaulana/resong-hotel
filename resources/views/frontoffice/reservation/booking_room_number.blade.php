@extends('layouts.dashboard_layout')
@section('content')

<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Check-in Table -->
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning">Daftar Kamar Tersedia</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="" id="frm-filter">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tanggal Checkin</label>
                                        <input type="text" name="reservation_checkin" value="{{ $reservation_checkin }}" class="form-control" id="reservation_checkin">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tanggal Checkout</label>
                                        <input type="text" name="reservation_checkout" value="{{ $reservation_checkout }}" class="form-control" id="reservation_checkout">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Guest Qty</label>
                                        <input type="text" name="qty_guest" class="form-control" id="qty_guest" value="{{ $qty_guest }}">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableID" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Room No</th>
                                        <th>Room Name</th>
                                        <th>Room Type</th>
                                        <th>Room Price</th>
                                        <th>Capacity</th>
                                        <th>Have Extrabed</th>
                                        <th>Room Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($availableRoom as $room)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $room['room_no'] }}</td>
                                            <td>{{ $room['room_name'] }}</td>
                                            <td>{{ $room['room_type'] }}</td>
                                            <td>{{ $room['room_price'] }}</td>
                                            <td>{{ $room['room_capacity'] }}</td>
                                            <td>
                                                @if($room['have_extra_bed'] == 1)
                                                    <span class="text-success">Yes</span>
                                                @else
                                                    <span class="text-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($room['status'] == 'Available')
                                                    @php
                                                        $isDisabled = '';
                                                    @endphp
                                                    <span class="text-success">Available</span>
                                                @elseif ($room['status'] == 'Occupied')
                                                    @php
                                                        $isDisabled = 'disabled';
                                                    @endphp
                                                    <span class="text-danger">Occupied</span>
                                                @else
                                                @php
                                                        $isDisabled = 'disabled';
                                                    @endphp
                                                    <span class="text-warning">Booked</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('booking.payment', $room['id'])}}" class="btn btn-success btn-sm {{ $isDisabled }}" > Select</>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('jsSection')
  @include('frontoffice.reservation.reservations_rooms_js')
@endsection