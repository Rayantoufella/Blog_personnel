<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Créer un article — Blog personnel</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>A</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:      #A855F7;
      --accent-rose: #EC4899;
      --accent-cyan: #06B6D4;
      --text-1: #F5F5FA;
      --text-2: #9CA3AF;
      --text-3: #6B7280;
      --green:  #10F5A0;
      --amber:  #FBBF24;
      --red:    #EF4444;
      --bg:     #0A0118;
      --glass:  rgba(255,255,255,0.055);
      --border: rgba(255,255,255,0.09);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-1);
      background: var(--bg);
      background-image:
        radial-gradient(ellipse 75% 55% at 80% 0%,   #1A0B2E 0%, transparent 65%),
        radial-gradient(ellipse 55% 45% at 5%  90%,  #0D0D1F 0%, transparent 55%),
        radial-gradient(ellipse 100% 100% at 50% 50%, #0A0118 0%, #0D0D1F 100%);
      min-height: 100vh;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
    }

    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.025) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none; z-index: 0;
    }

    .orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; filter: blur(130px); }
    .orb-1 { width: 560px; height: 560px; background: #A855F7; top: -130px; left: -100px; opacity: 0.28; animation: f1 24s ease-in-out infinite; }
    .orb-2 { width: 400px; height: 400px; background: #EC4899; bottom: 0; right: -60px; opacity: 0.2; animation: f2 19s ease-in-out infinite; }
    @keyframes f1 { 0%,100%{transform:translate(0,0)} 40%{transform:translate(35px,-45px)} 70%{transform:translate(-18px,28px)} }
    @keyframes f2 { 0%,100%{transform:translate(0,0)} 35%{transform:translate(-28px,-20px)} 65%{transform:translate(18px,16px)} }

    .glass {
      background: rgba(255,255,255,0.055);
      backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 16px;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
    }

    .navbar {
      position: sticky; top: 0; z-index: 200;
      background: rgba(10,1,24,0.82);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      padding: 0 32px; height: 60px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .logo-text { font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:16px; color:var(--text-1); }
    .logo-text span { color:var(--accent); }
    .nav-link { color: var(--text-2); text-decoration: none; font-size: 14px; transition: color .25s; }
    .nav-link:hover { color: var(--accent); }

    .container {
      position: relative;
      z-index: 10;
      max-width: 800px;
      margin: 40px auto;
      padding: 0 24px;
    }

    .form-header {
      margin-bottom: 32px;
    }

    .form-header h1 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 8px;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .form-header p {
      color: var(--text-2);
      font-size: 14px;
    }

    .form-card {
      background: var(--glass);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px;
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-1);
      margin-bottom: 8px;
      text-transform: capitalize;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px 16px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 8px;
      color: var(--text-1);
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      transition: all .2s;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--accent);
      background: rgba(255,255,255,0.06);
      box-shadow: 0 0 0 3px rgba(168,85,247,0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 200px;
      font-size: 14px;
      line-height: 1.6;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .error-msg {
      color: var(--red);
      font-size: 13px;
      margin-top: 6px;
    }

    .errors-box {
      background: rgba(239,68,68,0.1);
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 8px;
      padding: 16px;
      margin-bottom: 24px;
    }

    .errors-box ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .errors-box li {
      color: var(--red);
      font-size: 14px;
      margin-bottom: 6px;
    }

    .form-actions {
      display: flex;
      gap: 12px;
      margin-top: 32px;
    }

    button {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      color: white;
      flex: 1;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(168,85,247,0.3);
    }

    .btn-secondary {
      background: rgba(255,255,255,0.08);
      color: var(--text-2);
      border: 1px solid var(--border);
    }

    .btn-secondary:hover {
      background: rgba(255,255,255,0.12);
      color: var(--text-1);
    }

    a.btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--accent);
      text-decoration: none;
      font-size: 14px;
      margin-bottom: 16px;
      transition: color .2s;
    }

    a.btn-back:hover {
      color: var(--accent-rose);
    }

    @media (max-width: 640px) {
      .form-card { padding: 24px; }
      .form-row { grid-template-columns: 1fr; }
      .form-header h1 { font-size: 24px; }
    }
  </style>
</head>
<body>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo-text">Blog <span>Personnel</span></div>
    <div style="display: flex; gap: 16px;">
      <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
      <a href="{{ route('auth.logout') }}" class="nav-link">Déconnexion</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <a href="{{ route('dashboard') }}" class="btn-back">← Retour au dashboard</a>

    <div class="form-header">
      <h1>Créer un nouvel article</h1>
      <p>Partagez vos réflexions avec le monde</p>
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

    <div class="form-card">
      <form method="POST" action="{{ route('articles.store') }}">
        @csrf

        <div class="form-group">
          <label for="titre">Titre de l'article</label>
          <input type="text" id="titre" name="titre" placeholder="Ex: Comment apprendre Laravel..." required value="{{ old('titre') }}">
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
                <option value="{{ $cat->id }}" @if (old('category_id') == $cat->id) selected @endif>{{ $cat->nom }}</option>
              @endforeach
            </select>
            @error('category_id')
              <div class="error-msg">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
              <option value="brouillon" @if (old('statut') == 'brouillon') selected @endif>Brouillon</option>
              <option value="publie" @if (old('statut') == 'publie') selected @endif>Publié</option>
            </select>
            @error('statut')
              <div class="error-msg">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="contenu">Contenu</label>
          <textarea id="contenu" name="contenu" placeholder="Écrivez votre article ici..." required>{{ old('contenu') }}</textarea>
          @error('contenu')
            <div class="error-msg">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Créer l'article</button>
          <a href="{{ route('dashboard') }}" class="btn-secondary" style="display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
