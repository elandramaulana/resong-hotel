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
                            <div class="card-header pt-4 d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold text-warning">Daily Report</h6>
                                {{-- <form method="GET" action="{{ route('bill.report') }}" id="filter-form">
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <label for="from" class="mr-2">From:</label>
                                            <input type="date" name="from" id="from" class="form-control"
                                                value="{{ request('from') ?? now()->format('Y-m-d') }}">
                                        </div>
                                        <div class="col-auto">
                                            <label for="to" class="mr-2">To:</label>
                                            <input type="date" name="to" id="to" class="form-control"
                                                value="{{ request('to') ?? now()->format('Y-m-d') }}">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mt-3  ">Filter</button>
                                        </div>
                                    </div>
                                </form> --}}
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="font-weight-bold">Rabu,</span>
                                    <span class="font-weight-bold">20 Januari 2025</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 100%;" cellspacing="0" id="dataTable">
                                        <thead>
                                            <tr class="text-center text-xs">
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">No</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Kamar</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Tipe Ruangan</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Status</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Uraian/Nama</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Group</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">M/T</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Berapa Hari</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Tanggal Masuk</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Jam Masuk</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">KM</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">ORG</th>
                                                <th colspan="4" class="text-white text-center align-middle bg-dark">Stay (Hari) (Chek In)</th>
                                                <th colspan="8" class="text-white text-center align-middle bg-dark">Pendapatan (Chek Out) (Rp)</th>
                                                <th colspan="3" class="text-white text-center align-middle bg-dark">Pembayaran</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Keterangan</th>
                                            </tr>
                                            <tr class="text-xs">
                                                <th class="text-white text-center align-middle bg-dark">HR</th>
                                                <th class="text-white text-center align-middle bg-dark">KM</th>
                                                <th class="text-white text-center align-middle bg-dark">Rate</th>
                                                <th class="text-white text-center align-middle bg-dark">Jumlah</th>
                                                <th class="text-white text-center align-middle bg-dark">HR</th>
                                                <th class="text-white text-center align-middle bg-dark">KM</th>
                                                <th class="text-white text-center align-middle bg-dark">Rate</th>
                                                <th class="text-white text-center align-middle bg-dark">Jam Keluar</th>
                                                <th class="text-white text-center align-middle bg-dark">F&B</th>
                                                <th class="text-white text-center align-middle bg-dark">Laundry</th>
                                                <th class="text-white text-center align-middle bg-dark">Lain-lain</th>
                                                <th class="text-white text-center align-middle bg-dark">Total</th>
                                                <th class="text-white text-center align-middle bg-dark">Cash</th>
                                                <th class="text-white text-center align-middle bg-dark">Card</th>
                                                <th class="text-white text-center align-middle bg-dark">Piutang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-xs">
                                                <td style="max-width: 10px; width: 10px;">1</td>
                                                <td>112</td>
                                                <td>STANDARD</td>
                                                <td>OC</td>
                                                <td>Nita Andriyani</td>
                                                <td>Booking.com</td>
                                                <td>T</td>
                                                <td>1</td>
                                                <td>01/12/24</td>
                                                <td>15:00:00</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>275.000</td>
                                                <td>275.000</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>275.000</td>
                                                <td>12:00:00</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>275.000</td>
                                                <td></td>
                                                <td></td>
                                                <td>275.000</td>
                                                <td>AC Tidak Dingin</td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td style="max-width: 10px; width: 10px;">2</td>
                                                <td>112</td>
                                                <td>STANDARD</td>
                                                <td>OC</td>
                                                <td>Nita Andriyani</td>
                                                <td>Booking.com</td>
                                                <td>T</td>
                                                <td>1</td>
                                                <td>01/12/24</td>
                                                <td>15:00:00</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>275.000</td>
                                                <td>275.000</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>275.000</td>
                                                <td>12:00:00</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>275.000</td>
                                                <td></td>
                                                <td></td>
                                                <td>275.000</td>
                                                <td>AC Tidak Dingin</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                             <tr>
                                                <td colspan="28" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="4" class="font-weight-bold text-center">Total Pendapatan Hari ini</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>11</td>
                                                <td>21</td>
                                                <td>13</td>
                                                <td>11</td>
                                                <td></td>
                                                <td></td>
                                                <td>14</td>
                                                <td>10</td>
                                                <td>3.351.208</td>
                                                <td></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>3.351.208</td>
                                                <td>575.000</td>
                                                <td>100.000</td>
                                                <td>2.401.208</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="28" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="21" style="height: 10px; background-color: #f8f9fa;"></td>
                                                <td colspan="2" style="height: 10px;" class="font-weight-bold align-middle">Jumlah Pengeluaran</td>
                                                <td style="height: 10px;" class="align-middle">5.252.000</td>
                                                <td style="height: 10px;" class="align-middle">5.252.000</td>
                                                <td colspan="3" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="21" style="height: 10px; background-color: #f8f9fa;"></td>
                                                <td colspan="2" style="height: 10px;" class="font-weight-bold align-middle">Jumlah di Setor</td>
                                                <td style="height: 10px;" class="align-middle">1.900.792</td>
                                                <td style="height: 10px;" class="align-middle">4.677.000</td>
                                                <td style="height: 10px;" class="align-middle">100.000</td>
                                                <td style="height: 10px;" class="align-middle">2.401.208</td>
                                                <td style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="row my-5 text-sm">
                                        <div class="col-6">
                                            <p class="font-weight-bold mb-0">Pengeluaran</p>
                                            <table class="table table-bordered" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr class="text-xs">
                                                        <th class="text-white text-center align-middle bg-dark">No</th>
                                                        <th class="text-white text-center align-middle bg-dark">Item</th>
                                                        <th class="text-white text-center align-middle bg-dark">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-xs">
                                                        <td style="max-width: 10px; width: 10px;">1</td>
                                                        <td>Pemompa Kloset</td>
                                                        <td>Rp. 25.000</td>
                                                    </tr>
                                                    <tr class="text-xs">
                                                        <td style="max-width: 10px; width: 10px;">2</td>
                                                        <td>Pemompa Kloset</td>
                                                        <td>Rp. 25.000</td>
                                                    </tr>
                                                    <tr class="text-xs">
                                                        <td style="max-width: 10px; width: 10px;">3</td>
                                                        <td>Pemompa Kloset</td>
                                                        <td>Rp. 25.000</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" style="height: 10px; background-color: #f8f9fa;"></td>
                                                    </tr>
                                                    <tr class="text-xs">
                                                        <td colspan="2" class="font-weight-bold text-center">Total</td>
                                                        <td>Rp. 5.252.000</td>
                                                    </tr>
                                                </tfoot>
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
    </div>
@endsection
