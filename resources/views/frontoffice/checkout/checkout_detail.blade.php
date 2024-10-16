@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Check-Out</h1>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <h4>Error Message</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Checkout Detail -->
    
    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Room Number: {{ $detailCheckin->room_no }}</h2>
                </div>
                <div class="col-sm-4 text-warning text-center">
                    <h6 class="shape rounded p-2">{{ $detailCheckin->room_type }} (@RP {{ $detailCheckin->room_price }})</h6>
                </div>
                <div class="col-sm-4 text-warning d-flex justify-content-end text-center">
                    <button class="btn btn-extend"  data-bs-toggle="modal" data-bs-target="#extendData">
                        <i class="fas fa-plus"></i> Extend
                    </button>
                </div>
            </div>
                <form action="{{ route("checkout.edit.outdate") }}" method="POST" id="formDetailCheckin">
                    @csrf
                    <input type="text" hidden name="checkin_id" value="{{ $detailCheckin->checkin_id }}" >
                    <div class="mb-3">
                        <label for="invoice" class="form-label">#Invoice</label>
                        <input value="{{ $detailCheckin->no_invoice }}" name="invoice" type="text" class="form-control" id="invoice" disabled>
                    </div>

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input value="{{ $detailCheckin->name_guest }}" name="nama" type="text" class="form-control" id="invoice" disabled>
                            </div>
 
                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input value="{{ $detailCheckin->date_checkin }}" name="checkin_time" type="date" class="form-control" id="checkinTime" disabled>
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input value="{{ $detailCheckin->guest_adult }}" name="jumlah_dewasa" type="number" class="form-control" id="adults" disabled>
                            </div>
                        </div>

                        

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <input disabled type="text" class="form-control" value="{{ $detailCheckin->chanel_checkin }}">
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                @php
                                    if ($detailCheckin->date_checkout > date("Y-m-d") ){
                                        $disabled = ""; 
                                    }else{
                                        $disabled = "disabled";
                                    }
                                @endphp
                                
                                <input value="{{ $detailCheckin->date_checkout }}"  type="date" class="form-control" name="checkoutTime" id="checkoutTime" {{ $disabled }}>
                                <x-input-error :messages="$errors->get('checkoutTime')" class="mt-2"/>
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input name="number_child" value="3" type="number" class="form-control" id="children" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Invoice Detail  -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Invoice Details</h2>
                </div>

                <div class="col-sm-6 text-warning d-flex justify-content-end text-center">
                    {{-- <button class="btn btn-print" onclick="window.location='{{ route('generate.invoice', $detailCheckin->checkin_id) }}'">
                        Print PDF
                    </button> --}}
                    
                
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
                        @php
                            $subTotal = 0;
                            $Total = 0;
                        @endphp
                        @foreach ($dataDetailCheckin as $det)
                            @php
                                $showprice = formatCurrency($det->item_price);
                                $ShowTotal = formatCurrency($det->item_price * $det->item_qty);
                                $subTotal += $det->item_price * $det->item_qty; 
                            @endphp
                            <tr>
                                <td>{{ $det->item_name }}</td>
                                <td>{{ $det->item_qty }}</td>
                                <td>{{ $showprice }}</td>
                                <td>{{ $ShowTotal }}</td>
                            </tr>
                        @endforeach
                        @php
                            $ShowTotal = formatCurrency($subTotal);
                        @endphp
                    </tbody>
                </table>
            </div>
            

            <div class="container">
                    <form method="POST" action="{{ route("checkout.action") }}">
                        @csrf   
                        <input type="text" hidden name="checkin_id" value="{{ $detailCheckin->checkin_id }}" >
                        <div class="row">
                                <!-- Deposit -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Deposit:</label>
                                    <div class="col-sm-8">
                                        @php
                                            $showDeposit = formatCurrency($detailCheckin->payment);
                                        @endphp
                                        <input name="deposit" value="{{ $showDeposit }}" type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Total:</label>
                                    <div class="col-sm-8">
                                        <input name="total" value="{{ $ShowTotal }}" type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Discount -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">*Discount: (%)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputDiscount" name="inputDiscount">
                                    </div>
                                </div>
                                <!-- Grand total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Grand total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputGrandTotal" name="inputGrandTotal" disabled>
                                    </div>
                                </div>
                                <!-- Payment -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Payment:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="inputPayment" name="inputPayment">
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="checkout_method" id="checkout_method" class="form-control">
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
                                        <input type="text" name="changeValue" class="form-control" id="changeValue"  disabled>
                                    </div>
                                </div>
                        </div>
                        <!-- Button -->
                        <div class="mt-5 mb-3 d-flex justify-content-start">
                            <div class="mr-3">
                                {{-- <button type="submit"  class="btn ">
                                    Check Out
                                </button> --}}

                                <button type="submit" class="btn submit-btn" id="checkoutButton" disabled>
                                    Checkout
                                 </button><script type="text/javascript">
    $(function () {
        // Initialize variables
        var deposit = {{ $detailCheckin->payment }};
        var total = {{ $subTotal }};
        var grandTotal = {{ $subTotal }};
        
        // Set initial grand total value
        $("#inputGrandTotal").val(formatCurrency(grandTotal));

        // Handle discount keyup event
        $("#inputDiscount").on('keyup change', function () {
            var discount = $(this).val();

            // Cap discount to 50% maximum
            if (discount > 50) {
                discount = $(this).val(50);
            }

            // Calculate grand total after discount
            var discountAmount = (total * discount) / 100;
            grandTotal = total - discountAmount;
            $("#inputGrandTotal").val(formatCurrency(grandTotal));

            // Recheck if checkout button should be enabled
            validateCheckoutButton();
        });

        // Handle payment keyup event
        $("#inputPayment").on("keyup", function () {
            let paymentInput = $(this).val();
            let formattedPayment = formatNumber(paymentInput);
            $(this).val(formattedPayment);

            let payment = reverseFormatNumber(formattedPayment);
            let change = payment - grandTotal;
            $("#changeValue").val(formatCurrency(change));

            // Check if the checkout button should be enabled
            validateCheckoutButton();
        });

        // Function to enable/disable the checkout button
        function validateCheckoutButton() {
            let payment = reverseFormatNumber($("#inputPayment").val());
            let change = payment - grandTotal;

            // Enable button if payment is sufficient, otherwise disable
            if (payment >= grandTotal && change >= 0) {
                $("#checkoutButton").removeAttr('disabled');
            } else {
                $("#checkoutButton").attr('disabled', 'disabled');
            }
        }
        
        // Format number for currency display
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
        }

        function formatNumber(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        }

        function reverseFormatNumber(value) {
            return parseFloat(value.replace(/[^0-9\.-]+/g,""));
        }
    });
