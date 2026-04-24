@extends('layouts.app')

@section('title', 'Blog personnel — Mon blog de développeur')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
    <!-- Cursor glow -->
    <div id="cg"></div>

    <!-- Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('welcome') }}" class="nav-logo">
            <div class="logo-badge">B</div>
            Blog personnel
        </a>
        <ul class="nav-links">
            <li><a href="#" class="active">Accueil</a></li>
            <li><a href="#articles">Articles</a></li>
        </ul>
        <div class="nav-cta">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-ghost">Dashboard</a>
                <a href="{{ route('articles.create') }}" class="btn-primary">Nouvel article</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Connexion</a>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-tag">
            <span class="dot"></span>
            Dev thoughts, shipped weekly
        </div>
        <h1>
            Code. Learn.<br>
            <span class="grad">Ship it.</span>
        </h1>
        <p>Deep dives into Laravel, JavaScript, DevOps, and the messy reality of building software products from scratch.</p>
        <div class="hero-actions">
            <a href="#articles" class="btn-primary btn-lg">Read Articles</a>
            <a href="#newsletter" class="btn-ghost btn-lg">Subscribe — it's free</a>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num">{{ $totalArticles }}<span>+</span></div>
                <div class="stat-label">Articles published</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">1.2<span>k</span></div>
                <div class="stat-label">Monthly readers</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">380<span>+</span></div>
                <div class="stat-label">Subscribers</div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="content">

        <!-- Filter bar -->
        <div class="filter-bar" id="filter-bar">
            <span class="filter-label">Filter:</span>
            <button class="chip active" onclick="setFilter(this,'all')">All <span class="chip-count">{{ $totalArticles }}</span></button>
            <button class="chip" onclick="setFilter(this,'laravel')">Laravel <span class="chip-count">{{ $categoryStats['Laravel'] ?? 0 }}</span></button>
            <button class="chip" onclick="setFilter(this,'javascript')">JavaScript <span class="chip-count">{{ $categoryStats['JavaScript'] ?? 0 }}</span></button>
            <button class="chip" onclick="setFilter(this,'devops')">DevOps <span class="chip-count">{{ $categoryStats['DevOps'] ?? 0 }}</span></button>
        </div>

        <!-- Featured article -->
        <div class="section-heading reveal">
            <h2>Featured</h2>
            <span class="badge">Editor's pick</span>
        </div>

        @if($featuredArticle)
            <div class="featured-card reveal" data-cat="{{ strtolower($featuredArticle->category->nom ?? 'default') }}">
                <div class="featured-art">
                    <svg class="art-svg" width="260" height="200" viewBox="0 0 260 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="20" y="20" width="220" height="160" rx="12" fill="rgba(168,85,247,0.08)" stroke="rgba(168,85,247,0.3)" stroke-width="1.5"/>
                        <rect x="36" y="36" width="188" height="12" rx="4" fill="rgba(168,85,247,0.25)"/>
                        <rect x="36" y="56" width="140" height="8" rx="3" fill="rgba(255,255,255,0.1)"/>
                        <rect x="36" y="72" width="160" height="8" rx="3" fill="rgba(255,255,255,0.07)"/>
                    </svg>
                </div>
                <div class="featured-body">
                    <div class="featured-meta">
                        <span class="cat-badge cat-default">{{ $featuredArticle->category->nom ?? 'General' }}</span>
                        <span class="read-time">// {{ max(1, ceil(str_word_count(strip_tags($featuredArticle->contenu)) / 200)) }} min read</span>
                    </div>
                    <h3>{{ $featuredArticle->titre }}</h3>
                    <p>{{ Str::limit(strip_tags($featuredArticle->contenu), 150) }}</p>
                    <div class="featured-footer">
                        <div class="author">
                            <div class="avatar">AR</div>
                            <div>
                                <div class="author-name">{{ $featuredArticle->user->name ?? 'Author' }}</div>
                                <div class="author-date">{{ $featuredArticle->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                        <a href="{{ route('articles.show', $featuredArticle->id) }}" class="read-link">Read article →</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Articles grid -->
        <div id="articles">
            <div class="section-heading reveal">
                <h2>Recent Articles</h2>
            </div>
        </div>

        <div class="articles-grid" id="articles-grid">
            @forelse($articles as $article)
                @php
                    $catSlug = strtolower($article->category->nom ?? 'default');
                    $catSlug = str_replace(' ', '-', $catSlug);
                @endphp
                <div class="article-card reveal" data-cat="{{ $catSlug }}">
                    <div class="card-top">
                        <div class="card-cats">
                            <span class="cat-badge cat-default">{{ $article->category->nom ?? 'General' }}</span>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn" title="Bookmark">&#9825;</button>
                        </div>
                    </div>
                    <div class="card-title">{{ $article->titre }}</div>
                    <div class="card-excerpt">{{ Str::limit(strip_tags($article->contenu), 120) }}</div>
                    <div class="card-footer">
                        <div class="card-meta">
                            <span class="card-date">{{ $article->created_at->format('M d, Y') }}</span>
                            <span class="dot-sep"></span>
                            <span class="card-read-time">{{ max(1, ceil(str_word_count(strip_tags($article->contenu)) / 200)) }} min</span>
                        </div>
                        <a href="{{ route('articles.show', $article->id) }}" class="card-link">Read →</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: var(--text-3);">
                    <p>Aucun article publié pour le moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Newsletter -->
        <div class="newsletter reveal" id="newsletter">
            <div class="nl-icon">&#9993;</div>
            <h2>Stay in the loop</h2>
            <p>One email per week. No fluff &mdash; just the article, what I shipped, and one thing worth reading.</p>
            <form class="nl-form" id="nl-form" onsubmit="nlSubmit(event)">
                <input class="nl-input" type="email" placeholder="your@email.com" required>
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
            <div class="nl-success" id="nl-success">
                <span>&#10003;</span> You're in! Check your inbox.
            </div>
        </div>

    </div><!-- /content -->

    <!-- Footer -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('welcome') }}" class="nav-logo">
                    <div class="logo-badge">B</div>
                    Blog personnel
                </a>
                <p>A developer's notebook — covering Laravel, JavaScript, DevOps, and the occasional career reality check.</p>
                <div class="social-links">
                    <a href="#" class="social-btn" title="GitHub">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="Twitter / X">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" class="social-btn" title="LinkedIn">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Content</h4>
                <ul>
                    <li><a href="#articles">All Articles</a></li>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">DevOps</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Links</h4>
                <ul>
                    <li><a href="#">About me</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} Blog personnel &mdash; Built with <a href="#">Laravel</a></span>
            <span class="mono">v2.0.0</span>
        </div>
    </footer>
@endsection

@section('js')
    <script src="{{ asset('js/welcome.js') }}"></script>
@endsection
