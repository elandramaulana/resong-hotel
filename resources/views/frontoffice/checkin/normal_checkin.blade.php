@extends('layouts.dashboard_layout')

@section('content')
<style>
    #showWaitme{
        min-height: 150px;
    }
</style>
<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <h1 class="h3 mb-0 text-gray-800">Normal Check-in</h1> <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
    </div>

    <div class="row" id="showWaitme">
        <div id="ajax_select_rooms" class="col-lg-12" >
        </div>
    </div>

</div>
</section>

@endsection
@section('jsSection')
  @include('frontoffice.checkin.normal_checking_js')
@endsection