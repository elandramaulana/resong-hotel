<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Paid Out Receipt</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .container {
            width: 100%;
            padding: 20px;
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            overflow: hidden;
            clear: both; /* Clear any floats */
        }
        .header {
            font-weight: bold;
            font-size: 18px;
            padding-bottom: 10px;
            width: 100%;
            overflow: hidden; /* Clearfix */
            height: 90px;
        }
        .header .text {
            float: left;  /* Float the text to the left */
            width: 70%;  /* Adjust width as needed */
        }
        .header .logo {
            float: right;  /* Float the logo to the right */
            width: 120px;  /* Adjust the size of the logo */
            height: auto;
            margin-top: -5px;
            margin-right: 20px;
        }
        .info {
            margin-top: 20px;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            margin-top: 20px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            margin-right: 35px;
        }
        .subtotal {
            text-align: right;
            margin-top: 10px;
            margin-right: 35px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            width: 400px;
            height: 400px;
        }
    </style>
</head>
<body>
    {{-- <img class="watermark" src="{{ $logoPath }}" alt="Watermark"> --}}
    <div class="container">
        <div class="header">
            <div class="text">
                <p style="margin: 0px">PAID OUT RECEIPT</p>
                <p style="margin: 0px">RESONG HOTEL</p>
            </div>
            <img class="logo" src="{{ $logoPath }}" alt="Company Logo">
        </div>
        <div class="info">
            <p><strong>Guest Name:</strong> {{ $guest['name_guest'] }}</p>
            <p><strong>Date:</strong> {{ date('j F Y', strtotime(date("Y-m-d"))) }} <strong>Time:</strong> {{ date('H:i:s') }} <strong>Confirmation No.:</strong> ___________ <strong>Cashier:</strong> ___________</p>
        </div>
        <table border="1">
            <tr>
                <th style="width: 25%">Item</th>
                <th style="width: 15%" align="right">Rate</th>
                <th style="width: 15%" align="center">Qty</th>
                <th style="width: 30%">Description</th>
                <th style="width: 15%">Amount</th>
            </tr>
            @php
                $totalAmount = 0;
                $taxConvert = $taxConfig / 100;
            @endphp
            @foreach ($detReceipt as $detail)
                @php
                    $amount = $detail['item_price'] * $detail['item_qty'];
                    if($detail['item_category']=='Rooms'){
                        $item = $detail['item_name'] .
                                ' (' . date('d M Y', strtotime($receipt['date_checkin'])) .
                                ' - ' . date('d M Y', strtotime($receipt['date_checkout'])) .
                                ')';
                    }else{
                        $item = $detail['item_name'];
                    }

                @endphp
                <tr>
                    <td>{{ $item }}</td>
                    <td style="text-align: right">{{ 'Rp. ' . number_format($detail['item_price'], 0, ',', '.') }}</td>
                    <td style="text-align: center">{{ $detail['item_qty'] }}</td>
                    <td>{{ $detail['item_description'] }}</td>
                    <td style="text-align: right">{{ 'Rp.' . number_format($amount, 0, ',', '.') }}</td>
                </tr>

                @php
                    $totalAmount += $amount;
                @endphp
            @endforeach
            <tr>
                <td></td>
                <td style="text-align: right"></td>
                <td style="text-align: center"></td>
                <td></td>
                <td style="text-align: right"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right"></td>
                <td style="text-align: center"></td>
                <td></td>
                <td style="text-align: right"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right"></td>
                <td style="text-align: center"></td>
                <td></td>
                <td style="text-align: right"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right"></td>
                <td style="text-align: center"></td>
                <td></td>
                <td style="text-align: right"></td>
            </tr>
                @php
                    $tax = $totalAmount * $taxConvert;
                    $totalPlusPajak = $totalAmount + $tax;
                @endphp
                <tr>
                    <td colspan="4" style="text-align: left">
                        <strong>Subtotal</strong>
                    </td>
                    <td style="text-align: right">{{'Rp.' . number_format($totalAmount)}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left">
                        <strong>Tax ({{$taxConfig}}%)</strong>
                    </td>
                    <td style="text-align: right">{{'Rp.' . number_format($tax)}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left">
                        <strong>T O T A L (Pajak + Subtotal)</strong>
                    </td>
                    <td style="text-align: right">{{'Rp.' . number_format($totalPlusPajak)}}</td>
                </tr>
        </table>

        <p class="footer">Send Payment To:</p>
        <p>Bank: Bank Rakyat Indonesia (BRI)</p>
        <p>Account Name: PT RESONG CIPTA MANDIRI</p>
        <p>Account No.: _______________________</p>
        <p><em>*All item prices are inclusive of tax.</em></p>
        <div style="text-align:right;" class="signature">
            <p>________________________</p>
            <p style="text-align: right; position: relative; top: -15px; left: -25px"><strong>Signature</strong></p>
        </div>
    </div>
</body>
</html>
