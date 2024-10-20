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
                        <h6 class="font-weight-bold text-warning">Bill Report</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cleaningHistoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Invoice</th>
                                        <th>Guest Name</th>
                                        <th>Room</th>
                                        <th>Check-in-Time</th>
                                        <th>Check-out-Time</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php
                                    $counter_history = 1;
                                @endphp --}}
                               
                                    <tr>
                                        <td>1</td>
                                        <td>#0001213</td>
                                        <td>Joni Alfiansyah</td>
                                        <td>12</td>
                                        <td>15/02/2024</td>
                                        <td>16/02/2024</td>
                                        <td>Rp567.000</td>
                                        <td>
                                            <div>
                                                <button class="btn btn-warning rounded " type="button">
                                                    <a style="text-decoration: none;color:black;" href="{{route('bill.detail')}}">Detail</a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                {{-- @php
                                    $counter_history++;
                                @endphp --}}
                              
                              
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
