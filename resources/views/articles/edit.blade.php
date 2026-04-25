<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modifier l'article — Blog personnel</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>A</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/articles.css') }}" />
</head>
<body>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo-text">Blog <span>Personnel</span></div>
    <div style="display: flex; gap: 16px; align-items: center;">
      <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
      <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;padding:0;">Déconnexion</button>
      </form>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <a href="{{ route('dashboard') }}" class="btn-back">← Retour au dashboard</a>

    <div class="form-header">
      <h1>Modifier l'article</h1>
      <p>Mettez à jour le contenu de votre article</p>
    </div>

    @if ($errors->any())
      <div class="errors-box">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div class="errors-box" style="border-color: rgba(16,245,160,0.4); background: rgba(16,245,160,0.08);">
        <p style="color: #10F5A0; margin: 0;">{{ session('success') }}</p>
      </div>
    @endif

    <div class="form-card">
      <form method="POST" action="{{ route('articles.update', $article) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="titre">Titre de l'article</label>
          <input type="text" id="titre" name="titre" placeholder="Ex: Comment apprendre Laravel..." required value="{{ old('titre', $article->titre) }}">
          @error('titre')
            <div class="error-msg">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" required>
              <option value="">-- Choisir une catégorie --</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @if (old('category_id', $article->category_id) == $cat->id) selected @endif>{{ $cat->nom }}</option>
              @endforeach
            </select>
            @error('category_id')
              <div class="error-msg">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
              <option value="brouillon" @if (old('statut', $article->statut) == 'brouillon') selected @endif>Brouillon</option>
              <option value="publie" @if (old('statut', $article->statut) == 'publie') selected @endif>Publié</option>
            </select>
            @error('statut')
              <div class="error-msg">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="contenu">Contenu</label>
          <textarea id="contenu" name="contenu" placeholder="Écrivez votre article ici..." required>{{ old('contenu', $article->contenu) }}</textarea>
          @error('contenu')
            <div class="error-msg">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Enregistrer les modifications</button>
          <a href="{{ route('articles.show', $article) }}" class="btn-secondary" style="display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">Voir l'article</a>
          <a href="{{ route('dashboard') }}" class="btn-secondary" style="display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
