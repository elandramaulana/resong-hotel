@extends('layouts.dashboard_layout')

@section('content')

<section id="normal-checkin">
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start">
        <h2 class="h3 mb-0 text-gray-800">Proses Payroll</h2>
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
    
    

<!-- Invoice Detail  -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Employee Details</h3>
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
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Status</th>
                            <th>Gaji Pokok</th>
                            <th>Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>Elandra Maulana</td>
                                <td>1</td>
                                <td>100000</td>
                                <td>200000</td>
                                <td>12936123678123</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            

            <div class="container">
                    <form method="POST" action="">
                        @csrf   
                        <input type="text" hidden name="checkin_id" value="" >
                        <div class="row">
                                <!-- Bonus -->
                                <div class="mb-3 row">
                                    <label for="bonus" class="col-sm-3 col-form-label">Bonus:</label>
                                    <div class="col-sm-8">
                                        <input name="bonus" value="" type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <!-- Lembur -->
                                <div class="mb-3 row">
                                    <label for="lembur" class="col-sm-3 col-form-label">Lembur:</label>
                                    <div class="col-sm-8">
                                        <input name="lembur" value="" type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                <hr style="height:1px;border:none;color:#333;background-color:#333;">

                               
                        </div>
                        <!-- Button -->
                        <div class="mt-5 mb-3 d-flex justify-content-start">
                            <div class="mr-3">
                                {{-- <button type="submit"  class="btn ">
                                    Check Out
                                </button> --}}

                                <button type="submit" class="btn submit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                   Konfirmasi
                                </button>
                            </div>
                           
                        </div>
                        
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</section>


</section>


@endsection