<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPersonnel — Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
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

<script src="{{ asset('js/auth/login.js') }}"></script>
</body>
</html>
