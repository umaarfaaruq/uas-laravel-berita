<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Berita Terkini</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

        /* Root theme colors based on green Persebaya theme */
        :root {
            --green-dark: #004d30;
            --green-mid: #007a4d;
            --green-light: #00b140;
            --green-accent: #61e786;
            --text-light: #e6f2e6;
            --bg-gradient-start: #003926;
            --bg-gradient-end: #005c3a;
            --button-bg: var(--green-light);
            --button-hover-bg: var(--green-accent);
            --input-bg: rgba(255, 255, 255, 0.1);
            --input-border: rgba(255, 255, 255, 0.3);
            --input-focus-border: var(--green-accent);
            --error-red: #ff4d4d;
        }

        /* Reset & base */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            text-align: center;
        }

        .container {
            max-width: 480px;
            width: 100%;
            background: rgba(0, 123, 77, 0.85); /* Slightly transparent green */
            border-radius: 24px;
            padding: 48px 32px 64px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px); /* Frosted glass effect */
            animation: fadeInUp 0.8s ease forwards; /* Added animation */
        }

        h2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 24px;
            color: var(--text-light);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-light);
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--input-border);
            background-color: var(--input-bg);
            color: var(--text-light);
            font-size: 1rem;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .form-group input[type="email"]::placeholder,
        .form-group input[type="password"]::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: var(--input-focus-border);
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(97, 231, 134, 0.4);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 20px;
            text-align: left;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 1px solid var(--input-border);
            background-color: var(--input-bg);
            cursor: pointer;
            -webkit-appearance: none; /* Hide default checkbox */
            -moz-appearance: none;
            appearance: none;
            position: relative;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .checkbox-group input[type="checkbox"]:checked {
            background-color: var(--green-accent);
            border-color: var(--green-accent);
        }

        .checkbox-group input[type="checkbox"]:checked::after {
            content: '✔'; /* Checkmark */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--green-dark);
            font-size: 14px;
            font-weight: bold;
        }

        .checkbox-group label {
            font-size: 0.95rem;
            color: var(--text-light);
            cursor: pointer;
        }

        .form-footer {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        .form-footer a {
            color: #c9f7c9;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: var(--green-accent);
            text-decoration: underline;
        }

        .button {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 16px 48px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease,
                transform 0.2s ease;
            min-width: 140px;
            color: var(--green-dark);
            text-decoration: none;
            display: inline-block;
            background-color: var(--text-light);
            box-shadow: 0 6px 12px rgba(230, 242, 230, 0.7);
        }

        .button:hover,
        .button:focus {
            background-color: var(--green-accent);
            color: var(--green-dark);
            box-shadow: 0 10px 20px rgba(97, 231, 134, 0.8);
            transform: translateY(-3px);
            outline: none; /* Remove default outline for focus */
        }
        
        .button:focus-visible {
            outline: 3px solid var(--green-accent);
            outline-offset: 2px;
        }

        /* Error messages styling */
        .alert-message {
            background-color: rgba(255, 77, 77, 0.2);
            color: var(--error-red);
            border: 1px solid var(--error-red);
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: left;
        }

        .input-error {
            color: var(--error-red);
            font-size: 0.85rem;
            margin-top: 8px;
            display: block;
            text-align: left;
        }

        /* Animation subtle fade-in */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <main class="container" role="main" aria-label="Login page berita terkini">
        <h2>Login ke Akun Anda</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email Anda">
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" aria-label="Lupa password Anda?">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="button" aria-label="Log in">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </main>
</body>
</html>
