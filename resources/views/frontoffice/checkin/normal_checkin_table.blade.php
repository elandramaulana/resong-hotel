@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <h1 class="h3 mb-0 text-gray-800">Normal Check-in</h1> <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
    </div>

    <!-- Legend Color -->
    <div class="col-sm-12">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-3">
                    <h6>Terisi</h6>
                    <button class="btn-primary btn"></button>
                </div>
                <div class="col-sm-3">
                    <h6>Ready</h6>
                    <button class="btn-success btn"></button>
                </div>
                <div class="col-sm-3">
                    <h6>Booked</h6>
                    <button class="btn-warning btn"></button>
                </div>
                <div class="col-sm-3">
                    <h6>Kotor</h6>
                    <button class="btn-danger btn"></button>
                </div>
            </div>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold fs-5">Select Room to Check-in</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
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
                                    <th>Checkin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
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
                                            <span class="text-primary">Occupied</span>

                                        @elseif ($room['status'] == 'Vacant Dirty')
                                            @php
                                                $isDisabled = 'disabled';
                                            @endphp
                                            <span class="text-danger">Vacant Dirty</span>
                                        @else
                                        @php
                                                $isDisabled = 'disabled';
                                            @endphp
                                            <span class="text-warning">Booked</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('checkin.normal.form', $room['id'])}}" class="btn btn-success btn-sm {{ $isDisabled }}" > Select</>
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
  @include('frontoffice.checkin.normal_checking_js')
@endsection
