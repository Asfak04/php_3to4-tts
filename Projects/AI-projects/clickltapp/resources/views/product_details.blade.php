@extends('layout')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12 md:py-20 animate-in fade-in slide-in-from-bottom duration-700">
    
    <!-- Breadcrumb -->
    <nav class="flex mb-10 text-xs font-black uppercase tracking-widest text-gray-400 gap-3 items-center overflow-x-auto whitespace-nowrap pb-2 md:pb-0">
        <a href="/" class="hover:text-green-600 transition">Home</a>
        <i class="bi bi-chevron-right text-[8px]"></i>
        <a href="{{ route('product', ['category_id' => $product->category->id]) }}" class="hover:text-green-600 transition">{{ $product->category->name }}</a>
        <i class="bi bi-chevron-right text-[8px]"></i>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">
        
        <!-- LEFT: Premium Gallery -->
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-[3rem] p-10 border border-gray-100 flex items-center justify-center h-[400px] md:h-[600px] group relative overflow-hidden shadow-sm">
                <img id="main-image" src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full object-contain transform transition-transform duration-700 group-hover:scale-110" loading="eager">
                
                <!-- Badge Overlay -->
                <div class="absolute top-8 left-8 flex flex-col gap-3">
                    <span class="bg-green-600 text-white text-[10px] font-black py-2 px-4 rounded-full uppercase tracking-widest shadow-lg shadow-green-100">Fresh Stock</span>
                    @if($product->stock_quantity < 10 && $product->stock_quantity > 0)
                        <span class="bg-red-500 text-white text-[10px] font-black py-2 px-4 rounded-full uppercase tracking-widest shadow-lg shadow-red-100 italic">Limited: Only {{ $product->stock_quantity }} Left</span>
                    @endif
                </div>
            </div>

            <!-- Enhanced Thumbnails -->
            <div class="flex gap-4 p-2 overflow-x-auto no-scrollbar justify-center">
                <button onclick="document.getElementById('main-image').src = this.querySelector('img').src" class="w-20 h-20 bg-white rounded-2xl p-2 border-2 border-green-500 shadow-sm hover:shadow-lg transition-all flex-shrink-0 group">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                </button>
                @foreach($product->images as $galleryImg)
                    <button onclick="document.getElementById('main-image').src = this.querySelector('img').src" class="w-20 h-20 bg-white rounded-2xl p-2 border border-gray-100 shadow-sm hover:border-green-500 transition-all flex-shrink-0 group">
                        <img src="{{ asset($galleryImg->image_path) }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                    </button>
                @endforeach
            </div>
        </div>

        <!-- RIGHT: Product Details -->
        <div class="space-y-10">
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <div class="flex text-yellow-400 text-xs">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">4.8 (142 Reviews)</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight">{{ $product->name }}</h1>
                <p class="text-lg text-gray-500 font-medium italic leading-relaxed">{{ $product->description }}</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Unit Price</p>
                    <span class="text-4xl font-black text-green-600 tracking-tighter">₹{{ number_format($product->price) }}</span>
                </div>
                <div class="h-10 w-px bg-gray-100"></div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Availability</p>
                    <span class="text-xs font-black uppercase bg-gray-100 px-3 py-1 rounded-lg">{{ $product->unit }}</span>
                </div>
            </div>

            <!-- Delivery Promise -->
            <div class="bg-gray-900 text-white p-8 rounded-[2.5rem] flex items-center gap-6 shadow-2xl shadow-green-100 group">
                <div class="w-16 h-16 bg-green-500 rounded-3xl flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform duration-500 shadow-xl shadow-green-900/20">
                    🚀
                </div>
                <div>
                    <h4 class="text-lg font-black tracking-tight">Express Delivery in {{ $product->delivery_time ?? '8 Mins' }}</h4>
                    <p class="text-xs text-gray-400 font-medium italic">Your daily essentials, moving at the speed of ClickIT.</p>
                </div>
            </div>

            <!-- User Actions -->
            <form action="{{ route('add.to.cart') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex items-center bg-gray-100 rounded-2xl p-1 w-full sm:w-auto">
                        <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-green-600 transition"><i class="bi bi-dash-lg"></i></button>
                        <input type="number" name="quantity" value="1" min="1" max="100" class="w-16 bg-transparent border-none text-center font-black focus:ring-0 text-lg">
                        <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-green-600 transition"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    
                    <button type="submit" class="flex-grow bg-green-600 text-white rounded-2xl py-4 px-8 font-black text-lg uppercase tracking-widest shadow-xl shadow-green-100 hover:bg-green-700 hover:-translate-y-1 transition-all duration-300">
                        Add to Cart <i class="bi bi-cart-plus ml-2 text-xl"></i>
                    </button>
                </div>
            </form>

            <!-- Highlights & Perks -->
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['bi-heart', 'Ethically Sourced'],
                    ['bi-shield-check', 'Quality Check'],
                    ['bi-recycle', 'Eco Friendly'],
                    ['bi-truck', 'No Minimum Order']
                ] as $perk)
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100/50">
                    <i class="bi {{ $perk[0] }} text-green-600 text-lg"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ $perk[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bottom Information Grid -->
    <div class="mt-32 grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="bg-white p-10 md:p-16 rounded-[4rem] border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
            <div class="relative space-y-6">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight border-l-4 border-green-500 pl-6">Deep Information</h2>
                <p class="text-gray-500 font-medium leading-relaxed italic text-lg">
                    This {{ $product->name }} is carefully selected for its freshness and quality. We partner with local distributors and farmers to ensure that every grain or gram meets our strict "Farm-to-Fork" criteria. No preservatives, no long storage times. Just pure freshness delivered to your doorstep.
                </p>
                <p class="text-gray-500 font-medium leading-relaxed italic text-lg">
                    Store in a cool, dry place. For perishables, please refrigerate immediately upon delivery to maximize shelf life.
                </p>
            </div>
        </div>

        <div class="bg-gray-900 text-white p-10 md:p-16 rounded-[4rem] shadow-2xl relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 text-[10rem] opacity-10 group-hover:rotate-12 transition-transform duration-700">🛒</div>
            <div class="relative space-y-10">
                <h2 class="text-3xl font-black tracking-tight border-l-4 border-green-500 pl-6">Why ClickIT?</h2>
                <div class="grid grid-cols-2 gap-10">
                    <div class="space-y-2">
                        <p class="text-3xl font-black text-green-500">8 <span class="text-xs uppercase tracking-widest">Minutes</span></p>
                        <p class="text-xs font-bold text-gray-400">Average delivery time. Fastest in the city.</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-black text-green-500">100% <span class="text-xs uppercase tracking-widest">Fresh</span></p>
                        <p class="text-xs font-bold text-gray-400">Guaranteed replacement if quality is not met.</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-black text-green-500">No <span class="text-xs uppercase tracking-widest">Minimum</span></p>
                        <p class="text-xs font-bold text-gray-400">Order a single biscuit or a whole month's supply.</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-3xl font-black text-green-500">Zero <span class="text-xs uppercase tracking-widest">Hassle</span></p>
                        <p class="text-xs font-bold text-gray-400">Instant returns right at your doorstep.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
