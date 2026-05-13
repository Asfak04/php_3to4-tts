@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.products.index') }}" class="p-2 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-gray-900 transition shadow-sm">
        <i class="bi bi-arrow-left text-xl"></i>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Product</h2>
        <p class="text-gray-500 mt-1 font-medium">Update details for "{{ $product->name }}".</p>
    </div>
</div>

<div class="max-w-4xl bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-8">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @csrf
        @method('PATCH')
        
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
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
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Price (₹)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="0.00">
                    @error('price') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="unit" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Unit</label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit', $product->unit) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="e.g. 1 kg">
                    @error('unit') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="delivery_time" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Delivery Time</label>
                    <input type="text" name="delivery_time" id="delivery_time" value="{{ old('delivery_time', $product->delivery_time) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="e.g. 8 mins">
                    @error('delivery_time') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="stock_quantity" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                        placeholder="0">
                    @error('stock_quantity') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <label for="image" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Main Product Image</label>
                @if($product->image)
                    <div class="mb-4 h-32 w-32 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 p-2">
                        <img src="{{ asset($product->image) }}" class="h-full w-full object-contain">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
                <p class="text-xs text-gray-400 font-medium mt-2 italic">Leave blank to keep existing main image.</p>
                @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="images" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Add More Gallery Images</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
                @error('images.*') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="md:col-span-2">
             <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-4">Current Gallery Images</label>
             <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                 @forelse($product->images as $galleryImg)
                    <div class="relative group aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 p-2">
                        <img src="{{ asset($galleryImg->image_path) }}" class="h-full w-full object-contain">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <form action="{{ route('admin.products.deleteImage', $galleryImg) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition shadow-lg">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                 @empty
                    <p class="col-span-full text-sm text-gray-400 italic font-medium">No additional images in gallery.</p>
                 @endforelse
             </div>
        </div>

        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Description</label>
            <textarea name="description" id="description" rows="5"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium"
                placeholder="Describe the product...">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2 pt-4">
            <button type="submit" class="w-full px-8 py-4 bg-green-500 text-white rounded-2xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center justify-center gap-2">
                <i class="bi bi-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
