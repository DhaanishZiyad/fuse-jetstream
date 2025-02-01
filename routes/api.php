<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Get all products
Route::get('/products', function () {
    return response()->json(Product::all(), 200);
});

// Get a single product by ID
Route::get('/products/{id}', function ($id) {
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json($product, 200);
});

// Create a new product
Route::post('/products', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'old_price' => 'nullable|numeric|min:0',
        'current_price' => 'required|numeric|min:0',
        'image_path' => 'nullable|string|max:255',
    ]);

    $product = Product::create($validated);

    return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
});

// Update an existing product
Route::put('/products/{id}', function (Request $request, $id) {
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $validated = $request->validate([
        'name' => 'nullable|string|max:255',
        'old_price' => 'nullable|numeric|min:0',
        'current_price' => 'nullable|numeric|min:0',
        'image_path' => 'nullable|string|max:255',
    ]);

    $product->update($validated);

    return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
});

// Delete a product
Route::delete('/products/{id}', function ($id) {
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully'], 200);
});
