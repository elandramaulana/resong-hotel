@extends('layouts.dashboard_layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<section class="mt-5">
    <div class="container-fluid">
        <form action="{{ route('laundry.post') }}" method="POST" id="formInput">
            <div class="row">
                <!-- Check-in Table -->
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="font-weight-bold text-warning left">{{ $Title }}</h6>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="laundry_type">Type Laundry</label>
                                        <select name="laundry_type" class="form-control singleInput" id="laundry_type" >
                                            <option value="">Pilih Type Laundry</option>
                                            <option value="Guest">Guest</option>
                                            <option value="Linen">Linen</option>
                                            <option value="Uniforms">Uniforms</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="display: none" id="formSelectRoom">
                                    <div class="form-group">
                                        <label for="">Pilih No Kamar</label>
                                        <select name="checkin_id" id="checkin_id" class="form-control singleInput">
                                            <option value="">Pilih No Kamar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>Detail Laundry</h4>
                                        </div>
                                        <div class="col-lg-4  d-flex justify-content-end">
                                            <a  class="btn btn-extend" href="#" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modalAddLaundry"><i class="fa fa-plus"></i> Tambah</a>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="listLaundry">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Deskripsi</th>
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
                                    <button type="submit" class="btn btn-primary" id="btnSubmit" disabled><i class="fa fa-save"></i> Simpan</button>
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
                  <h3 class="font-weight-bolder">Add Laundry</h3>
              </div>
                      <div class="card-body">
                          <small id="showerror"></small>
                          <div class="row">
                              <!-- Left Column -->
                              <div class="col-md-12">   
                                  <!-- Check-in Time -->
                                  <div class="mb-3">
                                      <label for="item_category" class="form-label">Pilih Kategory</label>
                                      <select name="category_id" class="form-control" style="width:100%" id="category_id">
                                          <option value="">Pilih Kategori Pakaian</option>
                                      </select>    
                                      <small class="showerror"></small>
                                  </div>
                              </div>
                              <!-- Right Column -->
                              <div class="col-md-4">
                                <input type="text" name="" hidden id="frm_cat_id">
                                <input type="text" name="" hidden id="frm_cat_price">
                                <input type="text" name="" hidden id="frm_cat_unit">
                                <input type="text" name="" id="frm_cat_name" hidden>
                                  <!-- Check-out Time -->
                                  <div class="mb-3">
                                      <label for="cat_price" class="form-label">Harga</label>
                                      <input name="cat_price" placeholder="Harga" type="text" class="form-control" readonly id="cat_price"  >
                                      <small class="showerror"></small>
                                  </div>
                              </div>
  
                              <div class="col-md-4">   
                                  <!-- Check-in Time -->
                                  <div class="mb-3">
                                      <label for="cat_unit" class="form-label">Satuan</label>
                                      <input type="text" name="cat_unit" id="cat_unit" class="form-control" placeholder="Satuan" readonly>
                                      <small class="showerror"></small>
                                  </div>
                              </div>
  
                              <!-- Right Column -->
                              <div class="col-md-4">
                                  <!-- Check-out Time -->
                                  <div class="mb-3">
                                      <label for="item_qty" class="form-label">Jumlah</label>
                                      <input class="form-control" type="text" name="det_laundry_qty" id="det_laundry_qty" placeholder="Jumlah ">
                                      <small class="showerror"></small>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <!-- Check-out Time -->
                                  <div class="mb-3">
                                      <label for="item_description" class="form-label">Deskripsi</label>
                                      <textarea name="item_description" id="item_description" class="form-control" placeholder="Inputkan Keterangan terkait service ini"></textarea>
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
  @include('laundry.laundry_form_js')
@endsection