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
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            padding-bottom: 10px;
        }
        .logo {
            width: 100px; /* Adjust logo size */
            height: auto;
        }
        .info {
            margin-top: 20px;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }
        .footer {
            margin-top: 20px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            margin-right: 40px; /* Added right margin */
        }
        .subtotal {
            text-align: right;
            margin-top: 10px;
            margin-right: 40px; /* Added right margin */
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
    <img class="watermark" src="{{ public_path('img/logo.png') }}" alt="Watermark">
    <div class="container">
        <div class="header">
            <div>PAID OUT RECEIPT</div>
            <img class="logo" src="{{ $logoPath }}" alt="Company Logo">
        </div>
        <div class="info">
            <p><strong>Guest Name:</strong>{{ $logoPath }} _______________________</p>
            <p><strong>Date:</strong> ___________ <strong>Time:</strong> ___________ <strong>Confirmation No.:</strong> ___________ <strong>Cashier:</strong> ___________</p>
        </div>
        <table>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div class="subtotal">
            <strong>Subtotal:</strong> _______________________
        </div>
        <p class="footer">Send Payment To:</p>
        <p>Bank: Bank Rakyat Indonesia (BRI)</p>
        <p>Account Name: PT RESONG CIPTA MANDIRI</p>
        <p>Account No.: _______________________</p>
        <p><em>*All item prices are inclusive of tax.</em></p>
        <div class="signature">
            <p>________________________</p>
            <p><strong>Signature</strong></p>
        </div>
    </div>
</body>
</html>
