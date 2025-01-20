<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel; // Alias the model
use App\Models\Product;

class ShoppingCart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->cartItems = auth()->user()->cartItems; // Adjust according to your application
        $this->calculateTotals();
    }

    public function updateQuantity($itemId, $quantity)
    {
        $item = $this->cartItems->find($itemId);
        $item->quantity = max(1, $quantity);
        $item->save();
        $this->calculateTotals();
    }

    public function removeItem($itemId)
    {
        $this->cartItems = $this->cartItems->filter(fn($item) => $item->id !== $itemId);
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->current_price;
        });

        $this->shipping = $this->subtotal > 5000 ? 0 : 500;
        $this->total = $this->subtotal + $this->shipping;
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}