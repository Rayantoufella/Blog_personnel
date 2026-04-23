<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'article</title>
</head>
<body>
    <div>
        <h1>Modifier l'article</h1>
        
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('articles.update', $article) }}">
            @csrf
            @method('PUT')
            
            <div>
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" value="{{ $article->titre }}" required>
            </div>
            
            <div>
                <label for="category_id">Catégorie :</label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @if ($cat->id === $article->category_id) selected @endif>{{ $cat->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="contenu">Contenu :</label>
                <textarea id="contenu" name="contenu" required rows="10">{{ $article->contenu }}</textarea>
            </div>
            
            <div>
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="brouillon" @if ($article->statut === 'brouillon') selected @endif>Brouillon</option>
                    <option value="publie" @if ($article->statut === 'publie') selected @endif>Publié</option>
                </select>
            </div>
            
            <button type="submit">Mettre à jour</button>
        </form>
        
        <a href="{{ route('dashboard') }}">Retour au dashboard</a>
    </div>
</body>
</html>
