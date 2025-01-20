<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Get all products
Route::get('/products', function () {
    return response()->json(Product::all(), 200);
})->middleware('auth:sanctum');

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



Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user,
    ], 200);
});