</script>

                            </div>
                            {{-- <div>
                                <button class="btn cancel-btn">
                                    Cancel
                                </button>
                            </div> --}}
                        </div>
                        <!-- Scripnya ada di view dashboard_layout.blade.php -->
                            <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
                                "Nama" at Room "Nomor room" Checked Out Succesfully
                            </div>

                            <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                                Failed To Checkout
                            </div>
                    </form>
                    <small>* : Discount Maksimal 50%</small>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Cetak Invoice</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Ingin Cetak Invoice?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Cetak</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal for extend form -->
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
                                <input type="text" value="{{ $detailCheckin->checkin_id }}" hidden name="extend_checkin_id" id="extend_checkin_id">
                                <!-- Check-in Time -->
                                <div class="mb-3">
                                    <label for="checkinTime" class="form-label">Check-in Time</label>
                                    <input type="text" name="current_checkin" hidden value="{{ $detailCheckin->date_checkin }}">
                                    <input value="{{ $detailCheckin->date_checkin }}" readonly name="checkin_time_extend" type="date" class="form-control" id="checkinTime" onload="(this.type='text');this.value=formatDate(this.value)" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="extend_checkoutTime" class="form-label">Check-out Time</label>
                                    <input type="text" name="current_checkout" hidden value="{{ $detailCheckin->date_checkout }}">
                                    <input  value="{{ $detailCheckin->date_checkout }}" name="checkout_time_extend" type="date" class="form-control" id="extend_checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" >
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
</div>
@endsection
@section('jsSection')
  @include('frontoffice.checkout.detail_checkout_js')
@endsection