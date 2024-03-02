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

<<<<<<< HEAD
=======
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

>>>>>>> 66b13c4c2adf2e602b5f3f6c6c4432d3ebefe2fd
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