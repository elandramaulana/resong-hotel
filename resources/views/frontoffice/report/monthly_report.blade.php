@extends('layouts.dashboard_layout')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="text-center">Rekapan Transaksi</h2>
                <form method="GET" action="{{ route('monthly.report') }}" class="d-flex gap-2">
                    <select name="bulan" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln)
                            <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                                {{ $bln }}</option>
                        @endforeach
                    </select>

                    <select name="tahun" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tahun</option>
                        @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Tgl</th>
                                <th colspan="3">STAY (HARI)</th>
                                <th rowspan="1">Rekapan</th>
                                <th colspan="2">PEMBAYARAN</th>
                                <th rowspan="2">KET</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>ORG</th>
                                <th>HR</th>
                                <th>KM</th>
                                <th>Jumlah</th>
                                <th>Card</th>
                                <th>CASH</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($dataByDate as $index => $data)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data['date'])->format('d-m-Y') }}</td>
                                    <td>{{ $data['org'] }}</td>
                                    <td>{{ $data['hr'] }}</td>
                                    <td>{{ $data['km'] }}</td>
                                    <td>{{ number_format($data['rekapan_jumlah'], 2) }}</td>
                                    <td>{{ number_format($data['pembayaran_card'], 2) }}</td>
                                    <td>{{ number_format($data['pembayaran_cash'], 2) }}</td>
                                    <td><!-- Keterangan, nanti akan diisi logika tambahan --></td>
                                    <td>
                                        <div>
                                            <button style="margin-right: 10px" type="submit"
                                                class="btn btn-warning btn-sm mt-2">
                                                <a style="color: black" href="#"> <i class="fas fa-eye"></i></a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-warning text-center">
                                <td colspan="2"><strong>Total Transaksi</strong></td>
                                <td><strong>{{ number_format($total['org'], 0, ',', '.') }}</strong></td>
                                <td><strong>{{ number_format($total['hr'], 0, ',', '.') }}</strong></td>
                                <td><strong>{{ number_format($total['km'], 0, ',', '.') }}</strong></td>
                                <td><strong>Rp {{ number_format($total['rekapan_jumlah'], 0, ',', '.') }}</strong></td>
                                <td><strong>Rp {{ number_format($total['pembayaran_card'], 0, ',', '.') }}</strong></td>
                                <td><strong>Rp {{ number_format($total['pembayaran_cash'], 0, ',', '.') }}</strong></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
