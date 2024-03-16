@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h2 class="h3 mb-0 text-gray-800">Detail In-house Guest</h2>
    </div>
    

    <!-- form Room Number -->
    <form action="{{ route('checkin.normal.store') }}" method="POST">
        @csrf;
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
                    <button class="btn btn-extend"  data-bs-toggle="modal" data-bs-target="#extendGuestData">
                        <i class="fas fa-plus"></i> Extend
                    </button>
                </div>
            </div>

            

            <input type="text" name="room_id" value="" hidden>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="invoice" class="form-label">#Invoice</label>
                                <input value="null" name="invoice" type="text" class="form-control" id="invoice" disabled>
                            </div>

                            <!-- Nama (Disabled) -->
                            <div class="mb-3">
                                <label for="name" class="form-label">#Invoice</label>
                                <input value="Joni Alfiansyah" name="name" type="text" class="form-control" id="name" disabled>
                            </div>

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input value="2024-04-03" name="checkin_time" type="text" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" disabled>
                                <x-input-error :messages="$errors->get('checkin_time')" class="mt-2" />
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input name="number_of_adult" value="1" type="number" class="form-control" id="adults" disabled>
                                <x-input-error :messages="$errors->get('number_of_adult')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="channel" class="form-control" id="channel" disabled>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Traveloka" >Traveloka</option>
                                    <option value="Phone-in" >Phone-in</option>
                                    <option value="tiket.com" >Tiket.com</option>
                                    <option value="syifa_travel" >Syifa Travel</option>
                                </select>
                                <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                            </div>

                            <!-- Id Number -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Id Number</label>
                                <input value="140898346712123" name="id_number" type="text" class="form-control" id="checkoutTime" disabled>
                                <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input value="2024-04-03" name="checkout_time" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" disabled>
                                <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input value="2" name="number_of_children" type="number" class="form-control" id="children"  disabled>
                                <x-input-error :messages="$errors->get('number_of_children')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Pesan" id="floatingTextarea2" style="height: 100px" disabled></textarea>
                        <label for="floatingTextarea2">Pesan</label>
                    </div>
            </div>
        </div>
    </div>
</section>




<!-- Add On Service -->

