<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Club de Natación AquaVital</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --color-primary: #00B4D8;
            --color-primary-dark: #0096C7;
            --color-secondary: #0077B6;
            --color-dark: #03045E;
            --color-light: #CAF0F8;
            --color-black: #000000;
            --color-white: #FFFFFF;
            --color-gray-100: #F8F9FA;
            --color-gray-200: #E9ECEF;
            --color-gray-300: #DEE2E6;
            --color-gray-400: #CED4DA;
            --color-gray-500: #ADB5BD;
            --color-gray-600: #6C757D;
            --color-gray-700: #495057;
            --color-gray-800: #343A40;
            --color-gray-900: #212529;
            
            --font-sans: 'Montserrat', system-ui, -apple-system, sans-serif;
            --font-serif: 'Playfair Display', Georgia, serif;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--color-black);
            color: var(--color-white);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .wave-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%2300b4d8"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%2300b4d8"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%2300b4d8"></path></svg>');
            background-size: cover;
            z-index: 0;
        }

        .pool-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(0, 180, 216, 0.1) 0%, rgba(0, 0, 0, 0.9) 70%);
            z-index: -1;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            padding: 1rem 0;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }

        .logo {
            display: flex;
            align-items: center;
            font-family: var(--font-serif);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .logo-icon {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.5rem;
        }

        .auth-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            position: relative;
        }

        .auth-card {
            width: 100%;
            max-width: 28rem;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 0 0 1px rgba(255, 250, 237, 0.1);
            position: relative;
            z-index: 1;
        }

        .auth-title {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--color-white);
            text-align: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-2px);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--color-gray-300);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.25rem;
            color: var(--color-white);
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .text-red-400 {
            color: #f87171;
        }

        .border-red-500 {
            border-color: #ef4444;
        }

        .form-checkbox {
            width: 1rem;
            height: 1rem;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: 1px solid var(--color-gray-400);
            border-radius: 0.25rem;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-checkbox:checked {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 60%;
        }

        .focus-ring-primary:focus {
            box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.3);
        }

        .w-full {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .ml-2 {
            margin-left: 0.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
        }

        @media (min-width: 640px) {
            .container {
                max-width: 640px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 768px;
            }
        }

        @media (min-width: 1024px) {
            .container {
                max-width: 1024px;
            }
        }

        @media (min-width: 1280px) {
            .container {
                max-width: 1280px;
            }
        }

        .hidden {
            display: none;
        }

        @media (min-width: 768px) {
            .md\:flex {
                display: flex;
            }
        }

        .justify-between {
            justify-content: space-between;
        }

        .transition {
            transition-property: color, background-color, border-color, transform, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        .hover\:text-primary:hover {
            color: var(--color-primary);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container flex justify-between items-center">
            <a href="/" class="logo">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M8 16L12 12L16 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M16 16L12 12L8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span>Aqua<span class="text-primary">Vital</span></span>
            </a>
            
            <nav class="hidden md:flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-white hover:text-primary transition">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                @endif
            </nav>
            
            <button class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </header>

    <main>
        <div class="auth-container">
            <div class="pool-effect"></div>
            <div class="auth-card">
                <h1 class="auth-title">Iniciar Sesión</h1>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="text-red-400 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="text-red-400 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group flex items-center">
                        <input class="form-checkbox rounded border-gray-300 text-primary focus-ring-primary" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-label ml-2" for="remember">
                            Recordarme
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-full">
                            Iniciar Sesión
                        </button>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-4">
                                <a class="text-primary hover:text-primary-dark text-sm" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif
                    </div>

                    @if (Route::has('register'))
                        <div class="text-center mt-6">
                            <p class="text-gray-400 text-sm">¿No tienes una cuenta?
                                <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark font-medium">
                                    Regístrate
                                </a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="wave-bg"></div>
    </main>
</body>
</html>
