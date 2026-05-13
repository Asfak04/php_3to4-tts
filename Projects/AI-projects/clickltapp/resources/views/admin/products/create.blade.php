@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.products.index') }}" class="p-2 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-gray-900 transition shadow-sm">
        <i class="bi bi-arrow-left text-xl"></i>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Add New Product</h2>
        <p class="text-gray-500 mt-1 font-medium">Add a new item to your inventory.</p>
    </div>
</div>

<div class="max-w-4xl bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-8">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @csrf
        
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                    placeholder="e.g. Fresh Apples">
                @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Category</label>
                <select name="category_id" id="category_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Price (₹)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="0.00">
                    @error('price') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="unit" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Unit</label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="e.g. 1 kg">
                    @error('unit') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="delivery_time" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Delivery Time</label>
                    <input type="text" name="delivery_time" id="delivery_time" value="{{ old('delivery_time') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="e.g. 8 mins">
                    @error('delivery_time') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="stock_quantity" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', 0) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="0">
                    @error('stock_quantity') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <label for="image" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Main Product Image</label>
                <input type="file" name="image" id="image" accept="image/*" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
                @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="images" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Gallery Images (Multiple)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
                <p class="text-xs text-gray-400 font-medium mt-1 italic">You can select multiple files at once.</p>
                @error('images.*') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Description</label>
                <textarea name="description" id="description" rows="5"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                    placeholder="Describe the product...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="md:col-span-2 pt-4">
            <button type="submit" class="w-full px-8 py-4 bg-green-500 text-white rounded-2xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center justify-center gap-2">
                <i class="bi bi-check-lg"></i> Create Product
            </button>
        </div>
    </form>
</div>
@endsection
