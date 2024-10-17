@extends('layouts.dashboard_layout')
@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <h1 class="h3 mb-0 text-gray-800">Check-Out</h1> 
    </div>

    <div class="row" id="showWaitme">
        <div id="ajax_select_rooms" class="col-lg-12" >
        </div>
    </div>

</div>
</section>

@endsection
@section('jsSection')
  @include('frontoffice.checkout.checkout_js')
@endsection