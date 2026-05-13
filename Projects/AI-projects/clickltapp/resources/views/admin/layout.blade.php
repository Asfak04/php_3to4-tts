<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickIT - Administration Dashboard</title>
    
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
        .sidebar-link.active {
            background-color: #10b981;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50/50 antialiased text-gray-900 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-72 bg-white border-r border-gray-100 flex-shrink-0 hidden md:flex flex-col shadow-sm">
            <div class="p-8">
                <a href="{{ url('/') }}" class="group">
                    <h1 class="text-3xl font-black tracking-tighter text-gray-900 group-hover:scale-105 transition duration-300">
                        Click<span class="text-green-600">IT</span>
                    </h1>
                </a>
                <p class="text-[10px] font-black text-gray-400 mt-2 tracking-widest uppercase italic">Master Control</p>
            </div>
            
            <nav class="flex-1 px-6 space-y-3 overflow-y-auto pb-10">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-5 py-3.5 rounded-2xl transition font-bold text-sm {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-500 hover:bg-gray-50 hover:text-green-600' }}">
                    <i class="bi bi-speedometer2 text-lg"></i> Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3.5 rounded-2xl transition font-bold text-sm {{ request()->routeIs('admin.categories.*') ? 'active' : 'text-gray-500 hover:bg-gray-50 hover:text-green-600' }}">
                    <i class="bi bi-grid text-lg"></i> Categories
                </a>
                <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3.5 rounded-2xl transition font-bold text-sm {{ request()->routeIs('admin.products.*') ? 'active' : 'text-gray-500 hover:bg-gray-50 hover:text-green-600' }}">
                    <i class="bi bi-box-seam text-lg"></i> Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3.5 rounded-2xl transition font-bold text-sm {{ request()->routeIs('admin.orders.*') ? 'active' : 'text-gray-500 hover:bg-gray-50 hover:text-green-600' }}">
                    <i class="bi bi-bag-check text-lg"></i> Orders History
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3.5 rounded-2xl transition font-bold text-sm {{ request()->routeIs('admin.users.index') ? 'active' : 'text-gray-500 hover:bg-gray-50 hover:text-green-600' }}">
                    <i class="bi bi-people text-lg"></i> Customers List
                </a>
                
                <div class="pt-8 mt-8 border-t border-gray-50">
                    <h3 class="px-5 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic">Quick Actions</h3>
                    <a href="{{ url('/') }}" class="flex items-center gap-3 px-5 py-3.5 rounded-2xl text-gray-600 hover:bg-gray-50 hover:text-green-600 transition font-bold text-sm">
                        <i class="bi bi-arrow-up-right-circle"></i> Visit Store
                    </a>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?');">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-5 py-3.5 rounded-2xl text-red-500 hover:bg-red-50 transition font-bold text-sm">
                            <i class="bi bi-box-arrow-right"></i> System Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-gray-50/30">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 h-20 flex items-center justify-between px-10 flex-shrink-0 sticky top-0 z-10 shadow-sm">
                <button class="md:hidden p-3 rounded-xl bg-gray-50 text-gray-900 border border-transparent">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                
                <div class="flex items-center gap-6 ml-auto">
                    <div class="h-10 w-px bg-gray-100"></div>
                    <div class="flex flex-col items-end">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">System Admin</span>
                        <span class="font-black text-gray-900 tracking-tight">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Scrollable Section -->
            <main class="flex-1 overflow-y-auto p-10 lg:p-12">
                <div class="max-w-7xl mx-auto">
                    <!-- Session Feedback -->
                    @if(session('success'))
                        <div class="mb-10 bg-green-50 border border-green-100 p-6 rounded-3xl flex items-center gap-4 shadow-sm animate-in fade-in duration-500" role="alert">
                            <i class="bi bi-check2-circle text-2xl text-green-600"></i>
                            <div>
                                <p class="text-sm font-black text-green-900 uppercase tracking-tight">Success Captured</p>
                                <p class="text-sm text-green-700 font-medium mt-0.5 italic">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-10 bg-red-50 border border-red-100 p-6 rounded-3xl flex items-center gap-4 shadow-sm animate-in fade-in duration-500" role="alert">
                            <i class="bi bi-exclamation-circle text-2xl text-red-600"></i>
                            <div>
                                <p class="text-sm font-black text-red-900 uppercase tracking-tight">System Error</p>
                                <p class="text-sm text-red-700 font-medium mt-0.5 italic">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Sub-views Injection -->
                    @yield('admin_content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
