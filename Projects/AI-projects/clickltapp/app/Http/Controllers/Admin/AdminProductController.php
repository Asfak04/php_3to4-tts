<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'unit' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'stock_quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/'.$imageName;
        }

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time().'_'.rand(100, 999).'.'.$image->extension();
                $image->move(public_path('uploads/products/gallery'), $imageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/gallery/'.$imageName
                ]);
            }
        }

        return to_route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'unit' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'stock_quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/'.$imageName;
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time().'_'.rand(100, 999).'.'.$image->extension();
                $image->move(public_path('uploads/products/gallery'), $imageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/gallery/'.$imageName
                ]);
            }
        }

        return to_route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete main image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete gallery images
        foreach ($product->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
            $image->delete();
        }

        $product->delete();

        return to_route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage(ProductImage $image)
    {
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        $image->delete();

        return redirect()->back()->with('success', 'Additional image deleted successfully.');
    }
}
