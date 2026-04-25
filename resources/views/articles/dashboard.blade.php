<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard &mdash; Blog personnel</title>
  <link rel="icon" type="image/svg+xml"
    href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>A</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
</head>

<body>

  <div id="cg"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <!-- ══════════ NAVBAR ══════════ -->
  <header class="navbar">
    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
      <div class="logo-box">B</div>
      <span class="logo-text">Blog<span> personnel</span></span>
    </a>
    <div style="display:flex;align-items:center;gap:10px;">
      <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">Dashboard</span>
      <a href="{{ route('welcome') }}" class="nav-pill">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>
        Blog public
      </a>
      <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="btn-icon" title="D&eacute;connexion">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
          </svg>
        </button>
      </form>
    </div>
  </header>

  <!-- ══════════ PAGE ══════════ -->
  <main class="page">

    <!-- ── Header ── -->
    <div class="page-header reveal">
      <div>
        <h1><span class="wave">&#128075;</span> Salut {{ auth()->user()->name }}</h1>
        <p>Voici l&rsquo;&eacute;tat de ton blog aujourd&rsquo;hui &middot;
          <span
            style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">{{ now()->translatedFormat('d F Y') }}</span>
        </p>
      </div>
      <a href="{{ route('articles.create') }}" class="btn-primary">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
          <path d="M12 5v14M5 12h14" />
        </svg>
        Nouvel article
      </a>
    </div>

    <hr class="sep-line" />

    <!-- ── Stats grid ── -->
    <div class="stats-grid">

      <!-- Total -->
      <div class="glass stat-card reveal">
        <div class="stat-icon-wrap" style="background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.25);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#A855F7" stroke-width="2">
            <path
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
        </div>
        <div class="stat-label">Total articles</div>
        <div class="stat-value"
          style="background:linear-gradient(135deg,#A855F7,#EC4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
          {{ $totalArticles }}
        </div>
        <div class="stat-delta" style="color:var(--green);">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          +2 cette semaine
        </div>
      </div>

      <!-- Publi&eacute;s -->
      <div class="glass stat-card reveal" style="transition-delay:0.07s;">
        <div class="stat-icon-wrap" style="background:rgba(16,245,160,0.1);border:1px solid rgba(16,245,160,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#10F5A0" stroke-width="2">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="stat-label">Publi&eacute;s</div>
        <div class="stat-value" style="color:#10F5A0;">{{ $publishedCount }}</div>
        <div class="stat-delta" style="color:var(--text-3);">
          <span
            style="width:7px;height:7px;background:#10F5A0;border-radius:50%;box-shadow:0 0 7px #10F5A0;display:inline-block;animation:blink 2s ease-in-out infinite;"></span>
          Visibles publiquement
        </div>
      </div>

      <!-- Brouillons -->
      <div class="glass stat-card reveal" style="transition-delay:0.14s;">
        <div class="stat-icon-wrap" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#FBBF24" stroke-width="2">
            <path
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
        </div>
        <div class="stat-label">Brouillons</div>
        <div class="stat-value" style="color:#FBBF24;">{{ $draftCount }}</div>
        <div class="stat-delta" style="color:var(--text-3);">
          <span
            style="width:7px;height:7px;background:#FBBF24;border-radius:50%;box-shadow:0 0 7px #FBBF24;display:inline-block;"></span>
          En cours d&rsquo;&eacute;criture
        </div>
      </div>

      <!-- Vues -->
      <div class="glass stat-card reveal" style="transition-delay:0.21s;">
        <div class="stat-icon-wrap" style="background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#06B6D4" stroke-width="2">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
            <circle cx="12" cy="12" r="3" />
          </svg>
        </div>
        <div class="stat-label">Vues totales</div>
        <div class="stat-value" style="color:#06B6D4;">{{ number_format($totalViews) }}</div>
        <div class="stat-delta" style="color:var(--green);">
          <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          +34% cette semaine
        </div>
      </div>
    </div>

    <!-- ── Action bar ── -->
    <div class="section-label reveal">
      <h2>Tes articles</h2>
    </div>

    <div class="action-bar reveal">
      <div class="search-wrap">
        <span class="search-icon">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="M21 21l-4.35-4.35" />
          </svg>
        </span>
        <input type="text" placeholder="Rechercher un article&hellip;" oninput="filterRows(this.value)" />
      </div>
      <span class="filter-pill active" onclick="setStatusFilter(this,'all')">Tous</span>
      <span class="filter-pill" onclick="setStatusFilter(this,'publie')">Publi&eacute;s</span>
      <span class="filter-pill" onclick="setStatusFilter(this,'brouillon')">Brouillons</span>
      <div style="margin-left:auto;">
        <div class="view-toggle">
          <div class="view-btn active" title="Vue liste">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <line x1="8" y1="6" x2="21" y2="6" />
              <line x1="8" y1="12" x2="21" y2="12" />
              <line x1="8" y1="18" x2="21" y2="18" />
              <line x1="3" y1="6" x2="3.01" y2="6" />
              <line x1="3" y1="12" x2="3.01" y2="12" />
              <line x1="3" y1="18" x2="3.01" y2="18" />
            </svg>
          </div>
          <div class="view-btn" title="Vue grille">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="7" height="7" />
              <rect x="14" y="3" width="7" height="7" />
              <rect x="3" y="14" width="7" height="7" />
              <rect x="14" y="14" width="7" height="7" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Table ── -->
    <div class="glass table-wrap reveal" id="tableWrap">
      <div class="table-header">
        <span class="table-title">Articles</span>
        <span class="article-count" id="articleCount">{{ $totalArticles }}
          article{{ $totalArticles > 1 ? 's' : '' }}</span>
      </div>
      <div style="overflow-x:auto;">
        <table id="articlesTable">
          <colgroup>
            <col style="width:34%;">
            <col style="width:16%;">
            <col style="width:15%;">
            <col style="width:13%;">
            <col class="col-views" style="width:12%;">
            <col style="width:10%;">
          </colgroup>
          <thead>
            <tr>
              <th>TITRE</th>
              <th>CAT&Eacute;GORIE</th>
              <th>STATUT</th>
              <th>CR&Eacute;&Eacute; LE</th>
              <th class="col-views">VUES</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id="tableBody">

            @forelse($articles ?? [] as $article)
              @php /** @var \App\Models\Article $article */ @endphp
              <tr data-status="{{ $article->statut }}" data-title="{{ strtolower($article->titre) }}">
                <td>
                  <div class="title-cell">
                    <span class="title-dot"
                      style="background:{{ $article->statut === 'publie' ? '#FCA5A5' : '#FBBF24' }};box-shadow:0 0 7px {{ $article->statut === 'publie' ? 'rgba(252,165,165,0.5)' : 'rgba(251,191,36,0.5)' }};"></span>
                    <span class="article-name">{{ $article->titre }}</span>
                  </div>
                </td>
                <td>
                  @if($article->category)
                    @php
                      $cat = strtolower($article->category->nom ?? '');
                      $catClass = str_contains($cat, 'laravel') ? 'cat-laravel' : (str_contains($cat, 'javascript') || str_contains($cat, 'js') ? 'cat-js' : (str_contains($cat, 'devops') ? 'cat-devops' : 'cat-career'));
                      $catIcon = str_contains($cat, 'laravel') ? '&#9889;' : (str_contains($cat, 'javascript') || str_contains($cat, 'js') ? '&#9670;' : (str_contains($cat, 'devops') ? '&#9650;' : '&#9733;'));
                    @endphp
                    <span class="cat-badge {{ $catClass }}">{!! $catIcon !!} {{ $article->category->nom }}</span>
                  @else
                    <span class="cat-badge cat-laravel">&#9889; G&eacute;n&eacute;ral</span>
                  @endif
                </td>
                <td>
                  @if($article->statut === 'publie')
                    <span class="status-badge status-published"><span class="status-dot"></span>Publi&eacute;</span>
                  @else
                    <span class="status-badge status-draft"><span class="status-dot"></span>Brouillon</span>
                  @endif
                </td>
                <td style="white-space:nowrap;"><span
                    style="font-family:'JetBrains Mono',monospace;font-size:12px;">{{ $article->created_at->format('d M Y') }}</span>
                </td>
                <td class="col-views">
                  <div style="display:flex;align-items:center;gap:10px;">
                    @if($article->statut === 'publie' && $article->views)
                      <span
                        style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-1);min-width:38px;">{{ $article->views }}</span>
                      <div class="sparkline">
                        <div class="spark-bar" style="height:7px;"></div>
                        <div class="spark-bar" style="height:11px;"></div>
                        <div class="spark-bar" style="height:9px;"></div>
                        <div class="spark-bar" style="height:15px;"></div>
                        <div class="spark-bar" style="height:13px;"></div>
                        <div class="spark-bar" style="height:18px;background:rgba(168,85,247,0.9);"></div>
                      </div>
                    @else
                      <span
                        style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">&mdash;</span>
                    @endif
                  </div>
                </td>
                <td>
                  <div class="actions">
                    @if($article->statut === 'publie')
                      <a href="{{ route('articles.show', $article->id) }}" class="act-btn act-view" title="Voir l'article">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                          <circle cx="12" cy="12" r="3" />
                        </svg>
                      </a>
                    @else
                      <button class="act-btn act-view" title="Brouillon" style="opacity:0.35;cursor:not-allowed;" disabled>
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                          <circle cx="12" cy="12" r="3" />
                        </svg>
                      </button>
                    @endif
                    <a href="{{ route('articles.edit', $article->id) }}" class="act-btn act-edit" title="&Eacute;diter">
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <button class="act-btn act-del" title="Supprimer"
                      onclick="openDeleteModal('{{ addslashes($article->titre) }}', {{ $article->id }})">
                      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        <path d="M10 11v6M14 11v6" />
                        <path d="M9 6V4h6v2" />
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              @php
                $demoRows = [
                  ['title' => 'Apprendre Laravel en 2026 : Le Guide Complet', 'cat' => 'cat-laravel', 'catLabel' => '&#9889; Laravel', 'status' => 'publie', 'date' => '23 avr. 2026', 'views' => 432, 'dot' => '#FCA5A5', 'id' => 1],
                  ['title' => 'Les Nouveautés de PHP 8.4', 'cat' => 'cat-js', 'catLabel' => '&#9670; PHP', 'status' => 'publie', 'date' => '23 avr. 2026', 'views' => 287, 'dot' => '#FBBF24', 'id' => 2],
                  ['title' => 'Sécuriser son Application Web : Les Bonnes Pratiques', 'cat' => 'cat-career', 'catLabel' => '&#9733; Securite', 'status' => 'publie', 'date' => '23 avr. 2026', 'views' => 318, 'dot' => '#FCA5A5', 'id' => 3],
                  ['title' => 'Tendances Web Design 2026 : Minimalisme et Animations', 'cat' => 'cat-devops', 'catLabel' => '&#9650; Web Design', 'status' => 'brouillon', 'date' => '23 avr. 2026', 'views' => null, 'dot' => '#FBBF24', 'id' => 4],
                  ['title' => 'Maîtriser Eloquent ORM : Relations et Requêtes Avancées', 'cat' => 'cat-laravel', 'catLabel' => '&#9889; Laravel', 'status' => 'publie', 'date' => '23 avr. 2026', 'views' => 197, 'dot' => '#FCA5A5', 'id' => 5],
                  ['title' => 'Créer une API REST avec Laravel et Sanctum', 'cat' => 'cat-js', 'catLabel' => '&#9670; PHP', 'status' => 'brouillon', 'date' => '23 avr. 2026', 'views' => null, 'dot' => '#FBBF24', 'id' => 6],
                ];
              @endphp
              @foreach($demoRows as $row)
                <tr data-status="{{ $row['status'] }}" data-title="{{ strtolower($row['title']) }}">
                  <td>
                    <div class="title-cell">
                      <span class="title-dot"
                        style="background:{{ $row['dot'] }};box-shadow:0 0 7px {{ $row['dot'] }}44;"></span>
                      <span class="article-name">{{ $row['title'] }}</span>
                    </div>
                  </td>
                  <td><span class="cat-badge {{ $row['cat'] }}">{!! $row['catLabel'] !!}</span></td>
                  <td>
                    @if($row['status'] === 'publie')
                      <span class="status-badge status-published"><span class="status-dot"></span>Publi&eacute;</span>
                    @else
                      <span class="status-badge status-draft"><span class="status-dot"></span>Brouillon</span>
                    @endif
                  </td>
                  <td style="white-space:nowrap;"><span
                      style="font-family:'JetBrains Mono',monospace;font-size:12px;">{{ $row['date'] }}</span></td>
                  <td class="col-views">
                    @if($row['views'])
                      <div style="display:flex;align-items:center;gap:8px;">
                        <span
                          style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-1);">{{ $row['views'] }}</span>
                        <div class="sparkline">
                          <div class="spark-bar" style="height:6px;"></div>
                          <div class="spark-bar" style="height:10px;"></div>
                          <div class="spark-bar" style="height:8px;"></div>
                          <div class="spark-bar" style="height:14px;"></div>
                          <div class="spark-bar" style="height:12px;background:rgba(168,85,247,0.9);"></div>
                        </div>
                      </div>
                    @else
                      <span style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">&mdash;</span>
                    @endif
                  </td>
                  <td>
                    <div class="actions">
                      @if($row['status'] === 'publie')
                        <button class="act-btn act-view" title="Voir">
                          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                          </svg>
                        </button>
                      @else
                        <button class="act-btn act-view" title="Brouillon" style="opacity:0.3;cursor:not-allowed;" disabled>
                          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                          </svg>
                        </button>
                      @endif
                      <button class="act-btn act-edit" title="&Eacute;diter">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                      <button class="act-btn act-del" title="Supprimer"
                        onclick="openDeleteModal('{{ addslashes($row['title']) }}', {{ $row['id'] }})">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <polyline points="3 6 5 6 21 6" />
                          <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                          <path d="M10 11v6M14 11v6" />
                          <path d="M9 6V4h6v2" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            @endforelse

          </tbody>
        </table>
      </div>

      <!-- Empty search state -->
      <div class="empty-state" id="emptyState">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" style="margin:0 auto 20px;">
          <circle cx="40" cy="40" r="40" fill="rgba(168,85,247,0.08)" />
          <circle cx="40" cy="40" r="28" fill="rgba(168,85,247,0.06)" stroke="rgba(168,85,247,0.2)" stroke-width="1" />
          <path d="M28 42l8 8 16-18" stroke="rgba(168,85,247,0.4)" stroke-width="2.5" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        <p style="font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-3);">Aucun article
          trouv&eacute;</p>
      </div>
    </div>

    <!-- ── Bottom grid ── -->
    <div class="bottom-grid" id="bottomGrid">

      <!-- Activity feed -->
      <div class="glass reveal" style="padding:0;overflow:hidden;">
        <div
          style="padding:22px 26px 16px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:space-between;">
          <span style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:600;">Activit&eacute;
            r&eacute;cente</span>
          <span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-3);">// LOGS</span>
        </div>
        <div class="timeline">

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(16,245,160,0.12);border:1px solid rgba(16,245,160,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#10F5A0" stroke-width="2.5">
                <path d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Article publi&eacute; : <span style="color:#C084FC;">Les relations
                  Eloquent&hellip;</span></div>
              <div class="timeline-time">il y a 2h</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#FBBF24" stroke-width="2.5">
                <path
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Brouillon modifi&eacute; : <span style="color:#FBBF24;">Queues &amp; Jobs
                  Laravel&hellip;</span></div>
              <div class="timeline-time">hier, 22:14</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(6,182,212,0.12);border:1px solid rgba(6,182,212,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#06B6D4" stroke-width="2.5">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Pic de trafic : <span style="color:#06B6D4;">+89 vues en 1h</span></div>
              <div class="timeline-time">avant-hier, 15:30</div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-dot" style="background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#A855F7" stroke-width="2.5">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
              </svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Connexion depuis <span style="color:#A855F7;">Agadir, MA</span></div>
              <div class="timeline-time">il y a 2 jours &middot; Safari / macOS</div>
            </div>
          </div>

          <div class="timeline-item" style="padding-bottom:0;">
            <div class="timeline-dot" style="background:rgba(252,165,165,0.12);border:1px solid rgba(252,165,165,0.3);">
              <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="#FCA5A5" stroke-width="2.5">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Article publi&eacute; : <span style="color:#FCA5A5;">Prot&eacute;ger ses
                  routes&hellip;</span></div>
              <div class="timeline-time">il y a 5 jours</div>
            </div>
          </div>

        </div>
      </div>

      <!-- Quick actions -->
      <div class="glass reveal" style="padding:26px;display:flex;flex-direction:column;gap:14px;">
        <div style="font-family:'Space Grotesk',sans-serif;font-size:17px;font-weight:600;margin-bottom:2px;">Actions
          rapides</div>

        <a href="{{ route('articles.create') }}" class="btn-primary"
          style="width:100%;justify-content:center;height:44px;font-size:14px;">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
            <path d="M12 5v14M5 12h14" />
          </svg>
          Nouvel article
        </a>

        <a href="{{ route('welcome') }}" class="quick-btn">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
            <circle cx="12" cy="12" r="3" />
          </svg>
          Voir le blog public
        </a>

        <a href="{{ route('articles.create') }}" class="quick-btn warn">
          <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Reprendre un brouillon
        </a>

        <hr style="border:none;border-top:1px solid rgba(255,255,255,0.06);margin:2px 0;" />

        <div class="mini-stats">
          <div class="mini-stat">
            <div class="mini-stat-val" style="color:var(--green);">67%</div>
            <div class="mini-stat-lbl">TAUX PUBLICATION</div>
          </div>
          <div class="mini-stat">
            <div class="mini-stat-val" style="color:var(--accent);">8.2</div>
            <div class="mini-stat-lbl">MIN MOY. LECTURE</div>
          </div>
        </div>
      </div>

    </div><!-- /bottom-grid -->

  </main>

  <!-- ══════════ DELETE MODAL ══════════ -->
  <div class="modal-overlay" id="deleteModal" onclick="closeModalBackdrop(event)">
    <div class="modal-card">
      <div
        style="width:60px;height:60px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 22px;">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#EF4444" stroke-width="2">
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
          <path d="M10 11v6M14 11v6" />
          <path d="M9 6V4h6v2" />
        </svg>
      </div>
      <h3
        style="font-family:'Space Grotesk',sans-serif;font-size:22px;font-weight:700;text-align:center;margin-bottom:10px;">
        Supprimer l&rsquo;article&nbsp;?</h3>
      <p id="modalArticleName" style="text-align:center;color:var(--text-2);font-size:14px;margin-bottom:8px;"></p>
      <p style="text-align:center;color:var(--text-3);font-size:13px;margin-bottom:30px;line-height:1.6;">Cette action
        est irr&eacute;versible. L&rsquo;article et toutes ses donn&eacute;es seront supprim&eacute;s
        d&eacute;finitivement.</p>
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

  <!-- ══════════ TWEAKS PANEL ══════════ -->
  <div id="tweakPanel">
    <div class="glass" style="padding:22px;min-width:240px;border-radius:18px;">
      <div
        style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:600;color:var(--text-1);margin-bottom:16px;display:flex;align-items:center;gap:6px;">
        <span
          style="width:8px;height:8px;background:linear-gradient(135deg,#A855F7,#EC4899);border-radius:2px;display:inline-block;"></span>
        Tweaks
      </div>
      <label
        style="display:block;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;margin-bottom:6px;">ACCENT
        COLOR</label>
      <input type="color" value="#A855F7" oninput="applyTweak('accentColor',this.value)"
        style="width:100%;height:32px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.05);cursor:pointer;padding:2px;margin-bottom:14px;" />
      <label
        style="display:flex;align-items:center;gap:8px;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;cursor:pointer;margin-bottom:10px;">
        <input type="checkbox" id="twkTimeline" checked onchange="applyTweak('showTimeline',this.checked)"
          style="accent-color:#A855F7;" />
        ACTIVIT&Eacute; R&Eacute;CENTE
      </label>
      <label
        style="display:flex;align-items:center;gap:8px;font-size:11px;color:var(--text-3);font-family:'JetBrains Mono',monospace;cursor:pointer;">
        <input type="checkbox" id="twkViews" checked onchange="applyTweak('showViews',this.checked)"
          style="accent-color:#A855F7;" />
        COLONNE VUES
      </label>
    </div>
  </div>

  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>