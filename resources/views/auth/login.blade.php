<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPersonnel — Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --violet:  #7c3aed;
            --rose:    #db2777;
            --purple:  #a855f7;
            --bg:      #05030f;
        }

        /* ════════════════════════════════
           BASE
        ════════════════════════════════ */
        html { height: 100%; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100%;
            background: var(--bg);
            color: #fff;
            overflow-x: hidden;
        }

        /* ════════════════════════════════
           AURORA BACKGROUND
        ════════════════════════════════ */
        .aurora {
            position: fixed; inset: 0;
            z-index: 0; overflow: hidden;
            pointer-events: none;
        }
        .aurora-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
        }
        .orb-1 {
            width: 75vw; height: 75vw;
            background: radial-gradient(circle at center, rgba(88,28,220,.55) 0%, transparent 65%);
            top: -25%; left: -20%;
            animation: drift1 20s ease-in-out infinite alternate;
        }
        .orb-2 {
            width: 55vw; height: 55vw;
            background: radial-gradient(circle at center, rgba(190,24,93,.4) 0%, transparent 65%);
            bottom: -20%; right: -15%;
            animation: drift2 26s ease-in-out infinite alternate;
        }
        .orb-3 {
            width: 45vw; height: 45vw;
            background: radial-gradient(circle at center, rgba(49,10,120,.5) 0%, transparent 65%);
            top: 40%; left: 40%;
            animation: drift3 18s ease-in-out infinite alternate;
        }
        @keyframes drift1 {
            to { transform: translate(6%, 10%) scale(1.08); }
        }
        @keyframes drift2 {
            to { transform: translate(-8%, -6%) scale(1.12); }
        }
        @keyframes drift3 {
            to { transform: translate(-10%, 8%) scale(0.92); }
        }

        /* Dot grid */
        .grid-layer {
            position: fixed; inset: 0; z-index: 0;
            background-image: radial-gradient(rgba(255,255,255,0.055) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
        }
        /* Vignette to fade grid edges */
        .grid-layer::after {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 80% 70% at 50% 50%, transparent 30%, var(--bg) 100%);
        }

        /* ════════════════════════════════
           NAVBAR
        ════════════════════════════════ */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 200;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; height: 58px;
            background: rgba(5,3,15,.7);
            backdrop-filter: blur(18px) saturate(160%);
            border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .nav-brand {
            display: flex; align-items: center; gap: 10px;
            font-size: 15px; font-weight: 800; letter-spacing: -.02em;
            text-decoration: none; color: #fff;
        }
        .brand-mark {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, var(--violet), var(--rose));
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 900;
            box-shadow: 0 0 18px rgba(124,58,237,.55);
        }
        .brand-dot { color: var(--purple); }
        .nav-link {
            font-size: 13px; font-weight: 500;
            color: rgba(255,255,255,.38);
            text-decoration: none;
            display: flex; align-items: center; gap: 6px;
            transition: color .2s;
        }
        .nav-link:hover { color: rgba(255,255,255,.8); }
        .nav-link svg { width: 14px; height: 14px; transition: transform .2s; }
        .nav-link:hover svg { transform: translateX(2px); }

        /* ════════════════════════════════
           MAIN LAYOUT
        ════════════════════════════════ */
        main {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 80px 20px 60px;
        }

        /* ════════════════════════════════
           CARD  (gradient-border wrapper)
        ════════════════════════════════ */
        .card-shell {
            position: relative;
            padding: 1px; border-radius: 24px;
            background: linear-gradient(
                140deg,
                rgba(124,58,237,.6) 0%,
                rgba(219,39,119,.35) 40%,
                rgba(124,58,237,.08) 70%,
                transparent 100%
            );
            animation: cardIn .6s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(22px) scale(.98); }
            to   { opacity: 1; transform: translateY(0)    scale(1); }
        }
        .card {
            background: rgba(8,5,20,.88);
            border-radius: 23px;
            padding: 48px 44px 40px;
            backdrop-filter: blur(36px) saturate(150%);
            width: 100%; max-width: 460px;
        }

        /* ════════════════════════════════
           LOCK ICON  (spinning ring)
        ════════════════════════════════ */
        .icon-wrap {
            width: 72px; height: 72px;
            margin: 0 auto 30px;
            position: relative;
        }
        /* Spinning conic ring */
        .icon-ring {
            position: absolute; inset: -3px;
            border-radius: 50%;
            background: conic-gradient(
                from 0deg,
                transparent 0%,
                rgba(168,85,247,.9) 30%,
                rgba(219,39,119,.9) 55%,
                transparent 70%
            );
            animation: rotatRing 4s linear infinite;
        }
        @keyframes rotatRing {
            to { transform: rotate(360deg); }
        }
        /* Gap between ring and icon bg */
        .icon-ring::after {
            content: '';
            position: absolute; inset: 2px;
            border-radius: 50%;
            background: rgba(8,5,20,.88);
        }
        .icon-bg {
            position: absolute; inset: 0;
            border-radius: 50%;
            background: linear-gradient(145deg, #581c87, #7c3aed, #a855f7);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 28px rgba(124,58,237,.5), inset 0 1px 0 rgba(255,255,255,.15);
        }
        .icon-bg svg { width: 28px; height: 28px; color: #fff; }

        /* ════════════════════════════════
           HEADINGS
        ════════════════════════════════ */
        .card-title {
            text-align: center;
            font-size: 30px; font-weight: 900; letter-spacing: -.03em;
            background: linear-gradient(135deg, #fff 40%, rgba(168,85,247,.8));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        .card-sub {
            text-align: center; font-size: 13.5px;
            color: rgba(255,255,255,.35); line-height: 1.5;
            margin-bottom: 36px;
        }

        /* ════════════════════════════════
           ERROR BOX
        ════════════════════════════════ */
        .error-box {
            background: rgba(239,68,68,.09);
            border: 1px solid rgba(239,68,68,.28);
            border-radius: 12px; padding: 13px 16px;
            color: #fca5a5; font-size: 13px; margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px;
        }
        .error-box svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .8; }

        /* ════════════════════════════════
           FORM
        ════════════════════════════════ */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 10.5px; font-weight: 700;
            letter-spacing: .11em; text-transform: uppercase;
            color: rgba(255,255,255,.32); margin-bottom: 9px;
        }
        .input-wrap { position: relative; display: flex; align-items: center; }
        .fi {
            position: absolute; left: 15px; pointer-events: none;
            color: rgba(255,255,255,.26); display: flex; align-items: center;
        }
        .fi svg { width: 16px; height: 16px; }
        .form-input {
            width: 100%;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 12px; color: #fff;
            font-size: 14px; font-family: inherit;
            padding: 13.5px 16px 13.5px 44px;
            outline: none; transition: border-color .2s, background .2s, box-shadow .25s;
            caret-color: var(--purple);
        }
        .form-input::placeholder { color: rgba(255,255,255,.18); }
        .form-input:focus {
            border-color: rgba(168,85,247,.6);
            background: rgba(168,85,247,.06);
            box-shadow:
                0 0 0 3px rgba(124,58,237,.18),
                inset 0 1px 0 rgba(255,255,255,.04);
        }
        /* Eye toggle */
        .btn-eye {
            position: absolute; right: 14px;
            background: none; border: none; padding: 0;
            color: rgba(255,255,255,.25); cursor: pointer; line-height: 0;
            transition: color .2s;
        }
        .btn-eye:hover { color: rgba(255,255,255,.65); }
        .btn-eye svg { width: 17px; height: 17px; }

        /* ════════════════════════════════
           REMEMBER ROW
        ════════════════════════════════ */
        .row-meta {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        /* Custom checkbox */
        .check-label {
            display: flex; align-items: center; gap: 9px;
            font-size: 13px; color: rgba(255,255,255,.42);
            cursor: pointer; user-select: none;
        }
        .check-label input { display: none; }
        .check-box {
            width: 17px; height: 17px; border-radius: 5px; flex-shrink: 0;
            border: 1.5px solid rgba(255,255,255,.18);
            background: rgba(255,255,255,.04);
            display: flex; align-items: center; justify-content: center;
            transition: border-color .2s, background .2s;
        }
        .check-label input:checked ~ .check-box {
            background: linear-gradient(135deg, var(--violet), var(--rose));
            border-color: transparent;
        }
        .check-box svg { width: 10px; height: 10px; color: #fff; opacity: 0; transition: opacity .15s; }
        .check-label input:checked ~ .check-box svg { opacity: 1; }

        .forgot {
            font-size: 13px; color: rgba(255,255,255,.3);
            text-decoration: none; transition: color .2s;
        }
        .forgot:hover { color: var(--purple); }

        /* ════════════════════════════════
           SUBMIT BUTTON  (shimmer)
        ════════════════════════════════ */
        .btn-submit {
            position: relative; overflow: hidden;
            width: 100%; padding: 15px;
            background: linear-gradient(135deg, var(--violet) 0%, var(--rose) 100%);
            border: none; border-radius: 12px; color: #fff;
            font-size: 15px; font-weight: 700; font-family: inherit;
            letter-spacing: .01em; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 9px;
            box-shadow: 0 6px 24px rgba(124,58,237,.42), 0 1px 0 rgba(255,255,255,.12) inset;
            transition: opacity .2s, transform .15s, box-shadow .2s;
        }
        .btn-submit::after {
            content: '';
            position: absolute; top: 0; left: -120%; width: 55%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.18), transparent);
            animation: shimmer 2.8s ease-in-out 1.2s infinite;
        }
        @keyframes shimmer {
            0%        { left: -120%; }
            40%, 100% { left: 150%; }
        }
        .btn-submit:hover {
            opacity: .92; transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(124,58,237,.52), 0 1px 0 rgba(255,255,255,.12) inset;
        }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit svg { width: 16px; height: 16px; transition: transform .2s; }
        .btn-submit:hover svg { transform: translateX(3px); }

        /* Loading state */
        .btn-submit.loading { pointer-events: none; opacity: .7; }
        .btn-submit.loading .btn-text { opacity: 0; }
        .btn-submit .spinner {
            display: none;
            position: absolute;
            width: 20px; height: 20px;
            border: 2.5px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-submit.loading .spinner { display: block; }

        /* ════════════════════════════════
           DIVIDER
        ════════════════════════════════ */
        .divider {
            display: flex; align-items: center; gap: 14px;
            margin: 26px 0;
        }
        .div-line { flex: 1; height: 1px; background: rgba(255,255,255,.07); }
        .div-txt { font-size: 12px; color: rgba(255,255,255,.22); letter-spacing: .05em; }

        /* ════════════════════════════════
           NO ACCOUNT
        ════════════════════════════════ */
        .no-account { text-align: center; }
        .no-account p:first-child {
            font-size: 13.5px; color: rgba(255,255,255,.5); margin-bottom: 5px;
        }
        .no-account p:last-child {
            font-size: 12px; color: rgba(255,255,255,.24);
            line-height: 1.5;
        }

        /* ════════════════════════════════
           SECURE BAR
        ════════════════════════════════ */
        .secure-bar {
            display: flex; align-items: center; justify-content: center; gap: 20px;
            margin-top: 26px; padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .s-item {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: rgba(255,255,255,.25);
        }
        .s-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px #22c55e80;
            animation: blink 2.4s ease-in-out infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: .4; }
        }
        .s-item svg { width: 12px; height: 12px; opacity: .6; }
    </style>
</head>
<body>

{{-- ── Aurora background ── --}}
<div class="aurora" aria-hidden="true">
    <div class="aurora-orb orb-1"></div>
    <div class="aurora-orb orb-2"></div>
    <div class="aurora-orb orb-3"></div>
</div>
<div class="grid-layer" aria-hidden="true"></div>

{{-- ── Navbar ── --}}
<nav class="navbar">
    <a href="{{ route('welcome') }}" class="nav-brand">
        <div class="brand-mark">B</div>
        Blog<span class="brand-dot">Personnel</span>
    </a>
    <a href="{{ route('welcome') }}" class="nav-link">
        Retour au blog
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
        </svg>
    </a>
</nav>

{{-- ── Main ── --}}
<main>
    <div class="card-shell">
        <div class="card">

            {{-- Lock icon with spinning ring --}}
            <div class="icon-wrap" aria-hidden="true">
                <div class="icon-ring"></div>
                <div class="icon-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3C17.25 3.85 14.9 1.5 12 1.5zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <h1 class="card-title">Bon retour</h1>
            <p class="card-sub">Connectez-vous à votre espace d'écriture</p>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="error-box" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Adresse email</label>
                    <div class="input-wrap">
                        <span class="fi">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                            </svg>
                        </span>
                        <input
                            class="form-input"
                            type="email" id="email" name="email"
                            placeholder="vous@exemple.com"
                            value="{{ old('email') }}"
                            autocomplete="email" required autofocus>
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <span class="fi">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3C17.25 3.85 14.9 1.5 12 1.5zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input
                            class="form-input"
                            type="password" id="password" name="password"
                            placeholder="••••••••••••"
                            autocomplete="current-password" required>
                        <button type="button" class="btn-eye" id="eyeBtn" title="Afficher / Masquer">
                            {{-- Eye open --}}
                            <svg id="ico-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd"/>
                            </svg>
                            {{-- Eye slash --}}
                            <svg id="ico-slash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="display:none">
                                <path d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z"/>
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM21.25 12a11.264 11.264 0 01-4.949 7.978.75.75 0 01-.832-1.245A9.766 9.766 0 0019.75 12a9.75 9.75 0 00-1.04-4.392.75.75 0 011.305-.738A11.24 11.24 0 0121.25 12z"/>
                                <path d="M4.25 12c0-1.578.37-3.07 1.027-4.393a.75.75 0 00-1.338-.675A11.249 11.249 0 001.75 12a11.25 11.25 0 005.28 9.55.75.75 0 10.784-1.273A9.75 9.75 0 014.25 12z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember / Forgot --}}
                <div class="row-meta">
                    <label class="check-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="check-box">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Se souvenir de moi
                    </label>
                    <a href="#" class="forgot">Mot de passe oublié ?</a>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit" id="submitBtn">
                    <div class="spinner"></div>
                    <span class="btn-text" style="display:flex;align-items:center;gap:9px;">
                        Se connecter
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </button>
            </form>

            {{-- Divider --}}
            <div class="divider">
                <div class="div-line"></div>
                <span class="div-txt">OU</span>
                <div class="div-line"></div>
            </div>

            {{-- No account --}}
            <div class="no-account">
                <p>Pas encore de compte ?</p>
                <p>L'inscription se fait sur invitation uniquement.<br>Contactez un administrateur.</p>
            </div>

            {{-- Secure bar --}}
            <div class="secure-bar" aria-label="Informations de sécurité">
                <div class="s-item">
                    <div class="s-dot"></div>
                    Connexion sécurisée
                </div>
                <div class="s-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3C17.25 3.85 14.9 1.5 12 1.5zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                    </svg>
                    Chiffrement TLS
                </div>
            </div>

        </div>{{-- /card --}}
    </div>{{-- /card-shell --}}
</main>

<script>
    // ── Password toggle
    const pwInput  = document.getElementById('password');
    const eyeBtn   = document.getElementById('eyeBtn');
    const icoEye   = document.getElementById('ico-eye');
    const icoSlash = document.getElementById('ico-slash');

    eyeBtn.addEventListener('click', () => {
        const show = pwInput.type === 'password';
        pwInput.type     = show ? 'text' : 'password';
        icoEye.style.display   = show ? 'none'  : 'block';
        icoSlash.style.display = show ? 'block' : 'none';
    });

    // ── Submit loading state
    document.getElementById('loginForm').addEventListener('submit', () => {
        document.getElementById('submitBtn').classList.add('loading');
    });
</script>
</body>
</html>
