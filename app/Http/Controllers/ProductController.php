<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Retrieve all products
        return view('admin.all-products', compact('products'));
    }

    public function create()
    {
        return view('admin.add-product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'old_price' => 'nullable|numeric|min:0',
            'current_price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:5000', // Validate description
        ]);

        // Store the image in the 'public/images' directory and get the path
        $imagePath = $request->file('image')->store('images', 'public');

        // Create a new product
        Product::create([
            'name' => $validated['name'],
            'old_price' => $validated['old_price'],
            'current_price' => $validated['current_price'],
            'image_path' => $imagePath,
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.add-products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'old_price' => 'nullable|numeric|min:0',
            'current_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:5000', // Validate description
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image_path = $imagePath;
        }

        $product->update([
            'name' => $validated['name'],
            'old_price' => $validated['old_price'],
            'current_price' => $validated['current_price'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.all-products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.all-products')->with('success', 'Product deleted successfully!');
    }
}
