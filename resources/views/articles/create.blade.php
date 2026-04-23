<!DOCTYPE html>
<html>
<head>
    <title>Créer un article</title>
</head>
<body>
    <div>
        <h1>Créer un article</h1>
        
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('articles.store') }}">
            @csrf
            
            <div>
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            
            <div>
                <label for="category_id">Catégorie :</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="contenu">Contenu :</label>
                <textarea id="contenu" name="contenu" required rows="10"></textarea>
            </div>
            
            <div>
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="brouillon">Brouillon</option>
                    <option value="publie">Publié</option>
                </select>
            </div>
            
            <button type="submit">Créer l'article</button>
        </form>
        
        <a href="{{ route('dashboard') }}">Retour au dashboard</a>
    </div>
</body>
</html>