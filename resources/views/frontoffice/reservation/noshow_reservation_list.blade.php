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
                        <h6 class="font-weight-bold text-warning">No Show Reservation List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="reservationListTable" width="100%" cellspacing="0">
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
                                    <tr>
                                        <td>1</td>
                                        <td>Elandra Maulana</td>
                                        <td>106</td>
                                        <td>2024-02-04</td>
                                        <td>2024-02-07</td>
                                        <td>Traveloka</td>
                                        <td>Rp567.000</td>
                                    </tr>
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
