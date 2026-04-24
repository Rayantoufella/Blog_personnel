<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog personnel — Mon blog de développeur</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23A855F7'/><text x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' font-family='monospace' font-size='18' fill='white'>A</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&family=Space+Grotesk:wght@300;400;600;700&display=swap" rel="stylesheet">
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
      --amber: #FBBF24;
      --bg: #0A0118;
      --surface: rgba(255,255,255,0.035);
      --border: rgba(255,255,255,0.08);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text-1);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ── Cursor glow ── */
    #cg {
      position: fixed;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(168,85,247,0.12) 0%, transparent 70%);
      pointer-events: none;
      transform: translate(-50%, -50%);
      z-index: 0;
      transition: left 0.1s ease, top 0.1s ease;
    }

    /* ── Orbs ── */
    .orb {
      position: fixed;
      border-radius: 50%;
      filter: blur(120px);
      pointer-events: none;
      z-index: 0;
    }
    .orb-1 {
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(168,85,247,0.18) 0%, transparent 70%);
      top: -200px; left: -200px;
      animation: float 12s ease-in-out infinite;
    }
    .orb-2 {
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(236,72,153,0.14) 0%, transparent 70%);
      top: 30%; right: -150px;
      animation: float 15s ease-in-out infinite reverse;
    }
    .orb-3 {
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(6,182,212,0.12) 0%, transparent 70%);
      bottom: 10%; left: 20%;
      animation: float 18s ease-in-out infinite 3s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) scale(1); }
      33%       { transform: translateY(-30px) scale(1.04); }
      66%       { transform: translateY(20px) scale(0.97); }
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(32px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes gradientShift {
      0%, 100% { background-position: 0% 50%; }
      50%       { background-position: 100% 50%; }
    }
    @keyframes bob {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-8px); }
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50%       { opacity: 0.5; }
    }

    /* ── Glass utility ── */
    .glass {
      background: rgba(255,255,255,0.055);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 16px;
    }

    /* ── Navbar ── */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 0 max(24px, calc((100vw - 1200px)/2));
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(10,1,24,0.7);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .nav-logo {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--text-1);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .nav-logo .logo-badge {
      width: 28px; height: 28px;
      border-radius: 7px;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      display: grid;
      place-items: center;
      font-size: 14px;
    }
    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }
    .nav-links a {
      color: var(--text-2);
      text-decoration: none;
      font-size: 0.875rem;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: 8px;
      transition: color 0.2s, background 0.2s;
    }
    .nav-links a:hover { color: var(--text-1); background: rgba(255,255,255,0.06); }
    .nav-links a.active { color: var(--accent); }
    .nav-cta {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .btn-ghost {
      background: none;
      border: 1px solid rgba(255,255,255,0.12);
      color: var(--text-2);
      padding: 7px 16px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
    .btn-primary {
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      border: none;
      color: #fff;
      padding: 8px 18px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      font-family: inherit;
      transition: opacity 0.2s, transform 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }

    /* ── Hero ── */
    .hero {
      position: relative;
      z-index: 1;
      padding: 140px max(24px, calc((100vw - 1200px)/2)) 80px;
      text-align: center;
    }
    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(168,85,247,0.12);
      border: 1px solid rgba(168,85,247,0.25);
      border-radius: 100px;
      padding: 6px 16px;
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--accent);
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-bottom: 28px;
      animation: fadeUp 0.6s ease both;
    }
    .hero-tag .dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s ease infinite;
    }
    .hero h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2.4rem, 6vw, 4.5rem);
      font-weight: 700;
      line-height: 1.1;
      letter-spacing: -0.03em;
      margin-bottom: 24px;
      animation: fadeUp 0.6s ease 0.1s both;
    }
    .hero h1 .grad {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-rose) 50%, var(--accent-cyan) 100%);
      background-size: 200% 200%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: gradientShift 4s ease infinite;
    }
    .hero p {
      font-size: 1.125rem;
      color: var(--text-2);
      max-width: 540px;
      margin: 0 auto 40px;
      line-height: 1.7;
      animation: fadeUp 0.6s ease 0.2s both;
    }
    .hero-actions {
      display: flex;
      gap: 12px;
      justify-content: center;
      flex-wrap: wrap;
      animation: fadeUp 0.6s ease 0.3s both;
    }
    .btn-lg {
      padding: 13px 28px;
      font-size: 1rem;
      border-radius: 10px;
    }
    .hero-stats {
      display: flex;
      justify-content: center;
      gap: 48px;
      margin-top: 64px;
      animation: fadeUp 0.6s ease 0.4s both;
    }
    .stat-item { text-align: center; }
    .stat-num {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--text-1);
    }
    .stat-num span { color: var(--accent); }
    .stat-label {
      font-size: 0.8rem;
      color: var(--text-3);
      margin-top: 4px;
    }

    /* ── Content area ── */
    .content {
      position: relative;
      z-index: 1;
      padding: 0 max(24px, calc((100vw - 1200px)/2)) 80px;
    }

    /* ── Filter bar ── */
    .filter-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 48px;
      flex-wrap: wrap;
    }
    .filter-label {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--text-3);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-right: 4px;
    }
    .chip {
      padding: 7px 16px;
      border-radius: 100px;
      font-size: 0.82rem;
      font-weight: 500;
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.04);
      color: var(--text-2);
      cursor: pointer;
      transition: all 0.2s;
      font-family: inherit;
    }
    .chip:hover { border-color: var(--accent); color: var(--accent); }
    .chip.active {
      background: rgba(168,85,247,0.15);
      border-color: var(--accent);
      color: var(--accent);
    }
    .chip-count {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 18px; height: 18px;
      border-radius: 50%;
      background: rgba(168,85,247,0.2);
      font-size: 0.7rem;
      font-weight: 700;
      margin-left: 6px;
    }

    /* ── Section heading ── */
    .section-heading {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }
    .section-heading h2 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.3rem;
      font-weight: 700;
    }
    .section-heading .badge {
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      padding: 3px 10px;
      border-radius: 100px;
      background: rgba(168,85,247,0.15);
      color: var(--accent);
      border: 1px solid rgba(168,85,247,0.25);
    }

    /* ── Featured card ── */
    .featured-card {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
      margin-bottom: 64px;
      overflow: hidden;
      border-radius: 20px;
      border: 1px solid rgba(255,255,255,0.09);
      background: rgba(255,255,255,0.03);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .featured-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 24px 80px rgba(168,85,247,0.2);
    }
    .featured-art {
      position: relative;
      min-height: 380px;
      background: linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(236,72,153,0.1) 50%, rgba(6,182,212,0.08) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .featured-art::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 40% 50%, rgba(168,85,247,0.25) 0%, transparent 60%);
    }
    .art-svg { position: relative; z-index: 1; animation: bob 4s ease-in-out infinite; }
    .featured-body {
      padding: 48px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .featured-meta {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 20px;
    }
    .cat-badge {
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      padding: 4px 12px;
      border-radius: 100px;
    }
    .cat-laravel { background: rgba(255,45,85,0.15); color: #FF6B8A; border: 1px solid rgba(255,45,85,0.25); }
    .cat-js      { background: rgba(251,191,36,0.15); color: var(--amber); border: 1px solid rgba(251,191,36,0.25); }
    .cat-devops  { background: rgba(6,182,212,0.15); color: var(--accent-cyan); border: 1px solid rgba(6,182,212,0.25); }
    .cat-career  { background: rgba(16,245,160,0.15); color: var(--green); border: 1px solid rgba(16,245,160,0.25); }
    .cat-default { background: rgba(168,85,247,0.15); color: var(--accent); border: 1px solid rgba(168,85,247,0.25); }
    .read-time {
      font-size: 0.78rem;
      color: var(--text-3);
      font-family: 'JetBrains Mono', monospace;
    }
    .featured-body h3 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.65rem;
      font-weight: 700;
      line-height: 1.25;
      letter-spacing: -0.02em;
      margin-bottom: 14px;
      color: var(--text-1);
    }
    .featured-body p {
      font-size: 0.95rem;
      color: var(--text-2);
      line-height: 1.7;
      margin-bottom: 28px;
    }
    .featured-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .author {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      display: grid;
      place-items: center;
      font-size: 0.8rem;
      font-weight: 700;
      flex-shrink: 0;
    }
    .author-name {
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text-1);
    }
    .author-date {
      font-size: 0.75rem;
      color: var(--text-3);
      margin-top: 1px;
      font-family: 'JetBrains Mono', monospace;
    }
    .read-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--accent);
      text-decoration: none;
      transition: gap 0.2s;
    }
    .read-link:hover { gap: 10px; }

    /* ── Article grid ── */
    .articles-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
      margin-bottom: 64px;
    }
    .article-card {
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,0.08);
      background: rgba(255,255,255,0.04);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      padding: 28px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      transform-style: preserve-3d;
    }
    .article-card:hover {
      border-color: rgba(168,85,247,0.3);
      box-shadow: 0 16px 48px rgba(168,85,247,0.12);
    }
    .card-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
    }
    .card-cats { display: flex; gap: 6px; flex-wrap: wrap; }
    .card-actions { display: flex; gap: 6px; }
    .icon-btn {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.08);
      display: grid;
      place-items: center;
      cursor: pointer;
      transition: background 0.2s, border-color 0.2s;
      color: var(--text-3);
      font-size: 14px;
    }
    .icon-btn:hover { background: rgba(168,85,247,0.12); border-color: rgba(168,85,247,0.3); color: var(--accent); }
    .card-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.05rem;
      font-weight: 700;
      color: var(--text-1);
      line-height: 1.3;
      letter-spacing: -0.01em;
    }
    .card-excerpt {
      font-size: 0.875rem;
      color: var(--text-2);
      line-height: 1.65;
      flex: 1;
    }
    .card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 16px;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .card-meta {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .card-date {
      font-size: 0.75rem;
      color: var(--text-3);
      font-family: 'JetBrains Mono', monospace;
    }
    .dot-sep { width: 3px; height: 3px; border-radius: 50%; background: var(--text-3); }
    .card-read-time {
      font-size: 0.75rem;
      color: var(--text-3);
      font-family: 'JetBrains Mono', monospace;
    }
    .card-link {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--accent);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 4px;
      transition: gap 0.2s;
    }
    .card-link:hover { gap: 8px; }

    /* ── Newsletter ── */
    .newsletter {
      border-radius: 20px;
      border: 1px solid rgba(168,85,247,0.2);
      background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(236,72,153,0.05) 50%, rgba(6,182,212,0.04) 100%);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      padding: 56px 48px;
      text-align: center;
      position: relative;
      overflow: hidden;
      margin-bottom: 80px;
    }
    .newsletter::before {
      content: '';
      position: absolute;
      top: -100px; left: 50%;
      transform: translateX(-50%);
      width: 400px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(168,85,247,0.15) 0%, transparent 70%);
      pointer-events: none;
    }
    .nl-icon {
      width: 56px; height: 56px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent-rose));
      display: grid;
      place-items: center;
      margin: 0 auto 20px;
      font-size: 24px;
    }
    .newsletter h2 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 12px;
      letter-spacing: -0.02em;
    }
    .newsletter p {
      color: var(--text-2);
      font-size: 1rem;
      margin-bottom: 32px;
      max-width: 440px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.65;
    }
    .nl-form {
      display: flex;
      gap: 12px;
      max-width: 460px;
      margin: 0 auto;
    }
    .nl-input {
      flex: 1;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 10px;
      padding: 12px 18px;
      font-size: 0.9rem;
      color: var(--text-1);
      font-family: inherit;
      outline: none;
      transition: border-color 0.2s;
    }
    .nl-input::placeholder { color: var(--text-3); }
    .nl-input:focus { border-color: var(--accent); }
    .nl-success {
      display: none;
      align-items: center;
      justify-content: center;
      gap: 10px;
      color: var(--green);
      font-weight: 600;
      font-size: 0.95rem;
    }
    .nl-success.show { display: flex; }

    /* ── Footer ── */
    footer {
      position: relative;
      z-index: 1;
      border-top: 1px solid rgba(255,255,255,0.07);
      padding: 56px max(24px, calc((100vw - 1200px)/2)) 32px;
    }
    .footer-grid {
      display: grid;
      grid-template-columns: 1.6fr 1fr 1fr;
      gap: 48px;
      margin-bottom: 48px;
    }
    .footer-brand p {
      font-size: 0.875rem;
      color: var(--text-3);
      line-height: 1.65;
      margin-top: 12px;
      max-width: 280px;
    }
    .social-links {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }
    .social-btn {
      width: 36px; height: 36px;
      border-radius: 9px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.09);
      display: grid;
      place-items: center;
      color: var(--text-3);
      text-decoration: none;
      font-size: 14px;
      transition: all 0.2s;
    }
    .social-btn:hover { background: rgba(168,85,247,0.15); border-color: rgba(168,85,247,0.3); color: var(--accent); }
    .footer-col h4 {
      font-size: 0.8rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--text-3);
      margin-bottom: 16px;
    }
    .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .footer-col ul a {
      font-size: 0.875rem;
      color: var(--text-2);
      text-decoration: none;
      transition: color 0.2s;
    }
    .footer-col ul a:hover { color: var(--text-1); }
    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 24px;
      border-top: 1px solid rgba(255,255,255,0.06);
      font-size: 0.8rem;
      color: var(--text-3);
    }
    .footer-bottom a { color: var(--accent); text-decoration: none; }
    .footer-bottom .mono { font-family: 'JetBrains Mono', monospace; }

    /* ── Scroll reveal ── */
    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .reveal.visible {
      opacity: 1;
      transform: none;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
      .featured-card { grid-template-columns: 1fr; }
      .featured-art { min-height: 220px; }
      .articles-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
      .nav-links { display: none; }
    }
    @media (max-width: 600px) {
      .hero-stats { gap: 24px; }
      .footer-grid { grid-template-columns: 1fr; }
      .newsletter { padding: 36px 24px; }
      .nl-form { flex-direction: column; }
    }
  </style>
