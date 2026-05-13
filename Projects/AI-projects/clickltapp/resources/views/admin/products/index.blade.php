@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Products</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage your product inventory here.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-2xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-100">
        <i class="bi bi-plus-lg"></i> Add New Product
    </a>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Product</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Category</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Unit</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Price</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex items-center justify-center p-2 flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain text-xs">
                                    @else
                                        <i class="bi bi-box text-gray-300 text-xl"></i>
                                    @endif
                                </div>
                                <div class="max-w-xs truncate">
                                    <p class="font-bold text-gray-900">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400 font-medium leading-normal mt-0.5 line-clamp-1 italic">{{ $product->description }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-bold uppercase tracking-widest">{{ $product->category->name }}</span>
                        </td>
                        <td class="px-8 py-5 text-center text-gray-500 font-bold text-sm">{{ $product->unit ?? '-' }}</td>
                        <td class="px-8 py-5 text-center font-extrabold text-gray-900">₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                        <i class="bi bi-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-gray-500 font-medium italic">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
