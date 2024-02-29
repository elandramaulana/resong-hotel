@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Check-Out</h1>
    </div>
   

    <!-- Checkout Detail -->

    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Room Number: 12</h2>
                </div>
                <div class="col-sm-4 text-warning text-center">
                    <h6 class="shape rounded p-2">STANDARD SINGLE (@RP245.000)</h6>
                </div>

                <div class="col-sm-4 text-warning d-flex justify-content-end text-center">
                    <button class="btn btn-extend"  data-bs-toggle="modal" data-bs-target="#extendData">
                        <i class="fas fa-plus"></i> Extend
                    </button>
                </div>

            </div>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="invoice" class="form-label">#Invoice</label>
                        <input value="INV-0000121" name="invoice" type="text" class="form-control" id="invoice" disabled>
                    </div>
                    
                    <div class="row">

                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input value="Joni Alviansyah" name="" type="text" class="form-control" id="invoice" disabled>
                            </div>
 
                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input value="14/02/2024" name="checkin_time" type="date" class="form-control" id="checkinTime" disabled>
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input value="2" name="" type="number" class="form-control" id="adults" disabled>
                            </div>
                        </div>

                        

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="channel" class="form-control" id="channel" disabled>
                                    <option value="Traveloka">Traveloka</option>
                                    <option value="Phone-in">Phone-in</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Tiket.com">Tiket.com</option>
                                    <option value="Syifa Travel">Syifa Travel</option>
                                </select>
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input value="15/02/2024"  type="date" class="form-control" id="checkoutTime" disabled>
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input name="" value="3" type="number" class="form-control" id="children" disabled>
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
                        <tr>
                            <td>Room Standard Single</td>
                            <td>1/hari</td>
                            <td>Rp245.000</td>
                            <td>Rp245.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            

            <div class="container">
                    <form method="POST">
                        <div class="row">
                                <!-- Deposit -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Deposit:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Discount -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Discount:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName">
                                    </div>
                                </div>
                                <!-- Grand total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Grand total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Payment -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Payment:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName">
                                    </div>
                                </div>
                                <!-- Change -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Change:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                        </div>
                        <!-- Button -->
                        <div class="mt-5 mb-3 d-flex justify-content-start">
                            <div class="mr-3">
                                <button type="submit" class="btn submit-btn">
                                    Check Out
                                </button>
                            </div>
                            <div>
                                <button class="btn cancel-btn">
                                    Cancel
                                </button>
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
                    <form action="" method="POST">
                    
                    
                        <div class="row">

                            <!-- Left Column -->
                            <div class="col-md-6">
                                
                                <!-- Check-in Time -->
                                <div class="mb-3">
                                    <label for="checkinTime" class="form-label">Check-in Time</label>
                                    <input value="14/02/2024" name="checkin_time_extend" type="date" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="checkoutTime" class="form-label">Check-out Time</label>
                                    <input name="checkout_time_extend" value="15/02/2024" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" >
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