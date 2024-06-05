<!DOCTYPE html>
<html>
<head>
    <title>Facture de réservation</title>
</head>
<body>
    <h1>Facture de réservation</h1>
    <p>Merci pour votre réservation. Vous trouverez ci-joint la facture de votre réservation.</p>
    <p>Détails de la réservation :</p>
    <ul>
        <li>Date de début : {{ $reservation->date_debut }}</li>
        <li>Date de fin : {{ $reservation->date_fin }}</li>
        <li>Montant total : {{ $totalAmount }} USD</li>
    </ul>
    <p>Nous espérons que vous apprécierez votre séjour.</p>
</body>
</html>
