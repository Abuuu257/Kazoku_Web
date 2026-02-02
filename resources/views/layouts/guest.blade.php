<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Kazoku Pet Store' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .auth-pattern {
            background-color: #faf8f5;
            background-image: 
                radial-gradient(at 40% 20%, rgba(212, 165, 116, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, rgba(212, 165, 116, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 50%, rgba(120, 53, 15, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 50%, rgba(120, 53, 15, 0.03) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(212, 165, 116, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 100%, rgba(212, 165, 116, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 0%, rgba(212, 165, 116, 0.05) 0px, transparent 50%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 1);
            border: 1px solid #e7e3dc;
        }
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(120, 53, 15, 0.08);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen auth-pattern flex flex-col items-center justify-center py-12 px-4 relative overflow-hidden">
        
        <div style="width: 100%; max-width: 440px; margin: 0 auto;" class="relative z-10">
            <!-- Logo -->
            <div class="text-center">
                <a href="/" class="inline-flex flex-col items-center group mb-4" style="text-decoration: none;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3 transition-transform group-hover:scale-105" style="width: 80px; height: 80px; object-fit: contain;">
                    <span class="text-3xl font-black tracking-tighter mb-0.5 transition-transform group-hover:scale-105" style="color: #78350f;">KAZOKU</span>
                    <span class="text-[10px] font-bold tracking-[0.4em] uppercase" style="color: #64748b;">Pet Store</span>
                </a>
            </div>

            <!-- Main Content Card -->
            <div class="glass-card rounded-[32px] shadow-2xl shadow-slate-200/40 p-6 sm:p-8">
                {{ $slot }}
            </div>

        </div>
    </div>

    </style>
</body>
</html>
