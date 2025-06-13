<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome - Berita Terkini</title>
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
        }

        h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 24px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.75);
        }

        p.subtitle {
            font-weight: 400;
            font-size: 1.25rem;
            margin-bottom: 48px;
            color: #c9f7c9; /* Lighter green for subtitle */
            line-height: 1.5;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
        }

        .button { /* Changed from 'button' to '.button' to avoid conflicting with actual <button> tags */
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
            text-decoration: none; /* Remove underline for links */
            display: inline-block; /* Make links behave like block elements for padding */
        }

        .button:focus-visible {
            outline: 3px solid var(--green-accent);
            outline-offset: 2px;
        }

        .button.login {
            background-color: var(--text-light);
            box-shadow: 0 6px 12px rgba(230, 242, 230, 0.7);
        }

        .button.login:hover,
        .button.login:focus {
            background-color: var(--green-accent);
            color: var(--green-dark);
            box-shadow: 0 10px 20px rgba(97, 231, 134, 0.8);
            transform: translateY(-3px);
        }

        .button.register {
            background-color: transparent;
            color: var(--text-light);
            border: 2.5px solid var(--text-light);
            box-shadow: 0 0 0 transparent;
        }

        .button.register:hover,
        .button.register:focus {
            background-color: var(--text-light);
            color: var(--green-dark);
            box-shadow: 0 10px 20px rgba(230, 242, 230, 0.8);
            transform: translateY(-3px);
        }

        /* Responsive: stack buttons vertically on small screens */
        @media (max-width: 400px) {
            .button-group {
                flex-direction: column;
                gap: 16px;
            }

            .button {
                width: 100%;
                min-width: unset;
            }
        }

        /* Animation subtle fade-in */
        .container {
            opacity: 0;
            transform: translateY(24px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <main class="container" role="main" aria-label="Welcome page berita terkini">
        <h1>Selamat Datang di Situs Berita Terkini</h1>
        <p class="subtitle">Sumber terpercaya untuk berita terbaru dari berbagai kategori dan seluruh dunia.</p>

        <div class="button-group">
            <a href="{{ route('login') }}" class="button login" aria-label="Login ke akun Anda">Login</a>
            <a href="{{ route('register') }}" class="button register" aria-label="Buat akun baru">Register</a>
        </div>
    </main>
</body>
</html>
