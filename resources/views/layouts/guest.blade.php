    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            /* Kontainer utama login */
            .login-container {
                width: 100%;
                max-width: 400px;
                margin: 40px auto;
                padding: 32px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                border: 1px solid #e5e7eb;
            }

            /* Label untuk input */
            .label {
                font-size: 0.875rem;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 8px;
            }

            /* Input teks */
            .input {
                display: block;
                width: 100%;
                padding: 12px;
                border: 1px solid #d1d5db;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                margin-bottom: 16px;
                font-size: 1rem;
            }

            .input:focus {
                border-color: #3b82f6;
                outline: none;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }

            /* Pesan error */
            .error-message {
                font-size: 0.875rem;
                color: #dc2626;
                margin-top: 4px;
            }

            /* Kotak Remember Me */
            .remember-me {
                display: flex;
                align-items: center;
                margin-bottom: 16px;
            }

            .checkbox {
                margin-right: 8px;
                accent-color: #6366f1;
            }

            /* Teks Remember Me */
            .remember-text {
                font-size: 0.875rem;
                color: #4b5563;
            }

            /* Tombol submit */
            .submit-btn-container {
                text-align: right;
            }

            .submit-btn {
                width: 100%;
                padding: 12px;
                background: linear-gradient(90deg, #3b82f6, #6366f1);
                color: white;
                font-weight: 600;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                transition: background 0.2s ease-in-out;
            }

            .submit-btn:hover {
                background: linear-gradient(90deg, #2563eb, #4f46e5);
            }

            .submit-btn:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }
            /* Wrapper utama */
.login-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-top: 1.5rem;
}

/* Kontainer Logo */
.logo-container {
    margin-bottom: 20px;
}

/* Gambar Logo */
.logo-image {
    width: 200px;
    height: 200px;
    margin-top: 20px;
}

/* Kontainer Form */
.form-container {
    width: 100%;
    max-width: 400px;
    margin-top: 24px;
}

        </style>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans" style="background: url('{{ asset('loginbg.jpg') }}');background-size: cover">
        <div class="login-wrapper">
            <div class="logo-container">
                <a href="/" wire:navigate>
                    <img src="{{ asset('icb.png') }}" alt="Logo" class="logo-image">
                </a>
            </div>
        
            <div class="form-container">
                {{ $slot }}
            </div>
        </div>
    </body>

    </html>
