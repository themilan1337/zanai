<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Google OAuth</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            color: #333;
            margin-bottom: 1.5rem;
        }
        .auth-btn {
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
            margin: 0.5rem;
            width: 200px;
        }
        .google-btn {
            background-color: #4285f4;
        }
        .google-btn:hover {
            background-color: #357ae8;
        }
        .telegram-btn {
            background-color: #0088cc;
        }
        .telegram-btn:hover {
            background-color: #006699;
        }
        .auth-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
        .error-message {
            color: #d32f2f;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: #ffebee;
            border-radius: 4px;
        }
    </style>
    </head>
<body>
    <div class="login-container">
        <h1 class="login-title">Welcome</h1>
        <p>Please sign in with your preferred account to continue.</p>
        
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="auth-buttons">
            <a href="{{ route('auth.google') }}" class="auth-btn google-btn">
                🔐 Sign in with Google
            </a>
            
            {!! Socialite::driver('telegram')->getButton() !!}
        </div>
    </div>
</body>
</html>