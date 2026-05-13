@extends('layout')

@section('content')
<!-- ClickIT Hero Section -->
<section id="clickIt-banner" class="relative group overflow-hidden px-4 sm:px-6 py-6">
    <div class="max-w-7xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl shadow-green-100/50">
        <a href="{{ route('product') }}" class="block relative h-auto">
            <img src="{{ asset('user/images/banner.webp') }}" class="w-full object-cover transform transition-transform duration-1000 group-hover:scale-105" alt="ClickIT Hero Banner" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
        </a>
    </div>
</section>

<!-- Main Functional Grids -->
<section id="clickIt-content" class="max-w-7xl mx-auto px-4 sm:px-6 py-12 space-y-24">
    
    <!-- Promotion Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach(['babycare-WEB.avif', 'Pet-Care_WEB.avif', 'pharmacy-WEB.avif'] as $img)
            <div class="group rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                <a href="{{ route('product') }}">
                    <img src="{{ asset('user/images/'.$img) }}" class="w-full h-full object-cover" loading="lazy">
                </a>
            </div>
        @endforeach
    </div>

    <!-- Elegant Category Grid -->
    <div class="space-y-10">
        <div class="text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Shop by <span class="text-green-600">Category</span></h2>
            <p class="text-gray-400 font-medium mt-2 italic">Freshness delivered from every aisle.</p>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10 gap-6">
            @foreach($categories as $category)
                <div class="group">
                    <a href="{{ route('product', ['category_id' => $category->id]) }}" class="flex flex-col items-center gap-4">
                        <div class="w-20 h-20 bg-gray-50 rounded-3xl p-3 border border-gray-100 group-hover:bg-green-50 group-hover:border-green-100 group-hover:-translate-y-2 transition-all duration-300 shadow-sm group-hover:shadow-lg group-hover:shadow-green-100">
                            <img src="{{ asset($category->image) }}" class="w-full h-full object-contain" alt="{{ $category->name }}" loading="lazy">
                        </div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-center text-gray-400 group-hover:text-green-600 transition-colors truncate w-full">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Featured: New Arrivals -->
    @if(count($products) > 0)
    <div class="space-y-10">
        <div class="flex items-end justify-between px-2">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">New <span class="text-green-600">Arrivals</span></h2>
                <p class="text-gray-400 font-medium mt-2 italic">Newly harvested & arrived just now.</p>
            </div>
            <a href="{{ route('product') }}" class="text-xs font-black uppercase tracking-widest text-green-600 hover:text-green-700 transition flex items-center gap-2 group">
                See Everything <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach($products->take(6) as $product)
                <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <a href="{{ route('product.details', $product->id) }}" class="block">
                        <div class="aspect-square bg-gray-50 rounded-2xl p-4 mb-5 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-contain" alt="{{ $product->name }}" loading="lazy" />
                        </div>
                        <div class="flex items-center gap-1.5 mb-2">
                             <div class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></div>
                             <p class="text-[10px] font-black uppercase tracking-widest text-green-600">{{ $product->delivery_time ?? '8 Mins' }}</p>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm mb-1 truncate tracking-tight">{{ $product->name }}</h3>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 italic">{{ $product->unit }}</p>
                    </a>
                    
                    <div class="flex justify-between items-center bg-gray-50/50 p-2 rounded-2xl border border-gray-50">
                        <span class="font-black text-gray-900 pl-2">₹{{ number_format($product->price) }}</span>
                        <form action="{{ route('add.to.cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-10 h-10 bg-green-600 text-white rounded-xl flex items-center justify-center hover:bg-green-700 hover:scale-110 active:scale-95 transition-all shadow-md shadow-green-100">
                                <i class="bi bi-plus-lg text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Category Sections -->
    @foreach($categories as $category)
        @if($category->products->count() > 0)
        <div class="space-y-10">
            <div class="flex items-end justify-between px-2 border-l-4 border-green-500 pl-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ $category->name }}</h2>
                    <p class="text-gray-400 font-medium mt-1 italic">Handpicked from this section.</p>
                </div>
                <a href="{{ route('product', ['category_id' => $category->id]) }}" class="text-xs font-black uppercase tracking-widest text-green-600 hover:text-green-700 transition flex items-center gap-2 group">
                    See All <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach($category->products->take(6) as $product)
                    <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                        <a href="{{ route('product.details', $product->id) }}" class="block">
                            <div class="aspect-square bg-gray-50 rounded-2xl p-4 mb-5 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                <img src="{{ asset($product->image) }}" class="w-full h-full object-contain" alt="{{ $product->name }}" loading="lazy" />
                            </div>
                            <div class="flex items-center gap-1.5 mb-2">
                                 <div class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></div>
                                 <p class="text-[10px] font-black uppercase tracking-widest text-green-600">{{ $product->delivery_time ?? '8 Mins' }}</p>
                            </div>
                            <h3 class="font-black text-gray-900 text-sm mb-1 truncate tracking-tight">{{ $product->name }}</h3>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 italic">{{ $product->unit }}</p>
                        </a>
                        
                        <div class="flex justify-between items-center bg-gray-50/50 p-2 rounded-2xl border border-gray-50">
                            <span class="font-black text-gray-900 pl-2">₹{{ number_format($product->price) }}</span>
                            <form action="{{ route('add.to.cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-10 h-10 bg-green-600 text-white rounded-xl flex items-center justify-center hover:bg-green-700 hover:scale-110 active:scale-95 transition-all shadow-md shadow-green-100">
                                    <i class="bi bi-plus-lg text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach
</section>
@endsection

@section('google_translate')
<div class="col-span-2 md:col-span-1 mt-6 md:mt-0">
    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Google Translate</h3>
    <div id="google_translate_element"></div>
</div>
@endsection