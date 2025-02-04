<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;
use App\Http\Controllers\AuthController;
use App\Models\Wishlist;

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

// Get all cart items for the authenticated user
// Route::get('/cart', function () {
//     $cartItems = Cart::where('customer_id', Auth::id())->with('product')->get();

//     // Calculate subtotal, shipping, and total
//     $subtotal = $cartItems->sum(function ($item) {
//         return $item->quantity * $item->product->current_price;
//     });

//     $shipping = 500;  // Example static shipping fee
//     $total = $subtotal + $shipping;

//     return response()->json([
//         'cart_items' => $cartItems,
//         'subtotal' => $subtotal,
//         'shipping' => $shipping,
//         'total' => $total
//     ], 200);
// })->middleware('auth:sanctum');

Route::get('/cart', function () {
    $cartItems = Cart::where('customer_id', Auth::id())
        ->with('product') // Ensure the product relationship exists
        ->get();

    // Calculate subtotal
    $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->current_price);

    $shipping = 500; // Static shipping fee
    $total = $subtotal + $shipping;

    return response()->json([
        'cart_items' => $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'product_image' => url('storage/' . $item->product->image_path),
                'current_price' => $item->product->current_price,
                'quantity' => $item->quantity,
                'size' => $item->size,  // Include size
            ];
        }),
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total
    ], 200);
})->middleware('auth:sanctum');


// // Add a product to the cart
Route::post('/cart', function (Request $request) {
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'size' => 'required|string',
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = Cart::where('customer_id', Auth::id())
        ->where('product_id', $validated['product_id'])
        ->where('size', $validated['size'])
        ->first();

    if ($cartItem) {
        // Update quantity if item exists
        $cartItem->quantity += $validated['quantity'];
        $cartItem->save();
    } else {
        // Add new item
        Cart::create([
            'customer_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'size' => $validated['size'],
            'quantity' => $validated['quantity'],
        ]);
    }

    return response()->json(['message' => 'Product added to cart'], 201);
})->middleware('auth:sanctum');

// Update cart item quantity
Route::put('/cart/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = Cart::where('customer_id', Auth::id())->find($id);

    if (!$cartItem) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    $cartItem->quantity = $validated['quantity'];
    $cartItem->save();

    return response()->json(['message' => 'Cart updated successfully'], 200);
})->middleware('auth:sanctum');

// Remove a single item from the cart
Route::delete('/cart/{id}', function ($id) {
    $cartItem = Cart::where('customer_id', Auth::id())->find($id);

    if (!$cartItem) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    $cartItem->delete();

    return response()->json(['message' => 'Item removed from cart'], 200);
})->middleware('auth:sanctum');

// Clear entire cart
Route::delete('/cart/clear', function () {
    Cart::where('customer_id', Auth::id())->delete();
    return response()->json(['message' => 'Cart cleared'], 200);
})->middleware('auth:sanctum');

// Get all wishlist items for the authenticated user
Route::get('/wishlist', function () {
    $wishlistItems = Wishlist::where('user_id', Auth::id())
        ->with('product') // Ensure the product relationship exists
        ->get();

    return response()->json($wishlistItems->map(function ($item) {
        return [
            'id' => $item->id,
            'product_name' => $item->product->name,
            'product_image' => url('storage/' . $item->product->image_path),
            'old_price' => $item->product->old_price,
            'current_price' => $item->product->current_price,
        ];
    }), 200);
})->middleware('auth:sanctum');

// Add a product to the wishlist
Route::post('/wishlist', function (Request $request) {
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $wishlistItem = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $validated['product_id'])
        ->first();

    if ($wishlistItem) {
        return response()->json(['message' => 'Product already in wishlist'], 409);
    }

    Wishlist::create([
        'user_id' => Auth::id(),
        'product_id' => $validated['product_id'],
    ]);

    return response()->json(['message' => 'Product added to wishlist'], 201);
})->middleware('auth:sanctum');

// Remove a single item from the wishlist
Route::delete('/wishlist/{id}', function ($id) {
    $wishlistItem = Wishlist::where('customer_id', Auth::id())->find($id);

    if (!$wishlistItem) {
        return response()->json(['message' => 'Wishlist item not found'], 404);
    }

    $wishlistItem->delete();

    return response()->json(['message' => 'Item removed from wishlist'], 200);
})->middleware('auth:sanctum');

// Clear entire wishlist
Route::delete('/wishlist/clear', function () {
    Wishlist::where('customer_id', Auth::id())->delete();
    return response()->json(['message' => 'Wishlist cleared'], 200);
})->middleware('auth:sanctum');