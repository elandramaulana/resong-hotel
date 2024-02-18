@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h1 class="h3 mb-0 text-gray-800">Normal Check-in</h1> <p style="margin-top: 25px; margin-left:10px">Pilih Kamar yang tersedia</p>
    </div>
    
    <div style="background: rgba(219, 176, 79, 0.3); padding-top:12px" class="row rounded text-dark text-center">
        <div class="col-sm-3">
            <p>Jam Check-In : 14:00</p>
        </div>
        <div class="col-sm-3">
            <p>Jam Check-Out : 12:00</p>
        </div>
        <div class="col-sm-3">
            <p>Early Check-In : 06:00 - 14.00</p>
        </div>
        <div class="col-sm-3">
            <p>Early Check-Out : 12:00 - 14.00</p>
        </div>
    </div>

    <!-- form Room Number -->

    <section  id="form-booking">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-3">
                    <h2>Room Number: 12</h2>
                </div>
                <div class="col-sm-3 text-warning text-center">
                    <h6 class="shape rounded p-2">STANDARD SINGLE (@RP245.000)</h6>
                </div>
            </div>

                <form action="" method="POST">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="invoice" class="form-label">#Invoice</label>
                                <input value="null" name="invoice" type="text" class="form-control" id="invoice" disabled>
                            </div>

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input name="checkin_time" type="date" class="form-control" id="checkinTime">
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input name="number_of_adult" type="number" class="form-control" id="adults">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="channel" class="form-control" id="channel">
                                    <option value="Traveloka">Traveloka</option>
                                    <option value="Phone-in">Phone-in</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Walk-in">Tiket.com</option>
                                    <option value="Walk-in">Syifa Travel</option>
                                </select>
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input name="checkout_time" type="date" class="form-control" id="checkoutTime">
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input name="number_of_children" type="number" class="form-control" id="children">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!-- Form Detail Customer -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
                <form method="POST">

                <!-- Nama -->
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name*</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputName">
                        </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#customerData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>


                <!-- Id -->
                    <div class="row mt-3 ">
                        <label for="" class="col-sm-2 col-form-label">ID Number*</label>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <select name="id_type" class="form-control" id="idnumber">
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <input name="id_number" type="text" class="form-control" id="idnumber">
                            </div>
                    </div>


                <!-- TTL -->
                    <div class="row ">
                        <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input name="born" type="text" class="form-control" id="idnumber">
                            </div>

                            <div class="col-sm-4">
                                <input name="born_date" type="text" class="form-control" id="idnumber">
                            </div>
                    </div>

                <!-- Gender -->
                    <div class="mt-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Jenis Kelamin*</label>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Perempuan" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Perempuan
                                </label>
                                </div>
                            </div>
                    </div>


                <!-- Agama -->
                    <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <select name="religion" class="form-control" id="agama">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                        </div>

                <!-- Title -->
                <div class="row">
                        <label for="name" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Mr" id="title">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mr
                                </label>
                                </div>
                            </div>

                            <div class="col-sm-3 ">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Mrs" id="title">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mrs
                                </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="Ms" id="title">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Ms
                                </label>
                                </div>
                            </div>
                    </div>

                <!-- Negara -->
                <div class="row">
                        <label for="country" class="col-sm-2 col-form-label">Negara</label>
                            <div class="col-sm-8">
                                <input name="country" type="text" class="form-control" id="country">
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#countyData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>

                <!-- Provinsi -->
                <div class="mt-3 row">
                        <label for="province" class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <input name="province" type="text" class="form-control" id="provinsi">
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#provinceData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>


                <!-- Kota -->
                <div class="mt-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-8">
                                <input name="city" type="text" class="form-control" id="city">
                            </div>
                        <div class="col-sm-2">
                            <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cityData">
                                <i style="color: black;" class="fas fa-database"></i>
                            </button>
                        </div>
                    </div>


                <!-- Kode Pos -->
                <div class="row mt-3">
                        <label for="" class="col-sm-2 col-form-label">Kode Pos</label>
                            <div class="col-sm-8">
                                <input name="postal_code" type="text" class="form-control" id="idnumber">
                            </div>
                    </div>


                <!-- Email -->
                <div class="mt-3 row">
                        <label for="" class="col-sm-2 col-form-label">Email</label>
                            
                            <div class="col-sm-8">
                                <input name="email_address"  type="text" class="form-control" id="idnumber">
                            </div>
                    </div>


                <!-- No Telp -->
                <div class=" mt-3 row">
                        <label for="" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-8">
                                <input name="telp_number" type="text" class="form-control" id="idnumber">
                            </div>
                    </div>


                <!-- Upload Dokumen -->
                 <div class=" mt-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Upload Foto Dokumen</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <input name="document" type="file" class="form-control" id="inputGroupFile02">
                            </div>
                        </div>
                    </div>

                
                 <!-- Deposit -->
                 <div class="row">
                        <label for="name" class="col-sm-2 col-form-label">Total Deposit (Rp)</label>
                        <div class="col-sm-8">
                        <input name="deposit" type="text" class="form-control" id="inputName">
                        </div>
                    </div>


                <!-- Button -->
                    <div class="mt-5 mb-3 d-flex justify-content-start ">
                    <div class="">
                        <button type="submit" class="btn submit-btn mr-5">
                            Check In
                        </button>
                    </div>
                    <div class="">
                        <button class="btn cancel-btn">
                            Cancel
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!-- Modal for name customer -->
<div class="modal fade" id="customerData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="checkInTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>No Telp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>098878672343</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>09093892423</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>



<!-- Modal Country customer -->
<div class="modal fade" id="countyData" tabindex="-1" aria-labelledby="countyData" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Select Country</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="countryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Country Name</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Indonesia</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Japan</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>


<!-- Modal Province customer -->
<div class="modal fade" id="provinceData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ProvinceTable" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>Provinsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sumatera Utara</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kalimantan Barat</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
   
    </div>
  </div>
</div>


<!-- Modal city customer -->
<div class="modal fade" id="cityData" tabindex="-1" aria-labelledby="customerData" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Customer Check-in</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cityTable" width="100%" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>Kota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Padang</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jakarta</td>
                                        <td>
                                            <button class="btn btn-warning rounded">
                                                select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    
        </div>
    </div>
</div>



    </div>
</section>

@endsection