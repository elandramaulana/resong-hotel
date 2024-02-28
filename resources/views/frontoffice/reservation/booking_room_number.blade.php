@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
    </div>


    <!-- Standard single bed -->
    <div class="card shadow mt-4">
    <div class="card-body">
        <div class="standard-single">
            <div class="container d-flex justify-content-center">
                <div style="background-color:#D9D9D9; border:solid; border-radius:10px;" class="col-sm-12 d-flex justify-content-center">
                    <h4 class="text-dark">STANDARD SINGLE (@RP.245.000)</h4>
                </div>
            </div>

            <div class="container justify-content-between">
                <div class="row mt-4">
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="{{route('booking_form')}}">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="{{route('booking_form')}}">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
       
                </div>
            </div>
         </div>
    </div>
</div>


<!-- Twin bed -->
<div class="card shadow mt-4">
    <div class="card-body">
        <div class="standard-single">
            <div class="container d-flex justify-content-center">
                <div style="background-color:#D9D9D9; border:solid; border-radius:10px;" class="col-sm-12 d-flex justify-content-center">
                    <h4 class="text-dark">STANDARD TWIN (@RP.245.000)</h4>
                </div>
            </div>

            <div class="container justify-content-between">
                <div class="row mt-4">
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-success mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>



<div class="card shadow mt-4">
    <div class="card-body">
        <div class="standard-single">
            <div class="container d-flex justify-content-center">
                <div style="background-color:#D9D9D9; border:solid; border-radius:10px;" class="col-sm-12 d-flex justify-content-center">
                    <h4 class="text-dark">PREMIUM (@RP.567.000)</h4>
                </div>
            </div>

            <div class="container justify-content-between">
            <div class="row mt-4">
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success mb-4">
                    <a href="">1</a>
                </button>
            </div>
       </div>
    </div>
        </div>
    </div>
</div>


</div>
</section>

@endsection