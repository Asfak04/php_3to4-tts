@extends('layout')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    
    <!-- Search Results Header -->
    @if(request('search'))
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                Search Results for <span class="text-green-600">"{{ request('search') }}"</span>
            </h1>
            <p class="text-gray-400 font-medium mt-2 italic">{{ $products->total() }} items found matching your request.</p>
        </div>
    @endif

    <!-- Category Filter (Optional Enhancement) -->
    @if(!request('search'))
    <div class="flex flex-wrap gap-3 mb-12 justify-center">
        <a href="{{ route('product') }}" class="px-6 py-2.5 rounded-full text-xs font-bold transition-all border {{ !request('category_id') ? 'bg-green-600 text-white border-green-600 shadow-lg shadow-green-100' : 'bg-white text-gray-500 border-gray-100 hover:border-green-200 hover:text-green-600' }}">
            All Items
        </a>
        @foreach($categories as $category)
            <a href="{{ route('product', ['category_id' => $category->id]) }}" class="px-6 py-2.5 rounded-full text-xs font-bold transition-all border {{ request('category_id') == $category->id ? 'bg-green-600 text-white border-green-600 shadow-lg shadow-green-100' : 'bg-white text-gray-500 border-gray-100 hover:border-green-200 hover:text-green-600' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    @endif

    <!-- Product Grid -->
    @if(count($products) > 0)
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 transition-all duration-500">
            @foreach($products as $product)
                <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <a href="{{ route('product.details', $product->id) }}" class="block">
                        <div class="aspect-square bg-gray-50 rounded-2xl p-4 mb-5 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-contain" alt="{{ $product->name }}" loading="lazy" />
                        </div>
                        <div class="flex items-center gap-1.5 mb-2">
                             <div class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></div>
                             <p class="text-[10px] font-black uppercase tracking-widest text-green-600">{{ $product->delivery_time }} Delivery</p>
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

                    <!-- Discount Placeholder (Optional) -->
                    <div class="absolute top-4 left-4 bg-yellow-400 text-white text-[8px] font-black px-2 py-1 rounded-full uppercase tracking-tighter opacity-0 group-hover:opacity-100 transition-opacity">
                        Flash Sale
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-[3rem] border border-gray-100 shadow-sm">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="bi bi-search text-5xl text-gray-200"></i>
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">No Items Found</h2>
            <p class="text-gray-500 font-medium mt-3 italic mb-8">Try adjusting your search or category filters.</p>
            <a href="{{ route('product') }}" class="inline-flex items-center gap-2 text-green-600 font-black hover:text-green-700 decoration-2 transition">
                Clear Filters <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    @endif
</section>
@endsection