@extends('layouts.dashboard_layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Check-in Table -->
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning">Cancel Reservation List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cancelReservationListTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Guest Name</th>
                                        <th>Room</th>
                                        <th>Check-in Time</th>
                                        <th>Check-out Time</th>
                                        <th>Channel</th>
                                        <th>Down Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no =1;
                                    @endphp
                                    @foreach ($data as $dt)
                                        @php
                                            $showCheckinDate = tgl_indo($dt->reservation_checkin);
                                            $showCheckoutDate = tgl_indo($dt->reservation_checkout);
                                            $showDP = formatCurrency($dt->reservation_payment);
                                        @endphp
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dt->reservation_name }}</td>
                                            <td>{{ $dt->room_no }}</td>
                                            <td>{{ $showCheckinDate }}</td>
                                            <td>{{ $showCheckoutDate }}</td>
                                            <td>{{ $dt->reservation_chanel }}</td>
                                            <td>{{ $showDP }}</td>
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