</head>
<body>

<!-- Cursor glow -->
<div id="cg"></div>

<!-- Orbs -->
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

<!-- ── Navbar ── -->
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

<!-- ── Hero ── -->
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
      <div class="stat-num">42<span>+</span></div>
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

<!-- ── Content ── -->
<div class="content">

  <!-- Filter bar -->
  <div class="filter-bar" id="filter-bar">
    <span class="filter-label">Filter:</span>
    <button class="chip active" onclick="setFilter(this,'all')">All <span class="chip-count">42</span></button>
    <button class="chip" onclick="setFilter(this,'laravel')">Laravel <span class="chip-count">18</span></button>
    <button class="chip" onclick="setFilter(this,'javascript')">JavaScript <span class="chip-count">12</span></button>
    <button class="chip" onclick="setFilter(this,'devops')">DevOps <span class="chip-count">7</span></button>
    <button class="chip" onclick="setFilter(this,'career')">Career <span class="chip-count">5</span></button>
  </div>

  <!-- Featured article -->
  <div class="section-heading reveal">
    <h2>Featured</h2>
    <span class="badge">Editor's pick</span>
  </div>

  <div class="featured-card reveal" data-cat="laravel">
    <div class="featured-art">
      <!-- SVG cover art -->
      <svg class="art-svg" width="260" height="200" viewBox="0 0 260 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="20" y="20" width="220" height="160" rx="12" fill="rgba(168,85,247,0.08)" stroke="rgba(168,85,247,0.3)" stroke-width="1.5"/>
        <rect x="36" y="36" width="188" height="12" rx="4" fill="rgba(168,85,247,0.25)"/>
        <rect x="36" y="56" width="140" height="8" rx="3" fill="rgba(255,255,255,0.1)"/>
        <rect x="36" y="72" width="160" height="8" rx="3" fill="rgba(255,255,255,0.07)"/>
        <rect x="36" y="88" width="100" height="8" rx="3" fill="rgba(255,255,255,0.07)"/>
        <rect x="36" y="112" width="188" height="1" rx="1" fill="rgba(255,255,255,0.06)"/>
        <circle cx="52" cy="140" r="12" fill="rgba(168,85,247,0.3)"/>
        <rect x="72" y="134" width="80" height="7" rx="3" fill="rgba(255,255,255,0.12)"/>
        <rect x="72" y="145" width="56" height="6" rx="2" fill="rgba(255,255,255,0.07)"/>
        <path d="M196 120 L216 108 L216 132 L196 144 Z" fill="rgba(255,45,85,0.4)" stroke="rgba(255,45,85,0.6)" stroke-width="1"/>
        <path d="M196 120 L176 108 L176 132 L196 144 Z" fill="rgba(255,45,85,0.25)" stroke="rgba(255,45,85,0.4)" stroke-width="1"/>
        <path d="M196 120 L216 108 L196 96 L176 108 Z" fill="rgba(255,45,85,0.55)" stroke="rgba(255,45,85,0.7)" stroke-width="1"/>
      </svg>
    </div>
    <div class="featured-body">
      <div class="featured-meta">
        <span class="cat-badge cat-laravel">Laravel</span>
        <span class="read-time">// 14 min read</span>
      </div>
      <h3>Building a multi-tenant SaaS with Laravel 11 and Livewire 3</h3>
      <p>A complete walkthrough covering team isolation, permission layers, billing with Cashier, and the subtle pitfalls that'll hit you in production — lessons from actually shipping it.</p>
      <div class="featured-footer">
        <div class="author">
          <div class="avatar">AR</div>
          <div>
            <div class="author-name">Abderrahmane</div>
            <div class="author-date">Apr 18, 2025</div>
          </div>
        </div>
        <a href="#" class="read-link">Read article →</a>
      </div>
    </div>
  </div>

  <!-- Articles grid -->
  <div id="articles">
    <div class="section-heading reveal">
      <h2>Recent Articles</h2>
    </div>
  </div>

  <div class="articles-grid" id="articles-grid">

    <!-- Card 1 -->
    <div class="article-card reveal" data-cat="javascript">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-js">JavaScript</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">Signals vs. Observables: why reactivity is finally getting simpler</div>
      <div class="card-excerpt">Angular Signals, SolidJS, Vue's reactivity — the ecosystem is converging on a primitive that solves re-render thrash without a virtual DOM. Here's what it means for your apps.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Apr 12, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">9 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="article-card reveal" data-cat="devops">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-devops">DevOps</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">Zero-downtime deploys on a $6 VPS with Kamal 2</div>
      <div class="card-excerpt">No Kubernetes, no expensive cloud orchestration. Kamal wraps Docker with a clean CLI that handles blue-green deploys, health checks, and rollbacks with minimal config.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Apr 07, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">11 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="article-card reveal" data-cat="laravel">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-laravel">Laravel</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">Eloquent performance patterns you're probably not using</div>
      <div class="card-excerpt">From chunking and lazy collections to batched upserts and strategic indexing — the ORM conveniences that bite you at scale and how to keep your queries fast.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Mar 29, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">13 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="article-card reveal" data-cat="career">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-career">Career</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">How I learned to stop hoarding tabs and actually ship code</div>
      <div class="card-excerpt">The brutal productivity audit that changed how I work: time-boxing research, shipping ugly MVPs, and making peace with "good enough" as a feature.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Mar 21, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">7 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

    <!-- Card 5 -->
    <div class="article-card reveal" data-cat="devops">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-devops">DevOps</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">GitHub Actions caching strategies that actually cut 4&times; build times</div>
      <div class="card-excerpt">Composer cache, npm cache, Docker layer caching, artifact reuse — the pipeline setup that took a 12-minute CI run down to 3 minutes with no code changes.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Mar 14, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">8 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

    <!-- Card 6 -->
    <div class="article-card reveal" data-cat="javascript">
      <div class="card-top">
        <div class="card-cats">
          <span class="cat-badge cat-js">JavaScript</span>
        </div>
        <div class="card-actions">
          <button class="icon-btn" title="Bookmark">&#9825;</button>
        </div>
      </div>
      <div class="card-title">TypeScript discriminated unions: the pattern that replaces a hundred runtime checks</div>
      <div class="card-excerpt">Modeling state machines, API responses, and form lifecycle as discriminated unions — and how the compiler becomes your test suite for the hard edge cases.</div>
      <div class="card-footer">
        <div class="card-meta">
          <span class="card-date">Mar 05, 2025</span>
          <span class="dot-sep"></span>
          <span class="card-read-time">10 min</span>
        </div>
        <a href="#" class="card-link">Read &rarr;</a>
      </div>
    </div>

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

