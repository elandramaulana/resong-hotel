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
                        <h6 class="font-weight-bold text-warning">Cleaning Room</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="houseKeepingTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Room</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $counter_list = 1;
                                @endphp
                                    @foreach($listRoom as $listroom)
                                    <tr>
                                        <td>{{ $counter_list }}</td>
                                        <td>{{ $listroom->room_no }}</td>
                                        <td>{{ $listroom->room_type }}</td>
                                        <td class="text-center">
                                            @if($listroom->room_status == 'VACANT DIRTY')
                                                <p style="color:#fff" class="bg-danger rounded">Waiting</p>
                                            @endif
                                        </td>
                                        <td>
                                        <div>
                                            <button class="btn btn-warning rounded " type="button">
                                                <a style="text-decoration: none;color:black;" href="{{route('cleaningroom.details', ['id' => $listroom->id])}}">Edit</a>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $counter_list++;
                                    @endphp
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

<section class="mt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Check-in Table -->
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning">Cleaning History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cleaningHistoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Room</th>
                                        <th>Tipe</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $counter_history = 1;
                                @endphp
                                @foreach($history as $history)
                                    <tr>
                                        <td>{{ $counter_history }}</td>
                                        <td>{{ $history->room_no }}</td>
                                        <td>{{ $history->room_type }}</td>
                                        <td>{{ $history->tanggal_cleaning }}</td>
                                        <td>{{ $history->jam_cleaning }}</td>
                                        <td>{{ $history->pic_cleaning }}</td>
                                    </tr>
                                @php
                                    $counter_history++;
                                @endphp
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
