<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel; // Alias the model
use App\Models\Product;
use Illuminate\Support\Collection;

class ShoppingCart extends Component
{
    public $cartItems; // If using Collection
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
{
    $this->cartItems = collect();

    if (auth()->check()) {
        $this->cartItems = CartModel::with('product')
            ->where('customer_id', auth()->id())
            ->get();
    }

    $this->calculateTotals();
}

public function updateQuantity($itemId, $quantity)
{
    // Find the item in the database
    $item = CartModel::find($itemId);

    if ($item) {
        // Ensure the quantity is at least 1
        $item->quantity = max(1, $quantity);
        $item->save(); // Persist changes to the database
    }

    // Refresh cart items to reflect updated quantities
    $this->cartItems = CartModel::with('product')
        ->where('customer_id', auth()->id())
        ->get();

    // Recalculate totals after updating quantities
    $this->calculateTotals();
}

public function removeItem($itemId)
{
    CartModel::where('id', $itemId)->delete();

    // Refresh the cart items collection to reflect the changes
    $this->cartItems = $this->cartItems->reject(fn($item) => $item->id === $itemId);

    // Recalculate totals
    $this->calculateTotals();

    session()->flash('success', 'Item removed successfully!');
}

public function calculateTotals()
{
    $this->subtotal = $this->cartItems->sum(function ($item) {
        return $item->quantity * $item->product->current_price;
    });

    $this->shipping = 500;

    $this->total = $this->subtotal + $this->shipping;
}

public function render()
{
    return view('livewire.cart-component', [
        'cartItems' => $this->cartItems,
        'subtotal' => $this->subtotal,
        'shipping' => $this->shipping,
        'total' => $this->total,
    ]);
}
}