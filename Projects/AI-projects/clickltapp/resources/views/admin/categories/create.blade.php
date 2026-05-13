@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.categories.index') }}" class="p-2 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-gray-900 transition shadow-sm">
        <i class="bi bi-arrow-left text-xl"></i>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Add New Category</h2>
        <p class="text-gray-500 mt-1 font-medium">Create a new category for your products.</p>
    </div>
</div>

<div class="max-w-2xl bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-8">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                placeholder="e.g. Fruits & Vegetables">
            @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Category Image</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
            <p class="text-xs text-gray-400 font-medium mt-2">Recommended size: 512x512px. Max: 2MB.</p>
            @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full px-8 py-4 bg-green-500 text-white rounded-2xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center justify-center gap-2">
                <i class="bi bi-check-lg"></i> Create Category
            </button>
        </div>
    </form>
</div>
@endsection
