<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 1em;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #5dabff;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .table tfoot td {
            font-weight: bold;
            background-color: #e9ecef;
        }

        #showNameSlip {
            font-size: 1.1em;
            color: #007bff;
            font-weight: bold;
        }

        h1, h2, h3, h4 {
            text-align: center;
            margin: 0;
            padding-bottom: 10px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            table th, table td {
                font-size: 0.9em;
            }

            #showNameSlip {
                font-size: 1em;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Slip Gaji Resong Hotel</h1>
        <div class="row">
            <div class="col-lg-6">
                <table style="width:50%; border-collapse: collapse;">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b id="showNameSlip">{{$karyawan->k_nama}}</b></td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>{{$detailPayroll->periode_payroll}}</td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Komponen</th>
                            <th colspan="2">Jumlah (Rp)</th>
                        </tr>
                        <tr>
                            <th>Pemasukan</th>
                            <th>Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPemasukan = 0;
                            $totalPotongan = 0;
                            $thp = 0;

                            foreach ($payrollComponents as $key => $payrollComponent) {
                                if ($payrollComponent->type_komponen_payroll == 'pendapatan') {
                                    $totalPemasukan += $payrollComponent->besaran_komponen_payroll;
                                } else {
                                    $totalPotongan += $payrollComponent->besaran_komponen_payroll;
                                }
                            }
                            $thp = $totalPemasukan - $totalPotongan;
                        @endphp
                        <tr>
                            <th colspan="4" style="text-align: left">A. Pemasukan</th>
                        </tr>
                        @foreach ($payrollComponents as $key => $payrollComponent)
                            @if ($payrollComponent->type_komponen_payroll == 'pendapatan')
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$payrollComponent->nama_komponen_payroll}}</td>
                                    <td class="text-right
                                    ">{{number_format($payrollComponent->besaran_komponen_payroll, 0, ',', '.')}}</td>
                                    <td class="text-right
                                    ">-</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th colspan="4" style="text-align: left">B. Potongan</th>
                        </tr>
                        @foreach ($payrollComponents as $key => $payrollComponent)
                            @if ($payrollComponent->type_komponen_payroll == 'potongan')
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$payrollComponent->nama_komponen_payroll}}</td>
                                    <td class="text-right
                                    ">-</td>
                                    <td class="text-right
                                    ">{{number_format($payrollComponent->besaran_komponen_payroll, 0, ',', '.')}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-center"><b>Jumlah</b></td>
                            <td class="text-right">{{number_format($totalPemasukan, 0, ',', '.')}}</td>
                            <td class="text-right">{{number_format($totalPotongan, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center"><b>Take Home Pay</b></td>
                            <td class="text-right" colspan="2"><b>{{number_format($thp, 0, ',', '.')}}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

    </div>

</body>
</html>
