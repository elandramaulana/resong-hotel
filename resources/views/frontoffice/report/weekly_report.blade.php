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
                                    <span class="font-weight-bold">{{ \Carbon\Carbon::parse(request('date') ?? now())->isoFormat('dddd') }},</span>
                                    <span class="font-weight-bold">{{ \Carbon\Carbon::parse(request('date') ?? now())->isoFormat('D MMMM Y') }}</span>
                                </div>
                                <form method="GET" action="{{ route('weekly.report') }}" class="d-flex align-items-center">
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
                                                <th colspan="3" class="text-white text-center align-middle bg-dark">Stay (Hari) (Chek In)</th>
                                                <th colspan="4" class="text-white text-center align-middle bg-dark">Pendapatan (Chek Out) (Rp)</th>
                                                <th colspan="3" class="text-white text-center align-middle bg-dark">Pembayaran</th>
                                                <th rowspan="2" class="text-white text-center align-middle bg-dark">Keterangan</th>
                                            </tr>
                                            <tr class="text-xs">
                                                <th class="text-white text-center align-middle bg-dark">HR</th>
                                                {{-- <th class="text-white text-center align-middle bg-dark">KM</th> --}}
                                                <th class="text-white text-center align-middle bg-dark">Rate</th>
                                                <th class="text-white text-center align-middle bg-dark">Jumlah</th>
                                                <th class="text-white text-center align-middle bg-dark">HR</th>
                                                {{-- <th class="text-white text-center align-middle bg-dark">KM</th> --}}
                                                <th class="text-white text-center align-middle bg-dark">Rate</th>
                                                <th class="text-white text-center align-middle bg-dark">Jam Keluar</th>
                                                {{-- <th class="text-white text-center align-middle bg-dark">F&B</th>
                                                <th class="text-white text-center align-middle bg-dark">Laundry</th>
                                                <th class="text-white text-center align-middle bg-dark">Lain-lain</th> --}}
                                                <th class="text-white text-center align-middle bg-dark">Total</th>
                                                <th class="text-white text-center align-middle bg-dark">Cash</th>
                                                <th class="text-white text-center align-middle bg-dark">Card</th>
                                                <th class="text-white text-center align-middle bg-dark">Piutang</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $totalOrg = 0;
                                            $sumTotalHari = 0;
                                            $sumRateCheckout = 0;
                                            $sumJumlah = 0;
                                            $sumJumlahCash = 0;
                                            $sumJumlahNonCash = 0;
                                        @endphp
                                        <tbody>
                                            @php $no1 = 1; @endphp
                                            @foreach ($checkinCheckoutTransactions as $item)
                                                @if ($item->tabel_referensi == 'checkins')
                                                    <tr class="text-xs">
                                                        <td style="max-width: 10px; width: 10px;">{{ $no1 ++ }}</td>
                                                        <td>{{ $item->room_no ?? '-'  }}</td>
                                                        <td>{{ $item->room_type ?? '-' }}</td>
                                                        <td>{{ $item->room_status ?? '-' }}</td>
                                                        <td>{{ $item->name_guest ?? '-' }}</td>
                                                        <td>{{ $item->chanel_checkin ?? '-' }}</td>
                                                        <td>T</td>
                                                        <td>
                                                            @php
                                                                $totalHari = ($item->date_checkin && $item->date_checkout)
                                                                    ? \Carbon\Carbon::parse($item->date_checkin)->diffInDays(\Carbon\Carbon::parse($item->date_checkout))
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
                                                                $jumlah = $totalHari * $item->room_price;
                                                                $sumJumlah += $jumlah;

                                                                 // Pisahkan total berdasarkan metode pembayaran
                                                                if ($item->payment_method == 'Cash') {
                                                                    $sumJumlahCash += $jumlah;
                                                                } else {
                                                                    $sumJumlahNonCash += $jumlah;
                                                                }
                                                            @endphp
                                                            {{ $jumlah ? 'Rp. ' . number_format($jumlah, 0, ',', '.') : '-' }}
                                                        </td>
                                                        <td>{{ $totalHari }}</td>
                                                        <td>{{ $item->room_price ? 'Rp. ' . number_format($item->room_price, 0, ',', '.') : '-' }}</td>
                                                        <td>{{ $item->time_checkout ?? '-' }}</td>
                                                        <td>{{ $jumlah ? 'Rp. ' . number_format($jumlah, 0, ',', '.') : '-' }}</td>
                                                        <td>
                                                            @if ($item->payment_method == 'Cash')
                                                                {{ $jumlah ? 'Rp. ' . number_format($jumlah, 0, ',', '.') : '-' }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->payment_method != 'Cash')
                                                                {{ $jumlah ? 'Rp. ' . number_format($jumlah, 0, ',', '.') : '-' }}
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
                                            $totalCheckins = $checkinCheckoutTransactions->where('tabel_referensi', 'checkins')->count();
                                        @endphp
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
                                                <td>{{ $totalCheckins ?? '0' }}</td>
                                                <td>{{ $totalOrg ?? '0' }}</td>
                                                <td>{{ $totalCheckins ?? '0' }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $sumTotalHari ?? '0' }}</td>
                                                <td>{{ $sumRateCheckout ? 'Rp. ' . number_format($sumRateCheckout, 0, ',', '.') : '-' }}</td>
                                                <td></td>
                                                <td>{{ $sumJumlah ? 'Rp. ' . number_format($sumJumlah, 0, ',', '.') : '-' }}</td>
                                                <td>{{ $sumJumlahCash ? 'Rp. ' . number_format($sumJumlahCash, 0, ',', '.') : '-' }}</td>
                                                <td>{{ $sumJumlahNonCash ? 'Rp. ' . number_format($sumJumlahNonCash, 0, ',', '.') : '-' }}</td>
                                                <td>0</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="23" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="16" style="height: 10px; background-color: #f8f9fa;"></td>
                                                @php
                                                    $totalHarga = $otherTransactions->where('tabel_referensi', 'other_transactions')->sum('harga');
                                                @endphp
                                                <td colspan="2" style="height: 10px;" class="font-weight-bold align-middle">Jumlah Pengeluaran</td>
                                                <td style="height: 10px;" class="align-middle">{{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}</td>
                                                <td style="height: 10px;" class="align-middle">{{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}</td>
                                                <td colspan="3" style="height: 10px; background-color: #f8f9fa;"></td>
                                            </tr>
                                            <tr class="text-xs">
                                                <td colspan="16" style="height: 10px; background-color: #f8f9fa;"></td>
                                                <td colspan="2" style="height: 10px;" class="font-weight-bold align-middle">Jumlah di Setor</td>
                                                <td style="height: 10px;" class="align-middle">
                                                    @php
                                                        $jumlahSetor = $sumJumlah - $totalHarga;
                                                        $jumlahSetor2 = $sumJumlahCash - $totalHarga;
                                                    @endphp
                                                    {{ $jumlahSetor ? 'Rp. ' . number_format($jumlahSetor, 0, ',', '.') : 'Rp. 0' }}
                                                </td>
                                                <td style="height: 10px;" class="align-middle">{{ $jumlahSetor2 ? 'Rp. ' . number_format($jumlahSetor2, 0, ',', '.') : '-' }}</td>
                                                <td style="height: 10px;" class="align-middle">{{ $sumJumlahNonCash ? 'Rp. ' . number_format($sumJumlahNonCash, 0, ',', '.') : '-' }}</td>
                                                <td style="height: 10px;" class="align-middle">0</td>
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
                                                    @php $no2 = 1; @endphp
                                                    @foreach ($otherTransactions as $other)
                                                        @if ($other->tabel_referensi == 'other_transactions')
                                                            <tr class="text-xs">
                                                                <td style="max-width: 10px; width: 10px;">{{ $no2++ }}</td>
                                                                <td>{{ $other->item }}</td>
                                                                <td>{{ $other->harga ? 'Rp. ' . number_format($other->harga, 0, ',', '.') : '-' }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" style="height: 10px; background-color: #f8f9fa;"></td>
                                                    </tr>
                                                    <tr class="text-xs">
                                                        <td colspan="2" class="font-weight-bold text-center">Total</td>
                                                        <td>{{ $totalHarga ? 'Rp. ' . number_format($totalHarga, 0, ',', '.') : 'Rp. 0' }}</td>
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
