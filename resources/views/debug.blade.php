<!DOCTYPE html>
<html>
<head>
    <title>Debug Information</title>
</head>
<body>
    <h1>Debug Information</h1>
    @if(isset($numero))
        <p>La chambre avec le numéro {{ $numero }} n'a pas été trouvée dans la base de données.</p>
    @endif
    @if(isset($error))
        <p>Erreur : {{ $error }}</p>
    @endif
    <p>Veuillez vérifier les informations et réessayer.</p>
</body>
</html>
