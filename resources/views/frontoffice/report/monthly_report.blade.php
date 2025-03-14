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
                                <th colspan="3">Rekapan</th>
                                <th colspan="2">PEMBAYARAN</th>
                                <th rowspan="2">KET</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>ORG</th>
                                <th>HR</th>
                                <th>KM</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Total</th>
                                <th>CARD</th>
                                <th>CASH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataByDate as $index => $data)
                                @php
                                    // Cari data transaksi grouping berdasarkan created_at
                                    $rekapan = collect($transaksiByDate)->firstWhere('date', $data['date']);
                                    $rekapanDebit = $rekapan ? $rekapan['debit'] : 0;
                                    $rekapanKredit = $rekapan ? $rekapan['kredit'] : 0;
                                    $rekapanTotal = $rekapanDebit + $rekapanKredit;
                                    // Untuk pembayaran, gunakan grouping dari transaksi (jenis_pembayaran)
                                    $pembayaranCard = $rekapan ? $rekapan['card'] : 0;
                                    $pembayaranCash = $rekapan ? $rekapan['cash'] : 0;
                                @endphp
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data['date'])->format('d-m-Y') }}</td>
                                    <td>{{ $data['org'] }}</td>
                                    <td>{{ $data['hr'] }}</td>
                                    <td>{{ $data['km'] }}</td>
                                    <td>{{ number_format($rekapanDebit, 2) }}</td>
                                    <td>{{ number_format($rekapanKredit, 2) }}</td>
                                    <td>{{ number_format($rekapanTotal, 2) }}</td>
                                    <td>{{ number_format($pembayaranCard, 2) }}</td>
                                    <td>{{ number_format($pembayaranCash, 2) }}</td>
                                    <td><!-- Keterangan, nantinya akan diisi logika tambahan --></td>
                                    <td>
                                        <div>
                                            <button style="margin-right: 10px" type="submit"
                                                class="btn btn-warning btn-sm mt-2">
                                                <a style="color: black"
                                                    href="{{ route('weekly.report', ['date' => $data['date']]) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">Tidak ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            @php
                                // Total untuk Rekapan berdasarkan grouping transaksi (debit & kredit)
                                $totalRekapanDebit = $totalTransaksi['debit'];
                                $totalRekapanKredit = $totalTransaksi['kredit'];
                                $totalRekapanTotal = $totalRekapanDebit + $totalRekapanKredit;
                            @endphp
                            <tr class="table-warning text-center">
                                <td colspan="2"><strong>Total Transaksi</strong></td>
                                <td><strong>{{ number_format($total['org'], 0, ',', '.') }}</strong></td>
                                <td><strong>{{ number_format($total['hr'], 0, ',', '.') }}</strong></td>
                                <td><strong>{{ number_format($total['km'], 0, ',', '.') }}</strong></td>
                                <td><strong>{{ number_format($totalRekapanDebit, 2) }}</strong></td>
                                <td><strong>{{ number_format($totalRekapanKredit, 2) }}</strong></td>
                                <td><strong>{{ number_format($totalRekapanTotal, 2) }}</strong></td>
                                <td><strong>{{ number_format($totalTransaksi['card'], 2) }}</strong></td>
                                <td><strong>{{ number_format($totalTransaksi['cash'], 2) }}</strong></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
