@extends('layouts.app')

@section('title', 'Connexion')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="auth-container">
        <div class="auth-form-wrapper">
            <div class="auth-form">
                <div class="auth-header">
                    <h1>Connexion</h1>
                    <p>Accédez à votre tableau de bord</p>
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

                <form method="POST" action="{{ route('auth.login') }}" class="form">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="votre@email.com" required value="{{ old('email') }}">
                        @error('email')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="password-toggle" id="passwordToggle">👁️</button>
                        </div>
                        @error('password')
                            <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" value="on">
                        <label for="remember" style="margin: 0;">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="submit-btn">Se connecter</button>
                </form>

                <div class="auth-footer">
                    <p>Données de test : user@gmail.com / 123456</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            .auth-form {
                padding: 24px;
            }
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
