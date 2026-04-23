<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord</title>
</head>
<body>
    <div>
        <h1>Mes Articles</h1>
        
        <a href="{{ route('articles.create') }}">+ Créer un article</a>
        
        @if ($articles->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->titre }}</td>
                            <td>{{ $article->category->nom }}</td>
                            <td>{{ ucfirst($article->statut) }}</td>
                            <td>
                                <a href="{{ route('articles.edit', $article) }}">Modifier</a>
                                
                                <form method="POST" action="{{ route('articles.delete', $article) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Êtes-vous sûr ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun article. <a href="{{ route('articles.create') }}">Créer un article</a></p>
        @endif
        
        <a href="{{ route('auth.logout') }}">Se déconnecter</a>
    </div>
</body>
</html>