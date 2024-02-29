@extends('layouts.dashboard_layout')

@section('content')

<section id="speedy-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Speedy Check-in</h1>
    </div>
</div>

<div class="form-speedy">
<div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">

                <form action="" method="POST">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">

                         <div class="mb-3 row">
                                <div class="col-sm-10">
                                    <label for="bookingNumber" class="form-label">Booking Number</label>
                                    <input value="" name="booking_number" type="text" class="form-control" id="booking_number">
                                </div>

                                <div class="col-sm-2 mt-2">
                                    <button  type="button" class="btn btn-warning mt-lg-4" data-bs-toggle="modal" data-bs-target="#modalBooking">
                                        <i style="color: black;" class="fas fa-database"></i>
                                    </button>
                                </div>
                        </div>

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input name="speedy_checkin_time" value="" type="date" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                            </div>

                            
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input name="nama" value="" type="text" class="form-control" id="nama" >
                            </div>


                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input name="speedy_checkout_time" value="" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)">
                            </div>
                            
                        </div>

                        <div class="mt-4 mb-3 d-flex justify-content-start ">
                            <div class="">
                                <button type="submit" class="btn submit-btn mr-5">
                                    Check In
                                </button>
                            </div>
                        </div>

                    </div>

                   <!-- Scripnya ada di view dashboard_layout.blade.php -->
                    <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
                        "Nama" at Room "Nomor room" Checked in Succesfully
                    </div>

                    <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
                        Failed To Sumbit
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</section>


<!-- Modal for speedy data -->
<div class="modal fade" id="modalBooking" tabindex="-1" aria-labelledby="modalBooking" aria-hidden="true">
  <div class="modal-dialog  modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Booking Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="speedyCheckInTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Booking Number</th>
                                        <th>Nama</th>
                                        <th>Check-in Time</th>
                                        <th>Check-Out Time</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TR784234</td>
                                        <td>Elandra Maulana</td>
                                        <td>12/2/2024</td>
                                        <td>15/2/2024</td>
                                        <td>
                                            <button class="btn btn-warning rounded select-booking-button"
                                                    data-booking-number="TR784234"
                                                    data-nama="Elandra Maulana">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TR7908901</td>
                                        <td>Garrett Winter</td>
                                        <td>7/2/2024</td>
                                        <td>10/2/2024</td>
                                        <td>
                                        <button class="btn btn-warning rounded select-booking-button"
                                                data-booking-number="TR7908901"
                                                data-nama="Garrett Winter">
                                            select
                                        </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


<!-- scrip to input field from data in database -->

<script>
    // This function will be triggered when the "select" button is clicked
    function selectBooking(bookingNumber, nama) {
        // Set the value of the input with the selected booking number
        document.getElementById('booking_number').value = bookingNumber;

        // Close the modal
        $('#modalBooking').modal('hide');
    }

    // Optional: If you want to attach the function to each "select" button dynamically
    document.addEventListener('DOMContentLoaded', function() {
        var selectButtons = document.querySelectorAll('.select-booking-button');

        selectButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var bookingNumber = this.dataset.bookingNumber;
                var nama = this.dataset.nama;
                selectBooking(bookingNumber, nama);
            });
        });
    });
</script>
      </div>
   
    </div>
  </div>
</div>


@endsection