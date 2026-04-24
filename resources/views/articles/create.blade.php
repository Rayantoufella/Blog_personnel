@extends('layouts.app')

@section('title', 'Créer un article — Blog personnel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
@endsection

@section('content')
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo-text">Blog <span>Personnel</span></div>
        <div style="display: flex; gap: 16px;">
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
@endsection

@section('js')
    <script src="{{ asset('js/articles.js') }}"></script>
@endsection
