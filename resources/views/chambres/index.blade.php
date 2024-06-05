<!-- resources/views/chambres/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Chambres</title>
</head>
<body>
    <h1>Liste des Chambres</h1>
    <a href="{{ route('chambres.create') }}">Ajouter une nouvelle chambre</a>
    <ul>
        @foreach ($chambres as $chambre)
            <li>{{ $chambre->numero }} ({{ $chambre->chambreType->type }}) - @if($chambre->disponible) Disponible @else Indisponible @endif
                <a href="{{ route('chambres.edit', $chambre) }}">Éditer</a>
                <form action="{{ route('chambres.destroy', $chambre) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
