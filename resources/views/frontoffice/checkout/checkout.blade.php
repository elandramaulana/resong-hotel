@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <h1 class="h3 mb-0 text-gray-800">Check-Out</h1> 
    </div>


    <!-- Standard single bed -->
    <div class="card shadow mt-4">
    <div class="card-body">
        <div class="standard-single">
            <div class="container d-flex justify-content-center">
                <div style="background-color:#D9D9D9; border:solid; border-radius:10px;" class="col-sm-12 d-flex justify-content-center">
                    <h4 class="text-dark">STANDARD SINGLE</h4>
                </div>
            </div>

            <div class="container justify-content-between">
                <div class="row mt-4">
                <div class="col-sm-2">
                        <button class="btn btn-checkout mb-4">
                            <a href="{{route('checkout_detail')}}">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-checkout mb-4">
                            <a href="{{route('checkout_detail')}}">1</a>
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
                    <h4 class="text-dark">STANDARD TWIN</h4>
                </div>
            </div>

            <div class="container justify-content-between">
                <div class="row mt-4">
                <div class="col-sm-2">
                        <button class="btn btn-checkout mb-4">
                            <a href="">1</a>
                        </button>
                    </div>
                <div class="col-sm-2">
                        <button class="btn btn-checkout mb-4">
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
                    <h4 class="text-dark">PREMIUM</h4>
                </div>
            </div>

            <div class="container justify-content-between">
            <div class="row mt-4">
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
                    <a href="">1</a>
                </button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-checkout mb-4">
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