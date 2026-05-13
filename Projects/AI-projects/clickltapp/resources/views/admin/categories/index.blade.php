@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Categories</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage your product categories here.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-2xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-100">
        <i class="bi bi-plus-lg"></i> Add New Category
    </a>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Image</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Name</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Products</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="h-12 w-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex items-center justify-center p-2">
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-contain">
                                @else
                                    <i class="bi bi-image text-gray-300 text-xl"></i>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-5 font-bold text-gray-900">{{ $category->name }}</td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-extrabold">{{ $category->products_count }}</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                        <td colspan="4" class="px-8 py-10 text-center text-gray-500 font-medium italic">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($categories->hasPages())
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
