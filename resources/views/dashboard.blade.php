@extends('layouts.dashboard_layout')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
    @endif
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(\Session::has('checkin_id'))
    <script>window.location = {{ route('generate.invoice', \Session::get('checkin_id')) }};</script>
@endif
<section>
    <!-- Content Row -->
<div class="row">
    <!-- Large Wrapper Card -->
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Overview</h1>
                </div>
                <div class="row">
                    <!-- Available Rooms Content -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            
                                            {{$vacantRoomCount}}
                                        </div>
                                        <div class="h5 font-weight-bold text-white">Available Rooms</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-door-open fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Used Rooms Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                                {{$occupiedRoomCount}}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-white">Used Rooms</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-door-closed fa-5x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reserved Rooms Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                                
                                                {{$bookedRoomCount}}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-white">Reserved Rooms</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-desktop fa-5x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Cleaning Rooms Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            
                                            {{$vacantDirtyRoomCount}}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-white">Cleaning Rooms</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-broom fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            
                                            {{$vacantRoomCount}}
                                        </div>
                                        <div class="h5 font-weight-bold text-white">Jumlah Karyawan</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-5x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card bg-card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h1 font-weight-bold text-white text-uppercase mb-1">
                                            
                                            {{$vacantRoomCount}}
                                        </div>
                                        <div class="h5 font-weight-bold text-white">Absen Hari ini</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check fa-5x text-white"></i>
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

<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Check-in Table -->
            <div class="col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="checkInTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Rooms</th>
                                        <th>Check-in Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todayCheckin as $guest)
                                    <tr>
                                        <td>{{$guest->customer_name}}</td>
                                        <td>Room {{$guest->room_no }}</td>
                                        <td>{{$guest->checkin_time}}</td>
                                    </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check-out Table -->
            <div class="col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning">Customer Check-out</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="checkOutTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Rooms</th>
                                        <th>Check-out Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todayCheckout as $data)
                                    <tr>
                                        <td>{{$data->guest_name }}</td>
                                        <td>Room {{$data->room_no }}</td>
                                        <td>{{$data->checkout_date}}</td>
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







</div>
<!-- /.container-fluid -->

@endsection
