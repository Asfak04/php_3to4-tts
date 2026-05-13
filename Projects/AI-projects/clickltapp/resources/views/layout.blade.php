<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ClickIT - Freshness Delivered in Minutes</title>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- Tailwind JS & Elements -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #059669; }
    </style>
</head>

<body class="bg-white text-slate-900 antialiased overflow-x-hidden selection:bg-green-100 selection:text-green-900">
    <!-- ClickIT Glass Header -->
    <header id="clickIt-header" class="sticky top-0 z-50 glass-header border-b border-gray-100/50 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between py-4 gap-6">
                
                <!-- LOGO -->
                <div class="flex-shrink-0 group">
                    <a href="/" class="flex items-center">
                        <span class="text-4xl font-black tracking-tighter text-green-600 transition group-hover:scale-105 duration-300">
                            Click<span class="text-yellow-500">IT</span>
                        </span>
                    </a>
                </div>

                <!-- SEARCH (DESKTOP) -->
                <div class="hidden md:flex flex-grow max-w-2xl">
                    <form action="{{ route('product') }}" method="GET" class="w-full relative group">
                        <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-green-500"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search fresh groceries, dairy and more..."
                            class="w-full bg-gray-50 border border-gray-100 rounded-full pl-14 pr-6 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 bg-white transition-all duration-300 shadow-sm hover:shadow-md" />
                    </form>
                </div>

                <!-- ACTIONS (DESKTOP) -->
                <div class="hidden md:flex items-center gap-6">
                    @auth
                        <div class="flex items-center gap-2">
                             @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="p-2.5 rounded-xl bg-green-50 text-green-700 hover:bg-green-100 transition shadow-sm" title="Admin Dashboard">
                                    <i class="bi bi-speedometer2 text-lg"></i>
                                </a>
                             @endif
                             <a href="{{ route('orders') }}" class="p-2.5 rounded-xl bg-gray-50 text-gray-700 hover:bg-gray-100 transition shadow-sm" title="My Orders">
                                <i class="bi bi-bag-check text-lg"></i>
                             </a>
                             <div class="h-8 w-px bg-gray-100 mx-1"></div>
                             <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?');">
                                @csrf
                                <button type="submit" class="p-2.5 rounded-xl text-red-500 hover:bg-red-50 transition" title="Logout">
                                    <i class="bi bi-box-arrow-right text-lg"></i>
                                </button>
                             </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-900 hover:text-green-600 transition tracking-wide">
                            Login
                        </a>
                    @endauth

                    <a href="{{ route('cart') }}" class="flex items-center gap-3 bg-gray-900 text-white pl-5 pr-2 py-2 rounded-full font-bold text-sm hover:bg-black transition-all duration-300 shadow-lg shadow-gray-200 group">
                        <span>Cart</span>
                        <div class="bg-green-500 text-white w-7 h-7 rounded-full flex items-center justify-center group-hover:scale-110 transition duration-300">
                            {{ count(Session::get('cart', [])) }}
                        </div>
                    </a>
                </div>

                <!-- MOBILE ACTIONS & TOGGLE -->
                <div class="flex md:hidden items-center gap-2">
                    <a href="{{ route('cart') }}" class="relative p-2.5 rounded-xl bg-gray-900 text-white shadow-md hover:scale-105 active:scale-95 transition-all">
                        <i class="bi bi-cart3 text-xl"></i>
                        <span class="absolute -top-1.5 -right-1.5 bg-green-500 text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white">
                            {{ count(Session::get('cart', [])) }}
                        </span>
                    </a>
                    
                    <button
                        id="menu-btn"
                        class="p-2.5 rounded-xl bg-gray-50 text-gray-900 transition hover:bg-gray-100 border border-gray-100"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobile-menu" class="hidden md:hidden animate-in slide-in-from-top duration-300 bg-white border-t border-gray-50 p-6 space-y-6">
            <form action="{{ route('product') }}" method="GET" class="relative">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input
                    type="text"
                    name="search"
                    placeholder="Search products..."
                    class="w-full bg-gray-50 border border-transparent rounded-2xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-green-500" />
            </form>

            <div class="grid grid-cols-2 gap-4">
                @auth
                    <a href="{{ route('orders') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-2xl gap-2 font-bold text-sm">
                        <i class="bi bi-bag-check text-green-600 text-xl"></i> My Orders
                    </a>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?');" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex flex-col items-center justify-center p-4 bg-red-50 rounded-2xl gap-2 font-bold text-sm text-red-600">
                            <i class="bi bi-box-arrow-right text-xl"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="col-span-2 text-center p-4 bg-green-600 text-white rounded-2xl font-black uppercase tracking-widest">
                        Login
                    </a>
                @endauth
            </div>
            
            <a href="{{ route('cart') }}" class="flex items-center justify-center gap-3 p-4 bg-gray-900 text-white rounded-2xl font-black">
                <i class="bi bi-cart3"></i> View Cart ({{ count(Session::get('cart', [])) }})
            </a>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-6 animate-in fade-in duration-500">
            <div class="bg-green-50 border border-green-100 text-green-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm" role="alert">
                <i class="bi bi-check2-circle text-xl"></i>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-6 animate-in fade-in duration-500">
            <div class="bg-red-50 border border-red-100 text-red-800 p-4 rounded-2xl flex items-center gap-3 shadow-sm" role="alert">
                <i class="bi bi-exclamation-circle text-xl"></i>
                <p class="font-bold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif
   
    <!-- CONTENT -->
    <main class="min-h-screen relative">
        @yield('content')    
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-50 border-t border-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-24 mb-16">
                
                <div class="md:col-span-1">
                    <span class="text-3xl font-black text-gray-900 tracking-tighter mb-6 block">
                        Click<span class="text-green-600">IT</span>
                    </span>
                    <p class="text-sm text-gray-500 leading-relaxed font-medium mb-8">
                        Everything you need, delivered in minutes. Our mission is to make fresh, high-quality groceries accessible to everyone, instantly.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-green-600 hover:text-white transition-all"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-green-600 hover:text-white transition-all"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-8 md:col-span-3">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Explore</h3>
                        <ul class="space-y-4 text-sm font-bold text-gray-600">
                            <li><a href="/about" class="hover:text-green-600 transition">About Us</a></li>
                            <li><a href="/career" class="hover:text-green-600 transition">Careers</a></li>
                            <li><a href="/faq" class="hover:text-green-600 transition">FAQs</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Legals</h3>
                        <ul class="space-y-4 text-sm font-bold text-gray-600">
                            <li><a href="/privacy" class="hover:text-green-600 transition">Privacy Policy</a></li>
                            <li><a href="/terms" class="hover:text-green-600 transition">Terms of Service</a></li>
                        </ul>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Our App</h3>
                        <div class="space-y-3">
                            <button class="w-full bg-black text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition duration-300">App Store</button>
                            <button class="w-full bg-black text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition duration-300">Play Store</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-black text-gray-400 uppercase tracking-widest">
                <p>&copy; 2026 ClickIT App. All rights reserved.</p>
                <p>Made with ❤️ for you</p>
            </div>
        </div>

        <!-- WhatsApp Float -->
        <a href="https://wa.me/+919998003879" target="_blank" class="fixed bottom-8 right-8 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-all z-50 animate-bounce">
            <i class="bi bi-whatsapp text-2xl"></i>
        </a>
    </footer>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: '',
                    layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                },
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>