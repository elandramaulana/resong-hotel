<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<div style="text-align: center">
    <h1>Invoice </h1>
</div>

<table>
    <tr>
        <th>Nama Tamu</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Room</th>
        <th>Price</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<table style="margin-top: 20px">
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
    {{-- @foreach($data['detail_checkout'] as $item)
        <tr>
            <td></td>
            <td></td>
            <td>{{ formatCurrency($item['item_price']) }}</td>
            <td>{{ formatCurrency($item['item_price'] * $item['item_qty']) }}</td>
        </tr>
    @endforeach --}}
    {{-- <tr>
        <th colspan="3" style="text-align: right">Sub Total</th>
        <th>{{ formatCurrency($data['sub_total']) }}</th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: right">Tax</th>
        <th>{{ formatCurrency($data['tax']) }}</th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: right">Total</th>
        <th>{{ formatCurrency($data['total']) }}</th>
    </tr> --}}
</table>

</body>
</html>

