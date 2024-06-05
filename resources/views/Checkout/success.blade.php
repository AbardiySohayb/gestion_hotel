<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succès de la Réservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .card-body {
            background-color: #e9ecef;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Réservation Réussie</h3>
            </div>
            <div class="card-body">
                <p>Merci pour votre réservation.</p>
                <p><strong>Détails de la réservation:</strong></p>
                <p>{{ $reservationDetails }}</p>
                <p><strong>Montant Total:</strong> ${{ number_format($totalAmount / 100, 2) }}</p>
                <p><strong>Dates:</strong> du {{ $startDate }} au {{ $endDate }}</p>

                <a href="{{ route('download.invoice', ['id' => $reservation->id]) }}" class="btn btn-primary">
                    Télécharger la Facture
                </a>
                <a href="{{ url('/home') }}" class="btn btn-secondary ml-2">
                    Retourner à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
