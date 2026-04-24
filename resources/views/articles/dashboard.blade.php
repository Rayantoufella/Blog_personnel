@extends('layouts.app')

@section('title', 'Dashboard — Blog personnel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div id="cg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- NAVBAR -->
    <header class="navbar">
        <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div class="logo-box">B</div>
            <span class="logo-text">Blog<span> personnel</span></span>
        </a>
        <div style="display:flex;align-items:center;gap:10px;">
            <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">Dashboard</span>
            <a href="{{ route('welcome') }}" class="nav-pill">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                Blog public
            </a>
            <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn-icon" title="Déconnexion">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/></svg>
                </button>
            </form>
        </div>
    </header>

    <!-- PAGE -->
    <main class="page">

        <!-- Header -->
        <div class="page-header reveal">
            <div>
                <h1><span class="wave">&#128075;</span> Salut {{ auth()->user()->name }}</h1>
                <p>Voici l&rsquo;&eacute;tat de ton blog aujourd&rsquo;hui &middot; <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">{{ now()->translatedFormat('d F Y') }}</span></p>
            </div>
            <a href="{{ route('articles.create') }}" class="btn-primary">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg>
                Nouvel article
            </a>
        </div>

        <hr class="sep-line" />

        <!-- Stats grid -->
        <div class="stats-grid">
            <!-- Total -->
            <div class="glass stat-card reveal">
                <div class="stat-icon-wrap" style="background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.25);">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#A855F7" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div class="stat-label">Total articles</div>
                <div class="stat-value" style="background:linear-gradient(135deg,#A855F7,#EC4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">{{ $totalArticles }}</div>
                <div class="stat-delta" style="color:var(--green);">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 15l-6-6-6 6"/></svg>
                    +2 cette semaine
                </div>
            </div>

            <!-- Publiés -->
            <div class="glass stat-card reveal" style="transition-delay:0.07s;">
                <div class="stat-icon-wrap" style="background:rgba(16,245,160,0.1);border:1px solid rgba(16,245,160,0.2);">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#10F5A0" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="stat-label">Publiés</div>
                <div class="stat-value" style="color:#10F5A0;">{{ $publishedCount }}</div>
                <div class="stat-delta" style="color:var(--text-3);">
                    <span style="width:7px;height:7px;background:#10F5A0;border-radius:50%;box-shadow:0 0 7px #10F5A0;display:inline-block;animation:blink 2s ease-in-out infinite;"></span>
                    Visibles publiquement
                </div>
            </div>

            <!-- Brouillons -->
            <div class="glass stat-card reveal" style="transition-delay:0.14s;">
                <div class="stat-icon-wrap" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#FBBF24" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div class="stat-label">Brouillons</div>
                <div class="stat-value" style="color:#FBBF24;">{{ $draftCount }}</div>
                <div class="stat-delta" style="color:var(--text-3);">
                    <span style="width:7px;height:7px;background:#FBBF24;border-radius:50%;box-shadow:0 0 7px #FBBF24;display:inline-block;"></span>
                    En cours d&rsquo;&eacute;criture
                </div>
            </div>

            <!-- Vues -->
            <div class="glass stat-card reveal" style="transition-delay:0.21s;">
                <div class="stat-icon-wrap" style="background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#06B6D4" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div class="stat-label">Vues totales</div>
                <div class="stat-value" style="color:#06B6D4;">{{ number_format($totalViews) }}</div>
                <div class="stat-delta" style="color:var(--green);">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 15l-6-6-6 6"/></svg>
                    +34% cette semaine
                </div>
            </div>
        </div>

        <!-- Action bar -->
        <div class="section-label reveal">
            <h2>Tes articles</h2>
        </div>

        <div class="action-bar reveal">
            <div class="search-wrap">
                <span class="search-icon">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </span>
                <input type="text" placeholder="Rechercher un article&hellip;" oninput="filterRows(this.value)" />
            </div>
            <span class="filter-pill active" onclick="setStatusFilter(this,'all')">Tous</span>
            <span class="filter-pill" onclick="setStatusFilter(this,'publie')">Publiés</span>
            <span class="filter-pill" onclick="setStatusFilter(this,'brouillon')">Brouillons</span>
            <div style="margin-left:auto;">
                <div class="view-toggle">
                    <div class="view-btn active" title="Vue liste">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </div>
                    <div class="view-btn" title="Vue grille">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="glass table-wrap reveal" id="tableWrap">
            <div class="table-header">
                <span class="table-title">Articles</span>
                <span class="article-count" id="articleCount">{{ $totalArticles }} article{{ $totalArticles > 1 ? 's' : '' }}</span>
            </div>
            <div style="overflow-x:auto;">
                <table id="articlesTable">
                    <tbody id="tableBody">
                        @forelse($articles ?? [] as $article)
                            @php /** @var \App\Models\Article $article */ @endphp
                            <tr data-status="{{ $article->statut }}" data-title="{{ strtolower($article->titre) }}">
                                <td>
                                    <div class="title-cell">
                                        <span class="title-dot" style="background:{{ $article->statut === 'publie' ? '#FCA5A5' : '#FBBF24' }};"></span>
                                        <span class="article-name">{{ $article->titre }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($article->category)
                                        <span class="cat-badge">{{ $article->category->nom }}</span>
                                    @else
                                        <span class="cat-badge">Général</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge {{ $article->statut === 'publie' ? 'status-published' : 'status-draft' }}">{{ $article->statut === 'publie' ? 'Publié' : 'Brouillon' }}</span>
                                </td>
                                <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;">{{ $article->created_at->format('d M Y') }}</span></td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('articles.edit', $article->id) }}" class="act-btn act-edit" title="Éditer">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <button class="act-btn act-del" title="Supprimer" onclick="openDeleteModal('{{ addslashes($article->titre) }}', {{ $article->id }})">
                                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:40px;color:var(--text-3);">Aucun article trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- DELETE MODAL -->
    <div class="modal-overlay" id="deleteModal" onclick="closeModalBackdrop(event)">
        <div class="modal-card">
            <div style="width:60px;height:60px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 22px;">
                <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#EF4444" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;text-align:center;margin-bottom:10px;">Supprimer l&rsquo;article ?</h3>
            <p id="modalArticleName" style="text-align:center;color:var(--text-2);font-size:14px;margin-bottom:30px;"></p>
            <div style="display:flex;gap:10px;">
                <button class="btn-ghost" style="flex:1;" onclick="closeDeleteModal()">Annuler</button>
                <form id="deleteForm" method="POST" style="flex:1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" style="width:100%;">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
