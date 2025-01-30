<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistToggle extends Component
{
    public $product;
    public $isWishlisted;

    public function mount($product)
    {
        $this->product = $product;
        $this->isWishlisted = $this->checkIfWishlisted();
    }

    public function checkIfWishlisted()
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->exists();
        }
        return false;
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login');
        }

        if ($this->isWishlisted) {
            // Remove from wishlist
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->delete();
            $this->isWishlisted = false;
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
            ]);
            $this->isWishlisted = true;
        }

        // Notify wishlist component to refresh
        $this->dispatch('wishlistUpdated');
    }

    public function render()
    {
        return view('livewire.wishlist-toggle');
    }
}
