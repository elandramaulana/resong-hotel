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

                <form action="{{ route('booking_room_number') }}" method="get">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input value="" name="booking_checkin_time" type="text" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                
                            </div>

                            
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input name="booking_checkout_time" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                               
                            </div>
                            
                        </div>

                        <div class="col-sm-12">
                        <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="booking_channel" class="form-control" id="channel">
                                    <option value="Traveloka">Traveloka</option>
                                    <option value="Phone-in">Phone-in</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Walk-in">Tiket.com</option>
                                    <option value="Walk-in">Syifa Travel</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 mb-3 d-flex justify-content-start ">
                            <div class="">
                                <button type="submit" class="btn submit-btn mr-5">
                                   <a href="{{route('booking_room_number')}}">Next</a>
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