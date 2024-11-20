<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin: 0 auto; 
        }
        .report-table td{
            border: 1px solid black; 
            padding: 8px;
            text-align: left;
        }
        th {
            padding: 10px; 
            font-weight: bold;
            font-size: 18px;
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <table class="report-table">
        <tr>
            <th colspan="2">DONATION REPORT</th>
        </tr>
        <tr>
            <td style="width: 50%;"><strong>Name: </strong>{{ $datas['fullname'] }}</td>
            <td style="width: 50%;"><strong>Contact No.: </strong>{{ $datas['contactno'] }}</td>
        </tr>
        @if($type == 1)
            <tr>
                <td><strong>Donated Amount: </strong>{{ $datas['amount'] }}</td>
                <td><strong>Mode: </strong>{{ $datas['donationModeDesc'] }}</td>
            </tr>
        @elseif($type == 2)
            <tr>
                <td><strong>Category: </strong>{{ $datas['categoryDesc'] }}</td>
                <td><strong>Item Name: </strong>{{ $datas['itemName'] }}</td>
            </tr>
            <tr>
                <td><strong>Quantity: </strong>{{ $datas['quantity'] }}</td>
                <td><strong>Mode: </strong>{{ $datas['donationModeDesc'] }}</td>
            </tr>
        @endif
        <tr>
            <td colspan="2"><strong>Date: </strong>{{ \Carbon\Carbon::parse($datas['created_at'])->format('F j, Y') }}</td>
        </tr>
    </table>
</body>
</html>
