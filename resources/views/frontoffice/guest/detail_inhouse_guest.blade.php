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
                    <h2>Room Number: {{ $CheckinData->room_no }}</h2>
                </div>
                <div class="col-sm-4 text-warning text-center">
                    <h6 class="shape rounded p-2">{{ $CheckinData->room_type }} (@RP{{ $CheckinData->room_price }})</h6>
                </div>

                <div class="col-sm-4 text-warning d-flex justify-content-end text-center">
                    <button class="btn btn-extend"  data-bs-toggle="modal" data-bs-target="#extendGuestData">
                        <i class="fas fa-plus"></i> Extend
                    </button>
                </div>
            </div>
            <input type="text" name="room_id" value="" hidden>
            <input type="text" name="checkin_id" value="{{ $CheckinData->checkin_id }}" hidden>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Invoice (Disabled) -->
                            <div class="mb-3">
                                <label for="invoice" class="form-label">#Invoice</label>
                                <input value="{{ $CheckinData->no_invoice }}" name="invoice" type="text" class="form-control" id="invoice" disabled>
                            </div>

                            <!-- Nama (Disabled) -->
                            <div class="mb-3">
                                <label for="name" class="form-label">#Invoice</label>
                                <input value="{{ $CheckinData->name_guest }}" name="name" type="text" class="form-control" id="name" disabled>
                            </div>

                            <!-- Check-in Time -->
                            <div class="mb-3">
                                <label for="checkinTime" class="form-label">Check-in Time</label>
                                <input value="{{ $CheckinData->date_checkin }}" name="checkin_time" type="text" class="form-control" id="checkinTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" disabled>
                                <x-input-error :messages="$errors->get('checkin_time')" class="mt-2" />
                            </div>

                            <!-- Number of Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Jumlah Dewasa</label>
                                <input name="number_of_adult" value="{{ $CheckinData->guest_adult }}" type="number" class="form-control" id="adults" disabled>
                                <x-input-error :messages="$errors->get('number_of_adult')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Channel" class="form-label">Channel</label>
                                <select name="channel" class="form-control" id="channel" disabled>
                                    <option value="{{ $CheckinData->chanel_checkin }}">{{ $CheckinData->chanel_checkin }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('channel')" class="mt-2" />
                            </div>

                            <!-- Id Number -->
                            <div class="mb-3">
                                <label for="idnumber" class="form-label">Id Number</label>
                                <input value="{{ $CheckinData->id_number }}" name="id_number" type="text" class="form-control" id="checkoutTime" disabled>
                                <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                            </div>

                            <!-- Check-out Time -->
                            <div class="mb-3">
                                <label for="checkoutTime" class="form-label">Check-out Time</label>
                                <input value="{{ $CheckinData->date_checkout }}" name="checkout_time" type="date" class="form-control" id="checkoutTime" onfocus="(this.type='date');this.focus()" onblur="(this.type='text');this.value=formatDate(this.value)" disabled>
                                <x-input-error :messages="$errors->get('checkout_time')" class="mt-2" />
                            </div>

                            <!-- Number of Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Jumlah Anak-anak</label>
                                <input value="{{ $CheckinData->guest_kids }}" name="number_of_children" type="number" class="form-control" id="children"  disabled>
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


<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-2">
                    <h2>List Order</h2>
                    <br>
                </div>
                <div class="col-sm-4 offset-sm-4" style="align-content: right">

                    @php
                        if ($CheckinData->room_extrabed==1 && $CheckinData->is_extrabed ==0) {
                    @endphp
                    <a class="btn btn-extend" id="btn-extrabed">
                            <i class="fas fa-plus"></i> Extra Bed
                        </a>
                    @php
                        }
                    @endphp
                    
                        <a class="btn btn-extend" id="btn-extend " data-bs-toggle="modal" data-bs-target="#formAddOns">
                            <i class="fas fa-plus"></i> AddOn Service
                        </a>
                    
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
                                <th>No.</th>
                                <th>Product/Service</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                                $Total = 0;
                                $No = 1;
                            @endphp
                            @foreach ($dataInvoice  as $invoice)
                            @php
                                $showprice = formatCurrency($invoice->item_price);
                                $ShowTotal = formatCurrency($invoice->item_price * $invoice->item_qty);
                                $subTotal += $invoice->item_price * $invoice->item_qty; 
                            @endphp
                                <tr>
                                    <td>{{ $No }}</td>
                                    <td>{{ $invoice->item_name }}</td>
                                    <td>{{ $invoice->item_qty }}</td>
                                    <td>{{ $showprice }}</td>
                                    <td>{{ $ShowTotal }}</td>
                                    <td></td>
                                </tr>
                                @php
                                    $No++;
                                @endphp
                            @endforeach
                            @php
                                $TotalSemua = formatCurrency($subTotal);
                            @endphp
                        </tbody>
                    </table>
                </div>
                       <!-- Button -->
                       <div class="mt-5 mb-3 d-flex justify-content-start ">
                    <div class="">
                        <button class="btn submit-btn mr-5">
                           Total : {{ $TotalSemua }}
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
<div class="modal fade" id="formAddOns" tabindex="-1" aria-labelledby="formAddOns" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
             <div class="card-header py-3">
                <h3 class="font-weight-bolder">AddOns</h3>
            </div>
                    <div class="card-body">
                    <form action="{{ route('inhouse.postaddons') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">   
                                <!-- Check-in Time -->
                                <div class="mb-3">
                                    <label for="item_category" class="form-label">Kategori Layanan</label>
                                    <select name="item_category" class="form-control" id="item_category">
                                        <option value="Lain-Lain">Lain-Lain</option>
                                        <option value="Resto">Resto</option>
                                        <option value="House Keeping">House Keeping</option>
                                    </select>    
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="item_name" class="form-label">Nama Item</label>
                                    <input name="item_name" placeholder="Isi Nama Item Ex: Laundry Jas" type="text" class="form-control" id="item_name"  >
                                </div>
                            </div>

                            <div class="col-md-6">   
                                <!-- Check-in Time -->
                                <div class="mb-3">
                                    <label for="item_price" class="form-label">Harga</label>
                                    <input type="text" name="item_price" id="item_price" class="form-control" placeholder="inputkan Harga Item">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="item_qty" class="form-label">Jumlah</label>
                                    <input name="item_qty" placeholder="Inputkan Jumlah Item" type="text" class="form-control" id="item_qty"  >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Check-out Time -->
                                <div class="mb-3">
                                    <label for="item_description" class="form-label">Deskripsi</label>
                                    <input name="item_description" placeholder="Inputkan Keterangan Jika Ada" type="text" class="form-control" id="item_description"  >
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
  @include('frontoffice.guest.detail_inhouse_guest_js')
@endsection