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
                                    <th>Room Name</th>
                                    <th>Room No</th>
                                    <th>Bed Type</th>
                                    <th>Room Price</th>
                                    <th>Capacity</th>
                                    <th>Room Status</th>
                                    <th>Checkin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                @php
                                    $room_status = $room->room_status;
                                    if($room_status == 'OCCUPIED'){
                                        $status = 'btn-primary';
                                    }elseif($room_status == 'VACANT READY'){
                                        $status = 'btn-success';
                                    }elseif($room_status == 'BOOKED'){
                                        $status = 'btn-warning';
                                    }elseif($room_status == 'VACANT DIRTY'){
                                        $status = 'btn-danger';
                                    }
                                @endphp
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $room->room_name }}</td>
                                    <td>{{ $room->room_no }}</td>
                                    <td>{{ $room->bed_type }}</td>
                                    <td>{{ number_format($room->room_price, 2) }}</td>
                                    <td align="center">{{ $room->room_capacity }}</td>
                                    <td align="center"><a href="#" class=" btn-sm {{$status}}">{{$room->room_status}}</a></td>
                                    <td>
                                        @php
                                            if ($room->room_status == 'VACANT READY') {
                                            @endphp
                                                <a href="{{route('checkin.normal.form', $room->id)}}" class="btn-sm btn-primary" >Checkin</a>
                                            @php
                                            }
                                        @endphp

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
