@extends('layouts.dashboard_layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="text-center">Rekapan Transaksi</h2>
            <form method="GET"  action="{{ route('monthly.report') }}">
                <select name="bulan" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Bulan</option>
                    @foreach ([
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ] as $bln)
                        <option value="{{ $bln }}" {{ request('bulan') == $bln ? 'selected' : '' }}>
                            {{ $bln }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Referensi</th>
                            <th>Type</th>
                            <th>Jenis</th>
                            <th>Besar Transaksi</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->tabel_referensi }}</td>
                            <td>{{ $item->type_transaksi }}</td>
                            <td>{{ $item->jenis_transaksi }}</td>
                            <td>Rp {{ number_format($item->besar_transaksi, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan_transaksi }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-warning">
                            <td colspan="4" class="text-center"><strong>Total Transaksi</strong></td>
                            <td><strong>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</strong></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