<section  id="portfolio" class="portfolio">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
                
            <div class="row">
                <div class="col-sm-3">
                    <h2>Add-ond Service</h2>
                    <br>
                    <h3>List Service</h3>
                </div>
            </div>

          <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
          
          <div>
            <ul class="portfolio-flters">
              <li data-filter="*" class="filter-active"><button class="btn btn-warning">All</button></li>
              <li data-filter=".filter-food"><button class="btn btn-warning">Food</button></li>
              <li data-filter=".filter-drinks"><button class="btn btn-warning">Drink</button></li>
              <li data-filter=".filter-laundry"><button class="btn btn-warning">Laundry</button></li>
              <li data-filter=".filter-other"><button class="btn btn-warning">Other</button></li>
            </ul><!-- End Portfolio Filters -->
          </div>
          
          <div class="row gy-4 portfolio-container">

            <div class="col-xl-12 col-md-12 portfolio-item filter-food">
              <div class="portfolio-wrap">
                <div class="portfolio-info">
                <div class="table-responsive">
                <table class="table" id="listServiceGuestFood" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nasi Goreng</td>
                            <td>Porsi</td>
                            <td>Rp30000</td>
                            <td>
                                <div class="">
                                    <!-- DAT ITEM INI JUGA AKAN DINAMIS KAN BANG, JADI VARIABLE UNTUK NILAINYA KAYAKNYA BISA SAMA DENGAN NAMA ITEM -->
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Goreng">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nasi Ikan</td>
                            <td>Porsi</td>
                            <td>Rp40000</td>
                            <td>
                                <div class="">
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Ikan">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                        </div>
                </div>
              </div>
            </div><!-- End tabel food -->

            <div class="col-xl-12 col-md-12 portfolio-item filter-drinks">
              <div class="portfolio-wrap">
                <div class="portfolio-info">
                <div class="table-responsive">
                            <table class="table" id="listServiceGuestDrinks" width="100%" cellspacing="0">
                            <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nasi Goreng</td>
                            <td>Porsi</td>
                            <td>Rp30000</td>
                            <td>
                                <div class="">
                                    <!-- DAT ITEM INI JUGA AKAN DINAMIS KAN BANG, JADI VARIABLE UNTUK NILAINYA KAYAKNYA BISA SAMA DENGAN NAMA ITEM -->
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Goreng">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nasi Ikan</td>
                            <td>Porsi</td>
                            <td>Rp40000</td>
                            <td>
                                <div class="">
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Ikan">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                            </table>
                        </div>
                </div>
              </div>
            </div><!-- End tabel drink -->


            <div class="col-xl-12 col-md-12 portfolio-item filter-laundry">
              <div class="portfolio-wrap">
                <div class="portfolio-info">
                <div class="table-responsive">
                            <table class="table" id="listServiceGuestLaundry" width="100%" cellspacing="0">
                            <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nasi Goreng</td>
                            <td>Porsi</td>
                            <td>Rp30000</td>
                            <td>
                                <div class="">
                                    <!-- DAT ITEM INI JUGA AKAN DINAMIS KAN BANG, JADI VARIABLE UNTUK NILAINYA KAYAKNYA BISA SAMA DENGAN NAMA ITEM -->
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Goreng">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nasi Ikan</td>
                            <td>Porsi</td>
                            <td>Rp40000</td>
                            <td>
                                <div class="">
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Ikan">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                            </table>
                        </div>
                </div>
              </div>
            </div><!-- End tabel laundry -->


            <div class="col-xl-12 col-md-12 portfolio-item filter-other">
              <div class="portfolio-wrap">
                <div class="portfolio-info">
                <div class="table-responsive">
                            <table class="table" id="listServiceGuestOther" width="100%" cellspacing="0">
                            <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nasi Goreng</td>
                            <td>Porsi</td>
                            <td>Rp30000</td>
                            <td>
                                <div class="">
                                    <!-- DAT ITEM INI JUGA AKAN DINAMIS KAN BANG, JADI VARIABLE UNTUK NILAINYA KAYAKNYA BISA SAMA DENGAN NAMA ITEM -->
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Goreng">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nasi Ikan</td>
                            <td>Porsi</td>
                            <td>Rp40000</td>
                            <td>
                                <div class="">
                                    <button class="btn btn-warning rounded add-button" type="button" data-item="Nasi Ikan">
                                        Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                            </table>
                        </div>
                </div>
              </div>
            </div><!-- End tabel other -->

          </div><!-- End Portfolio Container -->

          </div>
                
            </div>
        </div>
        
    </div>
</section>


<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
                

            <div class="row">
                <div class="col-sm-3">
                    <h2>List Order</h2>
                    <br>
                </div>
            </div>

            <!-- BANG UNTUK LIST ORDER INI JSNYA ADA DI VIEW "layout.dashboard_layout", DIBAGIAN BAWAH BANG -->
            <!-- SOALNYA LAN GA TAU GIMANA SISTEM GENERATE INVOICENYA -->
            
            <div class="col-sm-12">

            <form id="orderForm" >
                <div class="table-responsive">
                    <table class="table" id="listServiceOrder" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Pesanan Ke</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- disini nanti data akan di tambahkan dari jsnya -->
                        </tbody>
                    </table>
                </div>
                       <!-- Button -->
                       <div class="mt-5 mb-3 d-flex justify-content-start ">
                    <div class="">
                        <button type="submit" class="btn submit-btn mr-5">
                           Order
                        </button>
                    </div>
                    <div class="">
                        <button class="btn cancel-btn">
                            Cancel
                        </button>
                    </div>
            </form>
            </div>

         
                </div>
                
            </div>
        </div>
        <div class="alert alert-success mt-3" role="alert" id="successAlert" style="display:none;">
            Order successfully
        </div>

        <div class="alert alert-danger mt-3" role="alert" id="errorAlert" style="display:none;">
            Failed To Order
        </div>
    </div>
</section>






<!-- Modal for extend form -->
<div class="modal fade" id="extendGuestData" tabindex="-1" aria-labelledby="extendGuestData" aria-hidden="true">
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