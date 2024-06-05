<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            background-color: #ffcccc;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            color: #333;
            position: relative;
        }
        .thank-you {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Facture</h1>
        <table>
            <tr>
                <th>Détail</th>
                <th>Information</th>
            </tr>
            <tr>
                <td>Détails de la réservation</td>
                <td>{{ $reservationDetails }}</td>
            </tr>
            <tr>
                <td>Montant Total</td>
                <td>${{ number_format($totalAmount / 100, 2) }}</td>
            </tr>
            <tr>
                <td>Dates</td>
                <td>du {{ $startDate }} au {{ $endDate }}</td>
            </tr>
        </table>
        <div class="total">
            <p>Total: ${{ number_format($totalAmount / 100, 2) }}</p>
        </div>
        <div class="thank-you">
            <p>Merci pour votre réservation!</p>
        </div>
        <div class="footer">
            <p>Facture</p>
        </div>
    </div>
</body>
</html>
