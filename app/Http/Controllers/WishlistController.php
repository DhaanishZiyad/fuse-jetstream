<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        // Get the authenticated user's wishlist items
        $wishlistItems = Wishlist::where('user_id', auth()->id())->pluck('product_id');

        // Fetch the products that are in the wishlist
        $products = Product::whereIn('id', $wishlistItems)->get();

        return view('customer.wishlist', compact('products'));
    }
}
