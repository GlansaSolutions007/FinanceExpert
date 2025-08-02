<!DOCTYPE html>
<html>
<head>
    <title>Payment Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .invoice-header {
            text-align: center;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div style="text-align: center;">
            <h1> Fin Experts</h1>
            <p style="border-bottom: 1px solid black;"> 6-3-661/B/2, Plot No 78, 2ed, SANGGTH NAGAR, SOMAJIGUDA, HYDERABAD</p>
        </div>
        <div class="invoice-header">
            <h3>Payment Invoice</h3>
        </div>
        <div class="invoice-items">
            
            <table>
                <tr>
                    <td>PV No:</td>
                    <td style="border-bottom: 1px solid black;width:100px;">01</td>
                    <td style="padding-left: 300px;">Dated:</td>
                    <td style="border-bottom: 1px solid black;width:100px;">27/07/2023</td>
                </tr>
                <tr>
                    <td style="width: 200PX;">Sum of Rupees:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">10,000 &#8377;</td>
                </tr>
                <tr>
                    <td>In Words:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">Ten Thousand Rupees Only</td>
                </tr>
                <tr>
                    <td>Paid To:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">Pradip Kathar</td>
                </tr>
                <tr >
                    <td>On Account of: </td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">0000123456789</td>
                </tr>
                <tr>
            </table>
            <div style="display: flex;justify-content: space-between;margin-top: 50px;">
                <p style="border-bottom: 1px solid black;margin-left: 50px;">Prepared By</p>
                <p style="border-bottom: 1px solid black;margin-right: 50px;">Recipient's Name</p>
            </div>
        </div>
    </div>
</body>
</html>
