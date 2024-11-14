<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Welfare Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .header h2, .header h3 {
            margin: 0;
        }
        .section {
            margin-top: 20px;
            padding: 10px;
        }
        .section-title {
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
        .sub-section {
            margin-top: 10px;
        }
        .sub-section-title {
            font-weight: bold;
            display: inline-block;
            width: 30%; /* Adjust label width */
            vertical-align: top;
        }
        .sub-section-content {
            display: inline-block;
            width: 65%; /* Adjust content width */
            vertical-align: top;
        }
        .two-column {
            margin-top: 10px;
        }
        .sub-section-left, .sub-section-right {
            display: inline-block;
            width: 48%; /* Ensure two items per row */
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Republic of the Philippines</h2>
            <h3>Department of Social Welfare</h3>
        </div>

        <div class="section">
            <div class="section-title">Donation Report</div>

            <div class="two-column">
                <div class="sub-section-left">
                    <div class="sub-section">
                        <div class="sub-section-title">Donor Name:</div>
                        <div class="sub-section-content">{{$datas['fullname']}}</div>
                    </div>
                    <div class="sub-section">
                        <div class="sub-section-title">Contact No.:</div>
                        <div class="sub-section-content">{{$datas['contactno']}}</div>
                    </div>
                    <div class="sub-section">
                        <div class="sub-section-title">Category Name:</div>
                        <div class="sub-section-content">{{$datas['categoryDesc']}}</div>
                    </div>
                    <div class="sub-section">
                        <div class="sub-section-title">Item Name:</div>
                        <div class="sub-section-content">{{$datas['itemName']}}</div>
                    </div>
                </div>
                <div class="sub-section-right">
                    <div class="sub-section">
                        <div class="sub-section-title">Quantity:</div>
                        <div class="sub-section-content">{{$datas['quantity']}}</div>
                    </div>
                    <div class="sub-section">
                        <div class="sub-section-title">Mode:</div>
                        <div class="sub-section-content">{{$datas['donationModeDesc']}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
