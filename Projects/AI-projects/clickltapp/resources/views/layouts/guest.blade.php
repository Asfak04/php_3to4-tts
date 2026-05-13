<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ClickIT - Welcome to Instant Freshness</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- Tailwind JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="font-sans text-slate-900 antialiased bg-gray-50/30 overflow-x-hidden selection:bg-green-100 selection:text-green-900">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-green-50/50 via-white to-white">
        
        <!-- Premium Branding -->
        <div class="mb-12 group transition-all duration-500 hover:-translate-y-1">
            <a href="/">
                <h1 class="text-6xl font-black tracking-tighter flex items-center gap-1">
                    <span class="text-gray-900">Click</span><span class="text-green-600 italic">IT</span>
                </h1>
            </a>
            <div class="h-1.5 w-12 bg-yellow-400 rounded-full mt-2 mx-auto group-hover:w-24 transition-all duration-500"></div>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md bg-white p-10 rounded-[3rem] shadow-2xl border border-gray-100 relative overflow-hidden animate-in fade-in zoom-in duration-700">
            <!-- Decorative Accent -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            
            <div class="relative">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer Accent -->
        <div class="mt-12 text-center space-y-2 opacity-50">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Instant Freshness • 10-Min Delivery</p>
            <p class="text-[10px] font-black text-gray-300 italic">© {{ date('Y') }} ClickIT Inc. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
