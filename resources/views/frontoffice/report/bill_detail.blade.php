@extends('layouts.dashboard_layout')

@section('content')


<!-- Invoice Detail  -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-6">
                    <h2>#INV-0000121</h2>
                </div>

                <div class="col-sm-6 text-warning d-flex justify-content-end text-center">
                <button class="btn btn-print" data-route="{{ route('generate.invoice') }}">
                    Print
                </button>
                
                </div>

            </div>
           
            <div class="container-fluid">
                <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
            </div>


            <div class="container table-responsive">
                <table class="table" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product/Service</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $subTotal = 0;
                            $Total = 0;
                        @endphp
                        @foreach ($dataDetailCheckin as $det)
                            @php
                                $showprice = formatCurrency($det->item_price);
                                $ShowTotal = formatCurrency($det->item_price * $det->item_qty);
                                $subTotal += $det->item_price * $det->item_qty; 
                            @endphp --}}
                            <tr>
                                <td>Room Standard Single</td>
                                <td>1/hari</td>
                                <td>Rp245.000</td>
                                <td>Rp245.000</td>
                            </tr>
                        {{-- @endforeach
                        @php
                            $ShowTotal = formatCurrency($subTotal);
                        @endphp --}}
                    </tbody>
                </table>
            </div>
            

            <div class="container">
                    <form method="POST" action="">
                        @csrf   
                        <input type="text" hidden name="checkin_id" value="" >
                        <div class="row">
                                <!-- Deposit -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Deposit:</label>
                                    <div class="col-sm-8">
                                        {{-- @php
                                            $showDeposit = formatCurrency($detailCheckin->payment);
                                        @endphp --}}
                                        <input value="" type="text" class="form-control" id="inputName" readonly>
                                    </div>
                                </div>
                                <!-- Total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Total:</label>
                                    <div class="col-sm-8">
                                        <input value="" type="text" class="form-control" id="inputName" readonly>
                                    </div>
                                </div>
                                <!-- Discount -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">*Discount: (%)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputDiscount" name="inputDiscount" readonly>
                                    </div>
                                </div>
                                <!-- Grand total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Grand total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputGrandTotal" name="inputGrandTotal" readonly>
                                    </div>
                                </div>
                                <!-- Payment -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Payment:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="inputPayment" name="inputPayment" readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="checkout_method" id="checkout_method" class="form-control" readonly>
                                            <option value="CASH">CASH</option>
                                            <option value="Qris">Qris</option>
                                            <option value="Credit Card">Credit Card</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Change -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Change:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="changeValue"  readonly>
                                    </div>
                                </div>
                        </div>
                        
                        <!-- Scripnya ada di view dashboard_layout.blade.php -->
                            <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
                                "Nama" at Room "Nomor room" Checked Out Succesfully
                            </div>

                            <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                                Failed To Checkout
                            </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</section>






{{-- <!-- Modal for extend form -->
<div class="modal fade" id="extendData" tabindex="-1" aria-labelledby="extendData" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
             <div class="card-header py-3">
                <h3 class="font-weight-bolder">Extend</h3>
            </div>
                   
                    <div class="card-body">
                    <form action="{{ route('checkout.extend') }}" method="POST" id="extendForm">
                        <div class="row">
                        @csrf
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <input type="text" value="" hidden name="extend_checkin_id" id="extend_checkin_id">
                                <!-- Check-in Time -->
                                <div class="mb-3">
                                    <label for="checkinTime" class="form-label">Check-in Time</label>
                                    <input type="text" name="current_checkin" hidden value="">
                                    <input value="" readonly name="checkin_time_extend" type="date" class="form-control" id="checkinTime" onload="(this.type='text');this.value=formatDate(this.value)" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="extend_checkoutTime" class="form-label">Check-out Time</label>
                                    <input type="text" name="current_checkout" hidden value="">
                                    <input  value="" name="checkout_time_extend" type="date" class="form-control" id="extend_checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" >
                                </div>

                            </div>
                        </div>

                            <div class="mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn submit-btn">
                                    Submit
                                </button>
                            </div>
                        
                </form>
                    </div>
        </div>
      </div>
   
    </div>
  </div>
</div> --}}
@endsection
{{-- @section('jsSection')
  @include('frontoffice.checkout.detail_checkout_js')
@endsection --}}