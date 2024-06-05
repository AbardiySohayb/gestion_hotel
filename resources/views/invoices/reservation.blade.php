<!DOCTYPE html>
<html>
<head>
    <title>Facture de Réservation</title>
</head>
<body>
    <h1>Facture de Réservation</h1>
    <p>Nom: {{ $reservation->user->name }}</p>
    <p>Email: {{ $reservation->user->email }}</p>
    <p>Chambre: {{ $reservation->room_type }}</p>
    <p>Date de début: {{ $reservation->start_date }}</p>
    <p>Date de fin: {{ $reservation->end_date }}</p>
    <p>Montant: {{ $reservation->amount }} Ksh</p>
</body>
</html>
