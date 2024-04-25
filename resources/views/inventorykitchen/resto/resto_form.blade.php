@extends('layouts.dashboard_layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<section class="mt-5">
    <div class="container-fluid">
        <form action="{{ route('resto.resto_submit') }}" method="POST" id="formInput">
            @csrf
            <div class="row">
                <!-- Check-in Table -->
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h3 class="font-weight-bold text-warning left">{{ $Title }}</h3>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_type">Type Customer</label>
                                        <select name="customer_type" class="form-control singleInput" id="customer_type" >
                                            <option value="">Pilih Type Customer</option>
                                            <option value="Guest">Guest</option>
                                            <option value="Non-guest">Non Guest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="formSelectRoom" style="display: none ">
                                    <div class="form-group">
                                        <label for="">Pilih No Kamar</label>
                                        <select name="checkin_id" id="checkin_id" class="form-control singleInput">
                                            <option value="">Pilih No Kamar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4" id="nama_customer" style="display: none">
                                    <div class="mb-3" >
                                        <label for="nama_customer" class="form-label">Nama</label>
                                        <input name="nama_customer" value="Ujang" placeholder="Harga" type="text" class="form-control"   required
                                        <small class="showerror"></small>
                                    </div>
                                </div>
                                <div class="col-sm-4" id="contact_customer" style="display: none">
                                    <div class="mb-3" >
                                        <label for="contact_customer" class="form-label">Kontak</label>
                                        <input name="contact_customer" value="089785654" placeholder="Harga" type="text" class="form-control"   required
                                        <small class="showerror"></small>
                                    </div>
                                    </div>
                                <div class="col-sm-4" id="customer_email" style="display: none">
                                    <div class="mb-3" >
                                        <label for="customer_email" class="form-label">Email</label>
                                        <input name="customer_email" value="ujangganteng@gmail.com" placeholder="Harga" type="text" class="form-control"  required >
                                        <small class="showerror"></small>
                                    </div>
                                    </div>
                                </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="font-weight-bold text-dark">Detail Resto</h4>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end">
                                                <a class="btn btn-extend" style="text-decoration: none; color:white" href="#" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modalAddLaundry">Tambah</a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="detailLayananRestoTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Menu</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total (Harga * Jumlah)</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr id="dataKosong">
                                                    <td style="text-align: center" colspan="6">Belum ada data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button disabled id="btnSubmit" type="submit" class="btn submit-btn mr-5">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
<div class="modal fade" id="modalAddLaundry" tabindex="-1" aria-labelledby="modalAddLaundry" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
        <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h3 class="font-weight-bolder">Add Resto Order</h3>
              </div>
                      <div class="card-body">
                          <small id="showerror"></small>
                          <div class="row">
                              <!-- Left Column -->
                              <div class="col-md-4">   
                                  <!-- Check-in Time -->
                                  <div class="mb-3">
                                      <label for="hari" class="form-label">Hari</label>
                                      <input type="text" value="{{ $dayName }}" readonly id="day_name" class="form-control"> 
                                      <small class="showerror"></small>
                                  </div>
                              </div>
                              <div class="col-md-4">   
                                  <!-- Check-in Time -->
                                  <div class="mb-3">
                                      <label for="item_category" class="form-label">Kategori</label>
                                      <select name="category_id" class="form-control" style="width:100%" id="category_id">
                                        <option value="">Pilih Kategory</option>
                                      </select>    
                                      <small class="showerror"></small>
                                  </div>
                              </div>
                              <div class="col-md-4">   
                                  <!-- Check-in Time -->
                                  <div class="mb-3">
                                    <label for="jam" class="form-label">Jam</label>
                                    <input name="jam" value="" placeholder="Harga" type="text" class="form-control" readonly id="jam"  >
                                    <small class="showerror"></small>
                                </div>
                              </div>

                              <div class="col-sm-4">

                                <div class="mb-3">
                                    <label for="list_menu" class="form-label">Pilih Menu</label>
                                    <select name="list_menu" class="form-control" style="width:100%" id="list_menu">
                                        <option value="">Pilih Menu</option>
                                    </select>    
                                    <small class="showerror"></small>
                                </div>
                              </div>
                              <div class="col-sm-4">

                                 <!-- Check-out Time -->
                                 <div class="mb-3">
                                    <label for="menu_price" class="form-label">Harga Satuan</label>
                                    <input name="menu_price" value="" placeholder="Harga" type="text" class="form-control" readonly id="menu_price"  >
                                    <small class="showerror"></small>
                                </div>
                              </div>

  
                              <!-- Right Column -->
                              <div class="col-md-4">
                                  <!-- Check-out Time -->
                                  <div class="mb-3">
                                      <label for="item_qty" class="form-label">Jumlah</label>
                                      <input class="form-control" min="1" value="1" type="number" name="menu_qty" id="menu_qty" placeholder="Jumlah ">
                                      <small class="showerror"></small>
                                  </div>
                              </div>
                          </div>
                              <div class="mt-3 d-flex justify-content-center">
                                  <button type="submit" class="btn submit-btn" id="btn-submit">
                                      Tambah
                                  </button>
                              </div>
                      </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- /.container-fluid -->
@endsection

@section('jsSection')
  @include('inventorykitchen.resto.resto_js')
@endsection