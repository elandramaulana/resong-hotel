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
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold text-warning">Bill Report</h6>
                                <form method="GET" action="{{ route('bill.report') }}">
                                    <div class="form-group mb-0 d-flex align-items-center">
                                        <label for="filter" class="mr-2">Filter:</label>
                                        <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                                            <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Harian</option>
                                            <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                            <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold fs-5">Laporan {{ $FilterType }}</p>
                                    <p class="font-weight-bold">{{ $Tanggal }}</p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 100%;" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2" class="text-white" style="background-color: black">No</th>
                                                <th rowspan="2" class="text-white" style="background-color: black">Item</th>
                                                <th class="text-white" style="max-width: 300px; width: 300px; background-color: black">Debit</th>
                                                <th class="text-white" style="max-width: 300px; width: 300px; background-color: black">Kredit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="max-width: 10px; width: 10px;">1</td>
                                                <td>Rooms</td>
                                                <td>Rp. 0</td>
                                                <td>Rp. {{ number_format($Vacant, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Services</td>
                                                <td>Rp. 0</td>
                                                <td>Rp. {{ number_format($Service, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Resto</td>
                                                <td>Rp. 0</td>
                                                <td>Rp. {{ number_format($Resto, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Laundry</td>
                                                <td>Rp. 0</td>
                                                <td>Rp. {{ number_format($Laundry, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Barang Resto</td>
                                                <td>Rp. {{ number_format($Barang, 0, ',', '.') }}</td>
                                                <td>Rp. 0</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Asset</td>
                                                <td>Rp. {{ number_format($Asset, 0, ',', '.') }}</td>
                                                <td>Rp. 0</td>
                                            </tr>
                                            {{-- Subtotal --}}
                                            <tr>
                                                <td colspan="2" class="text-center font-weight-bold">Sub Total</td>
                                                <td>Rp. {{ number_format($SubTotalDebit, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($SubTotalKredit, 0, ',', '.') }}</td>
                                            </tr>
                                            {{-- Total --}}
                                            <tr>
                                                <td colspan="2" class="text-center font-weight-bold">Total</td>
                                                <td colspan="2">Rp. {{ number_format($Total, 0, ',', '.') }}</td>
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
    <script>
        document.getElementById('filter-select').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>
@endsection
