<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $article->titre }} — Blog personnel</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>B</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent: #A855F7;
      --accent-rose: #EC4899;
      --accent-cyan: #06B6D4;
      --text-1: #F5F5FA;
      --text-2: #9CA3AF;
      --text-3: #6B7280;
      --green: #10F5A0;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-1);
      background: #0A0118;
      background-image:
        radial-gradient(ellipse 70% 50% at 80% 0%, #1A0B2E 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 5% 90%, #0D0D1F 0%, transparent 55%),
        radial-gradient(ellipse 100% 100% at 50% 50%, #0A0118 0%, #0D0D1F 100%);
      min-height: 100vh;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.025) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none; z-index: 0;
    }

    .orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; filter: blur(130px); }
    .orb-1 { width: 560px; height: 560px; background: #A855F7; top: -130px; left: -100px; opacity: 0.22; }
    .orb-2 { width: 400px; height: 400px; background: #EC4899; bottom: 0; right: -60px; opacity: 0.16; }

    #cg { position: fixed; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(168,85,247,0.065) 0%, transparent 70%); pointer-events: none; z-index: 0; transform: translate(-50%,-50%); transition: left .12s ease, top .12s ease; }

    /* NAVBAR */
    .navbar {
      position: sticky; top: 0; z-index: 200;
      background: rgba(10,1,24,0.82);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      padding: 0 32px; height: 60px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .logo-box { width: 32px; height: 32px; background: linear-gradient(135deg,#A855F7,#EC4899); border-radius: 9px; display:flex; align-items:center; justify-content:center; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:16px; color:#fff; flex-shrink:0; }
    .logo-text { font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:16px; color:var(--text-1); text-decoration:none; }
    .logo-text span { color:var(--accent); }

    .nav-actions { display:flex; align-items:center; gap:10px; }
    .nav-link { font-size:13px; color:var(--text-3); text-decoration:none; padding:6px 14px; border-radius:8px; transition:all .2s; display:flex; align-items:center; gap:6px; }
    .nav-link:hover { color:var(--text-1); background:rgba(255,255,255,0.06); }
    .btn-primary { background:linear-gradient(135deg,#A855F7,#EC4899); border:none; border-radius:10px; padding:8px 18px; font-family:'Inter',sans-serif; font-weight:600; font-size:13px; color:#fff; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all .3s; }
    .btn-primary:hover { transform:scale(1.02); box-shadow:0 0 24px rgba(168,85,247,.5); }

    /* ARTICLE */
    .article-container {
      position: relative; z-index: 1;
      max-width: 780px;
      margin: 0 auto;
      padding: 60px 32px 100px;
    }

    .back-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 13px; color: var(--text-3); text-decoration: none;
      margin-bottom: 40px; transition: color .25s;
    }
    .back-link:hover { color: #C084FC; }

    .article-meta {
      display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
      margin-bottom: 24px;
    }
    .cat-badge {
      font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;
      background: rgba(168,85,247,0.15); color: var(--accent);
      border: 1px solid rgba(168,85,247,0.25);
    }
    .read-time {
      font-family: 'JetBrains Mono', monospace; font-size: 12px; color: var(--text-3);
    }

    .article-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700;
      line-height: 1.15;
      letter-spacing: -0.025em;
      margin-bottom: 24px;
      color: var(--text-1);
    }

    .article-author {
      display: flex; align-items: center; gap: 12px;
      padding-bottom: 32px;
      margin-bottom: 40px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .avatar {
      width: 42px; height: 42px; border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      display: grid; place-items: center;
      font-size: 0.85rem; font-weight: 700; flex-shrink: 0;
    }
    .author-name { font-size: 14px; font-weight: 600; color: var(--text-1); }
    .author-date { font-size: 12px; color: var(--text-3); font-family: 'JetBrains Mono', monospace; margin-top: 2px; }

    .article-content {
      font-size: 1.1rem;
      line-height: 1.85;
      color: var(--text-2);
      word-wrap: break-word;
    }
    .article-content p { margin-bottom: 1.5em; }
    .article-content h2 { font-family:'Space Grotesk',sans-serif; font-size:1.6rem; font-weight:700; color:var(--text-1); margin:2em 0 0.8em; letter-spacing:-0.02em; }
    .article-content h3 { font-family:'Space Grotesk',sans-serif; font-size:1.25rem; font-weight:600; color:var(--text-1); margin:1.5em 0 0.6em; }
    .article-content strong { color: var(--text-1); font-weight: 600; }
    .article-content a { color: var(--accent); text-decoration: underline; text-underline-offset: 3px; }
    .article-content a:hover { color: #C084FC; }
    .article-content blockquote { border-left: 3px solid var(--accent); padding-left: 20px; margin: 1.5em 0; color: var(--text-3); font-style: italic; }
    .article-content code { background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); border-radius: 4px; padding: 2px 6px; font-family:'JetBrains Mono',monospace; font-size: 0.9em; color: #C084FC; }
    .article-content pre { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 20px; overflow-x: auto; margin: 1.5em 0; }
    .article-content pre code { background: none; border: none; padding: 0; color: var(--text-2); }
    .article-content ul, .article-content ol { padding-left: 1.5em; margin-bottom: 1.5em; }
    .article-content li { margin-bottom: 0.5em; }

    /* FOOTER NAV */
    .article-footer {
      margin-top: 60px; padding-top: 32px;
      border-top: 1px solid rgba(255,255,255,0.06);
      display: flex; justify-content: space-between; align-items: center;
    }
    .footer-link {
      font-size: 13px; color: var(--text-3); text-decoration: none;
      display: flex; align-items: center; gap: 6px; transition: color .2s;
    }
    .footer-link:hover { color: #C084FC; }

    /* Reveal */
    .reveal { opacity: 0; transform: translateY(16px); transition: opacity .5s, transform .5s; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 600px) {
      .article-container { padding: 40px 20px 80px; }
      .navbar { padding: 0 20px; }
    }
  </style>
</head>
<body>

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

  <script>
    // Cursor glow
    const cg = document.getElementById('cg');
    document.addEventListener('mousemove', e => { cg.style.left=e.clientX+'px'; cg.style.top=e.clientY+'px'; });

    // Scroll reveal
    const obs = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), {threshold:.05});
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
  </script>
</body>
</html>