<!-- ── Footer ── -->
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
        <a href="#" class="social-btn" title="RSS">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M6.18 15.64a2.18 2.18 0 012.18 2.18C8.36 19.01 7.38 20 6.18 20C4.98 20 4 19.01 4 17.82a2.18 2.18 0 012.18-2.18M4 4.44A15.56 15.56 0 0119.56 20h-2.83A12.73 12.73 0 004 7.27V4.44m0 5.66a9.9 9.9 0 019.9 9.9h-2.83A7.07 7.07 0 004 12.93V10.1z"/></svg>
        </a>
      </div>
    </div>

    <div class="footer-col">
      <h4>Content</h4>
      <ul>
        <li><a href="#">All Articles</a></li>
        <li><a href="#">Laravel</a></li>
        <li><a href="#">JavaScript</a></li>
        <li><a href="#">DevOps</a></li>
        <li><a href="#">Career</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Links</h4>
      <ul>
        <li><a href="#">About me</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Newsletter</a></li>
        <li><a href="#">RSS Feed</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <span>&copy; {{ date('Y') }} Blog personnel &mdash; Built with <a href="#">Laravel</a></span>
    <span class="mono">v2.0.0</span>
  </div>
</footer>

<script>
  // ── Cursor glow ──
  const cg = document.getElementById('cg');
  document.addEventListener('mousemove', function(e) {
    cg.style.left = e.clientX + 'px';
    cg.style.top  = e.clientY + 'px';
  });

  // ── Orb parallax on mousemove ──
  const orbs = document.querySelectorAll('.orb');
  document.addEventListener('mousemove', function(e) {
    const xRatio = (e.clientX / window.innerWidth  - 0.5) * 2;
    const yRatio = (e.clientY / window.innerHeight - 0.5) * 2;
    orbs.forEach(function(orb, i) {
      const factor = (i + 1) * 14;
      orb.style.transform = 'translate(' + (xRatio * factor) + 'px, ' + (yRatio * factor) + 'px)';
    });
  });

  // ── Scroll reveal ──
  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(function(el) { observer.observe(el); });

  // ── Category filter ──
  var activeFilter = 'all';

  function setFilter(chip, cat) {
    document.querySelectorAll('#filter-bar .chip').forEach(function(c) { c.classList.remove('active'); });
    chip.classList.add('active');
    activeFilter = cat;
    applyFilters();
  }

  function applyFilters() {
    document.querySelectorAll('[data-cat]').forEach(function(card) {
      var match = activeFilter === 'all' || card.dataset.cat === activeFilter;
      card.style.display = match ? '' : 'none';
    });
  }

  // ── Newsletter submit ──
  function nlSubmit(e) {
    e.preventDefault();
    document.getElementById('nl-form').style.display = 'none';
    document.getElementById('nl-success').classList.add('show');
  }

  // ── Card 3D tilt ──
  document.querySelectorAll('.article-card').forEach(function(card) {
    card.addEventListener('mousemove', function(e) {
      var rect = card.getBoundingClientRect();
      var x    = (e.clientX - rect.left) / rect.width  - 0.5;
      var y    = (e.clientY - rect.top)  / rect.height - 0.5;
      card.style.transform = 'perspective(600px) rotateY(' + (x * 8) + 'deg) rotateX(' + (-y * 8) + 'deg) translateZ(4px)';
    });
    card.addEventListener('mouseleave', function() {
      card.style.transform = '';
    });
  });

  // ── Smooth scroll for anchor links ──
  document.querySelectorAll('a[href^="#"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
      var target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
</script>
</body>
</html>
