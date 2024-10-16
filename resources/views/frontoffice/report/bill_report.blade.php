@extends('layouts.dashboard_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="font-weight-bold text-warning">Bill Report</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold fs-5">Laporan Harian</p>
                                    <p class="font-weight-bold">Selasa / 15 Oktober 2024</p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 100%;" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2" class="text-white" style="background-color: black">No
                                                </th>
                                                <th rowspan="2" class="text-white" style="background-color: black">Item
                                                </th>
                                                <th class="text-white"
                                                    style="max-width: 300px; width: 300px; background-color: black">
                                                    Debit</th>
                                                <th class="text-white"
                                                    style="max-width: 300px; width: 300px; background-color: black">Kredit
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="max-width: 10px; width: 10px;">1</td>
                                                <td>Resto</td>
                                                <td>Rp. 100.000</td>
                                                <td>Rp. 200.000</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Lorem</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Resto</td>
                                                <td>Rp. 100.000</td>
                                                <td>Rp. 100.000</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Lorem</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                            </tr>

                                            {{-- Subtotal --}}
                                            <tr>
                                                <td colspan="2" class="text-center font-weight-bold">Sub Total</td>
                                                <td>Rp. 300.000</td>
                                                <td>Rp. 300.000</td>
                                            </tr>

                                            {{-- Total --}}
                                            <tr>
                                                <td colspan="2" class="text-center font-weight-bold">Total</td>
                                                <td colspan="2">Rp. 600.000</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>
@endsection
