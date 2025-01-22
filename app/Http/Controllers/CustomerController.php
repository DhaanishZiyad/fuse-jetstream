<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CustomerController extends Controller
{
    public function index()
    {
        // Retrieve the latest products from the database, limiting to the ones you need
        $products = Product::latest()->take(4)->get();

        // Pass the products to the view
        return view('customer.dashboard', compact('products'));
    }

    public function allProducts()
    {
        // Retrieve all products from the database
        $products = Product::all();

        // Pass all products to the all-products view
        return view('customer.all-products', compact('products'));
    }

    public function productDetail($id)
    {
        // Find the product by ID or return a 404 error
        $product = Product::findOrFail($id);

        // Pass the product to the product-detail view
        return view('customer.product-detail', compact('product'));
    }

    public function showCart()
    {
        // Retrieve cart items for the logged-in user
        $cartItems = Cart::where('customer_id', Auth::id())->with('product')->get();

        // Calculate subtotal, shipping, and total
        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->current_price;
        });

        $shipping = 500;  // Example static shipping fee
        $total = $subtotal + $shipping;

        return view('customer.cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    // Add product to cart
    public function addToCart(Request $request)
    {
        // Validate the input data to ensure size, product_id, and quantity are provided
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];
        $size = $validated['size'];

        // Check if the product with the selected size is already in the cart
        $cartItem = Cart::where('customer_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->where('size', $size)
                        ->first();

        if ($cartItem) {
            // If the item is already in the cart, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Otherwise, create a new cart entry
            Cart::create([
                'customer_id' => Auth::id(),
                'product_id' => $product->id,
                'size' => $size,
                'quantity' => $quantity,
            ]);
        }

        // Redirect back to the cart page
        return redirect()->route('customer.show-cart')->with('success', 'Product added to cart');
    }



}
