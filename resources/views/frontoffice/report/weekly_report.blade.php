@extends('layouts.dashboard_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Check-in Table -->
                    <div class="col-sm-12">
                        <h6 class="font-weight-bold text-warning">Daily Report</h6>
                        <div class="card shadow mb-4">
                            <div class="card-header pt-4 d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2 align-items-center">
                                    <span
                                        class="font-weight-bold">{{ \Carbon\Carbon::parse(request('date') ?? now())->isoFormat('dddd') }},</span>
                                    <span
                                        class="font-weight-bold">{{ \Carbon\Carbon::parse(request('date') ?? now())->isoFormat('D MMMM Y') }}</span>
                                </div>
                                <form method="GET" action="{{ route('weekly.report') }}"
                                    class="d-flex align-items-center">
                                    <input type="date" name="date" class="form-control mr-2"
                                        value="{{ request('date') ?? now()->format('Y-m-d') }}">
                                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 100%;" cellspacing="0">
                                        <thead>
                                            <tr class="text-center text-xs">
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">No
                                                </th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Kamar</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Tipe Ruangan</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Status</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Uraian/Nama</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Group</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    M/T</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Berapa Hari</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Tanggal Masuk</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Jam Masuk</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">KM
                                                </th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    ORG</th>
                                                <th colspan="3" class="text-white text-center align-middle table-dark">
                                                    Stay (Hari) (Chek In)</th>
                                                <th colspan="5" class="text-white text-center align-middle table-dark">
                                                    Pendapatan (Chek Out) (Rp)</th>
                                                <th colspan="3" class="text-white text-center align-middle table-dark">
                                                    Pembayaran</th>
                                                <th rowspan="2" class="text-white text-center align-middle table-dark">
                                                    Keterangan</th>
                                            </tr>
                                            <tr class="text-xs">
                                                <th class="text-white text-center align-middle table-dark">HR</th>
                                                {{-- <th class="text-white text-center align-middle table-dark">KM</th> --}}
                                                <th class="text-white text-center align-middle table-dark">Rate</th>
                                                <th class="text-white text-center align-middle table-dark">Jumlah</th>
                                                <th class="text-white text-center align-middle table-dark">HR</th>
                                                {{-- <th class="text-white text-center align-middle table-dark">KM</th> --}}
                                                <th class="text-white text-center align-middle table-dark">Rate</th>
                                                <th class="text-white text-center align-middle table-dark">Jam Keluar</th>
                                                {{-- <th class="text-white text-center align-middle table-dark">F&B</th> --}}
                                                <th class="text-white text-center align-middle table-dark">Laundry</th>
                                                {{-- <th class="text-white text-center align-middle table-dark">Lain-lain</th> --}}
                                                <th class="text-white text-center align-middle table-dark">Total</th>
                                                <th class="text-white text-center align-middle table-dark">Cash</th>
                                                <th class="text-white text-center align-middle table-dark">Card</th>
                                                <th class="text-white text-center align-middle table-dark">Piutang</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $totalOrg = 0;
                                            $sumTotalHari = 0;
                                            $sumRateCheckout = 0;
                                            $sumJumlah = 0;
                                            $sumJumlahCash = 0;
                                            $sumJumlahNonCash = 0;
                                            $sumTotalLaundry = 0;
                                            $sumBesarTransaksi = 0;
                                        @endphp
                                        <tbody>
                                            @php $no1 = 1; @endphp
                                            @foreach ($checkinCheckoutTransactions as $item)
                                                @if ($item->tabel_referensi == 'checkins')
                                                    <tr class="text-xs">
                                                        <td style="max-width: 10px; width: 10px;">{{ $no1++ }}</td>
                                                        <td>{{ $item->room_no ?? '-' }}</td>
                                                        <td>{{ $item->room_type ?? '-' }}</td>
                                                        <td>{{ $item->room_status ?? '-' }}</td>
                                                        <td>{{ $item->name_guest ?? '-' }}</td>
                                                        <td>{{ $item->chanel_checkin ?? '-' }}</td>
                                                        <td>T</td>
                                                        <td>
                                                            @php
                                                                $totalHari =
                                                                    $item->date_checkin && $item->date_checkout
                                                                        ? \Carbon\Carbon::parse(
                                                                            $item->date_checkin,
                                                                        )->diffInDays(
                                                                            \Carbon\Carbon::parse($item->date_checkout),
                                                                        )
                                                                        : 0;
                                                                $sumTotalHari += $totalHari;
                                                            @endphp
                                                            {{ $totalHari }}
                                                        </td>
                                                        <td>{{ $item->date_checkin ?? '-' }}</td>
                                                        <td>{{ $item->time_checkin ?? '-' }}</td>
                                                        <td>1</td>
                                                        <td>
                                                            @php
                                                                $org = $item->guest_adult + $item->guest_kids;
                                                                $totalOrg += $org;
                                                            @endphp
                                                            {{ $org ?? '0' }}
                                                        </td>
                                                        <td>1</td>
                                                        <td>
                                                            @php
                                                                $sumRateCheckout += $item->room_price;
                                                            @endphp
                                                            {{ $item->room_price ? 'Rp. ' . number_format($item->room_price, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $hargaKamar = $totalHari * $item->room_price;
                                                                $jumlah = $hargaKamar + $item->total_laundry;
                                                                $sumJumlah += $jumlah;

                                                                $sumBesarTransaksi += $item->besar_transaksi;

                                                                if ($item->jenis_transaksi == 'cash') {
                                                                    $sumJumlahCash += $item->besar_transaksi;
                                                                } else {
                                                                    $sumJumlahNonCash += $item->besar_transaksi;
                                                                }
                                                            @endphp
                                                            {{ $jumlah ? 'Rp. ' . number_format($jumlah, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>{{ $totalHari }}</td>
                                                        <td>{{ $item->room_price ? 'Rp. ' . number_format($item->room_price, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>{{ $item->time_checkout ?? '-' }}</td>
                                                        <td>
                                                            {{ $item->total_laundry ? 'Rp. ' . number_format($item->total_laundry, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>{{ $item->besar_transaksi ? 'Rp. ' . number_format($item->besar_transaksi, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>
                                                            @if ($item->jenis_transaksi == 'cash')
                                                                {{ $item->besar_transaksi ? 'Rp. ' . number_format($item->besar_transaksi, 0, ',', '.') : '-' }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->jenis_transaksi != 'cash')
                                                                {{ $item->besar_transaksi ? 'Rp. ' . number_format($item->besar_transaksi, 0, ',', '.') : '-' }}
                                                            @endif
                                                        </td>
                                                        <td>0</td>
                                                        <td>{{ $item->keterangan_transaksi ?? '-' }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            {{-- <tr class="text-xs">
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
                                            </tr> --}}
                                        </tbody>
                                        @php
                                            $totalCheckins = $checkinCheckoutTransactions
                                                ->where('tabel_referensi', 'checkins')
                                                ->count();
                                        @endphp
                                        <tfoot>
                                            <tr>
                                                <td colspan="28" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs table-warning">
                                                <td colspan="4" class="font-weight-bold text-center">Total Pendapatan
                                                    Hari ini</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $totalCheckins ?? '0' }}</td>
                                                <td>{{ $totalOrg ?? '0' }}</td>
                                                <td>{{ $totalCheckins ?? '0' }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $sumTotalHari ?? '0' }}</td>
                                                <td>{{ $sumRateCheckout ? 'Rp. ' . number_format($sumRateCheckout, 0, ',', '.') : '-' }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $sumBesarTransaksi ? 'Rp. ' . number_format($sumBesarTransaksi, 0, ',', '.') : '-' }}
                                                </td>
                                                <td>{{ $sumJumlahCash ? 'Rp. ' . number_format($sumJumlahCash, 0, ',', '.') : '-' }}
                                                </td>
                                                <td>{{ $sumJumlahNonCash ? 'Rp. ' . number_format($sumJumlahNonCash, 0, ',', '.') : '-' }}
                                                </td>
                                                <td>0</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="24" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="17" style="height: 10px; background-color: #f8f9fa;"></td>
                                                @php
                                                    $totalHarga = $otherTransactions
                                                        ->where('tabel_referensi', 'other_transactions')
                                                        ->sum('harga');
                                                @endphp
                                                <td colspan="2" style="height: 10px;"
                                                    class="font-weight-bold align-middle table-warning">Jumlah Pengeluaran
                                                </td>
                                                <td style="height: 10px;" class="align-middle table-warning">
                                                    {{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}
                                                </td>
                                                <td style="height: 10px;" class="align-middle table-warning">
                                                    {{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}
                                                </td>
                                                <td colspan="3" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="17" style="height: 10px; background-color: #f8f9fa;"></td>
                                                <td colspan="2" style="height: 10px;"
                                                    class="font-weight-bold align-middle table-warning">Jumlah di Setor</td>
                                                <td style="height: 10px;" class="align-middle table-warning">
                                                    @php
                                                        $jumlahSetor = $sumBesarTransaksi - $totalHarga;
                                                        $jumlahSetor2 = $sumJumlahCash - $totalHarga;
                                                    @endphp
                                                    {{ $jumlahSetor ? 'Rp. ' . number_format($jumlahSetor, 0, ',', '.') : 'Rp. 0' }}
                                                </td>
                                                <td style="height: 10px;" class="align-middle table-warning">
                                                    {{ $jumlahSetor2 ? 'Rp. ' . number_format($jumlahSetor2, 0, ',', '.') : '-' }}
                                                </td>
                                                <td style="height: 10px;" class="align-middle table-warning">
                                                    {{ $sumJumlahNonCash ? 'Rp. ' . number_format($sumJumlahNonCash, 0, ',', '.') : '-' }}
                                                </td>
                                                <td style="height: 10px;" class="align-middle table-warning">0</td>
                                                <td style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    {{-- Pengeluaran --}}
                                    <div class="row my-5 text-sm">
                                        <div class="col-6">
                                            <p class="font-weight-bold mb-0">Pengeluaran</p>
                                            <table class="table table-bordered" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr class="text-xs">
                                                        <th class="text-white text-center align-middle table-dark">No</th>
                                                        <th class="text-white text-center align-middle table-dark">Item
                                                        </th>
                                                        <th class="text-white text-center align-middle table-dark">Jumlah
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no2 = 1; @endphp
                                                    @foreach ($otherTransactions as $other)
                                                        @if ($other->tabel_referensi == 'other_transactions')
                                                            <tr class="text-xs">
                                                                <td style="max-width: 10px; width: 10px;">
                                                                    {{ $no2++ }}</td>
                                                                <td>{{ $other->item }}</td>
                                                                <td>{{ $other->harga ? 'Rp. ' . number_format($other->harga, 0, ',', '.') : '-' }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3"
                                                            style="height: 10px; background-color: #f8f9fa;"></td>
                                                    </tr>
                                                    <tr class="text-xs table-warning">
                                                        <td colspan="2" class="font-weight-bold text-center">Total</td>
                                                        <td>{{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}
                                                        </td>
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
