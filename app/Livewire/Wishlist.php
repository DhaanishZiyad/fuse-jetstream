<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Component
{
    public $products;

    protected $listeners = ['wishlistUpdated' => 'loadWishlist'];

    public function mount()
    {
        $this->loadWishlist();
    }

    public function loadWishlist()
    {
        $this->products = Auth::user()->wishlistProducts; // Assuming a relationship exists
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}