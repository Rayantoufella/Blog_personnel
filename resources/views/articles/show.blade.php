@extends('layouts.app')

@section('title', $article->titre . ' — Blog personnel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div id="cg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- NAVBAR -->
    <header class="navbar">
        <a href="{{ route('welcome') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div class="logo-box">B</div>
            <span class="logo-text">Blog<span> personnel</span></span>
        </a>
        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('articles.edit', $article->id) }}" class="btn-primary">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modifier
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Connexion</a>
            @endauth
        </div>
    </header>

    <!-- ARTICLE -->
    <article class="article-container">

        <a href="{{ route('welcome') }}" class="back-link reveal">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Retour au blog
        </a>

        <div class="reveal" style="transition-delay:.05s;">
            <div class="article-meta">
                @if($article->category)
                    <span class="cat-badge">{{ $article->category->nom }}</span>
                @endif
                @php
                    $words = str_word_count(strip_tags($article->contenu));
                    $readMin = max(1, ceil($words / 200));
                @endphp
                <span class="read-time">// {{ $readMin }} min de lecture</span>
            </div>

            <h1 class="article-title">{{ $article->titre }}</h1>

            <div class="article-author">
                <div class="avatar">
                    {{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr(explode(' ', $article->user->name ?? 'U')[1] ?? '', 0, 1)) }}
                </div>
                <div>
                    <div class="author-name">{{ $article->user->name ?? 'Auteur' }}</div>
                    <div class="author-date">
                        @if($article->date_publication)
                            {{ $article->date_publication->translatedFormat('d F Y') }}
                        @else
                            {{ $article->created_at->translatedFormat('d F Y') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="article-content reveal" style="transition-delay:.1s;">
            {!! nl2br(e($article->contenu)) !!}
        </div>

        <div class="article-footer reveal" style="transition-delay:.15s;">
            <a href="{{ route('welcome') }}" class="footer-link">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                Tous les articles
            </a>
            @auth
                <a href="{{ route('articles.edit', $article->id) }}" class="footer-link" style="color:var(--accent);">
                    Modifier cet article
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            @endauth
        </div>
    </article>
@endsection

@section('js')
    <script src="{{ asset('js/show.js') }}"></script>
@endsection
