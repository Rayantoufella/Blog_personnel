<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modifier — {{ $article->titre }} — Blog personnel</title>
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
      --amber: #FBBF24;
      --red: #EF4444;
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
      padding-bottom: 80px;
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
    .orb-3 { width: 300px; height: 300px; background: #06B6D4; top: 35%; left: 50%; opacity: 0.14; animation: f3 28s ease-in-out infinite; }
    @keyframes f1 { 0%,100%{transform:translate(0,0)} 40%{transform:translate(35px,-45px)} 70%{transform:translate(-18px,28px)} }
    @keyframes f2 { 0%,100%{transform:translate(0,0)} 35%{transform:translate(-28px,-20px)} 65%{transform:translate(18px,16px)} }
    @keyframes f3 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(40px,-30px)} }

    #cg { position: fixed; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(168,85,247,0.065) 0%, transparent 70%); pointer-events: none; z-index: 0; transform: translate(-50%,-50%); transition: left .12s ease, top .12s ease; }

    .glass {
      background: rgba(255,255,255,0.055);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 16px;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
      transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    }

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
    .logo-text { font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:16px; color:var(--text-1); }
    .logo-text span { color:var(--accent); }

    /* EDITOR TOP BAR */
    .editor-topbar {
      position: sticky; top: 60px; z-index: 150;
      background: rgba(10,1,24,0.75);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.06);
      padding: 0 32px; height: 54px;
      display: flex; align-items: center; justify-content: space-between; gap: 16px;
    }
    .back-link { font-size: 13px; color: var(--text-3); text-decoration: none; display:flex; align-items:center; gap:6px; transition:color .25s; white-space:nowrap; }
    .back-link:hover { color: #C084FC; }

    .topbar-center {
      display: flex; align-items: center; gap: 10px;
      flex: 1; justify-content: center; min-width: 0; overflow: hidden;
    }
    .edit-label { font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--text-3); text-transform:uppercase; letter-spacing:.1em; white-space:nowrap; }
    .edit-title { font-size:13px; font-weight:600; color:var(--text-2); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:280px; }

    .save-indicator { display:flex; align-items:center; gap:7px; font-family:'JetBrains Mono',monospace; font-size:12px; }
    .save-dot { width:7px; height:7px; border-radius:50%; transition:background .4s,box-shadow .4s; }
    .save-dot.unsaved { background:var(--amber); box-shadow:0 0 6px var(--amber); animation:blink 1.5s ease-in-out infinite; }
    .save-dot.saved   { background:var(--green);  box-shadow:0 0 6px var(--green); }
    .save-dot.saving  { background:var(--accent-cyan); box-shadow:0 0 6px var(--accent-cyan); }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

    .topbar-actions { display:flex; align-items:center; gap:8px; }
    .btn-primary { background:linear-gradient(135deg,#A855F7,#EC4899); border:none; border-radius:10px; padding:0 18px; height:36px; font-family:'Inter',sans-serif; font-weight:600; font-size:13px; color:#fff; cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:all .3s cubic-bezier(.4,0,.2,1); white-space:nowrap; }
    .btn-primary:hover { transform:scale(1.02); box-shadow:0 0 24px rgba(168,85,247,.5); }
    .btn-secondary { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); border-radius:10px; padding:0 16px; height:36px; font-family:'Inter',sans-serif; font-weight:500; font-size:13px; color:var(--text-2); cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:all .3s cubic-bezier(.4,0,.2,1); white-space:nowrap; }
    .btn-secondary:hover { border-color:rgba(168,85,247,.45); color:var(--text-1); box-shadow:0 0 14px rgba(168,85,247,.2); }
    .btn-danger-outline { background:transparent; border:1px solid rgba(239,68,68,.3); border-radius:10px; padding:0 14px; height:36px; font-family:'Inter',sans-serif; font-weight:500; font-size:13px; color:rgba(252,165,165,.8); cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:all .3s ease; white-space:nowrap; }
    .btn-danger-outline:hover { background:rgba(239,68,68,.08); border-color:rgba(239,68,68,.6); color:#FCA5A5; box-shadow:0 0 14px rgba(239,68,68,.2); }

    /* LAYOUT */
    .editor-layout {
      position:relative; z-index:1;
      display:grid; grid-template-columns:1fr 320px; gap:24px;
      max-width:1280px; margin:0 auto; padding:36px 32px 40px;
      align-items:start;
    }
    .editor-main { min-width:0; }

    /* TITLE */
    #titleInput {
      width:100%; background:transparent; border:none; outline:none;
      font-family:'Space Grotesk',sans-serif;
      font-size:clamp(32px,4vw,52px); font-weight:700; letter-spacing:-.025em;
      color:var(--text-1); line-height:1.1; padding:0 0 16px; resize:none;
      border-bottom:2px solid rgba(255,255,255,.06); transition:border-color .3s;
      caret-color:var(--accent); overflow:hidden;
    }
    #titleInput:focus { border-bottom-color:rgba(168,85,247,.5); }
    #titleInput::placeholder { color:rgba(255,255,255,.1); }

    /* TOOLBAR */
    .format-toolbar { display:flex; align-items:center; gap:4px; padding:10px 14px; margin:20px 0 0; flex-wrap:wrap; }
    .tool-btn { width:34px; height:34px; border-radius:8px; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07); display:flex; align-items:center; justify-content:center; cursor:pointer; color:var(--text-3); transition:all .2s; font-family:'JetBrains Mono',monospace; font-size:13px; font-weight:700; position:relative; }
    .tool-btn:hover { background:rgba(168,85,247,.12); border-color:rgba(168,85,247,.3); color:#C084FC; }
    .tool-sep { width:1px; height:20px; background:rgba(255,255,255,.08); margin:0 6px; }
    .tool-btn::after { content:attr(data-tip); position:absolute; bottom:calc(100% + 8px); left:50%; transform:translateX(-50%); background:rgba(10,1,24,.95); border:1px solid rgba(255,255,255,.1); border-radius:6px; padding:4px 8px; font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--text-2); white-space:nowrap; opacity:0; pointer-events:none; transition:opacity .2s; }
    .tool-btn:hover::after { opacity:1; }

    /* CONTENT */
    #contentInput {
      width:100%; background:transparent; border:none; outline:none;
      font-family:'Inter',sans-serif; font-size:18px; color:var(--text-2); line-height:1.85;
      padding:24px 0; resize:none; min-height:520px; caret-color:var(--accent);
    }
    #contentInput:focus { color:#E5E5EC; }
    #contentInput::placeholder { color:rgba(255,255,255,.07); font-style:italic; }

    .field-error { display:none; align-items:center; gap:6px; background:rgba(239,68,68,.07); border:1px solid rgba(239,68,68,.2); border-radius:8px; padding:8px 12px; margin-top:6px; font-size:13px; color:rgba(252,165,165,.9); }
    .field-error.visible { display:flex; }

    /* Validation error block */
    .validation-errors { background:rgba(239,68,68,.07); border:1px solid rgba(239,68,68,.2); border-radius:12px; padding:14px 18px; margin-bottom:20px; }
    .validation-errors ul { list-style:none; }
    .validation-errors ul li { font-size:13px; color:rgba(252,165,165,.9); padding:3px 0; display:flex; align-items:center; gap:8px; }
    .validation-errors ul li::before { content:'·'; color:var(--red); font-size:18px; line-height:1; }

    /* SIDEBAR */
    .editor-sidebar { display:flex; flex-direction:column; gap:12px; position:sticky; top:126px; }
    .sidebar-card { padding:18px 20px; }
    .card-label { font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--text-3); text-transform:uppercase; letter-spacing:.1em; margin-bottom:14px; display:flex; align-items:center; gap:8px; }

    /* History card */
    .hist-row { display:flex; justify-content:space-between; align-items:baseline; padding:7px 0; border-bottom:1px solid rgba(255,255,255,.04); gap:8px; }
    .hist-row:last-child { border-bottom:none; }
    .hist-key { font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--text-3); }
    .hist-val { font-family:'JetBrains Mono',monospace; font-size:12px; color:var(--text-2); text-align:right; }

    /* Category */
    .cat-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    .cat-option { padding:12px 10px; border-radius:12px; border:1px solid rgba(255,255,255,.08); background:rgba(255,255,255,.03); cursor:pointer; transition:all .25s; text-align:center; }
    .cat-option:hover { border-color:rgba(168,85,247,.3); }
    .cat-option.selected { border-color:rgba(168,85,247,.6); background:rgba(168,85,247,.1); box-shadow:0 0 16px rgba(168,85,247,.2); }
    .cat-icon { font-size:20px; margin-bottom:6px; }
    .cat-name { font-size:12px; font-weight:500; color:var(--text-2); }

    /* Status */
    .status-option { padding:14px 16px; border-radius:12px; border:1px solid rgba(255,255,255,.08); background:rgba(255,255,255,.03); cursor:pointer; transition:all .25s; margin-bottom:8px; display:flex; gap:12px; align-items:flex-start; }
    .status-option:last-of-type { margin-bottom:0; }
    .status-option:hover { border-color:rgba(168,85,247,.3); }
    .status-option.selected { border-color:rgba(168,85,247,.5); background:rgba(168,85,247,.08); box-shadow:0 0 16px rgba(168,85,247,.15); }
    .status-option.sel-published.selected { border-color:rgba(16,245,160,.5); background:rgba(16,245,160,.06); box-shadow:0 0 14px rgba(16,245,160,.12); }
    .status-icon { font-size:18px; flex-shrink:0; margin-top:1px; }
    .status-title { font-size:14px; font-weight:600; color:var(--text-1); margin-bottom:3px; }
    .status-desc { font-size:12px; color:var(--text-3); line-height:1.5; }

    /* Stats */
    .stat-row { display:flex; justify-content:space-between; align-items:center; padding:6px 0; border-bottom:1px solid rgba(255,255,255,.04); }
    .stat-row:last-child { border-bottom:none; }
    .stat-key { font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--text-3); }
    .stat-val { font-family:'JetBrains Mono',monospace; font-size:12px; color:var(--text-2); font-weight:500; }

    /* Shortcuts */
    .shortcut-row { display:flex; justify-content:space-between; align-items:center; padding:5px 0; }
    .shortcut-row kbd { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); border-radius:4px; padding:2px 6px; font-size:10px; color:var(--text-2); font-family:'JetBrains Mono',monospace; }
    .shortcut-label { font-size:12px; color:var(--text-3); }

    /* Danger zone */
    .danger-card { background:rgba(239,68,68,.04); border:1px solid rgba(239,68,68,.2); border-radius:16px; padding:18px 20px; box-shadow:inset 0 1px 0 rgba(239,68,68,.1); }
    .danger-label { font-family:'JetBrains Mono',monospace; font-size:11px; color:rgba(252,165,165,.7); text-transform:uppercase; letter-spacing:.1em; margin-bottom:12px; display:flex; align-items:center; gap:6px; }
    .btn-danger-full { width:100%; padding:11px 16px; border-radius:10px; background:rgba(239,68,68,.08); border:1px solid rgba(239,68,68,.3); font-family:'Inter',sans-serif; font-size:13px; font-weight:600; color:rgba(252,165,165,.9); cursor:pointer; transition:all .3s; display:flex; align-items:center; justify-content:center; gap:8px; }
    .btn-danger-full:hover { background:rgba(239,68,68,.16); border-color:rgba(239,68,68,.6); color:#FCA5A5; box-shadow:0 0 20px rgba(239,68,68,.2); }

    /* Bottom bar */
    .bottom-bar {
      position:fixed; bottom:0; left:0; right:0; z-index:100;
      background:rgba(10,1,24,.88); backdrop-filter:blur(16px);
      border-top:1px solid rgba(255,255,255,.06);
      padding:14px 32px;
      display:flex; align-items:center; justify-content:space-between; gap:16px;
    }

    /* DELETE MODAL */
    .modal-overlay { position:fixed; inset:0; z-index:999; background:rgba(0,0,0,.7); backdrop-filter:blur(8px); display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .3s; padding:20px; }
    .modal-overlay.open { opacity:1; pointer-events:all; }
    .modal-card { background:rgba(12,4,26,.97); border:1px solid rgba(239,68,68,.25); border-radius:24px; padding:40px; max-width:460px; width:100%; box-shadow:0 0 80px rgba(239,68,68,.2),inset 0 1px 0 rgba(255,255,255,.06); transform:scale(.95) translateY(20px); transition:transform .35s cubic-bezier(.4,0,.2,1); }
    .modal-overlay.open .modal-card { transform:scale(1) translateY(0); }

    .confirm-input { width:100%; background:rgba(239,68,68,.06); border:1px solid rgba(239,68,68,.25); border-radius:10px; padding:12px 14px; font-family:'JetBrains Mono',monospace; font-size:14px; color:var(--text-1); outline:none; transition:all .3s; margin-bottom:20px; letter-spacing:.05em; }
    .confirm-input::placeholder { color:rgba(239,68,68,.35); }
    .confirm-input:focus { border-color:rgba(239,68,68,.6); box-shadow:0 0 0 3px rgba(239,68,68,.1); }

    .btn-delete-confirm { flex:1; padding:13px 20px; border-radius:12px; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.35); font-family:'Inter',sans-serif; font-weight:600; font-size:14px; color:rgba(252,165,165,.8); cursor:pointer; transition:all .3s; }
    .btn-delete-confirm:not(:disabled):hover { background:linear-gradient(135deg,#EF4444,#DC2626); border-color:transparent; color:#fff; box-shadow:0 0 28px rgba(239,68,68,.5); }
    .btn-delete-confirm:disabled { opacity:.35; cursor:not-allowed; }
    .btn-cancel-modal { flex:1; padding:13px 20px; border-radius:12px; background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); font-family:'Inter',sans-serif; font-weight:500; font-size:14px; color:var(--text-2); cursor:pointer; transition:all .3s; }
    .btn-cancel-modal:hover { border-color:rgba(255,255,255,.2); color:var(--text-1); }

    /* Reveal */
    .reveal { opacity:0; transform:translateY(16px); transition:opacity .5s,transform .5s; }
    .reveal.visible { opacity:1; transform:translateY(0); }

    @media (max-width:900px) {
      .editor-layout { grid-template-columns:1fr; }
      .editor-sidebar { position:static; }
      .navbar,.editor-topbar,.bottom-bar { padding-left:20px; padding-right:20px; }
      .editor-layout { padding:24px 20px 100px; }
      .topbar-center .edit-title { max-width:140px; }
    }
  </style>
</head>
<body>

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
    <span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);">Éditeur d'articles</span>
  </header>

  <!-- MAIN UPDATE FORM -->
  <form method="POST" action="{{ route('articles.update', $article) }}" id="mainForm">
    @csrf
    @method('PUT')

    <!-- EDITOR TOP BAR -->
    <div class="editor-topbar">
      <a href="{{ route('dashboard') }}" class="back-link">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Retour
      </a>

      <div class="topbar-center">
        <span class="edit-label">Modification</span>
        <span style="color:rgba(255,255,255,.15);">·</span>
        <span class="edit-title" id="topbarTitle">{{ Str::limit($article->titre, 40) }}</span>
        <span style="color:rgba(255,255,255,.12);">·</span>
        <div class="save-indicator">
          <span class="save-dot saved" id="saveDot"></span>
          <span id="saveLabel" style="color:var(--green);">Tout est à jour</span>
        </div>
      </div>

      <div class="topbar-actions">
        <button type="button" class="btn-danger-outline" onclick="openDeleteModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
          Supprimer
        </button>
        <button type="submit" name="force_statut" value="brouillon" class="btn-secondary" onclick="setStatutAndSubmit('brouillon')">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
          Brouillon
        </button>
        <button type="submit" class="btn-primary">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Mettre à jour
        </button>
      </div>
    </div>

    <div class="editor-layout">

      <!-- MAIN EDITOR -->
      <div class="editor-main reveal">

        @if ($errors->any())
          <div class="validation-errors">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <textarea id="titleInput" name="titre" rows="1"
          placeholder="Titre de l'article..."
          oninput="autoResize(this);onContentChange();syncTopbarTitle(this.value);"
          onkeydown="handleTitleKey(event)"
        >{{ old('titre', $article->titre) }}</textarea>

        <div class="field-error" id="titleError">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Le titre est obligatoire.
        </div>

        <!-- TOOLBAR -->
        <div class="glass format-toolbar" id="toolbar">
          <button type="button" class="tool-btn" data-tip="Gras (Ctrl+B)" onclick="fmt('bold')"><strong>B</strong></button>
          <button type="button" class="tool-btn" data-tip="Italique (Ctrl+I)" onclick="fmt('italic')"><em>I</em></button>
          <button type="button" class="tool-btn" data-tip="Souligné" onclick="fmt('underline')"><u>U</u></button>
          <div class="tool-sep"></div>
          <button type="button" class="tool-btn" data-tip="Lien (Ctrl+K)" onclick="fmt('link')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg></button>
          <button type="button" class="tool-btn" data-tip="Liste" onclick="fmt('list')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></button>
          <button type="button" class="tool-btn" data-tip="Citation" onclick="fmt('quote')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg></button>
          <button type="button" class="tool-btn" data-tip="Code" onclick="fmt('code')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></button>
          <div class="tool-sep"></div>
          <button type="button" class="tool-btn" data-tip="H2" onclick="fmt('h2')" style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:11px;">H2</button>
          <button type="button" class="tool-btn" data-tip="H3" onclick="fmt('h3')" style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:10px;">H3</button>
          <div style="margin-left:auto;font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-3);"><span id="charCount">0</span> car.</div>
        </div>

        <div class="field-error" id="contentError">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Le contenu ne peut pas être vide.
        </div>

        <textarea id="contentInput" name="contenu"
          placeholder="Commencez à écrire votre article..."
          oninput="onContentChange();updateStats();"
        >{{ old('contenu', $article->contenu) }}</textarea>

      </div>

      <!-- SIDEBAR -->
      <aside class="editor-sidebar">

        <!-- HISTORY CARD -->
        <div class="glass sidebar-card reveal" style="transition-delay:.0s;">
          <div class="card-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Historique
          </div>
          <div class="hist-row">
            <span class="hist-key">Créé le</span>
            <span class="hist-val">{{ $article->created_at->format('d M Y, H:i') }}</span>
          </div>
          <div class="hist-row">
            <span class="hist-key">Modifié le</span>
            <span class="hist-val">{{ $article->updated_at->format('d M Y, H:i') }}</span>
          </div>
          @if($article->date_publication)
          <div class="hist-row">
            <span class="hist-key">Publié le</span>
            <span class="hist-val" style="color:var(--green);">{{ $article->date_publication->format('d M Y') }}</span>
          </div>
          @endif
          @if($article->views)
          <div class="hist-row">
            <span class="hist-key">Vues</span>
            <span class="hist-val" style="color:#06B6D4;">{{ number_format($article->views) }}</span>
          </div>
          @endif
        </div>

        <!-- CATEGORY -->
        <div class="glass sidebar-card reveal" style="transition-delay:.05s;">
          <div class="card-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
            Catégorie
          </div>
          <div class="cat-grid">
            @foreach($categories as $cat)
              @php
                $slug = strtolower($cat->nom);
                $icons = ['laravel' => '⚡', 'php' => '🐘', 'securite' => '🔐', 'sécurité' => '🔐', 'web design' => '🎨', 'javascript' => '✦', 'devops' => '⚙', 'carrière' => '★'];
                $icon = $icons[$slug] ?? '📁';
                $isSelected = (old('category_id', $article->category_id) == $cat->id) ? 'selected' : '';
              @endphp
              <div class="cat-option {{ $isSelected }}" onclick="selectCat(this, {{ $cat->id }})">
                <div class="cat-icon">{{ $icon }}</div>
                <div class="cat-name">{{ $cat->nom }}</div>
              </div>
            @endforeach
          </div>
          <input type="hidden" name="category_id" id="catInput" value="{{ old('category_id', $article->category_id) }}" />
        </div>

        <!-- STATUS -->
        <div class="glass sidebar-card reveal" style="transition-delay:.1s;">
          <div class="card-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Statut
          </div>
          @php $currentStatut = old('statut', $article->statut); @endphp
          <div class="status-option {{ $currentStatut === 'brouillon' ? 'selected' : '' }}" id="statusDraft" onclick="selectStatus('brouillon')">
            <span class="status-icon">📝</span>
            <div>
              <div class="status-title">Brouillon</div>
              <div class="status-desc">Privé, visible uniquement dans ton dashboard</div>
            </div>
          </div>
          <div class="status-option sel-published {{ $currentStatut === 'publie' ? 'selected' : '' }}" id="statusPublished" onclick="selectStatus('publie')">
            <span class="status-icon">🌐</span>
            <div>
              <div class="status-title">Publié</div>
              <div class="status-desc">Visible par tous les visiteurs de ton blog</div>
            </div>
          </div>
          <input type="hidden" name="statut" id="statutInput" value="{{ $currentStatut }}" />
        </div>

        <!-- STATS -->
        <div class="glass sidebar-card reveal" style="transition-delay:.15s;">
          <div class="card-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
            Statistiques
          </div>
          <div class="stat-row"><span class="stat-key">Mots</span><span class="stat-val" id="wordCount">0</span></div>
          <div class="stat-row"><span class="stat-key">Lecture estimée</span><span class="stat-val" id="readTime">0 min</span></div>
          <div class="stat-row"><span class="stat-key">Caractères</span><span class="stat-val" id="charCountSide">0</span></div>
          <div class="stat-row"><span class="stat-key">Dernière modif.</span><span class="stat-val" id="lastSave" style="color:var(--text-3);">jamais</span></div>
        </div>

        <!-- SHORTCUTS -->
        <div class="glass sidebar-card reveal" style="background:rgba(255,255,255,.025);transition-delay:.2s;">
          <div class="card-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
            Raccourcis
          </div>
          <div class="shortcut-row"><span><kbd>Ctrl+S</kbd></span><span class="shortcut-label">Enregistrer brouillon</span></div>
          <div class="shortcut-row"><span><kbd>Ctrl+Enter</kbd></span><span class="shortcut-label">Mettre à jour</span></div>
          <div class="shortcut-row"><span><kbd>Ctrl+B</kbd></span><span class="shortcut-label">Gras</span></div>
          <div class="shortcut-row"><span><kbd>Ctrl+I</kbd></span><span class="shortcut-label">Italique</span></div>
          <div class="shortcut-row"><span><kbd>Ctrl+K</kbd></span><span class="shortcut-label">Insérer un lien</span></div>
        </div>

        <!-- DANGER ZONE -->
        <div class="danger-card reveal" style="transition-delay:.25s;">
          <div class="danger-label">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Zone dangereuse
          </div>
          <button type="button" class="btn-danger-full" onclick="openDeleteModal()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
            Supprimer définitivement
          </button>
          <p style="font-size:12px;color:rgba(252,165,165,.4);text-align:center;margin-top:10px;font-family:'JetBrains Mono',monospace;">Cette action est irréversible</p>
        </div>

      </aside>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bottom-bar">
      <div style="display:flex;align-items:center;gap:8px;">
        <div class="save-dot saved" id="saveDot2"></div>
        <span id="saveLabel2" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--green);">Tout est à jour</span>
      </div>
      <a href="{{ route('dashboard') }}" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-3);text-decoration:none;display:flex;align-items:center;gap:5px;transition:color .2s;" onmouseenter="this.style.color='#C084FC'" onmouseleave="this.style.color='var(--text-3)'">
        ← Retour au dashboard
      </a>
      <div style="display:flex;gap:8px;">
        <button type="button" class="btn-danger-outline" onclick="openDeleteModal()">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
        </button>
        <button type="button" class="btn-secondary" onclick="setStatutAndSubmit('brouillon')">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
          Brouillon
        </button>
        <button type="submit" class="btn-primary">
          <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Mettre à jour
        </button>
      </div>
    </div>

  </form>

  <!-- DELETE FORM (separate, uses DELETE method) -->
  <form method="POST" action="{{ route('articles.delete', $article) }}" id="deleteForm">
    @csrf
    @method('DELETE')
  </form>

  <!-- DELETE MODAL -->
  <div class="modal-overlay" id="deleteModal" onclick="overlayClose(event)">
    <div class="modal-card">
      <div style="width:60px;height:60px;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:0 0 20px rgba(239,68,68,.2);">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#EF4444" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M9 6V4h6v2"/></svg>
      </div>
      <h3 style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:700;text-align:center;margin-bottom:10px;letter-spacing:-.015em;">Tu es sûr ?</h3>
      <p style="text-align:center;color:var(--text-2);font-size:15px;line-height:1.65;margin-bottom:6px;">
        L'article <strong style="color:rgba(252,165,165,.9);">"{{ Str::limit($article->titre, 40) }}"</strong> sera définitivement supprimé.
      </p>
      <p style="text-align:center;color:var(--text-3);font-size:13px;margin-bottom:28px;">Cette action ne peut pas être annulée.</p>

      <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:11px;color:rgba(252,165,165,.6);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;">
        Tape <span style="color:rgba(239,68,68,.8);font-weight:700;">SUPPRIMER</span> pour confirmer
      </label>
      <input
        class="confirm-input"
        type="text"
        id="confirmInput"
        placeholder="SUPPRIMER"
        oninput="checkConfirm(this.value)"
        autocomplete="off"
        spellcheck="false"
      />

      <div style="display:flex;gap:10px;">
        <button class="btn-cancel-modal" onclick="closeDeleteModal()">Annuler</button>
        <button class="btn-delete-confirm" id="deleteConfirmBtn" disabled onclick="confirmDelete()">Supprimer définitivement</button>
      </div>
    </div>
  </div>

  <script>
    // Cursor glow
    const cg = document.getElementById('cg');
    document.addEventListener('mousemove', e => { cg.style.left=e.clientX+'px'; cg.style.top=e.clientY+'px'; });

    // Orb parallax
    const o1=document.querySelector('.orb-1'), o2=document.querySelector('.orb-2');
    document.addEventListener('mousemove', e => {
      const x=(e.clientX/window.innerWidth-.5)*25;
      const y=(e.clientY/window.innerHeight-.5)*25;
      o1.style.transform=`translate(${x}px,${y}px)`;
      o2.style.transform=`translate(${-x*.6}px,${-y*.6}px)`;
    });

    // Scroll reveal
    const obs = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), {threshold:.05});
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

    // Init textareas
    window.addEventListener('load', () => {
      document.querySelectorAll('textarea').forEach(t => autoResize(t));
      updateStats();
    });

    function autoResize(el) { el.style.height='auto'; el.style.height=el.scrollHeight+'px'; }
    function handleTitleKey(e) { if(e.key==='Enter'){e.preventDefault();document.getElementById('contentInput').focus();} }

    function syncTopbarTitle(val) {
      const short = val.length > 40 ? val.substring(0,40)+'...' : val;
      document.getElementById('topbarTitle').textContent = short || 'Sans titre';
    }

    // Save state
    let dirty = false, saveTimer = null;

    function onContentChange() {
      if(!dirty) { dirty=true; setSaveState('unsaved'); }
      clearTimeout(saveTimer);
      saveTimer = setTimeout(() => { setSaveState('unsaved'); }, 500);
    }

    function setSaveState(state) {
      const dots = [document.getElementById('saveDot'), document.getElementById('saveDot2')];
      const lbls = [document.getElementById('saveLabel'), document.getElementById('saveLabel2')];
      dots.forEach(d => { d.className='save-dot'; });
      if (state === 'unsaved') {
        dots.forEach(d => d.classList.add('unsaved'));
        lbls.forEach(l => { l.textContent='Non enregistré'; l.style.color='var(--amber)'; });
      } else {
        dots.forEach(d => d.classList.add('saved'));
        lbls.forEach(l => { l.textContent='Tout est à jour'; l.style.color='var(--green)'; });
      }
    }

    // Category selector
    function selectCat(el, id) {
      document.querySelectorAll('.cat-option').forEach(o => o.classList.remove('selected'));
      el.classList.add('selected');
      document.getElementById('catInput').value = id;
      onContentChange();
    }

    // Status selector
    function selectStatus(s) {
      document.getElementById('statusDraft').classList.toggle('selected', s === 'brouillon');
      document.getElementById('statusPublished').classList.toggle('selected', s === 'publie');
      document.getElementById('statutInput').value = s;
      onContentChange();
    }

    // Save as draft: set statut to brouillon then submit
    function setStatutAndSubmit(statut) {
      document.getElementById('statutInput').value = statut;
      document.getElementById('statusDraft').classList.toggle('selected', statut === 'brouillon');
      document.getElementById('statusPublished').classList.toggle('selected', statut === 'publie');
      document.getElementById('mainForm').submit();
    }

    // Format toolbar
    function fmt(type) {
      const ta = document.getElementById('contentInput');
      const s = ta.selectionStart, end = ta.selectionEnd, sel = ta.value.substring(s, end);
      const map = {
        bold: `**${sel||'texte'}**`,
        italic: `*${sel||'texte'}*`,
        underline: `<u>${sel||'texte'}</u>`,
        link: `[${sel||'lien'}](https://)`,
        list: `\n- ${sel||'élément'}`,
        quote: `\n> ${sel||'citation'}`,
        code: sel.includes('\n') ? `\n\`\`\`\n${sel||'code'}\n\`\`\`` : `\`${sel||'code'}\``,
        image: `![${sel||'alt'}](url)`,
        h2: `\n## ${sel||'Titre'}`,
        h3: `\n### ${sel||'Sous-titre'}`
      };
      const w = map[type] || sel;
      ta.value = ta.value.substring(0,s) + w + ta.value.substring(end);
      ta.focus(); ta.selectionStart = ta.selectionEnd = s + w.length;
      onContentChange(); updateStats();
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', e => {
      if (e.ctrlKey || e.metaKey) {
        if (e.key === 's') { e.preventDefault(); setStatutAndSubmit('brouillon'); }
        if (e.key === 'Enter') { e.preventDefault(); document.getElementById('mainForm').submit(); }
        if (e.key === 'b') { e.preventDefault(); fmt('bold'); }
        if (e.key === 'i') { e.preventDefault(); fmt('italic'); }
        if (e.key === 'k') { e.preventDefault(); fmt('link'); }
      }
    });

    // Stats
    function updateStats() {
      const content = document.getElementById('contentInput').value;
      const title = document.getElementById('titleInput').value;
      const words = (title+' '+content).trim().split(/\s+/).filter(w=>w.length>0).length;
      const chars = content.length;
      const rm = Math.max(1, Math.ceil(words/200));
      document.getElementById('wordCount').textContent = words.toLocaleString('fr');
      document.getElementById('readTime').textContent = rm + ' min';
      document.getElementById('charCountSide').textContent = chars.toLocaleString('fr');
      document.getElementById('charCount').textContent = chars.toLocaleString('fr');
    }

    // DELETE MODAL
    function openDeleteModal() {
      document.getElementById('deleteModal').classList.add('open');
      document.getElementById('confirmInput').value = '';
      document.getElementById('deleteConfirmBtn').disabled = true;
      setTimeout(() => document.getElementById('confirmInput').focus(), 300);
    }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('open'); }
    function overlayClose(e) { if(e.target === document.getElementById('deleteModal')) closeDeleteModal(); }
    function checkConfirm(v) { document.getElementById('deleteConfirmBtn').disabled = v !== 'SUPPRIMER'; }
    function confirmDelete() {
      const btn = document.getElementById('deleteConfirmBtn');
      btn.textContent = 'Suppression...';
      btn.style.background = 'linear-gradient(135deg,#EF4444,#DC2626)';
      btn.style.color = '#fff';
      btn.disabled = true;
      setTimeout(() => document.getElementById('deleteForm').submit(), 700);
    }
    document.addEventListener('keydown', e => { if(e.key === 'Escape') closeDeleteModal(); });
  </script>

</body>
</html>
