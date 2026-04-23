<!DOCTYPE html>
<html>
<head>
    <title>login</title>
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto; border: 1px solid #ddd; padding: 20px; border-radius: 5px;">
        <h1>Connexion</h1>
        
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            
            <button type="submit" style="width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;">
                Se connecter
            </button>
        </form>
    </div>
</body>
</html>